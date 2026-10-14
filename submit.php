<?php
/**
 * OSCloud — formulář „Chci se připojit“
 *
 * GET  submit.php?token=1  -> {"token": "..."}      podepsaný token (CSRF + minimální čas vyplnění)
 * POST submit.php          -> {"ok": true|false, …} validace, honeypot, rate limit, e-mail na info@oscloud.cz
 *
 * Konfigurace: config.php vedle tohoto souboru (viz config.sample.php).
 * Běží na stejném hostingu jako web (Cloudron LAMP), vedle index.html.
 */
declare(strict_types=1);

ini_set('display_errors', '0');
mb_internal_encoding('UTF-8');

const SERVICES = [
    'free'      => 'Zdarma: komunitní služby a Nextcloud 2 GB',
    'nextcloud' => 'Nextcloud, větší úložiště (placené)',
    'matrix'    => 'Matrix chat (mxchat.cz)',
    'other'     => 'Něco jiného',
];
const STORAGE = ['50' => '50 GB', '100' => '100 GB', '200' => '200 GB', '500' => '500 GB', '1000' => '1 TB'];
const PLANS = ['spolek' => 'Spolek', 'firma' => 'Firma'];
const PERIODS = ['monthly' => 'měsíčně', 'yearly' => 'ročně'];

// ---------------------------------------------------------------- config

function load_config(): array
{
    $cfg = [
        'secret'          => '',
        'mail_to'         => 'fediverse@oscloud.cz', // schránka, kterou čte FreeScout
        'mail_from'       => '',   // prázdné = CLOUDRON_MAIL_FROM, jinak noreply@oscloud.cz
        'allowed_origins' => ['https://oscloud.cz', 'https://www.oscloud.cz'],
        'trust_proxy'     => true, // za reverzní proxy (Cloudron) bereme poslední X-Forwarded-For
        'data_dir'        => null, // úložiště rate limitu; null = vedle webrootu
        'dry_run_dir'     => null, // pro testy: místo mail() zapíše e-mail do souboru
        'min_fill_secs'   => 3,
        'token_ttl_secs'  => 7200,
        'limit_attempts'  => [3600 => 30],             // všechny POSTy po ověření tokenu / IP
        'limit_ip'        => [3600 => 3, 86400 => 10], // odeslané žádosti / IP
        'limit_global'    => [86400 => 60],            // odeslané žádosti celkem
        'limit_email'     => [3600 => 1, 86400 => 3],  // odeslané žádosti / e-mailová adresa
    ];

    $file = __DIR__ . '/config.php';
    if (is_file($file)) {
        $user = require $file;
        if (is_array($user)) {
            $cfg = array_replace($cfg, $user);
        }
    }
    $envSecret = getenv('OSCLOUD_FORM_SECRET');
    if ($envSecret) {
        $cfg['secret'] = $envSecret;
    }
    if ($cfg['mail_from'] === '') {
        $cfg['mail_from'] = getenv('CLOUDRON_MAIL_FROM') ?: 'noreply@oscloud.cz';
    }
    return $cfg;
}

// ---------------------------------------------------------------- helpers

function respond(int $status, array $body): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($body, JSON_UNESCAPED_UNICODE);
    exit;
}

function fail(int $status, string $msg): never
{
    respond($status, ['ok' => false, 'error' => $msg]);
}

function client_ip(array $cfg): string
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    if ($cfg['trust_proxy'] && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $parts = array_map('trim', explode(',', (string) $_SERVER['HTTP_X_FORWARDED_FOR']));
        $last = end($parts);
        if ($last !== false && filter_var($last, FILTER_VALIDATE_IP)) {
            $ip = $last;
        }
    }
    return $ip;
}

function data_dir(array $cfg): string
{
    $dir = $cfg['data_dir'] ?: dirname(__DIR__) . '/oscloud-forms-data';
    if (!is_dir($dir)) {
        @mkdir($dir, 0700, true);
    }
    if (!is_dir($dir) || !is_writable($dir)) {
        $dir = sys_get_temp_dir() . '/oscloud-forms-data';
        if (!is_dir($dir)) {
            @mkdir($dir, 0700, true);
        }
    }
    return $dir;
}

