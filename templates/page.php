<?php
/*
 * Obecná obsahová stránka – úvod (hero) a pod ním bloky podle app/pages/{stránka}.php.
 * Každý blok se kreslí šablonou templates/blocks/{typ}.php uvnitř vlastní sekce.
 * bg: white (výchozí) | ice – barevné sekce dostanou vlnky nahoře i dole.
 */
/** @var array $content */
$hero = $content['hero'];
require TEMPLATES . '/partials/page-hero.php';

$prevWhite = false; // pod úvodem je vlnka, první bílá sekce tedy potřebuje plné odsazení
foreach ($content['blocks'] as $block):
    $bg = $block['bg'] ?? 'white';
    $classes = 'section';
    if ($bg !== 'white') {
        $classes .= ' section--' . $bg;
    } elseif ($prevWhite) {
        $classes .= ' section--flush-top';
    }
    ?>
    <section class="<?= $classes ?>"<?= !empty($block['id']) ? ' id="' . e($block['id']) . '"' : '' ?>>
        <?= $bg !== 'white' ? wave('top') : '' ?>
        <div class="container">
            <?php if (!empty($block['title']) && empty($block['own_title'])): ?>
                <header class="section-head">
                    <h2><?= e($block['title']) ?></h2>
                    <?php foreach ((array) ($block['text'] ?? []) as $para): ?>
                        <p><?= rich($para) ?></p>
                    <?php endforeach; ?>
                </header>
            <?php endif; ?>
            <?php require TEMPLATES . '/blocks/' . $block['type'] . '.php'; ?>
        </div>
        <?= $bg !== 'white' ? wave('bottom') : '' ?>
    </section>
    <?php
    $prevWhite = $bg === 'white';
endforeach;
