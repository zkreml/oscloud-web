<?php /** Několik bloků vedle sebe – items jsou bloky (výchozí typ text, může být i table apod.) */ ?>
<div class="columns columns--<?= count($block['items']) ?>">
    <?php foreach ($block['items'] as $item): ?>
        <div class="columns__item">
            <?php $outer = $block; $block = $item; require TEMPLATES . '/blocks/' . ($item['type'] ?? 'text') . '.php'; $block = $outer; ?>
        </div>
    <?php endforeach; ?>
</div>
