<?php
declare(strict_types=1);

/*
 * Formulář „Chci se připojit“ – žádost o účet pro jednotlivce, rodinu, spolek nebo firmu.
 * Žádost jde e-mailem do schránky ve FreeScoutu (registrace@, anglická verze en@); odpověď jde rovnou žadateli.
 * Potvrzení žadateli posílá automatická odpověď FreeScoutu, web ho neposílá podruhé.
 */

const JOIN_SERVICES = ['free', 'nextcloud', 'family', 'trilium', 'matrix', 'other'];
const JOIN_PAID     = ['nextcloud', 'family', 'trilium'];
const JOIN_PERIODS  = ['monthly', 'yearly'];

/** Výchozí hodnoty formuláře – z odkazů v ceníku (?typ=…&gb=…&period=…, ?sluzba=…). */
function join_defaults(): array
{
    $get = fn (string $key) => is_string($_GET[$key] ?? null) ? $_GET[$key] : '';
    $gb = (int) $get('gb');
    $period = in_array($get('period'), JOIN_PERIODS, true) ? $get('period') : '';
    $old = ['typ' => 'person', 'service' => '', 'period' => $period];

    $old['period_org'] = $period;
    switch ($get('typ')) {
        case 'jednotlivec':
            $old['service'] = 'nextcloud';
            $old['storage'] = nextcloud_price('jednotlivec', $gb) ? (string) $gb : '';
            break;
        case 'rodina':
            $old['service'] = 'family';
            $old['storage_family'] = nextcloud_price('rodina', $gb) ? (string) $gb : '';
            break;
        case 'spolek':
        case 'firma':
            $old['typ'] = 'org';
            $old['plan'] = $get('typ');
            $old['storage_org'] = nextcloud_price($get('typ'), $gb) ? (string) $gb : '';
            break;
        case 'trilium':
            $old['service'] = 'trilium';
            break;
    }
    if (in_array($get('sluzba'), JOIN_SERVICES, true)) {
        $old['service'] = $get('sluzba');
    }
    return $old;
}

/** Možnosti výběru úložiště pro tarif: [hodnota => popisek s cenou]. */
function join_storage_options(string $plan): array
{
    $options = [];
    foreach (nextcloud_sizes($plan) as $gb) {
        $price = money(nextcloud_price($plan, $gb));
        $options[(string) $gb] = storage_label($gb) . ' · ' . t(in_array($plan, ['spolek', 'firma'], true) ? 'join.from_month' : 'join.per_month', ['price' => $price]);
    }
    return $options;
}

