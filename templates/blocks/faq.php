<?php /** Časté dotazy – rozbalovací otázky: items [[otázka, odpověď]] */ ?>
<div class="faq">
    <?php foreach ($block['items'] as [$q, $a]): ?>
        <details class="faq__item">
            <summary><?= e($q) ?></summary>
            <p><?= rich($a) ?></p>
        </details>
    <?php endforeach; ?>
</div>
