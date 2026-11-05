<?php /** Degooglizace – co čím nahradit: items [from, to, host, text, badge, href] */ ?>
<ul class="swaps">
    <?php foreach ($block['items'] as $s): ?>
        <li class="swap">
            <p class="swap__from"><span aria-hidden="true">✕</span> <?= e($block['instead']) ?> <s><?= e($s['from']) ?></s> <?= e($block['use']) ?></p>
            <h3 class="swap__to">
                <?php if (!empty($s['href'])): ?>
                    <a href="<?= e($s['href']) ?>"<?= link_attrs($s['href']) ?>><?= e($s['to']) ?></a>
                <?php else: ?>
                    <?= e($s['to']) ?>
                <?php endif; ?>
            </h3>
            <?php if (!empty($s['host'])): ?>
                <p class="swap__host"><?= e($s['host']) ?></p>
            <?php endif; ?>
            <p class="swap__text"><?= e($s['text']) ?></p>
            <?php if (!empty($s['badge'])): ?>
                <p class="swap__badge"><?= e($s['badge']) ?></p>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
