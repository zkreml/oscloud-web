<?php
declare(strict_types=1);

/*
 * Přihlášení k newsletteru (Listmonk). Formulář v patičce českých stránek posílá e-mail na /newsletter,
 * server ho předá veřejnému API Listmonku (POST /api/public/subscription). Listmonk pošle potvrzovací e-mail
 * (double opt-in), takže bez kliknutí na odkaz se nikdo nepřihlásí. Žádné heslo ani API klíč není potřeba.
 *
 * Zapíná se v config/config.php: 'newsletter' => ['url' => 'https://…', 'list_uuid' => '…']. Bez nich se formulář nezobrazí.
 */

function newsletter_enabled(): bool
{
    $cfg = CONFIG['newsletter'] ?? [];
    return lang() === 'cs' && !empty($cfg['url']) && !empty($cfg['list_uuid']);
}

/** Tajný klíč pro podpis časového razítka formuláře (soubor ve storage/, mimo web). */
function newsletter_key(): string
{
    $file = STORAGE . '/newsletter.key';
    $key = is_file($file) ? trim((string) @file_get_contents($file)) : '';
    if ($key === '') {
        $key = bin2hex(random_bytes(32));
        @file_put_contents($file, $key, LOCK_EX);
    }
    return $key;
}

/** Podepsané časové razítko zobrazení formuláře (bez session: patička se vykresluje až po výstupu stránky). */
function newsletter_token(): string
{
    $ts = (string) time();
    return $ts . '.' . hash_hmac('sha256', $ts, newsletter_key());
}

/** Formulář musel být zobrazen aspoň 3 sekundy a nejvýš 24 hodin před odesláním. */
function newsletter_token_valid(string $token): bool
{
    if (!preg_match('/^(\d{9,12})\.([0-9a-f]{64})$/', $token, $m)) {
        return false;
    }
    $age = time() - (int) $m[1];
    return hash_equals(hash_hmac('sha256', $m[1], newsletter_key()), $m[2]) && $age >= 3 && $age <= 86400;
}

/** Zavolá API Listmonku. Vrací [HTTP kód, tělo odpovědi]; kód 0 = spojení se nepovedlo. */
function newsletter_post(string $url, array $payload): array
{
    $json = json_encode($payload, JSON_UNESCAPED_UNICODE);
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $json,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json', 'Accept: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_FOLLOWLOCATION => false,
        ]);
        $body = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);
        return [$status, is_string($body) ? $body : ''];
    }
    $ctx = stream_context_create(['http' => [
        'method' => 'POST', 'header' => "Content-Type: application/json\r\nAccept: application/json\r\n",
        'content' => $json, 'timeout' => 10, 'ignore_errors' => true, 'follow_location' => 0,
    ]]);
    $body = @file_get_contents($url, false, $ctx);
    $status = 0;
    foreach ($http_response_header ?? [] as $h) {
        if (preg_match('#^HTTP/\S+\s+(\d{3})#', $h, $m)) {
            $status = (int) $m[1];
        }
    }
    return [$status, is_string($body) ? $body : ''];
}

/** Zpracuje odeslání formuláře a přesměruje zpátky na stránku, odkud přišel (výsledek je v ?newsletter=…). */
function handle_newsletter(): never
{
    header('Cache-Control: no-store');
    if (!is_post() || !newsletter_enabled()) {
        redirect('/');
    }

    // kam zpátky: jen cesta na tomto webu (žádné cizí adresy, žádné „//“)
    $back = input('back', 200);
    if (!preg_match('#^/[A-Za-z0-9._~%/-]*$#', $back) || str_contains($back, '//') || $back === '/newsletter') {
        $back = '/';
    }
    $done = fn (string $code): never => redirect($back . '?newsletter=' . $code . '#newsletter');

    if (input('web') !== '' || !newsletter_token_valid(input('t', 100))) {
        $done('znovu');
    }
    $email = input('email', 190);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[^@\s]+@[^@\s]+\.[^@\s]{2,}$/', $email)) {
        $done('email');
    }

    rate_limit_gc();
    if (!rate_limit('nl-ip:' . client_ip(), [3600 => 5, 86400 => 20])
        || !rate_limit('nl-email:' . hash('sha256', mb_strtolower($email)), [3600 => 1, 86400 => 3])) {
        $done('limit');
    }

    $cfg = CONFIG['newsletter'];
    [$status, $body] = newsletter_post(
        rtrim((string) $cfg['url'], '/') . '/api/public/subscription',
        ['email' => $email, 'name' => strstr($email, '@', true), 'list_uuids' => [(string) $cfg['list_uuid']]]
    );
    if ($status !== 200) {
        error_log('newsletter: Listmonk vrátil HTTP ' . $status . ' ' . mb_substr($body, 0, 200));
        $done('chyba');
    }
    $done('ok');
}
