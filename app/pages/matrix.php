<?php
// Stránka Matrix – mxchat.cz (česky).

return [
    'title'       => 'Matrix — mxchat.cz | OSCloud',
    'description' => 'Komunitní chat na otevřeném decentralizovaném protokolu Matrix. Bez reklam, bez sledování, a můžeš si povídat i s lidmi z jiných Matrix serverů.',
    'nav'         => 'community',

    'hero' => [
        'breadcrumb' => [['Komunita', url('home') . '#komunita'], ['Matrix', null]],
        'eyebrow'    => 'Komunitní chat',
        'title'      => 'Matrix — mxchat.cz',
        'lead'       => 'Komunitní chat na otevřeném decentralizovaném protokolu Matrix.',
        'paragraphs' => ['Bez reklam, bez sledování, a můžeš si povídat **i s lidmi z jiných Matrix serverů**.'],
        'buttons'    => [['Vstoupit do komunity', LINKS['matrix']], ['Otevřít chat', LINKS['mxchat']]],
        'emoji'      => '💬',
        'chips'      => ['Šifrované', 'Federace', 'Element', 'FluffyChat'],
    ],

    'blocks' => [
        [
            'type'       => 'text',
            'heading'    => 'Co je Matrix',
            'paragraphs' => ['Matrix je otevřený protokol pro chat, **podobně jako e-mail**: máš účet na jednom serveru, a přesto píšeš s lidmi na jakémkoli jiném. Náš server je mxchat.cz, takže tvoje adresa bude vypadat jako **@jmeno:mxchat.cz**.'],
        ],
        [
            'type'  => 'columns',
            'bg'    => 'ice',
            'items' => [
                [
                    'heading'    => 'Jak získat účet',
                    'paragraphs' => ['Mxchat je komunitní Matrix server provozovaný OSCloudem. Registrace není uzavřená, jen na pozvání: vyžaduje **krátké schválení správcem**. Slouží to jako ochrana před spamboty a pro kvalitu komunity.'],
                    'steps'      => [
                        'Vyplň [formulář Chci se připojit](' . url('join') . '?sluzba=matrix), jako službu vyber Matrix chat a do poznámky napiš požadovaný nick a krátce, proč chceš účet.',
                        'Obvykle odpovídáme do 24 hodin.',
                        'Po schválení ti pošleme registrační token. **Token platí pro 5 lidí**, takže s ním můžeš pozvat i kamarády nebo rodinu.',
                        'Na [chat.mxchat.cz](' . LINKS['mxchat'] . ') klikni na Create Account, vyplň údaje a vlož token.',
                    ],
                    'buttons'    => [['Požádat o účet', url('join') . '?sluzba=matrix']],
                ],
                [
                    'heading'    => 'Alternativa: přihlášení přes OSCloud',
                    'paragraphs' => [
                        'Pokud už máš účet na OSCloud, token nepotřebuješ. Na [chat.mxchat.cz](' . LINKS['mxchat'] . ') klikni na **Continue with OSCloud** a přihlas se svým OSCloud účtem.',
                    ],
                    'after'      => [],
                    'note'       => '**Proč ne otevřená registrace?** Otevřené registrace na Matrix serverech přitahují spamboty a účty zneužívané k šíření nevyžádaného obsahu. Schvalování nám umožňuje udržet server s čistým štítem na banlistech federace a chránit komunitu před obtěžováním.',
                ],
            ],
        ],
        [
            'type'       => 'text',
            'heading'    => 'Aplikace',
            'paragraphs' => [
                'Web stačí, ale na mobilu a počítači je pohodlnější aplikace. Funguje jakýkoli Matrix klient, třeba [Element](https://element.io/download) nebo [FluffyChat](https://fluffychat.im/). Při přihlášení zadej jako domovský server **https://mxchat.cz**.',
                'Podpora OSCloud běží přes Matrix, takže se na nás můžeš obrátit rovnou tady. Pro cokoli oficiálního je tu [info@oscloud.cz](mailto:info@oscloud.cz).',
            ],
        ],
        [
            'type'   => 'facts',
            'bg'     => 'ice',
            'groups' => [
                ['Odkazy', [
                    ['Web mxchat.cz', 'web.mxchat.cz', 'https://web.mxchat.cz'],
                    ['Chat', 'chat.mxchat.cz', LINKS['mxchat']],
                    ['Server', 'mxchat.cz'],
                    ['Dokumentace', 'docs.oscloud.cz', LINKS['docs']],
                ]],
            ],
        ],
        [
            'type'       => 'closing',
            'heading'    => 'Přidej se k nám.',
            'paragraphs' => ['V místnosti #oscloudcz se řeší podpora, novinky i obyčejné povídání.'],
            'buttons'    => [['Vstoupit do komunity', LINKS['matrix']], ['Požádat o účet', url('join') . '?sluzba=matrix']],
        ],
    ],
];
