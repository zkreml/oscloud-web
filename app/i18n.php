<?php
declare(strict_types=1);

/*
 * Jazyky webu: čeština (výchozí, adresy bez předpony) a angličtina (adresy /en/…).
 *
 * - texty rozhraní (menu, formuláře, hlášky): app/lang/cs.php a app/lang/en.php, funkce t()
 * - obsah stránek: app/pages/{stránka}.php (česky) a app/pages/en/{stránka}.php (anglicky)
 * - adresy stránek v obou jazycích: ROUTES níže, odkazy vytváří funkce url()
 */

const LANGS = ['cs', 'en'];

/*
 * Stránky webu: klíč => [česká adresa, anglická adresa, soubor s obsahem v app/pages].
 */
const ROUTES = [
    'home'       => ['', '', null],
    'pricing'    => ['cenik', 'pricing', 'cenik'],
    'degoogle'   => ['degooglizace', 'degoogle', 'degooglizace'],
    'nextcloud'  => ['nextcloud', 'nextcloud', 'nextcloud'],
    'ente'       => ['ente-photos', 'ente-photos', 'ente'],
    'trilium'    => ['trilium', 'trilium', 'trilium'],
    'matrix'     => ['matrix', 'matrix', 'matrix'],
    'about'      => ['o-nas', 'about', 'o-nas'],
    'join'       => ['pripojit', 'join', null],
    'join_done'  => ['pripojit/odeslano', 'join/thank-you', null],
    'terms'      => ['podminky', 'terms', 'podminky'],
    'privacy'    => ['ochrana-osobnich-udaju', 'privacy', 'ochrana-osobnich-udaju'],
    'dpa'        => ['zpracovatelska-smlouva', 'data-processing', 'zpracovatelska-smlouva'],
];

function lang(): string
{
    return $GLOBALS['oscloud_lang'] ?? 'cs';
}

function set_lang(string $lang): void
{
    $GLOBALS['oscloud_lang'] = in_array($lang, LANGS, true) ? $lang : 'cs';
    unset($GLOBALS['oscloud_strings']);
}

/** Text rozhraní v aktuálním jazyce; {jmeno} se nahradí hodnotou z $params. */
function t(string $key, array $params = []): string
{
    $strings = $GLOBALS['oscloud_strings'] ??= require ROOT . '/app/lang/' . lang() . '.php';
    $text = $strings[$key] ?? $key;
    foreach ($params as $name => $value) {
        $text = str_replace('{' . $name . '}', (string) $value, $text);
    }
    return $text;
}

/** Seznam textů rozhraní (pole v app/lang), např. kroky postupu. */
function t_list(string $key): array
{
    $strings = $GLOBALS['oscloud_strings'] ??= require ROOT . '/app/lang/' . lang() . '.php';
    return (array) ($strings[$key] ?? []);
}

/** Odkaz na stránku v aktuálním (nebo zadaném) jazyce, např. url('pricing'). */
function url(string $route, array $params = [], ?string $lang = null): string
{
    $lang ??= lang();
    $path = ROUTES[$route][$lang === 'en' ? 1 : 0];
    foreach ($params as $name => $value) {
        $path = str_replace('{' . $name . '}', rawurlencode((string) $value), $path);
    }
    $prefix = ($lang === 'en' && !split_mode()) ? '/en' : '';
    return ($prefix . '/' . $path === '/' ? '/' : rtrim($prefix . '/' . $path, '/'));
}

/**
 * Najde stránku podle adresy.
 *
 * @return array{0: string, 1: ?string, 2: array} [jazyk, klíč stránky nebo null, parametry]
 */
function resolve_route(string $path, ?string $hostLang = null): array
{
    $lang = $hostLang ?? 'cs';
    if ($hostLang === null && ($path === 'en' || str_starts_with($path, 'en/'))) {
        $lang = 'en';
        $path = ltrim(substr($path, 2), '/');
    }

    foreach (ROUTES as $key => $paths) {
        if ($paths[$lang === 'en' ? 1 : 0] === $path) {
            return [$lang, $key, []];
        }
    }
    return [$lang, null, []];
}

