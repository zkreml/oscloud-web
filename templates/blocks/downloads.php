<?php /** Soubory ke stažení s náhledem: image, alt, items [[popisek, soubor v public/assets/files, velikost]] */ ?>
<div class="downloads">
    <?php if (!empty($block['image'])): ?>
        <a class="downloads__preview" href="<?= asset('files/' . $block['items'][0][1]) ?>">
            <img src="<?= asset('files/' . $block['image']) ?>" alt="<?= e($block['alt']) ?>" loading="lazy">
        </a>
    <?php endif; ?>
    <div class="downloads__text">
        <h2><?= e($block['heading']) ?></h2>
        <p><?= e($block['text']) ?></p>
        <ul class="downloads__list">
            <?php foreach ($block['items'] as [$label, $file, $size]): ?>
                <li><a class="btn btn--ghost" href="<?= asset('files/' . $file) ?>" download><span aria-hidden="true">⬇</span> <?= e($label) ?> <small>(<?= e($size) ?>)</small></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
