<?php /** Podpora OSCloudu – čísla účtů z ORG a QR platba */ ?>
<div class="donate">
    <div class="donate__text">
        <h2><?= e($block['heading']) ?></h2>
        <?php foreach ($block['paragraphs'] as $para): ?>
            <p><?= rich($para) ?></p>
        <?php endforeach; ?>
        <?php if (!empty($block['cta'])): ?>
            <div class="btn-row">
                <a class="btn btn--primary" href="<?= e($block['cta'][1]) ?>" rel="noopener"><?= e($block['cta'][0]) ?> <span aria-hidden="true">💙</span></a>
            </div>
        <?php endif; ?>
        <dl class="donate__accounts">
            <div>
                <dt><?= e($block['accounts'][0]) ?></dt>
                <dd><strong><?= e(ORG['bank']['transparent'][0]) ?></strong></dd>
            </div>
            <div>
                <dt><?= e($block['accounts'][1]) ?></dt>
                <dd><strong><?= e(ORG['bank']['private'][0]) ?></strong></dd>
            </div>
        </dl>
        <?php foreach ($block['after'] as $para): ?>
            <p class="donate__small"><?= rich($para) ?></p>
        <?php endforeach; ?>
    </div>
    <figure class="donate__qr">
        <img src="<?= asset('img/qr-platba.png') ?>" alt="<?= e($block['qr_alt']) ?>" width="328" height="328" loading="lazy">
        <figcaption><?= e($block['qr_caption']) ?></figcaption>
    </figure>
</div>
