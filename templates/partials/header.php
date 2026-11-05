<?php
$otherLang = lang() === 'en' ? 'cs' : 'en';
// Položky menu: Služby a Komunita jsou sekce úvodní stránky, ostatní samostatné stránky
$navHref = fn (string $key) => match ($key) {
    'services'  => url('home') . '#sluzby',
    'community' => url('home') . '#komunita',
    default     => url($key),
};
?>
<!doctype html>
<html lang="<?= lang() ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($page['title']) ?></title>
    <meta name="description" content="<?= e($page['description']) ?>">
    <meta name="theme-color" content="#081E34">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon-32.png" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <?php
    $route = $GLOBALS['oscloud_route'][0] ?? null;
    $canonical = empty($page['noindex']) ? canonical_path() : null;
    $bothLangs = $route !== null && page_translated($route, 'cs') && page_translated($route, 'en');
    ?>
    <?php if (!empty($page['noindex'])): ?>
        <meta name="robots" content="noindex, nofollow">
    <?php elseif ($canonical !== null): ?>
        <link rel="canonical" href="<?= e(absolute_url($canonical)) ?>">
        <?php if ($bothLangs): // Vyhledávače se dozví o obou jazykových verzích (jen když existují obě) ?>
            <link rel="alternate" hreflang="cs" href="<?= e(absolute_url(alternate_url('cs'))) ?>">
            <link rel="alternate" hreflang="en" href="<?= e(absolute_url(alternate_url('en'))) ?>">
            <link rel="alternate" hreflang="x-default" href="<?= e(absolute_url(alternate_url('cs'))) ?>">
        <?php endif; ?>
        <?php $ogImage = absolute_url(asset('img/og-' . lang() . '.png')); ?>
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="OSCloud">
        <meta property="og:locale" content="<?= lang() === 'en' ? 'en_US' : 'cs_CZ' ?>">
        <meta property="og:title" content="<?= e($page['title']) ?>">
        <meta property="og:description" content="<?= e($page['description']) ?>">
        <meta property="og:url" content="<?= e(absolute_url($canonical)) ?>">
        <meta property="og:image" content="<?= e($ogImage) ?>">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?= e($page['title']) ?>">
        <meta name="twitter:description" content="<?= e($page['description']) ?>">
        <meta name="twitter:image" content="<?= e($ogImage) ?>">
        <?php if ($route === 'home'): ?>
            <script type="application/ld+json"><?= json_encode([
                '@context' => 'https://schema.org',
                '@graph'   => [
                    [
                        '@type'     => 'Organization',
                        '@id'       => absolute_url('/') . '#org',
                        'name'      => 'OSCloud',
                        'legalName' => ORG['name'],
                        'url'       => absolute_url('/'),
                        'logo'      => absolute_url('/apple-touch-icon.png'),
                        'email'     => ORG['email'],
                        'taxID'     => ORG['dic'],
                        'address'   => ['@type' => 'PostalAddress', 'streetAddress' => ORG['street'], 'postalCode' => '356 01', 'addressLocality' => 'Sokolov', 'addressCountry' => 'CZ'],
                        'sameAs'    => [LINKS['mastodon'], LINKS['git_org']],
                    ],
                    [
                        '@type'      => 'WebSite',
                        'name'       => 'OSCloud',
                        'url'        => absolute_url('/'),
                        'inLanguage' => ['cs', 'en'],
                        'publisher'  => ['@id' => absolute_url('/') . '#org'],
                    ],
                ],
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
        <?php endif; ?>
    <?php endif; ?>
    <link rel="preload" href="<?= asset('fonts/Coiny-Regular.woff2') ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= asset('fonts/Quicksand-VariableFont_wght.woff2') ?>" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <script src="<?= asset('js/main.js') ?>" defer></script>
    <?php if (empty($page['noindex']) && !empty(CONFIG['umami_id'])): ?>
        <script defer src="https://analytics.oscloud.cz/script.js" data-website-id="<?= e(CONFIG['umami_id']) ?>"></script>
    <?php endif; ?>
</head>
<body>
<a class="skip-link" href="#obsah"><?= e(t('skip')) ?></a>

<header class="site-header">
    <div class="container site-header__inner">
        <a class="site-logo" href="<?= url('home') ?>" aria-label="<?= e(t('logo_label')) ?>">
            <img src="<?= asset('img/logo-horizontal.png') ?>" alt="OSCloud" width="794" height="108">
        </a>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="hlavni-menu">
            <span class="nav-toggle__bars" aria-hidden="true"></span>
            <span class="nav-toggle__label"><?= e(t('menu')) ?></span>
        </button>

        <nav class="main-nav" id="hlavni-menu" aria-label="<?= e(t('nav.main')) ?>">
            <ul>
                <?php foreach (MAIN_NAV as $key): ?>
                    <?php if (isset(NAV_EXTERNAL[$key])): ?>
                        <li><a href="<?= e(LINKS[NAV_EXTERNAL[$key]]) ?>" target="_blank" rel="noopener"><?= e(t('nav.' . $key)) ?></a></li>
                    <?php else: ?>
                        <li><a href="<?= e($navHref($key)) ?>"<?= $page['nav'] === $key ? ' aria-current="page"' : '' ?>><?= e(t('nav.' . $key)) ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <div class="main-nav__tools">
                <a class="main-nav__login" href="<?= e(LINKS['login']) ?>" target="_blank" rel="noopener"><?= e(t('nav.login')) ?></a>
                <?php if (empty($page['noindex'])): ?>
                    <a class="lang-switch" href="<?= e(alternate_url($otherLang)) ?>" hreflang="<?= $otherLang ?>" lang="<?= $otherLang ?>" title="<?= e(t('lang.switch')) ?>">
                        <span class="lang-switch__short" aria-hidden="true"><?= e(t('lang.short')) ?></span><span class="lang-switch__long"><?= e(t('lang.switch')) ?></span>
                    </a>
                <?php endif; ?>
            </div>
            <a class="btn btn--primary main-nav__cta" href="<?= url('join') ?>"><?= e(t('nav.cta')) ?></a>
        </nav>
    </div>
</header>

<main id="obsah">