/** Běží web na dvou doménách – česky na canonical_host a anglicky na canonical_host_en? */
function split_mode(): bool
{
    return (string) (CONFIG['canonical_host'] ?? '') !== '' && (string) (CONFIG['canonical_host_en'] ?? '') !== '';
}

/** Doména jazykové verze v režimu dvou domén. */
function lang_host(string $lang): string
{
    return (string) (CONFIG[$lang === 'en' ? 'canonical_host_en' : 'canonical_host'] ?? '');
}

/** Adresa aktuální stránky v druhém jazyce (pro přepínač CZ/EN a hreflang). */
function alternate_url(string $lang): string
{
    $route = $GLOBALS['oscloud_route'] ?? null;
    return $route ? url($route[0], $route[1], $lang) : url('home', [], $lang);
}

/** Plná adresa aktuální stránky v daném jazyce (hreflang). */
function alternate_abs(string $lang): string
{
    $route = $GLOBALS['oscloud_route'] ?? null;
    return url_abs($route ? $route[0] : 'home', $route ? $route[1] : [], $lang);
}

/** Odkaz přepínače jazyků: v režimu dvou domén vede na druhou doménu, jinak na adresu pod /en. */
function switch_url(string $lang): string
{
    return split_mode() ? alternate_abs($lang) : alternate_url($lang);
}

/** Plná adresa stránky v daném jazyce (se schématem a doménou). */
function url_abs(string $route, array $params, string $lang): string
{
    return absolute_url(url($route, $params, $lang), $lang);
}

/** Má stránka vlastní překlad v daném jazyce? Bez překladu se v angličtině zobrazuje čeština (např. právní dokumenty). */
function page_translated(string $route, string $lang): bool
{
    $file = ROUTES[$route][2] ?? null;
    return $lang === 'cs' || $file === null || is_file(ROOT . '/app/pages/en/' . $file . '.php');
}

/** Kanonická plná adresa aktuální stránky; nepřeložená anglická stránka ukazuje na českou verzi. */
function canonical_abs(): ?string
{
    $route = $GLOBALS['oscloud_route'] ?? null;
    if (!$route) {
        return null;
    }
    return url_abs($route[0], $route[1], page_translated($route[0], lang()) ? lang() : 'cs');
}

/** Obsah stránky z app/pages – česky přímo, anglicky z podsložky en/ (když chybí, použije se čeština). */
function page_content(string $file): array
{
    $en = ROOT . '/app/pages/en/' . $file . '.php';
    if (lang() === 'en' && is_file($en)) {
        return require $en;
    }
    return require ROOT . '/app/pages/' . $file . '.php';
}

/** Cena v korunách: 1 000 Kč (OSCloud účtuje jen v Kč, i v anglické verzi). */
function money(int|float $amount): string
{
    return number_format($amount, 0, ',', "\u{00A0}") . "\u{00A0}" . (lang() === 'en' ? 'CZK' : 'Kč');
}

/** Plná adresa (se schématem a doménou) pro hreflang a odkazy v e-mailech. */
function absolute_url(string $path, ?string $lang = null): string
{
    // V režimu dvou domén má každý jazyk svou; jinak má přednost hlavní doména z configu
    $canonical = split_mode() ? lang_host($lang ?? lang()) : (string) (CONFIG['canonical_host'] ?? '');
    if ($canonical !== '') {
        return 'https://' . $canonical . $path;
    }
    $https = is_https();
    // Host z hlavičky ověříme, aby se do odkazů nedostalo nic jiného než platné jméno hostitele
    $host = (string) ($_SERVER['HTTP_HOST'] ?? '');
    if (!preg_match('/^[a-z0-9]([a-z0-9.-]{0,251}[a-z0-9])?(:\d{1,5})?$/i', $host)) {
        $host = 'oscloud.cz';
    }
    return ($https ? 'https://' : 'http://') . $host . $path;
}

/** Spustí kód v jiném jazyce a pak vrátí původní (např. české e-maily pro OSCloud z anglické verze). */
function with_lang(string $lang, callable $fn): mixed
{
    $previous = lang();
    set_lang($lang);
    try {
        return $fn();
    } finally {
        set_lang($previous);
    }
}
