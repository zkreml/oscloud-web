<?php
declare(strict_types=1);

define('ROOT', dirname(__DIR__));
define('TEMPLATES', ROOT . '/templates');
define('STORAGE', ROOT . '/storage');

$configFile = ROOT . '/config/config.php';
if (!is_file($configFile)) {
    http_response_code(500);
    exit('Chybí config/config.php – zkopírujte config/config.example.php a doplňte heslo k e-mailu.');
}
define('CONFIG', require $configFile);

error_reporting(E_ALL);
ini_set('display_errors', CONFIG['debug'] ? '1' : '0');
ini_set('log_errors', '1');
ini_set('error_log', STORAGE . '/php-error.log');
ini_set('expose_php', '0');
date_default_timezone_set('Europe/Prague'); // časy v e-mailech a logu podle českého času, ne UTC
send_security_headers();

/** HTTPS i za reverzní proxy (Cloudron předává schéma v X-Forwarded-Proto). */
function is_https(): bool
{
    return (($_SERVER['HTTPS'] ?? '') !== '' && $_SERVER['HTTPS'] !== 'off')
        || strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '')) === 'https';
}

/** Bezpečnostní hlavičky pro všechny odpovědi generované PHP. */
function send_security_headers(): void
{
    if (headers_sent()) {
        return;
    }
    $umami = CONFIG['umami_id'] !== '' ? ' https://analytics.oscloud.cz' : '';
    header("Content-Security-Policy: default-src 'self'; script-src 'self'$umami; style-src 'self'; img-src 'self' data:; font-src 'self'; "
        . "connect-src 'self'$umami; form-action 'self'; frame-ancestors 'none'; base-uri 'self'; object-src 'none'");
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=(), usb=(), interest-cohort=()');
    header('Cross-Origin-Opener-Policy: same-origin');
    if (is_https()) {
        header('Strict-Transport-Security: max-age=31536000');
    }
    header_remove('X-Powered-By');
}

require ROOT . '/app/i18n.php';
require ROOT . '/app/Mailer.php';
require ROOT . '/app/forms.php';
require ROOT . '/app/pricing.php';
require ROOT . '/app/join.php';
require ROOT . '/app/newsletter.php';

// Údaje spolku – zobrazují se v patičce a na stránce O nás
const ORG = [
    'name'     => 'OSCloud, z. s.',
    'street'   => 'Pionýrů 1332',
    'city'     => '356 01 Sokolov',
    'ico'      => '29991145',
    'dic'      => 'CZ29991145',
    'email'    => 'info@oscloud.cz',
    'support'  => 'podpora@oscloud.cz',
    'bank'     => [
        'transparent' => ['284833433/0600', 'CZ27 0600 0000 0002 8483 3433'],
        'private'     => ['284833660/0600', 'CZ09 0600 0000 0002 8483 3660'],
    ],
];

// Hlavní menu – [klíč popisku nav.*, odkaz]; odkazy na sekce homepage vznikají v hlavičce
const MAIN_NAV = ['services', 'pricing', 'degoogle', 'community', 'about', 'docs', 'blog'];

// Položky hlavního menu, které vedou mimo web (do dokumentace a na blog) – otevírají se v novém okně
const NAV_EXTERNAL = ['docs' => 'docs', 'blog' => 'blog'];

// Odkazy na služby a projekty OSCloudu
const LINKS = [
    'login'     => 'https://my.oscloud.cz',
    'darujme'   => 'https://www.darujme.cz/komunitni-internet-bez-reklam',
    'keyoxide'  => 'https://keyoxide.org/hkp/6305D75BFFC4ED23F3EC407370B32BB2BEAF41C9',
    'docs'      => 'https://docs.oscloud.cz',
    'blog'      => 'https://blog.oscloud.cz',
    'helpdesk'  => 'https://helpdesk.oscloud.cz/help/3271740098',
    'git'       => 'https://git.oscloud.cz',
    'git_org'   => 'https://git.oscloud.cz/OSCloud',
    'matrix'    => 'https://chat.mxchat.cz/#/room/#oscloudcz:mxchat.cz',
    'mxchat'    => 'https://chat.mxchat.cz',
    'mastodon'  => 'https://mamutovo.cz/@oscloud',
    'mamutovo'  => 'https://mamutovo.cz',
    'peertube'  => 'https://vhsky.cz',
    'pixelfed'  => 'https://pixelfed.cz',
    'fitpub'    => 'https://makni.cz',
    'photos'    => 'https://oscloud.photos',
    'cryptpad'  => 'https://office.oscloud.cz/',
    'searxng'   => 'https://searxng.cz',
    'pass'      => 'https://pass.oscloud.cz',
];

// Odkaz do dokumentace konkrétní aplikace, např. doc('vaultwarden')
function doc(string $app = ''): string
{
    return LINKS['docs'] . ($app !== '' ? '/apps/' . $app . '/' : '');
}

function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Text s jednoduchým formátováním: **tučně** → <strong>, [popisek](adresa) → odkaz; zbytek se escapuje
function rich(string $text): string
{
    $html = preg_replace('/\*\*(.+?)\*\*/u', '<strong>$1</strong>', e($text));
    return preg_replace_callback('/\[([^\]]+)\]\(([^)\s]+)\)/u', function (array $m): string {
        $href = html_entity_decode($m[2], ENT_QUOTES, 'UTF-8');
        if (!preg_match('~^(https?://|mailto:|/|#)~', $href)) {
            return $m[0];
        }
        return '<a href="' . e($href) . '"' . link_attrs($href) . '>' . $m[1] . '</a>';
    }, $html);
}

