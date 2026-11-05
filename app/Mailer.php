<?php
declare(strict_types=1);

/**
 * Jednoduché odesílání e-mailů (text, případně i HTML verze) přes SMTP (SSL na portu 465 nebo STARTTLS na 587).
 * Bez externích knihoven – web posílá jen pár e-mailů z formulářů, nic víc nepotřebuje.
 */
final class Mailer
{
    /** @var resource|null */
    private $socket = null;

    public function __construct(private array $cfg)
    {
    }

    /**
     * @param string      $body  textová verze (zobrazí se v programech bez HTML)
     * @param string|null $html  HTML verze – volitelná
     * @param string[]    $bcc   skryté kopie
     * @throws RuntimeException když se e-mail nepodaří odeslat
     */
    public function send(string $to, string $subject, string $body, ?string $replyTo = null, ?string $html = null, array $bcc = []): void
    {
        foreach (array_merge([$to, $replyTo], $bcc) as $address) {
            if ($address !== null && !self::isValidAddress($address)) {
                throw new RuntimeException('Neplatná e-mailová adresa.');
            }
        }

        $message = $this->buildMessage($to, $subject, $body, $replyTo, $html);

        if (($this->cfg['driver'] ?? 'smtp') === 'log') {
            $this->writeLog(($bcc ? 'Bcc: ' . implode(', ', $bcc) . "\r\n" : '') . $message);
            return;
        }

        try {
            $this->smtpSend(array_merge([$to], $bcc), $message);
        } finally {
            if ($this->socket) {
                fclose($this->socket);
                $this->socket = null;
            }
        }
    }

    public static function isValidAddress(string $address): bool
    {
        return strlen($address) <= 254
            && filter_var($address, FILTER_VALIDATE_EMAIL) !== false
            && preg_match('/^[^\s"<>(),;:\\\\@]+@[^\s"<>(),;:\\\\@]+$/', $address) === 1;
    }

    private function buildMessage(string $to, string $subject, string $body, ?string $replyTo, ?string $html): string
    {
        $from = $this->cfg['from'];
        $domain = substr(strrchr($from, '@'), 1);

        $headers = [
            'Date: ' . date('r'),
            'From: ' . self::encodeHeader($this->cfg['from_name']) . ' <' . $from . '>',
            'To: <' . $to . '>',
            'Subject: ' . self::encodeHeader($subject),
            'Message-ID: <' . bin2hex(random_bytes(16)) . '@' . $domain . '>',
            'MIME-Version: 1.0',
        ];
        if ($replyTo !== null) {
            $headers[] = 'Reply-To: <' . $replyTo . '>';
        }

        if ($html === null) {
            $headers[] = 'Content-Type: text/plain; charset=UTF-8';
            $headers[] = 'Content-Transfer-Encoding: base64';
            return implode("\r\n", $headers) . "\r\n\r\n" . self::encodeBody($body);
        }

        // Textová i HTML verze – poštovní program si vybere tu, kterou umí zobrazit
        $boundary = 'oscloud-' . bin2hex(random_bytes(12));
        $headers[] = 'Content-Type: multipart/alternative; boundary="' . $boundary . '"';

        return implode("\r\n", $headers) . "\r\n\r\n"
            . "--$boundary\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n"
            . self::encodeBody($body) . "\r\n"
            . "--$boundary\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n"
            . self::encodeBody($html) . "\r\n"
            . "--$boundary--";
    }

    private static function encodeBody(string $text): string
    {
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $text = str_replace("\n", "\r\n", $text);
        return rtrim(chunk_split(base64_encode($text), 76, "\r\n"));
    }

    private static function encodeHeader(string $text): string
    {
        // mb_encode_mimeheader rozdělí dlouhý text na více zakódovaných částí (max. 75 znaků na část)
        return preg_match('/[^\x20-\x7E]/', $text) ? mb_encode_mimeheader($text, 'UTF-8', 'B', "\r\n") : $text;
    }

