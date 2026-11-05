<?php
// Ente Photos page (English).

return [
    'title'       => 'Ente Photos — private alternative to Google Photos | OSCloud',
    'description' => 'A private, end-to-end encrypted photo cloud at oscloud.photos. An alternative to Google Photos, 10 GB free forever, servers in Germany.',
    'nav'         => 'services',

    'hero' => [
        'breadcrumb' => [['Pricing', url('pricing')], ['Ente Photos', null]],
        'eyebrow'    => 'Encrypted photos',
        'title'      => 'Ente Photos',
        'lead'       => 'A private, end-to-end encrypted photo cloud at **oscloud.photos**. An alternative to Google Photos where only you can access your photos.',
        'paragraphs' => ['Photos are encrypted on your device before they are uploaded, so **not even we can see them**. Our own Ente instance runs on our servers in Germany (Hetzner, Falkenstein).'],
        'price'      => ['', '10 GB free', 'forever'],
        'buttons'    => [['Open oscloud.photos', LINKS['photos']], ['Documentation', doc('ente-photos')]],
        'emoji'      => '📷',
        'chips'      => ['Encrypted', 'Android', 'iOS', 'Family'],
    ],

    'blocks' => [
        [
            'type'    => 'cards',
            'title'   => 'What it does',
            'columns' => 4,
            'items'   => [
                ['icon' => 'sync', 'title' => 'Everywhere', 'text' => 'Apps for web, Android, iOS and desktop.'],
                ['icon' => 'shield', 'title' => 'Phone backups', 'text' => 'Automatic background backup of photos from your phone.'],
                ['icon' => 'share', 'title' => 'Album sharing', 'text' => 'Via an encrypted link, **even for people without an account**.'],
                ['icon' => 'people', 'title' => 'Family plan', 'text' => 'Storage for up to 5 family members **at no extra cost**.'],
            ],
        ],
        [
            'type' => 'text',
            'note' => '**Your password is the only key to your data.** If you forget your password and lose the recovery key, your photos are gone for good. Nobody can restore them, not even us. Keep the recovery key safe when you sign up (ideally printed) and keep important photos backed up elsewhere too, e.g. on your own external drive.',
        ],
        [
            'type'    => 'table',
            'bg'      => 'ice',
            'id'      => 'cenik',
            'title'   => 'Pricing',
            'text'    => 'Every account has **10 GB free forever**. Paying yearly saves you about two months.',
            'caption' => 'Ente Photos price by storage',
            'narrow'  => true,
            'head'    => ['Storage', 'Monthly', 'Yearly'],
            'rows'    => array_map(fn ($gb, $p) => [storage_label($gb), money($p[0]), money($p[1])], array_keys(ENTE_PRICES), ENTE_PRICES),
            'notes'   => ['We are not a VAT payer, prices are final.'],
        ],
        [
            'type'  => 'columns',
            'items' => [
                [
                    'heading' => 'Sign-up',
                    'steps'   => [
                        'Open [oscloud.photos](' . LINKS['photos'] . ') in your browser and click **Sign up**.',
                        'Enter your email and password (twice), accept the terms and create the account.',
                        'Enter the verification code we email you.',
                        'Keep the **recovery key** that is shown.',
                    ],
                    'after'   => ['If a “Developer settings / Server endpoint” window pops up, click Cancel and do not change anything.'],
                ],
                [
                    'heading'    => 'Subscription',
                    'paragraphs' => ['Subscriptions are bought **only on the oscloud.photos website**, which also works in a mobile browser (not in the app). Native apps pay through Google Play and the App Store, which is not possible with our instance. The message “cannot pay, contact the administrator” in the app is normal.'],
                    'steps'      => [
                        'Log in at oscloud.photos in your browser.',
                        'Menu → Subscription, choose a plan (monthly or yearly).',
                        'Pay by card via Stripe. Storage increases immediately.',
                        'Log in to the mobile app with the same account, the subscription applies automatically.',
                    ],
                ],
            ],
        ],
        [
            'type'  => 'columns',
            'bg'    => 'ice',
            'items' => [
                [
                    'heading'    => 'Apps and server setup',
                    'paragraphs' => ['The web needs no setup. In the Android, iOS and desktop apps you first need to **set our server**, otherwise they connect to the official Ente.'],
                    'steps'      => [
                        'Get the app: Google Play, F-Droid, App Store, or [ente.io/download](https://ente.io/download) for desktop.',
                        'On the welcome screen **tap the logo 7 times quickly**. The server settings open.',
                        'In the Endpoint field enter exactly **https://oscloud.photos** and save.',
                        'Log in or sign up, allow access to your photos and the backup starts.',
                    ],
                    'after'      => ['If the 7 taps do not work, try again, they must be quick. Details including video guides are in the [documentation](' . doc('ente-photos') . ').'],
                ],
                [
                    'heading'    => 'Family plan',
                    'paragraphs' => [
                        'You can share storage with **up to 5 family members**. Everyone has their own account and encryption; only capacity is shared. Members cannot see each other’s photos.',
                        'You need an active paid subscription. Then: **Menu → Subscription → Manage family → Add member** and enter their email.',
                    ],
                ],
            ],
        ],
        [
            'type'  => 'faq',
            'title' => 'FAQ',
            'items' => [
                ['Can you see my photos?', 'No. They reach the server already encrypted. We only see how much space you use.'],
                ['What if I forget my password?', 'Use the recovery key from sign-up. Without the password and the key, nobody can access the data.'],
                ['Can I move from Google Photos?', 'Yes, Ente has guides for importing from Google Photos and Apple Photos.'],
                ['Where is the data?', 'On Hetzner servers in Germany (Falkenstein), i.e. in the EU.'],
            ],
        ],
        [
            'type'       => 'closing',
            'heading'    => 'Need help?',
            'paragraphs' => ['Write to [podpora@oscloud.cz](mailto:podpora@oscloud.cz) or use the [helpdesk](' . LINKS['helpdesk'] . '). The video guides were made together with infoek.cz, thank you.'],
            'buttons'    => [['Open oscloud.photos', LINKS['photos']], ['Full pricing', url('pricing')]],
        ],
    ],
];