function handle_join(): array
{
    $old = [
        'typ'             => input('typ') === 'org' ? 'org' : 'person',
        'name'            => input('name', 100),
        'email'           => input('email', 190),
        'service'         => input('service', 20),
        'storage'         => input('storage', 10),
        'storage_family'  => input('storage_family', 10),
        'period'          => input('period', 10),
        'billing_name'    => input('billing_name', 150),
        'billing_address' => input('billing_address', 300),
        'org_name'        => input('org_name', 150),
        'ico'             => preg_replace('/\s+/', '', input('ico', 20)),
        'users'           => preg_replace('/\D+/', '', input('users', 6)) ?? '',
        'org_address'     => input('org_address', 300),
        'contact'         => input('contact', 150),
        'plan'            => input('plan', 10),
        'storage_org'     => input('storage_org', 10),
        'period_org'      => input('period_org', 10),
        'org_email'       => input('org_email', 190),
        'note'            => input('note', 2000, true),
        'consent'         => input('consent', 5),
    ];

    $errors = [];
    if ($guard = form_check('join', 5)) {
        $errors['_form'] = $guard;
    }

    if ($old['typ'] === 'person') {
        if ($old['name'] === '') {
            $errors['name'] = t('join.err.name');
        }
        if (!Mailer::isValidAddress($old['email'])) {
            $errors['email'] = t('join.err.email');
        }
        if (!in_array($old['service'], JOIN_SERVICES, true)) {
            $errors['service'] = t('join.err.service');
        }
        if ($old['service'] === 'nextcloud' && !nextcloud_price('jednotlivec', (int) $old['storage'])) {
            $errors['storage'] = t('join.err.storage');
        }
        if ($old['service'] === 'family' && !nextcloud_price('rodina', (int) $old['storage_family'])) {
            $errors['storage_family'] = t('join.err.storage');
        }
        if (in_array($old['service'], JOIN_PAID, true)) {
            if (!in_array($old['period'], JOIN_PERIODS, true)) {
                $errors['period'] = t('join.err.period');
            }
            if ($old['billing_name'] === '') {
                $errors['billing_name'] = t('join.err.billing_name');
            }
            if ($old['billing_address'] === '') {
                $errors['billing_address'] = t('join.err.billing_address');
            }
        }
    } else {
        if ($old['org_name'] === '') {
            $errors['org_name'] = t('join.err.org_name');
        }
        if (!preg_match('/^\d{8}$/', $old['ico'])) {
            $errors['ico'] = t('join.err.ico');
        }
        if ($old['org_address'] === '') {
            $errors['org_address'] = t('join.err.org_address');
        }
        if ($old['contact'] === '') {
            $errors['contact'] = t('join.err.contact');
        }
        if (!Mailer::isValidAddress($old['org_email'])) {
            $errors['org_email'] = t('join.err.email');
        }
        if (!isset(ORG_SURCHARGE[$old['plan']])) {
            $errors['plan'] = t('join.err.plan');
        } elseif (!nextcloud_price($old['plan'], (int) $old['storage_org'])) {
            $errors['storage_org'] = t('join.err.storage');
        }
        if (!in_array($old['period_org'], JOIN_PERIODS, true)) {
            $errors['period_org'] = t('join.err.period');
        }
        // Dál se pracuje se společnými poli e-mail a platba
        $old['email'] = $old['org_email'];
        $old['period'] = $old['period_org'];
    }
    if ($old['consent'] !== '1') {
        $errors['consent'] = t('join.err.consent');
    }

    if ($errors) {
        return [$errors, $old];
    }

    // Limity odeslaných žádostí: na IP, celkem a na e-mailovou adresu (zapisují se až po úspěšném odeslání)
    $limits = [
        'ip:' . ($_SERVER['REMOTE_ADDR'] ?? '')    => [3600 => 3, 86400 => 10],
        'global'                                  => [86400 => 60],
        'email:' . mb_strtolower($old['email'])   => [3600 => 1, 86400 => 3],
    ];
    foreach ($limits as $key => $windows) {
        if (!rate_limit($key, $windows, false)) {
            return [['_form' => t('form.rate', ['email' => CONFIG['mail']['to']])], $old];
        }
    }

    $lines = join_summary($old);
    $adminLines = with_lang('cs', fn () => join_summary($old));
    $body = implode("\n", array_merge(
        ['Nová žádost z formuláře Chci se připojit' . (lang() === 'en' ? ' (anglická verze webu – odpovídejte anglicky)' : ''), 'Jazyk:        ' . (lang() === 'en' ? 'English' : 'Čeština'), ''],
        array_map(fn ($l) => $l[0] . ':' . str_repeat(' ', max(1, 14 - mb_strlen($l[0] . ':'))) . $l[1], $adminLines),
        ['', '---', 'Odesláno: ' . date('j. n. Y H:i'),
         'Na tento e-mail stačí odpovědět, odpověď půjde žadateli.'],
    ));

    $en = lang() === 'en';
    $who = $old['typ'] === 'org' ? $old['org_name'] : $old['name'];
    $kind = $old['typ'] === 'org'
        ? ($en ? 'Request (association/company)' : 'Žádost (spolek/firma)')
        : ($en ? 'Request (individual)' : 'Žádost (jednotlivec)');
    $to = ($en && trim((string) (CONFIG['mail']['to_en'] ?? '')) !== '') ? trim(CONFIG['mail']['to_en']) : CONFIG['mail']['to'];

    try {
        mailer()->send($to, $kind . ' — ' . $who, $body, $old['email'], null, [], $who);
    } catch (Throwable $e) {
        log_mail_error($e);
        return [['_form' => t('join.err.send', ['email' => $to])], $old];
    }

    foreach ($limits as $key => $windows) {
        rate_limit($key, $windows);
    }

    flash_set('join', ['email' => $old['email'], 'lines' => $lines]);
    redirect(url('join_done'));
}

/** Shrnutí žádosti jako [popisek, hodnota] v aktuálním jazyce. */
function join_summary(array $o): array
{
    $period = in_array($o['period'], JOIN_PERIODS, true) ? t('join.period.' . $o['period']) : '';

    if ($o['typ'] === 'org') {
        $plan = $o['plan'];
        $gb = (int) $o['storage_org'];
        return array_values(array_filter([
            [t('sum.type'), t('join.type.org')],
            [t('sum.org'), $o['org_name']],
            [t('sum.plan'), t('price.' . ($plan === 'spolek' ? 'club' : 'company'))],
            [t('sum.ico'), $o['ico']],
            [t('sum.storage'), storage_label($gb)],
            [t('sum.price'), t('join.per_month', ['price' => money(nextcloud_price($plan, $gb))])],
            [t('sum.period'), $period],
            [t('sum.users'), $o['users'] ?: '—'],
            [t('sum.billing'), $o['org_address']],
            [t('sum.contact'), $o['contact']],
            [t('sum.email'), $o['email']],
            $o['note'] !== '' ? [t('sum.note'), $o['note']] : null,
        ]));
    }

    $service = $o['service'];
    $rows = [
        [t('sum.type'), t('join.type.person')],
        [t('sum.name'), $o['name']],
        [t('sum.service'), t('join.service.' . $service, ['price' => money(TRILIUM_PRICES['monthly'])])],
        [t('sum.email'), $o['email']],
    ];
    if ($service === 'nextcloud' || $service === 'family') {
        $plan = $service === 'nextcloud' ? 'jednotlivec' : 'rodina';
        $gb = (int) ($service === 'nextcloud' ? $o['storage'] : $o['storage_family']);
        $rows[] = [t('sum.storage'), storage_label($gb)];
        $rows[] = [t('sum.price'), t('join.per_month', ['price' => money(nextcloud_price($plan, $gb))])];
    }
    if ($service === 'trilium') {
        $rows[] = [t('sum.price'), money(TRILIUM_PRICES[$o['period']] ?? TRILIUM_PRICES['monthly']) . ' ' . t($o['period'] === 'yearly' ? 'per_year' : 'per_month')];
    }
    if (in_array($service, JOIN_PAID, true)) {
        $rows[] = [t('sum.period'), $period];
        $rows[] = [t('sum.billing'), $o['billing_name'] . ', ' . $o['billing_address']];
    }
    if ($o['note'] !== '') {
        $rows[] = [t('sum.note'), $o['note']];
    }
    return $rows;
}
