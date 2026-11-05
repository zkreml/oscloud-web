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

// Staré adresy z původního statického webu (…/nextcloud.html apod.) přesměrujeme na nové
$legacy = [
    'index.html' => 'home', 'nextcloud.html' => 'nextcloud', 'ente.html' => 'ente', 'trilium.html' => 'trilium',
    'mxchat.html' => 'matrix', 'degooglizace.html' => 'degoogle', 'o-nas.html' => 'about',
    'podminky.html' => 'terms', 'ochrana-udaju.html' => 'privacy', 'zpracovatelska-smlouva.html' => 'dpa',
];
$legacyLang = str_starts_with($path, 'en/') ? 'en' : 'cs';
if (isset($legacy[$legacyPath = preg_replace('~^en/~', '', $path)])) {
    header('Location: ' . url($legacy[$legacyPath], [], $legacyLang), true, 301);
    exit;
}

// sitemap.xml a robots.txt se skládají z tabulky ROUTES, takže vždy odpovídají aktuálním stránkám a doméně
if ($path === 'sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    $skip = ['join_done'];
    $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
        . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
    foreach (array_keys(ROUTES) as $key) {
        if (in_array($key, $skip, true)) {
            continue;
        }
        foreach (LANGS as $l) {
            $out .= "  <url>\n    <loc>" . htmlspecialchars(absolute_url(url($key, [], $l)), ENT_XML1) . "</loc>\n";
            foreach (LANGS as $alt) {
                $out .= '    <xhtml:link rel="alternate" hreflang="' . $alt . '" href="' . htmlspecialchars(absolute_url(url($key, [], $alt)), ENT_XML1) . '"/>' . "\n";
            }
            $out .= "  </url>\n";
        }
    }
    echo $out . "</urlset>\n";
    exit;
}
if ($path === 'robots.txt') {
    header('Content-Type: text/plain; charset=utf-8');
    echo "User-agent: *\nDisallow: " . url('join_done', [], 'cs') . "\nDisallow: " . url('join_done', [], 'en') . "\n\nSitemap: " . absolute_url('/sitemap.xml') . "\n";
    exit;
}

// --- Web (česky, anglicky pod /en) ---------------------------------------------
[$lang, $route, $params] = resolve_route($path);
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
