<?php
// Ceník Nextcloudu z app/pricing.php – každá cena je odkaz, který předvyplní formulář žádosti
$plans = ['jednotlivec' => t('price.person'), 'rodina' => t('price.family'), 'spolek' => t('price.club'), 'firma' => t('price.company')];
?>
<div class="price-box" id="<?= e($block['anchor'] ?? 'nextcloud-cenik') ?>">
    <div class="table-scroll" tabindex="0" role="region" aria-label="<?= e(t('price.nc_caption')) ?>">
        <table class="compare compare--prices">
            <caption class="visually-hidden"><?= e(t('price.nc_caption')) ?></caption>
            <thead>
                <tr>
                    <th scope="col"><?= e(t('price.storage')) ?></th>
                    <?php foreach ($plans as $name): ?>
                        <th scope="col"><?= e($name) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach (NEXTCLOUD_PRICES as $gb => $row): ?>
                    <tr>
                        <th scope="row"><?= e(storage_label($gb)) ?></th>
                        <?php foreach (NEXTCLOUD_PLANS as $i => $plan): ?>
                            <td>
                                <?php if ($row[$i] === null): ?>
                                    <span class="muted">–</span>
                                <?php else: ?>
                                    <a class="price-link" href="<?= e(url('join') . '?typ=' . $plan . '&gb=' . $gb) ?>" aria-label="<?= e(t('price.order_label', ['plan' => $plans[$plan], 'storage' => storage_label($gb), 'price' => money($row[$i])])) ?>"><?= e(money($row[$i])) ?> <span aria-hidden="true">→</span></a>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p class="table-hint"><?= e(t('price.click_hint')) ?></p>
    <?php foreach ($block['notes'] ?? [] as $note): ?>
        <p class="price-box__note"><?= rich($note) ?></p>
    <?php endforeach; ?>
</div>