// ---------------------------------------------------------------- token (stateless HMAC)

function make_token(string $secret): string
{
    $payload = time() . '.' . bin2hex(random_bytes(6));
    return $payload . '.' . hash_hmac('sha256', $payload, $secret);
}

/** @return string|null kód chyby, null = OK */
function check_token(string $token, string $secret, int $minAge, int $maxAge): ?string
{
    $parts = explode('.', $token);
    if (count($parts) !== 3 || !ctype_digit($parts[0])) {
        return 'format';
    }
    $expected = hash_hmac('sha256', $parts[0] . '.' . $parts[1], $secret);
    if (!hash_equals($expected, $parts[2])) {
        return 'sig';
    }
    $age = time() - (int) $parts[0];
    if ($age < $minAge) {
        return 'young';
    }
    if ($age > $maxAge) {
        return 'old';
    }
    return null;
}

// ---------------------------------------------------------------- rate limit (soubor + flock)

/**
 * @param array<int,int> $limits  [okno_v_sekundách => max_počet]
 * @return bool true = povoleno (a zapsáno, pokud $record)
 */
function rate_limit(string $dir, string $key, array $limits, bool $record = true): bool
{
    $file = $dir . '/rl_' . hash('sha256', $key) . '.json';
    $fh = @fopen($file, 'c+');
    if (!$fh) {
        return true; // nechceme shodit formulář kvůli disku; limit je best-effort
    }
    flock($fh, LOCK_EX);
    $raw = stream_get_contents($fh);
    $hits = $raw ? json_decode($raw, true) : [];
    $hits = is_array($hits) ? $hits : [];

    $now = time();
    $longest = max(array_keys($limits));
    $hits = array_values(array_filter($hits, fn ($t) => is_int($t) && $t > $now - $longest));

    $allowed = true;
    foreach ($limits as $window => $max) {
        $count = count(array_filter($hits, fn ($t) => $t > $now - $window));
        if ($count >= $max) {
            $allowed = false;
            break;
        }
    }
    if ($allowed && $record) {
        $hits[] = $now;
    }
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, json_encode($hits));
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
    return $allowed;
}

function gc_rate_files(string $dir): void
{
    if (random_int(1, 100) !== 1) {
        return;
    }
    foreach (glob($dir . '/rl_*.json') ?: [] as $f) {
        if (filemtime($f) < time() - 2 * 86400) {
            @unlink($f);
        }
    }
}

// ---------------------------------------------------------------- input cleaning

function clean_line(string $s): string
{
    $s = preg_replace('/[\x00-\x1F\x7F]+/u', ' ', $s) ?? '';
    return trim(preg_replace('/\s{2,}/u', ' ', $s) ?? '');
}

function clean_text(string $s): string
{
    $s = str_replace(["\r\n", "\r"], "\n", $s);
    $s = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $s) ?? '';
    $s = preg_replace("/\n{3,}/", "\n\n", $s) ?? '';
    return trim($s);
}

function header_phrase(string $name): string
{
    $name = trim(str_replace(['"', '<', '>', ',', ';', ':', '\\', '(', ')', '@'], '', $name));
    if ($name === '') {
        return '';
    }
    return mb_encode_mimeheader($name, 'UTF-8', 'B', "\r\n");
}

/** Kontrola IČO (8 číslic + kontrolní číslice, modulo 11). */
function valid_ico(string $ico): bool
{
    if (!preg_match('/^\d{8}$/', $ico)) {
        return false;
    }
    $sum = 0;
    for ($i = 0; $i < 7; $i++) {
        $sum += (int) $ico[$i] * (8 - $i);
    }
    $r = $sum % 11;
    $c = $r === 0 ? 1 : ($r === 1 ? 0 : 11 - $r);
    return $c === (int) $ico[7];
}

// ---------------------------------------------------------------- mail

