<div class="stories">
    <?php foreach ($block['items'] as $s): ?>
        <article class="story"<?= !empty($s['id']) ? ' id="' . e($s['id']) . '"' : '' ?>>
            <div class="story__head">
                <?php if (!empty($s['highlight'])): ?>
                    <p class="story__highlight">
                        <strong><?= e($s['highlight'][0]) ?></strong>
                        <span><?= e($s['highlight'][1]) ?></span>
                    </p>
                <?php endif; ?>
                <h2 class="story__title"><?= e($s['title']) ?></h2>
            </div>
            <div class="story__body">
                <?php foreach ($s['paragraphs'] as $para): ?>
                    <p><?= rich($para) ?></p>
                <?php endforeach; ?>
                <?php if (!empty($s['link'])): ?>
                    <a class="link-arrow" href="<?= e($s['link'][1]) ?>"<?= link_attrs($s['link'][1]) ?>><?= e($s['link'][0]) ?> <span aria-hidden="true">→</span></a>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; ?>
</div>
