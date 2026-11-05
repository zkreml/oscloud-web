<?php
/*
 * Obecná tabulka: caption, head[], rows[[buňka, …]]; první buňka řádku je jeho nadpis.
 * Buňka je text, nebo [popisek, odkaz] – pak se vykreslí jako odkaz (např. Objednat).
 */
$cell = function ($c): string {
    if (is_array($c)) {
        return '<a class="price-link" href="' . e($c[1]) . '"' . link_attrs($c[1]) . '>' . e($c[0]) . ' <span aria-hidden="true">→</span></a>';
    }
    return rich((string) $c);
};
?>
<div class="price-box<?= !empty($block['narrow']) ? ' price-box--narrow' : '' ?>"<?= !empty($block['anchor']) ? ' id="' . e($block['anchor']) . '"' : '' ?>>
    <?php if (!empty($block['heading'])): ?>
        <h3 class="price-box__title"><?= e($block['heading']) ?></h3>
    <?php endif; ?>
    <div class="table-scroll" tabindex="0" role="region" aria-label="<?= e($block['caption']) ?>">
        <table class="compare compare--prices">
            <caption class="visually-hidden"><?= e($block['caption']) ?></caption>
            <thead>
                <tr>
                    <?php foreach ($block['head'] as $h): ?>
                        <th scope="col"><?= e($h) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($block['rows'] as $row): ?>
                    <tr>
                        <th scope="row"><?= $cell(array_shift($row)) ?></th>
                        <?php foreach ($row as $c): ?>
                            <td><?= $cell($c) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($block['list'])): ?>
        <ul class="tick-list tick-list--small">
            <?php foreach ($block['list'] as $li): ?>
                <li><?= rich($li) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php foreach ($block['notes'] ?? [] as $note): ?>
        <p class="price-box__note"><?= rich($note) ?></p>
    <?php endforeach; ?>
</div>
