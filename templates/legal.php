<?php /** @var array $content */ ?>
<section class="page-hero page-hero--compact">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?= e(t('breadcrumb')) ?>">
            <a href="<?= url('home') ?>"><?= e(t('breadcrumb.home')) ?></a> <span aria-hidden="true">›</span>
            <span aria-current="page"><?= e($content['heading']) ?></span>
        </nav>
        <h1><?= e($content['heading']) ?></h1>
        <p class="page-hero__lead"><?= e($content['lead']) ?></p>
        <?php if (t('legal.cz_only') !== ''): ?>
            <p class="lang-note" lang="en"><?= e(t('legal.cz_only')) ?></p>
        <?php endif; ?>
    </div>
    <?= wave('bottom') ?>
</section>

<section class="section">
    <div class="container">
        <article class="legal" lang="cs">
            <nav class="legal__toc" aria-label="<?= e(t('legal.toc')) ?>">
                <p class="legal__toc-title"><?= e(t('legal.toc')) ?></p>
                <ol>
                    <?php foreach ($content['sections'] as $i => $section): ?>
                        <li><a href="#cast-<?= $i + 1 ?>"><?= e($section['title']) ?></a></li>
                    <?php endforeach; ?>
                </ol>
            </nav>

            <div class="legal__body">
                <?php foreach ($content['sections'] as $i => $section): ?>
                    <section class="legal__section<?= !empty($section['highlight']) ? ' legal__section--highlight' : '' ?>" id="cast-<?= $i + 1 ?>">
                        <h2><span class="legal__num"><?= $i + 1 ?>.</span> <?= e($section['title']) ?></h2>
                        <?php foreach ($section['body'] as $item): ?>
                            <?php if (is_array($item) && isset($item['table'])): ?>
                                <div class="legal__table-wrap" tabindex="0" role="region" aria-label="<?= e($section['title']) ?>">
                                    <table class="legal__table">
                                        <thead><tr><?php foreach ($item['table']['head'] as $th): ?><th scope="col"><?= e($th) ?></th><?php endforeach; ?></tr></thead>
                                        <tbody>
                                            <?php foreach ($item['table']['rows'] as $row): ?>
                                                <tr><?php foreach ($row as $n => $cell): ?><<?= $n === 0 ? 'th scope="row"' : 'td' ?> data-label="<?= e($item['table']['head'][$n] ?? '') ?>"><?= rich($cell) ?></<?= $n === 0 ? 'th' : 'td' ?>><?php endforeach; ?></tr>
                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php elseif (is_array($item)): ?>
                                <ul>
                                    <?php foreach ($item['list'] as $li): ?>
                                        <li><?= rich($li) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p><?= rich($item) ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </section>
                <?php endforeach; ?>

                <p class="legal__effective"><?= e(t('legal.effective', ['date' => $content['effective']])) ?></p>
            </div>
        </article>
    </div>
</section>
