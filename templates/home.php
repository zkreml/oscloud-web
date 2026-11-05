<?php
// Texty jsou v app/pages/home.php (česky) a app/pages/en/home.php (anglicky)
$c = page_content('home');
?>

<!-- ÚVOD -->
<section class="hero">
    <div class="container hero__grid">
        <div class="hero__text">
            <p class="eyebrow"><?= e($c['hero']['eyebrow']) ?></p>
            <h1 class="hero__title"><?= e($c['hero']['title']) ?><br><span class="text-accent"><?= e($c['hero']['title_2']) ?></span></h1>
            <p class="hero__lead"><?= e($c['hero']['lead']) ?></p>
            <p><?= rich($c['hero']['text']) ?></p>
            <div class="btn-row">
                <a class="btn btn--primary btn--lg" href="<?= url('join') ?>"><?= e($c['hero']['buttons'][0]) ?> <span aria-hidden="true">→</span></a>
                <a class="btn btn--ghost btn--lg" href="#sluzby"><?= e($c['hero']['buttons'][1]) ?> <span aria-hidden="true">↓</span></a>
            </div>
            <ul class="hero__facts">
                <?php foreach ($c['hero']['facts'] as [$strong, $rest]): ?>
                    <li><strong><?= e($strong) ?></strong> <?= e($rest) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="hero__visual">
            <div class="hero__blob" aria-hidden="true"></div>
            <img src="<?= asset('img/hero-cloud.svg') ?>" alt="" width="520" height="400">
            <ul class="hero__bubbles" aria-hidden="true">
                <?php foreach ($c['hero']['bubbles'] as $i => $name): ?>
                    <li class="hero__bubble hero__bubble--<?= $i + 1 ?>"><?= e($name) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?= wave('bottom') ?>
</section>

<!-- SLUŽBY PODLE POTŘEBY -->
<section class="section" id="sluzby">
    <div class="container">
        <header class="section-head">
            <h2><?= e($c['services']['title']) ?></h2>
            <p><?= rich($c['services']['text']) ?></p>
        </header>

        <div class="needs">
            <?php foreach ($c['services']['items'] as [$emoji, $title, $text, $apps]): ?>
                <article class="need">
                    <span class="need__emoji" aria-hidden="true"><?= e($emoji) ?></span>
                    <h3><?= e($title) ?></h3>
                    <p><?= e($text) ?></p>
                    <ul class="app-tags">
                        <?php foreach ($apps as [$name, $href]): ?>
                            <li>
                                <?php if ($href): ?>
                                    <a href="<?= e($href) ?>"<?= link_attrs($href) ?>><?= e($name) ?></a>
                                <?php else: ?>
                                    <span><?= e($name) ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="helper-box">
            <p><?= rich($c['services']['helper']) ?></p>
            <a class="btn btn--primary" href="<?= url('pricing') ?>"><?= e($c['services']['button']) ?> <span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>

<!-- PROČ OSCLOUD -->
<section class="section section--ice" id="proc">
    <?= wave('top') ?>
    <div class="container">
        <header class="section-head">
            <h2><?= e($c['reasons']['title']) ?></h2>
            <p><?= rich($c['reasons']['text']) ?></p>
        </header>
        <div class="card-grid card-grid--4">
            <?php foreach ($c['reasons']['items'] as [$ic, $title, $text]): ?>
                <article class="reason reason--white">
                    <span class="reason__icon" aria-hidden="true"><?= icon($ic) ?></span>
                    <h3><?= e($title) ?></h3>
                    <p><?= rich($text) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
    <?= wave('bottom') ?>
</section>

<!-- DEGOOGLIZACE -->
<section class="section">
    <div class="container">
        <div class="feature-card degoogle-teaser">
            <div class="feature-card__text">
                <p class="terminal"><?= e($c['degoogle']['terminal']) ?></p>
                <h2><?= e($c['degoogle']['title']) ?></h2>
                <p><?= rich($c['degoogle']['text']) ?></p>
                <a class="btn btn--primary" href="<?= url('degoogle') ?>"><?= e($c['degoogle']['button']) ?> <span aria-hidden="true">→</span></a>
            </div>
            <ul class="swap-mini">
                <?php foreach ($c['degoogle']['swaps'] as [$from, $to]): ?>
                    <li><s><?= e($from) ?></s> <span aria-hidden="true">→</span> <strong><?= e($to) ?></strong></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<!-- KOMUNITA -->
<section class="section section--dark oscloud" id="komunita">
    <?= wave('top') ?>
    <div class="container oscloud__grid">
        <div class="oscloud__text">
            <p class="eyebrow eyebrow--light"><?= e($c['community']['eyebrow']) ?></p>
            <h2><?= e($c['community']['title']) ?></h2>
            <p><?= rich($c['community']['text']) ?></p>
        </div>
        <ul class="community-links">
            <?php foreach ($c['community']['links'] as [$emoji, $name, $text, $href]): ?>
                <li>
                    <a href="<?= e($href) ?>" target="_blank" rel="noopener<?= str_contains($href, 'mamutovo') ? ' me' : '' ?>">
                        <span class="community-links__emoji" aria-hidden="true"><?= e($emoji) ?></span>
                        <span><strong><?= e($name) ?></strong><small><?= e($text) ?></small></span>
                        <span class="community-links__arrow" aria-hidden="true">↗</span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?= wave('bottom') ?>
</section>

<!-- TRANSPARENTNÍ PROVOZ -->
<section class="section">
    <div class="container">
        <header class="section-head">
            <h2><?= e($c['costs']['title']) ?></h2>
            <p><?= rich($c['costs']['text']) ?></p>
        </header>
        <div class="cost-card">
            <span class="reason__icon" aria-hidden="true"><?= icon('server') ?></span>
            <div class="cost-card__body">
                <p class="cost-card__label"><?= e($c['costs']['label']) ?></p>
                <p class="cost-card__amount"><strong><?= e($c['costs']['amount']) ?></strong> <?= e($c['costs']['unit']) ?></p>
                <p class="cost-card__specs"><?= e($c['costs']['specs']) ?></p>
                <p><?= rich($c['costs']['after']) ?></p>
                <div class="btn-row">
                    <a class="btn btn--primary" href="<?= url('pricing') ?>#podpora"><?= e($c['costs']['buttons'][0]) ?> <span aria-hidden="true">💙</span></a>
                    <a class="btn btn--ghost" href="<?= url('about') ?>"><?= e($c['costs']['buttons'][1]) ?> <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ZÁVĚREČNÁ VÝZVA -->
<section class="section section--flush-top cta">
    <div class="container">
        <div class="closing">
            <h2><?= e($c['cta']['title']) ?></h2>
            <?php foreach ($c['cta']['paragraphs'] as $para): ?>
                <p><?= rich($para) ?></p>
            <?php endforeach; ?>
            <ul class="tick-list tick-list--inline">
                <?php foreach ($c['cta']['ticks'] as $tick): ?>
                    <li><?= e($tick) ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="btn-row btn-row--center">
                <a class="btn btn--primary btn--lg" href="<?= url('join') ?>"><?= e($c['cta']['buttons'][0]) ?> <span aria-hidden="true">→</span></a>
                <a class="btn btn--ghost btn--lg" href="<?= url('pricing') ?>"><?= e($c['cta']['buttons'][1]) ?> <span aria-hidden="true">→</span></a>
            </div>
        </div>
    </div>
</section>
