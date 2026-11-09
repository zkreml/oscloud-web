<?php
// Pricing (English). Prices come from app/pricing.php, only texts are here.

$trilium = TRILIUM_PRICES;

return [
    'title'       => 'Pricing — Nextcloud, Ente Photos, Trilium | OSCloud',
    'description' => 'Basic services are free. Nextcloud from 15 CZK a month, Ente Photos, Trilium Next, community Mastodon, forums, wikis and web hosting. No VAT, prices are final.',
    'nav'         => 'pricing',

    'hero' => [
        'breadcrumb' => [['Pricing', null]],
        'eyebrow'    => 'Free or for a few crowns',
        'title'      => 'Pricing',
        'lead'       => 'Basic services are **free**. You choose Nextcloud by storage size.',
        'paragraphs' => ['Associations and companies pay extra for invoices with a company ID, support and more users. All prices are in Czech crowns (CZK) and final, we are not a VAT payer.', 'You can pay by bank transfer from abroad using our IBAN (account details on the [About us](' . url('about') . '#ucty) page). Your bank converts the amount at its own rate.'],
        'buttons'    => [['Join us', url('join')], ['Price table', '#nextcloud-cenik']],
        'emoji'      => '🧾',
        'chips'      => ['Free', 'from 15 CZK', 'no VAT', 'no ads'],
    ],

    'blocks' => [
        [
            'type'  => 'tiers',
            'title' => 'Choose your plan',
            'text'  => 'Everything can be combined. Start for free and add more when you need it.',
            'items' => [
                [
                    'name' => 'Community', 'price' => ['', 'Free', ''], 'sub' => 'For anyone who wants to try open source',
                    'features' => ['Mastodon, Pixelfed, PeerTube', 'SearXNG, CryptPad, PrivateBin (after registration)', 'FreshRSS, HedgeDoc, Vaultwarden', 'Forgejo: Git hosting, private and public repositories', '**Nextcloud 2 GB**', 'Support via Matrix'],
                    'button' => ['Start for free', url('join') . '?sluzba=free'], 'featured' => true, 'badge' => 'Most popular',
                ],
                [
                    'name' => 'Individual', 'price' => ['from', money(PRICES['nc']['5']), '/ month'], 'sub' => 'Nextcloud, as much as you need',
                    'features' => ['Everything in Community', '**Nextcloud 5 GB to 1 TB**', 'Support via Matrix', 'Price as per the table below'],
                    'button' => ['Choose storage', '#nextcloud-cenik'],
                ],
                [
                    'name' => 'Family', 'price' => ['from', money(PRICES['family_base']), '/ month'], 'sub' => 'Shared storage ' . PRICES['nc_family_min'] . ' GB, larger as per the table',
                    'features' => ['Everything in Community', '**Up to 6 users**, each with their own account', 'You divide the storage among yourselves as needed', '10 GB team folder included', 'Shared calendars and contacts', 'Support via Matrix'],
                    'button' => ['Order Family', url('join') . '?typ=rodina&gb=50'],
                ],
                [
                    'name' => 'Associations', 'price' => ['from', money(plan_from('spolek')), '/ month'], 'sub' => 'Includes ' . PRICES['nc_org_min'] . ' GB shared storage, larger as per the table',
                    'features' => ['Everything in Community', '**Up to 10 Nextcloud users**, shared storage', '10 GB team folder included', 'Shared calendars and contacts', 'Invoices with company ID', 'Support by email + Matrix', 'The scope can be adjusted'],
                    'button' => ['Order for an association', url('join') . '?typ=spolek&gb=50'],
                ],
                [
                    'name' => 'Companies', 'price' => ['from', money(plan_from('firma')), '/ month'], 'sub' => 'Includes ' . PRICES['nc_org_min'] . ' GB shared storage, larger as per the table',
                    'features' => ['Everything in Community', '**Up to 10 Nextcloud users**, shared storage', '10 GB team folder included', 'Shared calendars and contacts', 'Invoices with company ID', 'Support by email + Matrix', 'SLA: response within 24 hours', 'The scope can be adjusted'],
                    'button' => ['Order for a company', url('join') . '?typ=firma&gb=50'],
                ],
            ],
        ],
        [
            'type'   => 'nextcloud-prices',
            'bg'     => 'ice',
            'id'     => 'nextcloud',
            'title'  => 'Nextcloud price per month by storage',
            'text'   => 'Click a price and the request form is pre-filled. More about Nextcloud on [its own page](' . url('nextcloud') . ').',
            'notes'  => [
                'Prices in the Association and Company columns are **totals**: the storage price plus the plan surcharge.',
                '**How team plans work.** Family, Association and Company plans have one shared storage of the chosen size (see the table). The team administrator adds members and divides the space among them as needed, or leaves usage open. The team as a whole never exceeds the package size. The 10 GB team folder is part of the package; by agreement it can be larger, but always within the chosen plan.',
                'We set up storage of 1 TB and above by arrangement as external storage. The number of users in the Association and Company plans is approximate. For a bigger team, write to [info@oscloud.cz](mailto:info@oscloud.cz).',
                'It is a good idea to back up important data outside OSCloud as well, for example on your own external drive.',
            ],
        ],
        [
            'type'  => 'columns',
            'id'    => 'dalsi',
            'items' => [
                [
                    'heading'    => '📷 Ente Photos – encrypted photos',
                    'paragraphs' => ['A separate product at **oscloud.photos**, an alternative to Google Photos. Photos are encrypted right on your device, so not even we can see them. **Every account has 10 GB free forever.**'],
                    'list'       => [
                        'With a yearly subscription you pay up to two months less.',
                        'You can share storage with up to 5 family members at no extra cost.',
                        'Subscriptions are bought on oscloud.photos (also from a mobile browser), not in the app. Payment by card via Stripe.',
                    ],
                    'links'      => [['More about Ente Photos', url('ente')], ['Documentation', doc('ente-photos')]],
                ],
                [
                    'heading'    => '📝 Trilium Next – your own notes',
                    'paragraphs' => ['Your own Trilium Next instance: tree-structured notes, Markdown and access from anywhere. **Including 5 GB of storage.**'],
                    'list'       => [
                        'Every customer has their own separate instance and backups.',
                        'Custom domain (e.g. notes.mydomain.com) on request.',
                        'Custom domain and more storage individually.',
                    ],
                    'links'      => [['More about Trilium Next', url('trilium')], ['Documentation', doc('triliumnext')]],
                ],
            ],
        ],
        [
            'type'  => 'columns',
            'items' => [
                [
                    'type'    => 'table',
                    'caption' => 'Ente Photos price by storage',
                    'heading' => 'Ente Photos',
                    'head'    => ['Storage', 'Monthly', 'Yearly'],
                    'rows'    => array_map(fn ($gb, $p) => [storage_label($gb), money($p[0]), money($p[1])], array_keys(ENTE_PRICES), ENTE_PRICES),
                    'notes'   => ['10 GB free forever. Subscriptions are bought on [oscloud.photos](https://oscloud.photos).'],
                ],
                [
                    'type'    => 'table',
                    'caption' => 'Trilium Next price',
                    'heading' => 'Trilium Next',
                    'head'    => ['Plan', 'Price', ''],
                    'rows'    => [
                        ['Basic', money($trilium['monthly']) . ' / month', ['Order', url('join') . '?typ=trilium&period=monthly']],
                        ['Yearly', money($trilium['yearly']) . ' / year', ['Order', url('join') . '?typ=trilium&period=yearly']],
                    ],
                    'notes'   => ['Custom domain and more storage individually.'],
                ],
            ],
        ],
        [
            'type'  => 'offers',
            'bg'    => 'ice',
            'id'    => 'pro-komunity',
            'title' => 'For associations and communities',
            'text'  => 'Your own services, tailored. Leave administration, updates and backups to us.',
            'items' => [
                ['emoji' => '🐘', 'title' => 'Mastodon for small communities', 'price' => 'from ' . money(PRICES['mastodon']) . ' / month',
                    'text' => 'Your own Mastodon instance for a smaller association or community; expect dozens of active users, not hundreds. Administration, updates and backups are on us. Custom domain possible. A larger instance on a separate server can be arranged individually.'],
                ['emoji' => '💬', 'title' => 'Forum for communities', 'price' => 'from ' . money(PRICES['forum']) . ' / month',
                    'text' => 'Your own discussion forum (Discourse or NodeBB) for your association, project or community. Administration and backups are on us.'],
                ['emoji' => '📚', 'title' => 'Wiki for communities', 'price' => 'from ' . money(PRICES['wiki']) . ' / month',
                    'text' => 'Your own wiki for an association, project or community. Choose from BookStack, DokuWiki, MediaWiki, Wiki.js or Docmost. Administration, updates and backups are on us.'],
                ['emoji' => '🌐', 'title' => 'Web hosting and email',
                    'text' => 'On your own domain, administration and backups on us. A mailbox can only be ordered together with web hosting.',
                    'list' => [
                        ['Static site (Surfer), 1 GB **from ' . money(PRICES['hosting']['static']) . '/mo**', doc('surfer')],
                        ['LAMP (PHP + MySQL), 5 GB **from ' . money(PRICES['hosting']['lamp']) . '/mo**', doc('lamp')],
                        ['Managed WordPress, 5 GB **from ' . money(PRICES['hosting']['wordpress']) . '/mo**', doc('wordpress-managed')],
                        'Mailbox 1 / 5 / 10 GB **' . implode(' / ', array_values(PRICES['mail'])) . ' CZK/mo**',
                    ]],
                ['emoji' => '🧡', 'title' => 'Charities and youth groups',
                    'text' => 'We support non-profit and charitable associations, youth groups, scouts and similar communities. We agree on the terms individually.',
                    'link' => ['Get in touch via helpdesk', LINKS['helpdesk']]],
            ],
        ],
        [
            'type'    => 'offers',
            'id'      => 'sponzoring',
            'title'   => 'Sponsoring',
            'text'    => 'Support OSCloud regularly? We will put your logo on oscloud.cz.',
            'columns' => 1,
            'items'   => [
                ['emoji' => '🤝', 'title' => 'Sponsorship levels',
                    'text' => 'Details by agreement. Click a level to open an email.',
                    'list' => [
                        ['**Bronze** ' . money(PRICES['sponsor']['bronz']) . '/mo', 'mailto:info@oscloud.cz?subject=Sponzoring%20OSCloud%20-%20Bronz'],
                        ['**Silver** ' . money(PRICES['sponsor']['stribro']) . '/mo', 'mailto:info@oscloud.cz?subject=Sponzoring%20OSCloud%20-%20Stribro'],
                        ['**Gold** ' . money(PRICES['sponsor']['zlato']) . '/mo', 'mailto:info@oscloud.cz?subject=Sponzoring%20OSCloud%20-%20Zlato'],
                    ]],
            ],
        ],
        [
            'type'       => 'donate',
            'id'         => 'podpora',
            'heading'    => '💙 Just want to support OSCloud?',
            'paragraphs' => [
                'You do not need the services but like what we do? You can send us **any donation**. It helps cover the server, backups and our work. We are non-profit, everything goes into running the services.',
            ],
            'accounts'   => ['Transparent account', 'Private account'],
            'after'      => [
                'Write “dar” (donation) in the payment message. IBANs are on the [About page](' . url('about') . '#ucty).',
                'Need a receipt? Email [info@oscloud.cz](mailto:info@oscloud.cz) your name, the amount and the date of payment and we will issue a donation receipt. It confirms the payment; we cannot guarantee a tax deduction.',
            ],
            'qr_alt'     => 'QR code for a payment to the OSCloud transparent account',
            'qr_caption' => 'QR payment · transparent account',
        ],
        [
            'type'       => 'closing',
            'heading'    => 'More services are on the way.',
            'paragraphs' => ['Have an idea what would be useful? Write to us via the form or on Matrix. Ideas are welcome.'],
            'buttons'    => [['Join us', url('join')], ['Matrix chat', url('matrix')]],
        ],
    ],
];
