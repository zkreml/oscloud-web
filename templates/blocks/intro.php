<div class="intro-text">
    <?php foreach ($block['paragraphs'] as $i => $para): ?>
        <p<?= $i === 0 ? ' class="lead"' : '' ?>><?= rich($para) ?></p>
    <?php endforeach; ?>
</div>
