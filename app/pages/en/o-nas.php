<?php
// About & contact page (English). Association details are in ORG in app/bootstrap.php.

return [
    'title'       => 'About & contact — OSCloud',
    'description' => 'OSCloud, z. s. is a Czech community running open source services without ads or tracking. Association details, bank details and contact.',
    'nav'         => 'about',

    'hero' => [
        'breadcrumb' => [['About', null]],
        'eyebrow'    => 'A community, not a company',
        'title'      => 'About us',
        'lead'       => 'OSCloud is a Czech community running open source services **without ads or tracking**.',
        'paragraphs' => [
            'Our servers run in Germany at Hetzner, so your data does not leave Europe.',
            'Since September 2026 we are a registered association. No investors, no exit plan. We do this because we believe privacy and open source matter.',
        ],
        'buttons'    => [['Join us', url('join')], ['Send an email', 'mailto:' . ORG['email']]],
        'emoji'      => '🤝',
        'chips'      => ['Association', 'Open source', 'Data in the EU', 'No ads'],
    ],

    'blocks' => [
        [
            'type'   => 'facts',
            'title'  => 'Association details',
            'groups' => [
                ['Association', [
                    ['Name', ORG['name']],
                    ['Legal form', 'Association (spolek)'],
                    ['Company ID', ORG['ico']],
                    ['VAT ID', ORG['dic']],
                    ['Registered office', ORG['street'] . ', ' . ORG['city']],
                    ['Register', 'Regional Court in Plzeň, section L, file 11449'],
                    ['VAT', 'We are not a VAT payer, all prices are final.'],
                ]],
                ['Contact', [
                    ['Email', ORG['email'], 'mailto:' . ORG['email']],
                    ['Support', 'helpdesk.oscloud.cz', LINKS['helpdesk']],
                    ['Join us', 'Request form', url('join')],
                    ['Matrix', 'chat.mxchat.cz', LINKS['matrix']],
                    ['Mastodon', '@oscloud@mamutovo.cz', LINKS['mastodon']],
                    ['Git', 'git.oscloud.cz/OSCloud', LINKS['git_org']],
                    ['Blog', 'blog.oscloud.cz', LINKS['blog']],
                    ['Documentation', 'docs.oscloud.cz', LINKS['docs']],
                ]],
            ],
        ],
        [
            'type'   => 'facts',
            'bg'     => 'ice',
            'id'     => 'ucty',
            'title'  => 'Bank details',
            'text'   => ['MONETA Money Bank (code 0600). For donations, write “dar” in the payment message.'],
            'groups' => [
                ['Transparent account', [
                    ['Account', ORG['bank']['transparent'][0]],
                    ['IBAN', ORG['bank']['transparent'][1]],
                ]],
                ['Private account', [
                    ['Account', ORG['bank']['private'][0]],
                    ['IBAN', ORG['bank']['private'][1], null, 'For those who do not want to be publicly visible, and for companies and associations. We forward payments to the transparent account under an alias.'],
                ]],
            ],
        ],
        [
            'type'    => 'cards',
            'title'   => 'What we care about',
            'columns' => 4,
            'items'   => [
                ['icon' => 'eye-off', 'title' => 'No tracking', 'text' => 'No ads, no tracking cookies, no selling data.'],
                ['icon' => 'code', 'title' => 'Open source', 'text' => 'Anyone can check everything we run.'],
                ['icon' => 'globe', 'title' => 'Data in the EU', 'text' => 'Server in Germany, backups on separate storage.'],
                ['icon' => 'people', 'title' => 'Community', 'text' => 'We are non-profit, everything goes into running the services.'],
            ],
        ],
        [
            'type'       => 'closing',
            'bg'         => 'ice',
            'heading'    => 'Want to support us?',
            'paragraphs' => ['The server costs about 8,500 CZK a month. Every donation helps, but **it is not a condition**. The services are for everyone.'],
            'buttons'    => [['Support OSCloud', url('pricing') . '#podpora'], ['Join us', url('join')]],
        ],
    ],
];
