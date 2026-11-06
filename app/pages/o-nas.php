<?php
// Stránka O nás a kontakt (česky). Údaje spolku jsou v ORG v app/bootstrap.php.

return [
    'title'       => 'O nás a kontakt — OSCloud, z. s.',
    'description' => 'OSCloud, z. s. je česká komunita, která provozuje open source služby bez reklam a sledování. Údaje o spolku, bankovní spojení a kontakt.',
    'nav'         => 'about',

    'hero' => [
        'breadcrumb' => [['O nás', null]],
        'eyebrow'    => 'Komunita, ne firma',
        'title'      => 'O nás',
        'lead'       => 'OSCloud je česká komunita, která provozuje open source služby **bez reklam a sledování**.',
        'paragraphs' => [
            'Servery běží v Německu (Hetzner, Contabo, netcup), takže data neopouští Evropu.',
            'Od září 2026 jsme registrovaný spolek. Žádní investoři, žádný exit plan. Děláme to, protože věříme, že soukromí a open source mají smysl.',
        ],
        'buttons'    => [['Chci se připojit', url('join')], ['Napsat e-mail', 'mailto:' . ORG['email']]],
        'emoji'      => '🤝',
        'chips'      => ['Spolek', 'Open source', 'Data v EU', 'Bez reklam'],
    ],

    'blocks' => [
        [
            'type'   => 'facts',
            'title'  => 'Údaje o spolku',
            'groups' => [
                ['Spolek', [
                    ['Název', ORG['name']],
                    ['Právní forma', 'Spolek'],
                    ['IČO', ORG['ico']],
                    ['DIČ', ORG['dic']],
                    ['Sídlo', ORG['street'] . ', ' . ORG['city']],
                    ['Zápis', 'Krajský soud v Plzni, oddíl L, vložka 11449'],
                    ['DPH', 'Nejsme plátci DPH, všechny ceny jsou konečné.'],
                ]],
                ['Kontakt', [
                    ['E-mail', ORG['email'], 'mailto:' . ORG['email']],
                    ['Podpora', 'helpdesk.oscloud.cz', LINKS['helpdesk']],
                    ['Chci se připojit', 'Formulář žádosti', url('join')],
                    ['Matrix', 'chat.mxchat.cz', LINKS['matrix']],
                    ['Mastodon', '@oscloud@mamutovo.cz', LINKS['mastodon']],
                    ['Git', 'git.oscloud.cz/OSCloud', LINKS['git_org']],
                    ['Blog', 'blog.oscloud.cz', LINKS['blog']],
                    ['Dokumentace', 'docs.oscloud.cz', LINKS['docs']],
                ]],
            ],
        ],
        [
            'type'   => 'facts',
            'bg'     => 'ice',
            'id'     => 'ucty',
            'title'  => 'Bankovní spojení',
            'text'   => ['MONETA Money Bank (kód 0600). Do zprávy u daru napiš „dar“.'],
            'groups' => [
                ['Transparentní účet', [
                    ['Číslo účtu', ORG['bank']['transparent'][0]],
                    ['IBAN', ORG['bank']['transparent'][1]],
                ]],
                ['Netransparentní účet', [
                    ['Číslo účtu', ORG['bank']['private'][0]],
                    ['IBAN', ORG['bank']['private'][1], null, 'Pro ty, kdo nechtějí být veřejně vidět, a pro firmy a spolky. Platby z něj přeposíláme na transparentní účet pod aliasem.'],
                ]],
            ],
        ],
        [
            'type'  => 'cards',
            'title' => 'Na čem nám záleží',
            'columns' => 4,
            'items' => [
                ['icon' => 'eye-off', 'title' => 'Žádné sledování', 'text' => 'Bez reklam, bez sledovacích cookies, bez prodeje dat.'],
                ['icon' => 'code', 'title' => 'Open source', 'text' => 'Všechno, co provozujeme, si může kdokoli zkontrolovat.'],
                ['icon' => 'globe', 'title' => 'Data v EU', 'text' => 'Server v Německu, zálohy na samostatném úložišti.'],
                ['icon' => 'people', 'title' => 'Komunita', 'text' => 'Nejsme ziskoví, všechno jde do provozu.'],
            ],
        ],
        [
            'type'       => 'closing',
            'bg'         => 'ice',
            'heading'    => 'Chceš nás podpořit?',
            'paragraphs' => ['Server stojí asi 8 500 Kč měsíčně. Každý dar pomůže, ale **není to podmínka**. Služby jsou pro všechny.'],
            'buttons'    => [['Podpořit OSCloud', url('pricing') . '#podpora'], ['Chci se připojit', url('join')]],
        ],
    ],
];
