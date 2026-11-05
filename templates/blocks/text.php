<?php
/*
 * Textový blok: heading, paragraphs[], list[], steps[] (číslovaný postup), note (zvýrazněné upozornění),
 * links [[popisek, odkaz]] a buttons [[popisek, odkaz]]. **tučně** funguje ve všech textech.
 */
?>
<div class="text-block<?= !empty($block['wide']) ? ' text-block--wide' : '' ?>">
    <?php if (!empty($block['heading'])): ?>
        <h2><?= e($block['heading']) ?></h2>
    <?php endif; ?>
    <?php foreach ($block['paragraphs'] ?? [] as $para): ?>
        <p><?= rich($para) ?></p>
    <?php endforeach; ?>
    <?php if (!empty($block['list'])): ?>
        <ul class="tick-list tick-list--small">
            <?php foreach ($block['list'] as $li): ?>
                <li><?= rich($li) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php if (!empty($block['steps'])): ?>
        <ol class="steps">
            <?php foreach ($block['steps'] as $step): ?>
                <li><?= rich($step) ?></li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
    <?php foreach ($block['after'] ?? [] as $para): ?>
        <p><?= rich($para) ?></p>
    <?php endforeach; ?>
    <?php if (!empty($block['note'])): ?>
        <p class="note-box"><span aria-hidden="true">💡</span> <span><?= rich($block['note']) ?></span></p>
    <?php endif; ?>
    <?php if (!empty($block['links'])): ?>
        <p class="link-row">
            <?php foreach ($block['links'] as [$label, $href]): ?>
                <a class="link-arrow" href="<?= e($href) ?>"<?= link_attrs($href) ?>><?= e($label) ?> <span aria-hidden="true"><?= str_starts_with($href, 'http') ? '↗' : '→' ?></span></a>
            <?php endforeach; ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($block['buttons'])): ?>
        <div class="btn-row">
            <?php foreach ($block['buttons'] as $i => [$label, $href]): ?>
                <a class="btn <?= $i === 0 ? 'btn--primary' : 'btn--ghost' ?>" href="<?= e($href) ?>"<?= link_attrs($href) ?>><?= e($label) ?> <span aria-hidden="true"><?= str_starts_with($href, 'http') ? '↗' : '→' ?></span></a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
