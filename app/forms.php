<?php
declare(strict_types=1);

/*
 * Pomocné funkce pro formuláře: session, ochrana proti podvrženým odesláním (CSRF),
 * jednoduchá ochrana proti spamovým robotům a omezení počtu odeslání z jedné IP adresy.
 */

function start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    session_name('oscloud');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => is_https(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function redirect(string $to): never
{
    header('Location: ' . $to, true, 303);
    exit;
}

/** Hodnota z odeslaného formuláře – oříznutá a s omezenou délkou. */
function input(string $name, int $maxLength = 200, bool $multiline = false): string
{
    $value = $_POST[$name] ?? '';
    if (!is_string($value) || !mb_check_encoding($value, 'UTF-8')) {
        return '';
    }
    if ($multiline) {
        $value = str_replace(["\r\n", "\r"], "\n", $value);
        $value = preg_replace('/[\x00-\x09\x0B-\x1F\x7F]/', '', $value) ?? '';
    } else {
        $value = preg_replace('/[\x00-\x1F\x7F]+/', ' ', $value) ?? '';
    }
    return mb_substr(trim($value), 0, $maxLength);
}

// --- Jednorázové zprávy mezi požadavky (po přesměrování) -------------------

function flash_set(string $key, mixed $value): void
{
    start_session();
    $_SESSION['flash'][$key] = $value;
}

function flash_get(string $key): mixed
{
    start_session();
    $value = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $value;
}

// --- Ochrana formuláře -----------------------------------------------------

/**
 * Skrytá pole vkládaná do každého formuláře: CSRF token a past na roboty (honeypot).
 * Zároveň si zapamatuje, kdy byl formulář zobrazen – člověk ho nevyplní za 2 sekundy.
 */
function form_guard(string $form): string
{
    start_session();
    $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
    $_SESSION['form_shown'][$form] = time();

    return '<input type="hidden" name="_token" value="' . e($_SESSION['csrf']) . '">'
        . '<div class="hp" aria-hidden="true"><label>' . e(t('form.honeypot')) . ' <input type="text" name="web" tabindex="-1" autocomplete="off"></label></div>';
}

/** Ověří CSRF token z formuláře proti tokenu v session. */
function csrf_valid(): bool
{
    start_session();
    $token = $_POST['_token'] ?? '';
    return is_string($token) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

/**
 * Vrací chybovou hlášku, nebo null, když je odeslání v pořádku.
 */
function form_check(string $form, int $maxPerHour): ?string
{
    if (!csrf_valid()) {
        return t('form.expired');
    }

    $shown = $_SESSION['form_shown'][$form] ?? 0;
    if (input('web') !== '' || time() - $shown < 3) {
        return t('form.retry');
    }

    rate_limit_gc();
    if (!rate_limit('attempt:' . ($_SERVER['REMOTE_ADDR'] ?? '') . ':' . $form, [3600 => max(30, $maxPerHour * 6)])) {
        return t('form.rate', ['email' => CONFIG['mail']['to']]);
    }

    return null;
}

/**
 * Souborový limit s okny, např. [3600 => 3, 86400 => 10] = 3 za hodinu a 10 za den.
 * $record = false jen zkontroluje, true zapíše další pokus. Bez zapisovatelné složky limit nevynucuje.
 *
 * @param array<int,int> $limits
 */
function rate_limit(string $key, array $limits, bool $record = true): bool
{
    $dir = STORAGE . '/ratelimit';
    if (!is_dir($dir) && !@mkdir($dir, 0775, true)) {
        return true;
    }
    $file = $dir . '/' . hash('sha256', $key) . '.json';
    $now = time();
    $longest = max(array_keys($limits));

    $fh = @fopen($file, 'c+');
    if (!$fh) {
        return true;
    }
    flock($fh, LOCK_EX);
    $hits = json_decode((string) stream_get_contents($fh), true);
    $hits = is_array($hits) ? array_values(array_filter($hits, fn ($t) => is_int($t) && $t > $now - $longest)) : [];

    $ok = true;
    foreach ($limits as $window => $max) {
        if (count(array_filter($hits, fn ($t) => $t > $now - $window)) >= $max) {
            $ok = false;
            break;
        }
    }
    if ($ok && $record) {
        $hits[] = $now;
        ftruncate($fh, 0);
        rewind($fh);
        fwrite($fh, json_encode($hits));
    }
    flock($fh, LOCK_UN);
    fclose($fh);
    return $ok;
}

/** Smaže staré soubory limitů (občas, ať se složka nenafukuje). */
function rate_limit_gc(): void
{
    $dir = STORAGE . '/ratelimit';
    if (random_int(1, 50) !== 1 || !is_dir($dir)) {
        return;
    }
    foreach (glob($dir . '/*.json') ?: [] as $f) {
        if (filemtime($f) < time() - 2 * 86400) {
            @unlink($f);
        }
    }
}

// --- Zobrazení chyb u políček -------------------------------------------------

function field_error(array $errors, string $name): string
{
    return isset($errors[$name])
        ? '<p class="field__error" id="chyba-' . e($name) . '">' . e($errors[$name]) . '</p>'
        : '';
}

function field_attrs(array $errors, string $name): string
{
    return isset($errors[$name]) ? ' aria-invalid="true" aria-describedby="chyba-' . e($name) . '"' : '';
}

function form_errors_box(array $errors): string
{
    if (!$errors) {
        return '';
    }
    $html = '<div class="form-alert form-alert--error" role="alert"><strong>'
        . e($errors['_form'] ?? t('form.fix')) . '</strong>';
    $fields = array_diff_key($errors, ['_form' => true]);
    if ($fields) {
        $html .= '<ul>';
        foreach ($fields as $name => $message) {
            $html .= '<li><a href="#pole-' . e($name) . '">' . e($message) . '</a></li>';
        }
        $html .= '</ul>';
    }
    return $html . '</div>';
}

function log_mail_error(Throwable $e): void
{
    @mkdir(STORAGE, 0775, true);
    error_log('[' . date('c') . '] ' . $e->getMessage() . PHP_EOL, 3, STORAGE . '/mail-error.log');
}
