<div class="card-grid card-grid--<?= (int) ($block['columns'] ?? 3) ?>">
    <?php foreach ($block['items'] as $card): ?>
        <article class="reason<?= ($block['bg'] ?? 'white') !== 'white' ? ' reason--white' : '' ?>">
            <span class="reason__icon"><?= icon($card['icon']) ?></span>
            <h3><?= e($card['title']) ?></h3>
            <p><?= rich($card['text']) ?></p>
        </article>
    <?php endforeach; ?>
</div>
<?php if (!empty($block['after'])): ?>
    <p class="card-grid__after"><?= rich($block['after']) ?></p>
<?php endif; ?>
