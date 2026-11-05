<?php /** Přehledy údajů vedle sebe: groups [[nadpis, [[popisek, hodnota, odkaz?], …]]] */ ?>
<div class="facts">
    <?php foreach ($block['groups'] as [$title, $rows]): ?>
        <section class="facts__group">
            <h2 class="facts__title"><?= e($title) ?></h2>
            <dl>
                <?php foreach ($rows as $row): ?>
                    <div class="facts__row">
                        <dt><?= e($row[0]) ?></dt>
                        <dd>
                            <?php if (!empty($row[2])): ?>
                                <a href="<?= e($row[2]) ?>"<?= link_attrs($row[2]) ?>><?= e($row[1]) ?></a>
                            <?php else: ?>
                                <?= rich($row[1]) ?>
                            <?php endif; ?>
                            <?php if (!empty($row[3])): ?>
                                <small><?= e($row[3]) ?></small>
                            <?php endif; ?>
                        </dd>
                    </div>
                <?php endforeach; ?>
            </dl>
        </section>
    <?php endforeach; ?>
</div>
