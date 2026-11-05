<?php
// De-Googling page (English) – what to replace with what.

return [
    'title'       => 'De-Googling — what to replace Google services with | OSCloud',
    'description' => 'What to replace with what: photos, files, email, chat, passwords and social networks. Step by step and without stress, with a poster to download.',
    'nav'         => 'degoogle',

    'hero' => [
        'breadcrumb' => [['De-Googling', null]],
        'eyebrow'    => '$ oscloud --degoogle --step-by-step',
        'title'      => 'De-Googling',
        'lead'       => 'Step by step, no stress.',
        'paragraphs' => ['What to replace with what. Everything you see here is run by us, **a non-profit association**. You do not have to switch everything at once, start with your photos, for example.'],
        'buttons'    => [['Start for free', url('join') . '?sluzba=free'], ['Download the poster', '#plakat']],
        'emoji'      => '🧹',
        'chips'      => ['No Google', 'Step by step', 'Free', 'In the EU'],
    ],

    'blocks' => [
        [
            'type'    => 'swaps',
            'title'   => 'What to replace with what',
            'instead' => 'Instead of',
            'use'     => 'use:',
            'items'   => [
                ['from' => 'Google Photos', 'to' => 'Ente Photos', 'host' => 'oscloud.photos', 'text' => 'Photos are encrypted right on your device, not even we can see them.', 'badge' => '10 GB free forever', 'href' => url('ente')],
                ['from' => 'Google Drive, Calendar', 'to' => 'Nextcloud', 'host' => '', 'text' => 'Files, sharing, calendars and contacts in one place.', 'badge' => '2 GB free · from 15 CZK/mo', 'href' => url('nextcloud')],
                ['from' => 'Gmail', 'to' => 'Your own email', 'host' => '', 'text' => 'A mailbox on your own domain. We take care of administration and backups. Ordered together with web hosting.', 'badge' => 'from 19 CZK/mo', 'href' => url('pricing') . '#pro-komunity'],
                ['from' => 'Google Chat, WhatsApp', 'to' => 'Matrix', 'host' => 'mxchat.cz', 'text' => 'Federation: you can write to people on other servers too. OSCloud support also runs on Matrix.', 'badge' => '', 'href' => url('matrix')],
                ['from' => 'password managers', 'to' => 'Vaultwarden', 'host' => 'pass.oscloud.cz', 'text' => 'Compatible with Bitwarden clients: web, desktop, mobile and browser extensions.', 'badge' => 'open registration', 'href' => LINKS['pass']],
                ['from' => 'Google Search', 'to' => 'SearXNG', 'host' => 'searxng.cz', 'text' => 'A search engine that sends your queries to multiple sources.', 'badge' => 'open to everyone', 'href' => LINKS['searxng']],
                ['from' => 'Google Docs', 'to' => 'CryptPad, HedgeDoc', 'host' => '', 'text' => 'Collaborative documents with privacy and shared notes in Markdown.', 'badge' => 'free · SSO, one password', 'href' => LINKS['cryptpad']],
                ['from' => 'YouTube', 'to' => 'PeerTube', 'host' => 'vhsky.cz', 'text' => 'Video sharing without a central platform.', 'badge' => 'open registration', 'href' => LINKS['peertube']],
                ['from' => 'Instagram', 'to' => 'Pixelfed', 'host' => 'pixelfed.cz', 'text' => 'Photo sharing in the fediverse.', 'badge' => 'open registration', 'href' => LINKS['pixelfed']],
                ['from' => 'X (Twitter)', 'to' => 'Mastodon', 'host' => 'mamutovo.cz', 'text' => 'A decentralised social network.', 'badge' => 'open registration', 'href' => LINKS['mamutovo']],
                ['from' => 'GitHub', 'to' => 'Forgejo', 'host' => 'git.oscloud.cz', 'text' => 'Your own Git hosting: private and public repositories, issues, pull requests. Log in with SSO.', 'badge' => 'free · open registration', 'href' => LINKS['git']],
                ['from' => 'Strava', 'to' => 'FitPub', 'host' => 'makni.cz', 'text' => 'Sports activities in the fediverse.', 'badge' => 'open registration', 'href' => LINKS['fitpub']],
                ['from' => 'algorithmic feeds', 'to' => 'FreshRSS', 'host' => '', 'text' => 'An RSS reader instead of algorithmically sorted news.', 'badge' => 'free · SSO, one password', 'href' => doc('freshrss')],
            ],
        ],
        [
            'type'    => 'cards',
            'bg'      => 'ice',
            'title'   => 'Start for free',
            'text'    => ['Try the Community plan: Mastodon, Pixelfed, PeerTube, SearXNG, CryptPad, PrivateBin (after registration), FreshRSS, HedgeDoc, Vaultwarden, Forgejo and Nextcloud with 2 GB.'],
            'columns' => 3,
            'items'   => [
                ['icon' => 'heart', 'title' => 'Non-profit', 'text' => 'Run by the association OSCloud, z. s. No investors.'],
                ['icon' => 'server', 'title' => 'Server at Hetzner', 'text' => 'Germany, regular backups.'],
                ['icon' => 'chat', 'title' => 'Support', 'text' => 'Via Matrix and helpdesk in every plan.'],
            ],
        ],
        [
            'type'    => 'downloads',
            'id'      => 'plakat',
            'heading' => 'Poster to download',
            'text'    => 'The same overview as a poster you can share or print (English version).',
            'image'   => 'plakat-degooglizace-en-nahled.png',
            'alt'     => 'Preview of the De-Googling poster – what to replace with what',
            'items'   => [
                ['Download PNG', 'plakat-degooglizace-en.png', '436 kB'],
                ['Download PDF', 'plakat-degooglizace-en.pdf', '100 kB'],
                ['PDF for printing (light, saves ink)', 'plakat-degooglizace-en-tisk.pdf', '85 kB'],
            ],
        ],
        [
            'type'       => 'closing',
            'bg'         => 'ice',
            'heading'    => 'You do not have to do it all at once.',
            'paragraphs' => ['Start with one service and see how it suits you. If you get stuck, we will help on Matrix.'],
            'buttons'    => [['Join us', url('join')], ['Community on Matrix', url('matrix')]],
        ],
    ],
];
