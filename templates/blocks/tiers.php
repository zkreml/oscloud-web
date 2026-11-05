<?php /** Tarify vedle sebe: name, price [před, částka, za], sub, features[], button [popisek, odkaz], featured */ ?>
<div class="tiers">
    <?php foreach ($block['items'] as $tier): ?>
        <article class="tier<?= !empty($tier['featured']) ? ' tier--featured' : '' ?>">
            <?php if (!empty($tier['badge'])): ?>
                <p class="tier__badge"><?= e($tier['badge']) ?></p>
            <?php endif; ?>
            <h3 class="tier__name"><?= e($tier['name']) ?></h3>
            <p class="tier__price"><?= e($tier['price'][0]) ?> <strong><?= e($tier['price'][1]) ?></strong> <?= e($tier['price'][2]) ?></p>
            <p class="tier__sub"><?= e($tier['sub']) ?></p>
            <ul class="tier__features">
                <?php foreach ($tier['features'] as $f): ?>
                    <li><?= rich($f) ?></li>
                <?php endforeach; ?>
            </ul>
            <a class="btn <?= !empty($tier['featured']) ? 'btn--primary' : 'btn--ghost' ?> tier__btn" href="<?= e($tier['button'][1]) ?>"><?= e($tier['button'][0]) ?> <span aria-hidden="true">→</span></a>
        </article>
    <?php endforeach; ?>
</div>