// Odkazy mimo web se otevírají v novém okně
function link_attrs(string $href): string
{
    return str_starts_with($href, 'http') ? ' target="_blank" rel="noopener"' : '';
}

// Jednoduché čárové ikony (24×24, barva podle textu)
function icon(string $name): string
{
    $paths = [
        'people'  => '<path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM2 20c0-3.3 3.1-6 7-6s7 2.7 7 6M16 14.2c3.2.2 6 2.4 6 5.8"/>',
        'star'    => '<path d="m12 3 2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1-4.4-4.3 6.1-.9L12 3Z"/>',
        'shield'  => '<path d="M12 3 4 6v6c0 4.4 3.4 8.2 8 9 4.6-.8 8-4.6 8-9V6l-8-3Z"/><path d="m8.5 12 2.5 2.5 4.5-5"/>',
        'heart'   => '<path d="M12 20s-7.5-4.6-9.2-9.4C1.7 7.4 3.8 4 7.2 4c2 0 3.6 1.1 4.8 2.8C13.2 5.1 14.8 4 16.8 4c3.4 0 5.5 3.4 4.4 6.6C19.5 15.4 12 20 12 20Z"/>',
        'chat'    => '<path d="M4 5h16v11H9l-5 4V5Z"/><path d="M8 10h8M8 13h5"/>',
        'puzzle'  => '<path d="M10 3h4v3a2 2 0 1 0 4 0V3h3v7h-3a2 2 0 1 0 0 4h3v7h-7v-3a2 2 0 1 0-4 0v3H3v-7h3a2 2 0 1 0 0-4H3V3h7Z"/>',
        'check'   => '<path d="m5 12 5 5 9-10"/>',
        'cross'   => '<path d="M6 6l12 12M18 6 6 18"/>',
        'calendar'=> '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
        'contacts'=> '<rect x="4" y="3" width="16" height="18" rx="2"/><circle cx="12" cy="10" r="3"/><path d="M8 17c.7-1.8 2.2-3 4-3s3.3 1.2 4 3"/>',
        'tasks'   => '<path d="M9 6h11M9 12h11M9 18h11"/><path d="m3 6 1.5 1.5L7 5M3 12l1.5 1.5L7 11M3 18l1.5 1.5L7 17"/>',
        'share'   => '<circle cx="6" cy="12" r="3"/><circle cx="18" cy="6" r="3"/><circle cx="18" cy="18" r="3"/><path d="m8.7 10.6 6.6-3.2M8.7 13.4l6.6 3.2"/>',
        'reply'   => '<path d="M10 8 4 13l6 5"/><path d="M4 13h10a6 6 0 0 1 6 6"/>',
        'sync'    => '<path d="M20 11a8 8 0 0 0-14.3-4.9L4 8"/><path d="M4 4v4h4"/><path d="M4 13a8 8 0 0 0 14.3 4.9L20 16"/><path d="M20 20v-4h-4"/>',
        'eye-off' => '<path d="M3 3l18 18"/><path d="M10.6 5.1A10 10 0 0 1 12 5c5 0 9 4.5 10 7-.4 1-1.3 2.4-2.6 3.7M6.6 6.6C4.5 8 3.1 10 2 12c1 2.5 5 7 10 7 1.6 0 3.1-.4 4.4-1.1"/><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/>',
        'code'    => '<path d="m8 7-5 5 5 5M16 7l5 5-5 5M14 4l-4 16"/>',
        'globe'   => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.6 3.8 5.6 3.8 9s-1.3 6.4-3.8 9c-2.5-2.6-3.8-5.6-3.8-9S9.5 5.6 12 3Z"/>',
        'cloud'   => '<path d="M7 18a5 5 0 0 1-.7-9.95A6 6 0 0 1 17.7 9 4.5 4.5 0 0 1 17.5 18H7Z"/>',
        'server'  => '<rect x="3" y="4" width="18" height="7" rx="2"/><rect x="3" y="13" width="18" height="7" rx="2"/><path d="M7 7.5h.01M7 16.5h.01M11 7.5h6M11 16.5h6"/>',
    ];

    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
        . ($paths[$name] ?? '') . '</svg>';
}

// Vlnitý přechod mezi sekcemi – má barvu sekce, ve které je (CSS proměnná --section-bg)
function wave(string $position): string
{
    $path = $position === 'top'
        ? 'M0,40 C240,80 480,0 720,30 C960,60 1200,10 1440,40 L1440,80 L0,80 Z'
        : 'M0,40 C240,0 480,80 720,50 C960,20 1200,70 1440,40 L1440,0 L0,0 Z';

    return '<div class="wave wave--' . $position . '" aria-hidden="true">'
        . '<svg viewBox="0 0 1440 80" preserveAspectRatio="none"><path d="' . $path . '"/></svg></div>';
}

// Cesta k souboru v public/assets s verzí podle data změny (kvůli cache prohlížeče)
function asset(string $path): string
{
    $file = ROOT . '/public/assets/' . $path;
    $v = is_file($file) ? filemtime($file) : 0;
    return '/assets/' . $path . '?v=' . $v;
}

function render(string $template, array $page, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require TEMPLATES . '/partials/header.php';
    require TEMPLATES . '/' . $template . '.php';
    require TEMPLATES . '/partials/footer.php';
}