function send_mail(array $cfg, string $subject, string $replyName, string $email, array $fields, string $message, string $origin): bool
{
    $body  = "Nová žádost z webu oscloud.cz\n";
    $body .= "================================\n\n";
    foreach ($fields as $label => $value) {
        $body .= "{$label}: {$value}\n";
    }
    $body .= 'Odesláno: ' . date('Y-m-d H:i:s T') . "\n";
    $body .= 'Z webu: ' . ($origin !== '' ? $origin : '-') . "\n";
    $body .= "Souhlas s podmínkami a zásadami OÚ: ano\n\n";
    $body .= "Zpráva:\n";
    $body .= ($message !== '' ? $message : '(bez zprávy)') . "\n";

    $replyName = header_phrase($replyName);
    $replyTo = ($replyName !== '' ? $replyName . ' ' : '') . '<' . $email . '>';
    $fromName = mb_encode_mimeheader('OSCloud web', 'UTF-8', 'B', "\r\n");

    $headers = [
        'From: ' . $fromName . ' <' . $cfg['mail_from'] . '>',
        'Reply-To: ' . $replyTo,
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: base64',
        'X-OSCloud-Form: join',
        'Auto-Submitted: auto-generated',
    ];
    $encodedSubject = mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n");
    $encodedBody = chunk_split(base64_encode($body));

    if (!empty($cfg['dry_run_dir'])) {
        @mkdir($cfg['dry_run_dir'], 0700, true);
        $out = "To: {$cfg['mail_to']}\nSubject: {$encodedSubject}\n" . implode("\n", $headers) . "\n\n" . $body;
        return file_put_contents($cfg['dry_run_dir'] . '/mail_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . '.txt', $out) !== false;
    }

    // Cloudron: odesílání přes SMTP mail addon (v LAMP appce není sendmail)
    $smtpHost = getenv('CLOUDRON_MAIL_SMTP_SERVER');
    if ($smtpHost) {
        return smtp_send(
            $smtpHost,
            (int) (getenv('CLOUDRON_MAIL_SMTP_PORT') ?: 2525),
            (string) getenv('CLOUDRON_MAIL_SMTP_USERNAME'),
            (string) getenv('CLOUDRON_MAIL_SMTP_PASSWORD'),
            $cfg['mail_from'],
            $cfg['mail_to'],
            $encodedSubject,
            $headers,
            $encodedBody
        );
    }

    return mail($cfg['mail_to'], $encodedSubject, $encodedBody, implode("\r\n", $headers));
}

/** Minimální SMTP klient (AUTH PLAIN, bez TLS — interní síť Cloudronu). */
function smtp_send(string $host, int $port, string $user, string $pass, string $from, string $to, string $subject, array $headers, string $body): bool
{
    $fp = @stream_socket_client("tcp://{$host}:{$port}", $errno, $errstr, 10);
    if (!$fp) {
        error_log("oscloud-form: SMTP spojení selhalo: {$errstr}");
        return false;
    }
    stream_set_timeout($fp, 15);

    $read = function () use ($fp): string {
        $out = '';
        while (($line = fgets($fp, 515)) !== false) {
            $out .= $line;
            if (strlen($line) < 4 || $line[3] === ' ') {
                break;
            }
        }
        return $out;
    };
    $cmd = function (string $c, string $expect) use ($fp, $read): bool {
        fwrite($fp, $c . "\r\n");
        $r = $read();
        if (strpos($r, $expect) !== 0) {
            error_log('oscloud-form: SMTP ' . (strpos($c, 'AUTH') === 0 ? 'AUTH' : $c) . ' -> ' . trim($r));
            return false;
        }
        return true;
    };

    $ok = strpos($read(), '220') === 0
        && $cmd('EHLO oscloud.cz', '250')
        && ($user === '' || $cmd('AUTH PLAIN ' . base64_encode("\0{$user}\0{$pass}"), '235'))
        && $cmd("MAIL FROM:<{$from}>", '250')
        && $cmd("RCPT TO:<{$to}>", '250')
        && $cmd('DATA', '354');

    if ($ok) {
        $msg = 'To: ' . $to . "\r\n"
            . 'Subject: ' . $subject . "\r\n"
            . 'Date: ' . date('r') . "\r\n"
            . implode("\r\n", $headers) . "\r\n\r\n"
            . $body;
        $msg = preg_replace('/^\./m', '..', $msg); // dot-stuffing
        fwrite($fp, $msg . "\r\n.\r\n");
        $r = $read();
        $ok = strpos($r, '250') === 0;
        if (!$ok) {
            error_log('oscloud-form: SMTP DATA -> ' . trim($r));
        }
    }
    @fwrite($fp, "QUIT\r\n");
    fclose($fp);
    return $ok;
}

// ---------------------------------------------------------------- main

$cfg = load_config();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$originOk = $origin !== '' && in_array($origin, $cfg['allowed_origins'], true);

if ($originOk) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Vary: Origin');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 600');
}

