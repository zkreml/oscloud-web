<?php
/**
 * Formulář Chci se připojit. Jednotlivec / spolek-firma se přepíná přepínačem „typ“;
 * s JavaScriptem se ukazují jen pole, která k volbě patří (app/join.php ověří vše znovu na serveru).
 *
 * @var array $errors  @var array $old
 */
$val = fn (string $name) => e((string) ($old[$name] ?? ''));
$sel = fn (string $name, string $value) => (string) ($old[$name] ?? '') === $value ? ' selected' : '';
$typ = ($old['typ'] ?? 'person') === 'org' ? 'org' : 'person';

// Rozbalovací seznam s volbou „– vybrat –“
$select = function (string $name, string $id, array $options) use ($errors, $sel): string {
    $html = '<select id="' . $id . '" name="' . $name . '"' . field_attrs($errors, $name) . '>'
        . '<option value="">' . e(t('form.choose')) . '</option>';
    foreach ($options as $value => $label) {
        $html .= '<option value="' . e((string) $value) . '"' . $sel($name, (string) $value) . '>' . e($label) . '</option>';
    }
    return $html . '</select>';
};
$services = [];
foreach (JOIN_SERVICES as $s) {
    $services[$s] = t('join.service.' . $s, ['price' => money(TRILIUM_PRICES['monthly'])]);
}
$periods = ['monthly' => t('join.period.monthly'), 'yearly' => t('join.period.yearly')];
$consent = t('join.consent', [
    'terms'   => '[' . t('join.consent.terms') . '](' . url('terms') . ')',
    'privacy' => '[' . t('join.consent.privacy') . '](' . url('privacy') . ')',
]);
?>
<section class="page-hero page-hero--compact">
    <div class="container">
        <nav class="breadcrumb" aria-label="<?= e(t('breadcrumb')) ?>">
            <a href="<?= url('home') ?>"><?= e(t('breadcrumb.home')) ?></a> <span aria-hidden="true">›</span>
            <span aria-current="page"><?= e(t('join.title')) ?></span>
        </nav>
        <p class="eyebrow"><?= e(t('join.eyebrow')) ?></p>
        <h1><?= e(t('join.title')) ?></h1>
        <p class="page-hero__lead"><?= e(t('join.lead')) ?></p>
    </div>
    <?= wave('bottom') ?>
</section>

