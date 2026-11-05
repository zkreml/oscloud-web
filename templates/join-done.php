<?php /** @var array $join  shrnutí žádosti z app/join.php (email, lines) */ ?>
<section class="page-hero page-hero--compact">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?= e(t('breadcrumb')) ?>">
            <a href="<?= url('home') ?>"><?= e(t('breadcrumb.home')) ?></a> <span aria-hidden="true">›</span>
            <a href="<?= url('join') ?>"><?= e(t('join.title')) ?></a> <span aria-hidden="true">›</span>
            <span aria-current="page"><?= e(t('join.done.title')) ?></span>
        </nav>
        <h1><?= e(t('join.done.title')) ?> 🎉</h1>
        <p class="page-hero__lead"><?= e(t('join.done.text', ['email' => $join['email']])) ?></p>
    </div>
    <?= wave('bottom') ?>
</section>

<section class="section section--order">
    <div class="container join-done">
        <div class="done__summary">
            <h2 class="done__title"><?= e(t('join.done.summary')) ?></h2>
            <dl class="summary-card__list">
                <?php foreach ($join['lines'] as [$label, $value]): ?>
                    <div>
                        <dt><?= e($label) ?></dt>
                        <dd><?= nl2br(e($value)) ?></dd>
                    </div>
                <?php endforeach; ?>
            </dl>
        </div>
        <div class="btn-row btn-row--center">
            <a class="btn btn--primary btn--lg" href="<?= url('home') ?>"><?= e(t('join.done.home')) ?> <span aria-hidden="true">→</span></a>
            <a class="btn btn--ghost btn--lg" href="<?= e(LINKS['docs']) ?>" target="_blank" rel="noopener"><?= e(t('join.done.docs')) ?> <span aria-hidden="true">↗</span></a>
        </div>
    </div>
</section>