if ($method === 'OPTIONS') {
    http_response_code($originOk ? 204 : 403);
    exit;
}

if (strlen($cfg['secret']) < 32) {
    error_log('oscloud-form: secret v config.php chybí nebo je kratší než 32 znaků');
    fail(500, 'Formulář není správně nastavený. Napiš nám prosím na info@oscloud.cz.');
}

if ($method === 'GET') {
    if (isset($_GET['token'])) {
        respond(200, ['token' => make_token($cfg['secret'])]);
    }
    fail(404, 'Nenalezeno.');
}

if ($method !== 'POST') {
    header('Allow: GET, POST, OPTIONS');
    fail(405, 'Metoda není povolená.');
}

// 1) původ požadavku (CSRF, vrstva 1)
if (!$originOk) {
    fail(403, 'Nepovolený původ požadavku.');
}

// 2) honeypot — bot dostane „úspěch“ a nic se neodešle
if (trim((string) ($_POST['website'] ?? '')) !== '') {
    respond(200, ['ok' => true, 'message' => 'Díky! Ozveme se ti na zadaný e-mail.']);
}

// 3) token (CSRF, vrstva 2 + minimální čas vyplnění)
$tokenErr = check_token((string) ($_POST['token'] ?? ''), $cfg['secret'], (int) $cfg['min_fill_secs'], (int) $cfg['token_ttl_secs']);
if ($tokenErr === 'young') {
    fail(429, 'Moc rychle — počkej pár vteřin a odešli to znovu.');
}
if ($tokenErr !== null) {
    fail(400, 'Platnost formuláře vypršela. Načti stránku znovu a zkus to ještě jednou.');
}

// 4) rate limit
$dir = data_dir($cfg);
gc_rate_files($dir);
$ip = client_ip($cfg);
if (!rate_limit($dir, 'attempt:' . $ip . $cfg['secret'], $cfg['limit_attempts'])) {
    fail(429, 'Příliš mnoho pokusů. Zkus to prosím později.');
}

// 5) validace
$type = (($_POST['type'] ?? 'individual') === 'org') ? 'org' : 'individual';
$name = clean_line((string) ($_POST['name'] ?? ''));
$email = clean_line((string) ($_POST['email'] ?? ''));
$message = clean_text((string) ($_POST['message'] ?? ''));
$post = fn (string $k): string => (string) ($_POST[$k] ?? '');

if ($name === '' || mb_strlen($name) > 80) {
    fail(422, $type === 'org'
        ? 'Vyplň prosím kontaktní osobu (max. 80 znaků).'
        : 'Vyplň prosím jméno nebo přezdívku (max. 80 znaků).');
}
if ($email === '' || mb_strlen($email) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    fail(422, 'Zkontroluj prosím e-mailovou adresu.');
}

