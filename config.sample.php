<?php
// Zkopíruj jako config.php a vyplň secret:
//   php -r 'echo bin2hex(random_bytes(32)), PHP_EOL;'
return [
    'secret'          => 'ZMEN_NA_64_ZNAKU_Z_PHP_RANDOM_BYTES',
    'mail_to'         => 'fediverse@oscloud.cz', // schránka, kterou čte FreeScout (helpdesk.oscloud.cz/mailbox/4)
    'mail_from'       => '',   // prázdné = CLOUDRON_MAIL_FROM, jinak noreply@oscloud.cz
    'allowed_origins' => ['https://oscloud.cz', 'https://www.oscloud.cz'],
    'trust_proxy'     => true, // false, pokud PHP není za reverzní proxy
    // 'data_dir'     => '/app/data/oscloud-forms-data',
    // 'dry_run_dir'  => '/tmp/outbox', // jen pro testy, nic neodesílá
];