    /** @param string[] $recipients */
    private function smtpSend(array $recipients, string $message): void
    {
        $enc = $this->cfg['encryption'] ?? 'ssl';
        $remote = ($enc === 'ssl' ? 'ssl://' : 'tcp://') . $this->cfg['host'] . ':' . (int) $this->cfg['port'];
        $context = stream_context_create(['ssl' => ['peer_name' => $this->cfg['host']]]);

        $socket = @stream_socket_client($remote, $errno, $errstr, 15, STREAM_CLIENT_CONNECT, $context);
        if (!$socket) {
            throw new RuntimeException("Nelze se připojit k SMTP serveru ($errstr).");
        }
        $this->socket = $socket;
        stream_set_timeout($socket, 15);

        $hostname = $_SERVER['SERVER_NAME'] ?? 'localhost';

        $this->expect(220);
        $this->command('EHLO ' . $hostname, 250);

        if ($enc === 'tls') {
            $this->command('STARTTLS', 220);
            if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                throw new RuntimeException('Nepodařilo se zapnout šifrování (STARTTLS).');
            }
            $this->command('EHLO ' . $hostname, 250);
        }

        if (($this->cfg['username'] ?? '') !== '') {
            $this->command('AUTH LOGIN', 334);
            $this->command(base64_encode($this->cfg['username']), 334);
            $this->command(base64_encode($this->cfg['password']), 235, 'AUTH (heslo)');
        }

        $this->command('MAIL FROM:<' . $this->cfg['from'] . '>', 250);
        foreach ($recipients as $recipient) {
            $this->command('RCPT TO:<' . $recipient . '>', [250, 251]);
        }
        $this->command('DATA', 354);

        // Řádky začínající tečkou se musí zdvojit (base64 tělo je nemá, ale hlavičky pro jistotu ano)
        $data = preg_replace('/^\./m', '..', $message);
        $this->command($data . "\r\n.", 250, 'DATA');
        $this->command('QUIT', 221);
    }

    /** @param int|int[] $expected */
    private function command(string $line, int|array $expected, ?string $label = null): void
    {
        fwrite($this->socket, $line . "\r\n");
        $this->expect($expected, $label ?? strtok($line, ' '));
    }

    /** @param int|int[] $expected */
    private function expect(int|array $expected, string $label = 'spojení'): void
    {
        $response = '';
        while (($line = fgets($this->socket, 1024)) !== false) {
            $response .= $line;
            // Víceřádková odpověď má za kódem pomlčku, poslední řádek mezeru
            if (strlen($line) < 4 || $line[3] === ' ') {
                break;
            }
        }

        $code = (int) substr($response, 0, 3);
        if (!in_array($code, (array) $expected, true)) {
            throw new RuntimeException("SMTP chyba při $label: " . trim($response));
        }
    }

    private function writeLog(string $message): void
    {
        @mkdir(STORAGE, 0775, true);
        $entry = str_repeat('=', 70) . "\n" . date('c') . "\n" . $message . "\n";
        // Tělo je v base64 – pro čitelnost logu přidáme dekódovanou textovou verzi
        if (preg_match('~Content-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n([A-Za-z0-9+/=\r\n]+)~', $message, $m)) {
            $entry .= "\n--- dekódovaný text ---\n" . base64_decode(str_replace("\r\n", '', $m[1])) . "\n";
        }
        file_put_contents(STORAGE . '/mail.log', $entry, FILE_APPEND | LOCK_EX);
    }
}

function mailer(): Mailer
{
    static $mailer;
    if ($mailer === null) {
        $cfg = CONFIG['mail'];
        if (($cfg['driver'] ?? '') === 'cloudron') {
            // Cloudron: přihlašovací údaje k poště dodá platforma v proměnných prostředí, v souborech žádné heslo není
            $cfg['host']       = (string) getenv('CLOUDRON_MAIL_SMTP_SERVER');
            $cfg['port']       = (int) (getenv('CLOUDRON_MAIL_SMTP_PORT') ?: 2525);
            $cfg['username']   = (string) getenv('CLOUDRON_MAIL_SMTP_USERNAME');
            $cfg['password']   = (string) getenv('CLOUDRON_MAIL_SMTP_PASSWORD');
            $cfg['from']       = (string) (getenv('CLOUDRON_MAIL_FROM') ?: 'noreply@oscloud.cz');
            $cfg['encryption'] = 'none';
            $cfg['driver']     = 'smtp';
        }
        $mailer = new Mailer($cfg);
    }
    return $mailer;
}
