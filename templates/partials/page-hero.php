<?php /** @var array $hero  @var array $page */ ?>
<section class="page-hero<?= !empty($hero['tone']) ? ' page-hero--' . e($hero['tone']) : '' ?>">
    <div class="container page-hero__grid">
        <div class="page-hero__text">
            <nav class="breadcrumb" aria-label="<?= e(t('breadcrumb')) ?>">
                <a href="<?= url('home') ?>"><?= e(t('breadcrumb.home')) ?></a>
                <?php foreach ($hero['breadcrumb'] as [$label, $href]): ?>
                    <span aria-hidden="true">›</span>
                    <?php if ($href): ?>
                        <a href="<?= e($href) ?>"><?= e($label) ?></a>
                    <?php else: ?>
                        <span aria-current="page"><?= e($label) ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>

            <?php if (!empty($hero['eyebrow'])): ?>
                <p class="eyebrow"><?= e($hero['eyebrow']) ?></p>
            <?php endif; ?>
            <h1><?= e($hero['title']) ?></h1>
            <?php if (!empty($hero['lead'])): ?>
                <p class="page-hero__lead"><?= rich($hero['lead']) ?></p>
            <?php endif; ?>
            <?php foreach ($hero['paragraphs'] ?? [] as $para): ?>
                <p><?= rich($para) ?></p>
            <?php endforeach; ?>
            <?php if (!empty($hero['price'])): ?>
                <p class="price-tag"><?= e($hero['price'][0]) ?> <strong><?= e($hero['price'][1]) ?></strong> <?= e($hero['price'][2] ?? '') ?></p>
            <?php endif; ?>

            <?php if (!empty($hero['buttons'])): ?>
                <div class="btn-row">
                    <?php foreach ($hero['buttons'] as $i => [$label, $href]): ?>
                        <a class="btn <?= $i === 0 ? 'btn--primary' : 'btn--ghost' ?> btn--lg" href="<?= e($href) ?>"<?= link_attrs($href) ?>><?= e($label) ?> <span aria-hidden="true"><?= str_starts_with($href, 'http') ? '↗' : '→' ?></span></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php // Obrázek: velké emoji v bublině a kolem něj menší „obláčky“ s názvy služeb ?>
        <div class="page-hero__visual">
            <div class="bubble-art" aria-hidden="true">
                <span class="bubble-art__blob"></span>
                <span class="bubble-art__emoji"><?= e($hero['emoji'] ?? '☁️') ?></span>
                <?php foreach (array_slice($hero['chips'] ?? [], 0, 4) as $i => $chip): ?>
                    <span class="bubble-art__chip bubble-art__chip--<?= $i + 1 ?>"><?= e($chip) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?= wave('bottom') ?>
</section>
