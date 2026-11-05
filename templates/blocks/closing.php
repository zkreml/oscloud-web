<div class="closing">
    <h2><?= e($block['heading']) ?></h2>
    <?php foreach ($block['paragraphs'] ?? [] as $para): ?>
        <p><?= rich($para) ?></p>
    <?php endforeach; ?>
    <?php if (!empty($block['motto'])): ?>
        <p class="closing__motto"><?= e($block['motto']) ?></p>
    <?php endif; ?>
    <?php if (!empty($block['buttons'])): ?>
        <div class="btn-row btn-row--center">
            <?php foreach ($block['buttons'] as $i => [$label, $href]): ?>
                <a class="btn <?= $i === 0 ? 'btn--primary' : 'btn--ghost' ?> btn--lg" href="<?= e($href) ?>"<?= link_attrs($href) ?>><?= e($label) ?> <span aria-hidden="true">→</span></a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php if (!empty($block['links'])): ?>
    <div class="link-cards">
        <?php foreach ($block['links'] as [$question, $label, $href]): ?>
            <a class="link-card" href="<?= e($href) ?>">
                <span class="link-card__question"><?= e($question) ?></span>
                <span class="link-card__label"><?= e($label) ?> <span aria-hidden="true">→</span></span>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
