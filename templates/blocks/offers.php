<?php /** Karty doplňkových služeb: emoji, title, price, text, list[], link [popisek, odkaz] */ ?>
<div class="offers offers--<?= (int) ($block['columns'] ?? 2) ?>">
    <?php foreach ($block['items'] as $o): ?>
        <article class="offer"<?= !empty($o['id']) ? ' id="' . e($o['id']) . '"' : '' ?>>
            <span class="offer__emoji" aria-hidden="true"><?= e($o['emoji']) ?></span>
            <h3 class="offer__title"><?= e($o['title']) ?></h3>
            <?php if (!empty($o['price'])): ?>
                <p class="offer__price"><?= e($o['price']) ?></p>
            <?php endif; ?>
            <?php foreach ((array) ($o['text'] ?? []) as $para): ?>
                <p><?= rich($para) ?></p>
            <?php endforeach; ?>
            <?php if (!empty($o['list'])): ?>
                <ul class="offer__list">
                    <?php foreach ($o['list'] as $li): ?>
                        <li>
                            <?php if (is_array($li)): ?>
                                <a href="<?= e($li[1]) ?>"<?= link_attrs($li[1]) ?>><?= rich($li[0]) ?></a>
                            <?php else: ?>
                                <?= rich($li) ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php if (!empty($o['link'])): ?>
                <a class="link-arrow offer__link" href="<?= e($o['link'][1]) ?>"<?= link_attrs($o['link'][1]) ?>><?= e($o['link'][0]) ?> <span aria-hidden="true"><?= str_starts_with($o['link'][1], 'http') ? '↗' : '→' ?></span></a>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</div>