<section class="section section--order" id="formular">
    <div class="container join">
        <form class="form join__form" action="<?= url('join') ?>#formular" method="post" novalidate data-join-form>
            <?= form_guard('join') ?>
            <?= form_errors_box($errors) ?>

            <fieldset class="join-type">
                <legend><?= e(t('join.type')) ?></legend>
                <div class="choices choices--two">
                    <?php foreach (['person' => 'person', 'org' => 'org'] as $value => $key): ?>
                        <label class="choice">
                            <input class="choice__input" type="radio" name="typ" value="<?= $value ?>"<?= $typ === $value ? ' checked' : '' ?>>
                            <span class="choice__card">
                                <span class="choice__name"><?= $value === 'person' ? '🙋' : '🏢' ?> <?= e(t('join.type.' . $key)) ?></span>
                                <span class="choice__claim"><?= e(t('join.type.' . $key . '_hint')) ?></span>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <!-- Jednotlivec -->
            <div class="join__part" data-part="person">
                <div class="form__row">
                    <div class="field" id="pole-name">
                        <label for="j-name"><?= e(t('join.name')) ?></label>
                        <input id="j-name" name="name" type="text" autocomplete="nickname" value="<?= $val('name') ?>"<?= field_attrs($errors, 'name') ?>>
                        <?= field_error($errors, 'name') ?>
                    </div>
                    <div class="field" id="pole-email">
                        <label for="j-email"><?= e(t('join.email')) ?></label>
                        <input id="j-email" name="email" type="email" autocomplete="email" value="<?= $val('email') ?>"<?= field_attrs($errors, 'email') ?>>
                        <?= field_error($errors, 'email') ?>
                    </div>
                </div>
                <div class="field" id="pole-service">
                    <label for="j-service"><?= e(t('join.service')) ?></label>
                    <?= $select('service', 'j-service', $services) ?>
                    <?= field_error($errors, 'service') ?>
                </div>
                <div class="form__row">
                    <div class="field" id="pole-storage" data-show="nextcloud">
                        <label for="j-storage"><?= e(t('join.storage')) ?></label>
                        <?= $select('storage', 'j-storage', join_storage_options('jednotlivec')) ?>
                        <?= field_error($errors, 'storage') ?>
                    </div>
                    <div class="field" id="pole-storage_family" data-show="family">
                        <label for="j-storage-family"><?= e(t('join.storage_family')) ?></label>
                        <?= $select('storage_family', 'j-storage-family', join_storage_options('rodina')) ?>
                        <?= field_error($errors, 'storage_family') ?>
                    </div>
                    <div class="field" id="pole-period" data-show="nextcloud family trilium">
                        <label for="j-period"><?= e(t('join.period')) ?></label>
                        <?= $select('period', 'j-period', $periods) ?>
                        <p class="field__hint" data-show="trilium"><?= e(money(TRILIUM_PRICES['monthly']) . ' ' . t('per_month') . ' · ' . money(TRILIUM_PRICES['yearly']) . ' ' . t('per_year')) ?></p>
                        <?= field_error($errors, 'period') ?>
                    </div>
                </div>
                <div class="join__billing" data-show="nextcloud family trilium">
                    <div class="form__row">
                        <div class="field" id="pole-billing_name">
                            <label for="j-billing-name"><?= e(t('join.billing_name')) ?></label>
                            <input id="j-billing-name" name="billing_name" type="text" autocomplete="name" value="<?= $val('billing_name') ?>"<?= field_attrs($errors, 'billing_name') ?>>
                            <?= field_error($errors, 'billing_name') ?>
                        </div>
                        <div class="field" id="pole-billing_address">
                            <label for="j-billing-address"><?= e(t('join.billing_address')) ?></label>
                            <input id="j-billing-address" name="billing_address" type="text" autocomplete="street-address" value="<?= $val('billing_address') ?>"<?= field_attrs($errors, 'billing_address') ?>>
                            <?= field_error($errors, 'billing_address') ?>
                        </div>
                    </div>
                    <p class="field__hint"><?= e(t('join.billing_hint')) ?></p>
                </div>
            </div>

            <!-- Spolek nebo firma -->
            <div class="join__part" data-part="org">
                <div class="form__row">
                    <div class="field" id="pole-org_name">
                        <label for="j-org-name"><?= e(t('join.org_name')) ?></label>
                        <input id="j-org-name" name="org_name" type="text" autocomplete="organization" value="<?= $val('org_name') ?>"<?= field_attrs($errors, 'org_name') ?>>
                        <?= field_error($errors, 'org_name') ?>
                    </div>
                    <div class="field" id="pole-ico">
                        <label for="j-ico"><?= e(t('join.ico')) ?></label>
                        <input id="j-ico" name="ico" type="text" inputmode="numeric" maxlength="12" value="<?= $val('ico') ?>"<?= field_attrs($errors, 'ico') ?>>
                        <?= field_error($errors, 'ico') ?>
                    </div>
                </div>
                <div class="form__row">
                    <div class="field" id="pole-plan">
                        <label for="j-plan"><?= e(t('join.plan')) ?></label>
                        <?= $select('plan', 'j-plan', [
                            'spolek' => t('join.plan.club', ['price' => money(ORG_SURCHARGE['spolek'])]),
                            'firma'  => t('join.plan.company', ['price' => money(ORG_SURCHARGE['firma'])]),
                        ]) ?>
                        <?= field_error($errors, 'plan') ?>
                    </div>
                    <div class="field" id="pole-storage_org">
                        <label for="j-storage-org"><?= e(t('join.storage')) ?></label>
                        <?= $select('storage_org', 'j-storage-org', join_storage_options('spolek')) ?>
                        <?= field_error($errors, 'storage_org') ?>
                    </div>
                    <div class="field" id="pole-period_org">
                        <label for="j-period-org"><?= e(t('join.period')) ?></label>
                        <?= $select('period_org', 'j-period-org', $periods) ?>
                        <?= field_error($errors, 'period_org') ?>
                    </div>
                </div>
                <div class="form__row">
                    <div class="field" id="pole-users">
                        <label for="j-users"><?= e(t('join.users')) ?> <span class="optional"><?= e(t('optional')) ?></span></label>
                        <input id="j-users" name="users" type="text" inputmode="numeric" maxlength="6" value="<?= $val('users') ?>">
                    </div>
                    <div class="field" id="pole-org_address">
                        <label for="j-org-address"><?= e(t('join.org_address')) ?></label>
                        <input id="j-org-address" name="org_address" type="text" autocomplete="street-address" value="<?= $val('org_address') ?>"<?= field_attrs($errors, 'org_address') ?>>
                        <?= field_error($errors, 'org_address') ?>
                    </div>
                </div>
                <div class="form__row">
                    <div class="field" id="pole-contact">
                        <label for="j-contact"><?= e(t('join.contact')) ?></label>
                        <input id="j-contact" name="contact" type="text" autocomplete="name" value="<?= $val('contact') ?>"<?= field_attrs($errors, 'contact') ?>>
                        <?= field_error($errors, 'contact') ?>
                    </div>
                    <div class="field" id="pole-org_email">
                        <label for="j-org-email"><?= e(t('join.org_email')) ?></label>
                        <input id="j-org-email" name="org_email" type="email" autocomplete="email" value="<?= $val('org_email') ?>"<?= field_attrs($errors, 'org_email') ?>>
                        <?= field_error($errors, 'org_email') ?>
                    </div>
                </div>
            </div>

            <div class="field" id="pole-note">
                <label for="j-note"><?= e(t('join.note')) ?> <span class="optional"><?= e(t('optional')) ?></span></label>
                <textarea id="j-note" name="note" rows="4"><?= $val('note') ?></textarea>
                <p class="field__hint" data-show="matrix"><?= e(t('join.note_hint')) ?></p>
            </div>

            <div class="field field--check" id="pole-consent">
                <label class="check">
                    <input type="checkbox" name="consent" value="1"<?= ($old['consent'] ?? '') === '1' ? ' checked' : '' ?><?= field_attrs($errors, 'consent') ?>>
                    <span><?= rich($consent) ?></span>
                </label>
                <?= field_error($errors, 'consent') ?>
                <p class="field__hint"><?= e(t('join.consent_note')) ?></p>
            </div>

            <button class="btn btn--primary btn--lg" type="submit"><?= e(t('join.submit')) ?> <span aria-hidden="true">→</span></button>
        </form>

        <aside class="join__side">
            <div class="join-card">
                <p class="join-card__emoji" aria-hidden="true">☁️</p>
                <h2 class="join-card__title"><?= e(t('join.side.title')) ?></h2>
                <ol class="join-card__steps">
                    <?php foreach (t_list('join.side.steps') as $step): ?>
                        <li><?= e($step) ?></li>
                    <?php endforeach; ?>
                </ol>
                <p class="join-card__help"><?= rich(t('join.side.help', ['email' => '[' . ORG['email'] . '](mailto:' . ORG['email'] . ')'])) ?></p>
            </div>
        </aside>
    </div>
</section>
