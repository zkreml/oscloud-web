<?php
/*
 * Konfigurace webu OSCloud.
 *
 * Zkopíruj tento soubor jako config/config.php a doplň heslo k e-mailu.
 * config/config.php se nenahrává v ZIPu s webem, aby se při aktualizaci nepřepsal.
 */

return [
    // true jen při vývoji – zobrazuje chyby PHP přímo na stránce
    'debug' => false,

    // Umami (analytics.oscloud.cz) – ID webu; prázdné = měření vypnuté
    'umami_id' => '92b865bd-f0d2-4d73-a974-14f428a1b7f5',

    'mail' => [
        // cloudron = odesílání přes poštu Cloudronu (údaje z proměnných prostředí CLOUDRON_MAIL_*, žádné heslo v souboru)
        // smtp     = vlastní SMTP server (doplň host, port, username, password níže)
        // log      = jen zápis do storage/mail.log (lokální vývoj)
        'driver'     => 'cloudron',

        // jen pro driver smtp – heslo nikdy necommituj, config.php je v .gitignore
        'host'       => '',
        'port'       => 465,
        'encryption' => 'ssl',            // ssl (465) | tls (587, STARTTLS) | none
        'username'   => '',
        'password'   => '',

        // odesílatel (u driveru cloudron ho určuje platforma)
        'from'       => 'noreply@oscloud.cz',
        'from_name'  => 'OSCloud',

        // kam chodí žádosti: schránky ve FreeScoutu
        'to'         => 'registrace@oscloud.cz',
        'to_en'      => 'en@oscloud.cz',   // anglická verze webu; prázdné = použije se 'to'
    ],
];
