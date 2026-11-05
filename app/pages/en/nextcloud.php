<?php
// Nextcloud page (English). Prices are in app/pricing.php.

return [
    'title'       => 'Nextcloud — OSCloud',
    'description' => 'Files, calendar and contacts in one place, on servers in Germany. 2 GB free, more storage from 15 CZK a month. Collabora Online included.',
    'nav'         => 'services',

    'hero' => [
        'breadcrumb' => [['Pricing', url('pricing')], ['Nextcloud', null]],
        'eyebrow'    => 'Your own cloud',
        'title'      => 'Nextcloud',
        'lead'       => 'Your files, calendar and contacts in one place, on servers in Germany.',
        'paragraphs' => ['An open source alternative to Google Drive, iCloud or Dropbox, **without ads or tracking**.'],
        'price'      => ['', '2 GB free', '· more from ' . money(PRICES['nc']['5']) . ' / month'],
        'buttons'    => [['Join us', url('join') . '?sluzba=free'], ['Documentation', doc('nextcloud')]],
        'emoji'      => '🗂️',
        'chips'      => ['Files', 'Calendar', 'Contacts', 'Collabora'],
    ],

    'blocks' => [
        [
            'type'    => 'cards',
            'title'   => 'What it does',
            'columns' => 3,
            'id'      => 'collabora',
            'items'   => [
                ['icon' => 'sync', 'title' => 'Files everywhere', 'text' => 'Available on the web, phone and computer, **synced between devices**.'],
                ['icon' => 'share', 'title' => 'Share by link', 'text' => 'Share files and folders by link, optionally **with a password and expiry**.'],
                ['icon' => 'calendar', 'title' => 'Calendar & contacts', 'text' => 'Sync with your phone via CalDAV and CardDAV.'],
                ['icon' => 'tasks', 'title' => 'Online office', 'text' => 'Documents, spreadsheets and presentations in the browser with **Collabora Online**, even several people at once. Not every provider offers it; with us it is included.'],
                ['icon' => 'globe', 'title' => 'Data in the EU', 'text' => 'Data stays in the EU, **backups on separate storage**.'],
                ['icon' => 'heart', 'title' => '2 GB free', 'text' => 'Try Nextcloud for free. When you run out of space, add more storage.'],
            ],
        ],
        [
            'type'  => 'nextcloud-prices',
            'bg'    => 'ice',
            'id'    => 'cenik',
            'title' => 'Pricing',
            'text'  => 'Price per month by storage size. Family from ' . money(PRICES['family_base']) . ' including a shared ' . PRICES['nc_family_min'] . ' GB folder (larger folders cost more, see the table), associations from ' . money(plan_from('spolek')) . ' and companies from ' . money(plan_from('firma')) . ' (storage price + a surcharge of ' . money(ORG_SURCHARGE['spolek']) . ' and ' . money(ORG_SURCHARGE['firma']) . ').',
            'notes' => [
                'Prices in the Association and Company columns are **totals**: the storage price plus the plan surcharge.',
                '**Everything can be combined.** The Family plan includes a shared folder of the chosen size and each member gets 2 GB free. Anyone who needs more space for themselves can buy their own storage at the Individual price; the shared folder stays the same.',
                'Storage over 1 TB is possible by arrangement as external storage. We are not a VAT payer, all prices are final.',
            ],
        ],
        [
            'type'  => 'stories',
            'title' => 'Plans in detail',
            'items' => [
                ['highlight' => ['1 account', 'storage as per table'], 'title' => 'Individual', 'paragraphs' => ['One account, storage from 5 GB to 1 TB as per the table.']],
                ['highlight' => ['4 people', 'from ' . money(PRICES['family_base']) . ' / month'], 'title' => 'Family', 'paragraphs' => [
                    '4 Nextcloud users, each with their own account and 2 GB free, plus a **shared 50 GB folder** for everyone. A larger folder costs more as per the table. Shared calendars and contacts, support via Matrix.',
                    'Anyone who needs more space for themselves can buy personal storage at the Individual price; the shared folder stays the same.',
                ]],
                ['highlight' => ['5 people', 'from ' . money(plan_from('spolek')) . ' / month'], 'title' => 'Associations', 'paragraphs' => ['5 Nextcloud users with shared storage, shared calendars and contacts, invoices with company ID, support by email and via Matrix.']],
                ['highlight' => ['10 people', 'from ' . money(plan_from('firma')) . ' / month'], 'title' => 'Companies', 'paragraphs' => ['10 users with shared storage, shared calendars and contacts, invoices with company ID, support by email and via Matrix, **response within 24 hours**.', 'The number of users is approximate. For a bigger team write to [info@oscloud.cz](mailto:info@oscloud.cz) or use the [helpdesk](' . LINKS['helpdesk'] . ').']],
            ],
        ],
        [
            'type'  => 'columns',
            'bg'    => 'ice',
            'items' => [
                [
                    'heading'    => 'Teams for associations and companies',
                    'paragraphs' => ['With the association and company plans, **only the team leader** needs to sign up with OSCloud. They add the other members themselves.'],
                    'steps'      => [
                        'The team leader gets an OSCloud account (request via the [form](' . url('join') . '?typ=spolek)).',
                        'They log in to Nextcloud.',
                        'We create a team for your company or association with the agreed storage and make them the team admin.',
                        'The team admin adds people themselves.',
                    ],
                    'after'      => ['The maximum is 5 users for associations and 10 for companies. Need more? No problem, just contact support.'],
                ],
                [
                    'heading' => 'How to start',
                    'steps'   => [
                        'Fill in the [Join us form](' . url('join') . ') and tell us what you need (free or more storage).',
                        'We will email you an invitation and login details.',
                        'Log in, set a strong password and turn on **two-factor authentication** (Settings → Security).',
                    ],
                    'buttons' => [['Join us', url('join')]],
                ],
            ],
        ],
        [
            'type'       => 'text',
            'heading'    => 'Apps and sync',
            'paragraphs' => ['For convenient sync install the [official Nextcloud app](https://nextcloud.com/install/#install-clients). When logging in, enter our server address and your account.'],
            'list'       => [
                '**Computer** (Linux, Windows, macOS): the desktop client syncs selected folders.',
                '**Android and iOS**: the Nextcloud app, optionally with automatic photo upload.',
                '**Calendar and contacts**: via CalDAV and CardDAV, on Android e.g. with DAVx5.',
            ],
            'note'       => '**Sync is not a backup.** If you delete a file on one device, it disappears everywhere. Back up important things separately and outside OSCloud, for example on your own external drive.',
            'links'      => [['Detailed steps and screenshots in the documentation', doc('nextcloud')]],
        ],
        [
            'type'  => 'faq',
            'bg'    => 'ice',
            'title' => 'FAQ',
            'items' => [
                ['How much is free?', 'Everyone gets 2 GB. More storage starts at 15 CZK a month, up to 1 TB.'],
                ['Can I use it for my family?', 'Yes. The Family plan is for four people in the same household. Everyone has their own account with 2 GB free and you all share a 50 GB folder (larger for extra). Plus shared calendars and contacts.'],
                ['Can it be combined?', 'Yes. Family has a shared folder (from 50 GB) and each member 2 GB free. Anyone who needs more space just for themselves buys their own storage at the Individual price. The others can stay on 2 GB free and the shared folder does not change.'],
                ['How is Family different from Individual?', 'Individual is one account. Family is four separate accounts linked by a shared group and folder. Nextcloud only allows sharing between users in a shared group. Without Family you can still send files by link (optionally with a password and expiry), but you will not share an editable calendar or a common folder.'],
                ['Can I use it for an association or company?', 'Yes. The association and company plans include more users and invoices with a company ID.'],
                ['Where is the data?', 'On Hetzner servers in Germany, i.e. in the EU.'],
                ['Can I change my plan?', 'Write to us and we will adjust your storage.'],
            ],
        ],
        [
            'type'       => 'closing',
            'heading'    => 'Need help?',
            'paragraphs' => ['Write to [info@oscloud.cz](mailto:info@oscloud.cz), use the [helpdesk](' . LINKS['helpdesk'] . ') or [Matrix](' . url('matrix') . ').'],
            'buttons'    => [['Join us', url('join')], ['Full pricing', url('pricing')]],
        ],
    ],
];
