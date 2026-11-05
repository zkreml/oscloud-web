<?php
// Home page texts (English). **bold** = highlighted text.

return [
    'hero' => [
        'eyebrow'  => 'A community for digital freedom',
        'title'    => 'Your data.',
        'title_2'  => 'Your rules.',
        'lead'     => 'OSCloud is a Czech community running open source services.',
        'text'     => 'No ads, no tracking, no vendor lock-in. **Just tools that work.** Cloud, photos, chat, passwords and social networks – on a server in the EU and without Google.',
        'buttons'  => ['Join us', 'What we offer'],
        'facts'    => [['Free', 'basic services'], ['Data in the EU', '(Germany)'], ['100%', 'open source']],
        'bubbles'  => ['Nextcloud', 'Matrix', 'Mastodon', 'Ente Photos', 'Vaultwarden', 'PeerTube'],
    ],

    'services' => [
        'title' => 'What you will find here',
        'text'  => 'We do not tell you which software to use. We tell you which problem you can solve.',
        'items' => [
            ['💬', 'Want to chat securely?', 'Encrypted messages, groups, calls. No Meta, no data harvesting. You write, and you know only the other person reads it.',
                [['Matrix / Element', url('matrix')], ['MiroTalk', null], ['Ntfy', null]]],
            ['🌐', 'Want social networks without ads?', 'The Fediverse: decentralised networks with no algorithm telling you what to read.',
                [['Mastodon', LINKS['mamutovo']], ['PeerTube', LINKS['peertube']], ['Pixelfed', LINKS['pixelfed']], ['FitPub', LINKS['fitpub']]]],
            ['☁️', 'Want your own cloud?', 'Files, calendar, contacts and the Collabora online office in one place. Photos, encrypted, in Ente Photos. No Google Drive, no iCloud.',
                [['Nextcloud', url('nextcloud')], ['Ente Photos', url('ente')]]],
            ['📝', 'Want to collaborate?', 'Shared documents, spreadsheets, presentations and code. In real time, without Google. Encrypted.',
                [['CryptPad', LINKS['cryptpad']], ['HedgeDoc', doc('hedgedoc')], ['Trilium', url('trilium')], ['Collabora Online', url('nextcloud') . '#collabora'], ['Forgejo', LINKS['git']]]],
            ['🔒', 'Want your passwords safe?', 'A password manager, a private search engine, one-time text sharing. Security without compromise.',
                [['Vaultwarden', doc('vaultwarden')], ['SearXNG', doc('searxng')], ['PrivateBin (after registration)', doc('privatebin')]]],
            ['📰', 'Want to read without algorithms?', 'RSS readers, bookmarks, offline reading. You choose what you read, not an algorithm.',
                [['FreshRSS', doc('freshrss')], ['Miniflux', null], ['Wallabag', doc('wallabag')], ['Linkwarden', doc('linkwarden')]]],
        ],
        'helper' => '**Not sure where to start?** Basic services are free. A short form is all it takes.',
        'button' => 'See pricing',
    ],

    'reasons' => [
        'title' => 'Why OSCloud?',
        'text'  => 'Because privacy should be the default, not a premium feature.',
        'items' => [
            ['eye-off', 'No tracking', 'We do not use cookies on oscloud.cz, so there is nothing to click away. We measure traffic anonymously with our own Umami instance on our own server. Our services only use technical cookies needed to log in, no advertising or tracking cookies. We send no data to Google, Amazon or other advertising and analytics services. **There are no ads.** Your privacy is the default, not a premium feature.'],
            ['code', 'Open source', 'Everything we run is open source. Anyone can check the code. **No black boxes.**'],
            ['globe', 'Data in the EU', 'Our server runs in Germany at Hetzner. Your data does not leave Europe. **GDPR is not a marketing trick, it is reality.**'],
            ['people', 'A community, not a company', 'OSCloud is a non-profit association. No investors, no exit plan. **We do it because we believe it matters.**'],
        ],
    ],

    'degoogle' => [
        'terminal' => '$ oscloud --degoogle --step-by-step',
        'title'    => 'De-Googling',
        'text'     => 'What to replace with what: photos, files, e-mail, chat, passwords and social networks. **Step by step, no stress**, and there is a poster to download.',
        'swaps'    => [['Google Photos', 'Ente Photos'], ['Google Drive', 'Nextcloud'], ['WhatsApp', 'Matrix'], ['YouTube', 'PeerTube'], ['X (Twitter)', 'Mastodon']],
        'button'   => 'Take a look',
    ],

    'community' => [
        'eyebrow' => 'Community',
        'title'   => 'Meet people who care about the same things.',
        'text'    => 'Linux, self-hosting, privacy, the Fediverse. **No gatekeeping.** Anyone can ask here, even complete beginners.',
        'links'   => [
            ['💬', 'Matrix — mxchat.cz', 'Community chat and support', LINKS['matrix']],
            ['🐘', 'Mastodon', '@oscloud@mamutovo.cz', LINKS['mastodon']],
            ['🔧', 'Forgejo', 'Our code and configuration', LINKS['git_org']],
            ['📖', 'Blog', 'News and how-tos', LINKS['blog']],
        ],
    ],

    'costs' => [
        'title'  => 'Transparent operation',
        'text'   => 'We will not pretend it is free. A server costs money. Here is how it works.',
        'label'  => 'Monthly server cost',
        'amount' => '~8,500 CZK',
        'unit'   => '/ month',
        'specs'  => 'Dedicated Hetzner server · Intel Core i9-13900 · 64 GB RAM · backups on separate storage',
        'after'  => 'We pay for it ourselves. If you want to help, you can chip in, but **it is not a condition. The services are for everyone.**',
        'buttons' => ['Support OSCloud', 'About us'],
    ],

    'cta' => [
        'title'      => 'Try it. For free.',
        'paragraphs' => [
            'The Community plan is free for everyone: Mastodon, Pixelfed, PeerTube, SearXNG, CryptPad, FreshRSS, HedgeDoc, Vaultwarden, Forgejo and **Nextcloud with 2 GB**.',
        ],
        'ticks'   => ['A short form, reply by email.', 'No phone verification.', 'Support via Matrix and helpdesk.'],
        'buttons' => ['Join us', 'Full pricing'],
    ],
];