$fields = [];
if ($type === 'individual') {
    $service = $post('service');
    if (!array_key_exists($service, SERVICES)) {
        fail(422, 'Vyber prosím službu.');
    }
    $fields['Typ žádosti'] = 'Jednotlivec';
    $fields['Jméno / přezdívka'] = $name;
    $fields['E-mail'] = $email;
    $fields['Služba'] = SERVICES[$service];
    if ($service === 'nextcloud') {
        $storage = $post('storage');
        $period = $post('period');
        if (!array_key_exists($storage, STORAGE)) {
            fail(422, 'Vyber prosím velikost úložiště.');
        }
        if (!array_key_exists($period, PERIODS)) {
            fail(422, 'Vyber prosím měsíční nebo roční platbu.');
        }
        $fields['Úložiště'] = STORAGE[$storage];
        $fields['Platba'] = PERIODS[$period];
    }
    $subject = 'Žádost (jednotlivec) — ' . $name;
} else {
    $orgName = clean_line($post('org_name'));
    $ico = preg_replace('/\s+/', '', clean_line($post('ico'))) ?? '';
    $address = clean_line($post('address'));
    $users = clean_line($post('users'));
    $plan = $post('plan');
    $storage = $post('storage');
    $period = $post('period');
    if ($orgName === '' || mb_strlen($orgName) > 120) {
        fail(422, 'Vyplň prosím název spolku nebo firmy (max. 120 znaků).');
    }
    if (!valid_ico($ico)) {
        fail(422, 'Zkontroluj prosím IČO (8 číslic).');
    }
    if ($address === '' || mb_strlen($address) > 200) {
        fail(422, 'Vyplň prosím fakturační adresu (max. 200 znaků).');
    }
    if ($users !== '' && !preg_match('/^\d{1,3}$/', $users)) {
        fail(422, 'Počet uživatelů má být číslo.');
    }
    if (!array_key_exists($plan, PLANS)) {
        fail(422, 'Vyber prosím tarif.');
    }
    if (!array_key_exists($storage, STORAGE)) {
        fail(422, 'Vyber prosím velikost úložiště.');
    }
    if (!array_key_exists($period, PERIODS)) {
        fail(422, 'Vyber prosím měsíční nebo roční platbu.');
    }
    $fields['Typ žádosti'] = 'Spolek nebo firma';
    $fields['Název'] = $orgName;
    $fields['IČO'] = $ico;
    $fields['Fakturační adresa'] = $address;
    $fields['Kontaktní osoba'] = $name;
    $fields['E-mail'] = $email;
    $fields['Tarif'] = PLANS[$plan];
    $fields['Úložiště'] = STORAGE[$storage];
    $fields['Platba'] = PERIODS[$period];
    $fields['Počet uživatelů'] = $users !== '' ? $users : '(neuvedeno)';
    $subject = 'Žádost (spolek/firma) — ' . $orgName;
}

if ($post('consent') !== '1') {
    fail(422, 'Potvrď prosím, že sis přečetl/a podmínky a zásady ochrany osobních údajů.');
}
if (mb_strlen($message) > 2000) {
    fail(422, 'Zpráva je moc dlouhá (max. 2000 znaků).');
}
if (preg_match_all('~https?://|www\.~i', $message) > 2) {
    fail(422, 'Zpráva obsahuje příliš mnoho odkazů.');
}

// 6) limit odeslaných žádostí (na IP + celkem)
if (
    !rate_limit($dir, 'ip:' . $ip . $cfg['secret'], $cfg['limit_ip'], false)
    || !rate_limit($dir, 'global', $cfg['limit_global'], false)
) {
    fail(429, 'Dnes už od tebe (nebo z tvé sítě) přišlo hodně žádostí. Zkus to prosím později, nebo napiš na info@oscloud.cz.');
}

// 6b) opakovaná žádost ze stejné e-mailové adresy (v souboru je jen hash, ne adresa)
$emailKey = 'mail:' . mb_strtolower($email) . $cfg['secret'];
if (!rate_limit($dir, $emailKey, $cfg['limit_email'], false)) {
    fail(429, 'Žádost z této e-mailové adresy už byla odeslána. Odpověď přijde e-mailem. Pokud ne, kontakt je info@oscloud.cz.');
}

// 7) odeslání
if (!send_mail($cfg, $subject, $name, $email, $fields, $message, $origin)) {
    error_log('oscloud-form: odeslání e-mailu selhalo');
    fail(500, 'Žádost se nepodařilo odeslat. Napiš nám prosím na info@oscloud.cz.');
}
rate_limit($dir, 'ip:' . $ip . $cfg['secret'], $cfg['limit_ip'], true);
rate_limit($dir, 'global', $cfg['limit_global'], true);
rate_limit($dir, $emailKey, $cfg['limit_email'], true);

respond(200, ['ok' => true, 'message' => 'Díky! Ozveme se ti na zadaný e-mail.']);
