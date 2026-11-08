<?php
declare(strict_types=1);

// Vestavěný PHP server (php -S) má statické soubory servírovat sám
if (PHP_SAPI === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file) && $file !== __FILE__) {
        return false;
    }
}

require __DIR__ . '/../app/bootstrap.php';

if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD', 'POST'], true)) {
    http_response_code(405);
    header('Allow: GET, HEAD, POST');
    exit;
}

$path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');

// Domény: aliasy (www., oscloud.online …) přesměrujeme na hlavní doménu, ať neexistují duplicitní weby.
// V režimu dvou domén (canonical_host + canonical_host_en) určuje jazyk doména a adresy nemají předponu /en.
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$readOnly = in_array($method, ['GET', 'HEAD'], true);
$requestUri = (string) ($_SERVER['REQUEST_URI'] ?? '/');
$reqHost = strtolower(explode(':', (string) ($_SERVER['HTTP_HOST'] ?? ''))[0]);
$hostLang = null;
if (split_mode()) {
    if ($reqHost === lang_host('cs')) {
        $hostLang = 'cs';
    } elseif ($reqHost === lang_host('en')) {
        $hostLang = 'en';
    } elseif ($readOnly) {
        $target = in_array($reqHost, [lang_host('en'), 'www.' . lang_host('en')], true) ? 'en' : 'cs';
        header('Location: https://' . lang_host($target) . $requestUri, true, 301);
        exit;
    } else {
        $hostLang = 'cs';
    }
    set_lang($hostLang);
    // Staré adresy /en/… (z doby, kdy byla angličtina pod předponou) vedou na anglickou doménu bez předpony
    if ($readOnly && ($path === 'en' || str_starts_with($path, 'en/'))) {
        $rest = ltrim(substr($path, 2), '/');
        $qs = (string) parse_url($requestUri, PHP_URL_QUERY);
        header('Location: https://' . lang_host('en') . '/' . $rest . ($qs !== '' ? '?' . $qs : ''), true, 301);
        exit;
    }
} else {
    $mainHost = (string) (CONFIG['canonical_host'] ?? '');
    if ($mainHost !== '' && $readOnly && $reqHost !== strtolower($mainHost)) {
        header('Location: https://' . $mainHost . $requestUri, true, 301);
        exit;
    }
}

// Staré adresy z původního statického webu (…/nextcloud.html apod.) přesměrujeme na nové
$legacy = [
    'index.html' => 'home', 'nextcloud.html' => 'nextcloud', 'ente.html' => 'ente', 'trilium.html' => 'trilium',
    'mxchat.html' => 'matrix', 'degooglizace.html' => 'degoogle', 'o-nas.html' => 'about',
    'podminky.html' => 'terms', 'ochrana-udaju.html' => 'privacy', 'zpracovatelska-smlouva.html' => 'dpa',
];
$legacyLang = $hostLang ?? (str_starts_with($path, 'en/') ? 'en' : 'cs');
if (isset($legacy[$legacyPath = preg_replace('~^en/~', '', $path)])) {
    header('Location: ' . url($legacy[$legacyPath], [], $legacyLang), true, 301);
    exit;
}

// Adresa s lomítkem na konci (/cenik/, /en/) je duplicita – přesměrujeme na jedinou kanonickou podobu
if ($path !== '' && preg_match('#^[\w./%~-]+$#', $path) && !str_contains($path, '//') && str_ends_with((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/')
    && in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD'], true)) {
    $qs = (string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    header('Location: /' . $path . ($qs !== '' ? '?' . $qs : ''), true, 301);
    exit;
}

// sitemap.xml a robots.txt se skládají z tabulky ROUTES, takže vždy odpovídají aktuálním stránkám a doméně
if ($path === 'sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    $skip = ['join_done'];
    $listLangs = $hostLang !== null ? [$hostLang] : LANGS; // na jazykové doméně jen její stránky, hreflang ukazuje na obě
    $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
        . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
    foreach (array_keys(ROUTES) as $key) {
        if (in_array($key, $skip, true)) {
            continue;
        }
        foreach ($listLangs as $l) {
            if (!page_translated($key, $l)) {
                continue; // nepřeložené stránky (anglické právní dokumenty) do mapy nepatří
            }
            $out .= "  <url>\n    <loc>" . htmlspecialchars(url_abs($key, [], $l), ENT_XML1) . "</loc>\n";
            foreach (LANGS as $alt) {
                if (!page_translated($key, $alt)) {
                    continue;
                }
                $out .= '    <xhtml:link rel="alternate" hreflang="' . $alt . '" href="' . htmlspecialchars(url_abs($key, [], $alt), ENT_XML1) . '"/>' . "\n";
            }
            $out .= "  </url>\n";
        }
    }
    echo $out . "</urlset>\n";
    exit;
}
if ($path === 'robots.txt') {
    header('Content-Type: text/plain; charset=utf-8');
    $disallow = '';
    foreach ($hostLang !== null ? [$hostLang] : LANGS as $l) {
        $disallow .= 'Disallow: ' . url('join_done', [], $l) . "\n";
    }
    if ($hostLang !== 'en') {
        $disallow .= "Disallow: /newsletter\n";
    }
    echo "User-agent: *\n" . $disallow . "\nSitemap: " . absolute_url('/sitemap.xml') . "\n";
    exit;
}

// Přihlášení k newsletteru (jen česky; formulář je v patičce)
if ($path === 'newsletter' && $hostLang !== 'en') {
    handle_newsletter();
}

// --- Web (česky, anglicky pod /en) ---------------------------------------------
[$lang, $route, $params] = resolve_route($path, $hostLang);
set_lang($lang);
$GLOBALS['oscloud_route'] = $route ? [$route, $params] : null;

$meta = fn (string $key, ?string $nav = null) => [
    'title'       => t("meta.$key.title"),
    'description' => t("meta.$key.description"),
    'nav'         => $nav,
];

switch ($route) {
    case 'home':
        render('home', $meta('home'));
        break;

    case 'join':
        header('Cache-Control: no-store');
        start_session(); // před jakýmkoli výstupem, aby nezáviselo na output_buffering
        [$errors, $old] = is_post() ? handle_join() : [[], join_defaults()];
        render('join', $meta('join', 'join'), ['errors' => $errors, 'old' => $old]);
        break;

    case 'join_done':
        $join = flash_get('join');
        if (!$join) {
            redirect(url('join'));
        }
        render('join-done', $meta('join_done', 'join') + ['noindex' => true], ['join' => $join]);
        break;

    case null:
        http_response_code(404);
        render('404', $meta('404'));
        break;

    default:
        // Obsahové stránky – texty a skladba bloků jsou v app/pages/{soubor}.php (anglicky v app/pages/en/)
        $content = page_content(ROUTES[$route][2]);
        render($content['template'] ?? 'page', [
            'title'       => $content['title'],
            'description' => $content['description'],
            'nav'         => $content['nav'] ?? null,
        ], ['content' => $content]);
}
