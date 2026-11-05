<?php
// Ceník (česky). Ceny se berou z app/pricing.php, tady jsou jen texty.

$trilium = TRILIUM_PRICES;

return [
    'title'       => 'Ceník — Nextcloud, Ente Photos, Trilium | OSCloud',
    'description' => 'Základní služby jsou zdarma. Nextcloud od 15 Kč měsíčně, Ente Photos, Trilium Next, komunitní Mastodon, fóra, wiki a webhosting. Bez DPH, ceny jsou konečné.',
    'nav'         => 'pricing',

    'hero' => [
        'breadcrumb' => [['Ceník', null]],
        'eyebrow'    => 'Zdarma i za pár korun',
        'title'      => 'Ceník',
        'lead'       => 'Základní služby jsou **zdarma**. Nextcloud si vybereš podle velikosti úložiště.',
        'paragraphs' => ['Spolky a firmy platí navíc za fakturu s IČO, podporu a víc uživatelů. Nejsme plátci DPH, všechny ceny jsou konečné.'],
        'buttons'    => [['Chci se připojit', url('join')], ['Tabulka cen', '#nextcloud-cenik']],
        'emoji'      => '🧾',
        'chips'      => ['Zdarma', 'od 15 Kč', 'bez DPH', 'bez reklam'],
    ],

    'blocks' => [
        [
            'type'  => 'tiers',
            'title' => 'Vyber si tarif',
            'text'  => 'Vše jde kombinovat. Začít můžeš zdarma a přidat si, až budeš potřebovat.',
            'items' => [
                [
                    'name' => 'Komunita', 'price' => ['', 'Zdarma', ''], 'sub' => 'Pro každého, kdo chce vyzkoušet open source',
                    'features' => ['Mastodon, Pixelfed, PeerTube', 'SearXNG, CryptPad, PrivateBin (po registraci)', 'FreshRSS, HedgeDoc, Vaultwarden', 'Forgejo: Git hosting, soukromé i veřejné repozitáře', '**Nextcloud 2 GB**', 'Podpora přes Matrix'],
                    'button' => ['Začít zdarma', url('join') . '?sluzba=free'], 'featured' => true, 'badge' => 'Nejoblíbenější',
                ],
                [
                    'name' => 'Jednotlivec', 'price' => ['od', money(PRICES['nc']['5']), '/ měsíc'], 'sub' => 'Nextcloud podle toho, kolik potřebuješ',
                    'features' => ['Všechno z tarifu Komunita', '**Nextcloud 5 GB až 1 TB**', 'Podpora přes Matrix', 'Cena podle tabulky níže'],
                    'button' => ['Vybrat úložiště', '#nextcloud-cenik'],
                ],
                [
                    'name' => 'Rodina', 'price' => ['od', money(PRICES['family_base']), '/ měsíc'], 'sub' => 'Včetně společné složky ' . PRICES['nc_family_min'] . ' GB',
                    'features' => ['Všechno z tarifu Komunita', '**4 uživatelé**, každý s vlastním účtem a 2 GB zdarma', 'Společná složka pro všechny členy, větší za příplatek', 'Sdílené kalendáře a kontakty', 'Podpora přes Matrix'],
                    'button' => ['Objednat Rodinu', url('join') . '?typ=rodina&gb=50'],
                ],
                [
                    'name' => 'Pro spolky', 'price' => ['od', money(plan_from('spolek')), '/ měsíc'], 'sub' => 'Včetně společného úložiště ' . PRICES['nc_org_min'] . ' GB, větší podle tabulky',
                    'features' => ['Všechno z tarifu Komunita', '**5 uživatelů** Nextcloudu, úložiště společně', 'Sdílené kalendáře a kontakty', 'Fakturace s IČO', 'Podpora e-mail + Matrix', 'Rozsah lze upravit podle potřeb'],
                    'button' => ['Objednat pro spolek', url('join') . '?typ=spolek&gb=50'],
                ],
                [
                    'name' => 'Firemní', 'price' => ['od', money(plan_from('firma')), '/ měsíc'], 'sub' => 'Včetně společného úložiště ' . PRICES['nc_org_min'] . ' GB, větší podle tabulky',
                    'features' => ['Všechno z tarifu Komunita', '**10 uživatelů** Nextcloudu, úložiště společně', 'Sdílené kalendáře a kontakty', 'Fakturace s IČO', 'Podpora e-mail + Matrix', 'SLA – reakce do 24 hodin', 'Rozsah lze upravit podle potřeb'],
                    'button' => ['Objednat pro firmu', url('join') . '?typ=firma&gb=50'],
                ],
            ],
        ],
        [
            'type'   => 'nextcloud-prices',
            'bg'     => 'ice',
            'id'     => 'nextcloud',
            'title'  => 'Cena Nextcloudu za měsíc podle úložiště',
            'text'   => 'Klikni na cenu a formulář žádosti se předvyplní. Podrobně o Nextcloudu najdeš na [samostatné stránce]('.url('nextcloud').').',
            'notes'  => [
                'Ceny ve sloupcích Spolek a Firma jsou **celkové**: cena úložiště + příplatek za tarif.',
                '**Vše jde kombinovat.** V tarifu Rodina je v ceně společná složka vybrané velikosti a každý člen má navíc 2 GB zdarma. Komu to nestačí, může si přikoupit vlastní větší úložiště za cenu ze sloupce Jednotlivec, společná složka se tím nemění. Příklad: společná složka 50 GB (50 Kč) a jeden člen s vlastními 100 GB (69 Kč), ostatní zůstanou na 2 GB zdarma.',
                'Větší úložiště než 1 TB je možné po domluvě jako externí úložiště. Počet uživatelů v tarifu spolek a firma je orientační. Při větším týmu se ozvi na [info@oscloud.cz](mailto:info@oscloud.cz) a domluvíme se.',
                'Důležitá data je vhodné zálohovat i mimo OSCloud, například na vlastní externí disk.',
            ],
        ],
        [
            'type'    => 'columns',
            'id'      => 'dalsi',
            'items'   => [
                [
                    'heading'    => '📷 Ente Photos – šifrované fotky',
                    'paragraphs' => ['Samostatný produkt na **oscloud.photos**, alternativa ke Google Photos. Fotky se šifrují přímo v tvém zařízení, takže do nich nevidíme ani my. **Každý účet má 10 GB zdarma navždy.**'],
                    'list'       => [
                        'Při ročním předplatném platíš až o dva měsíce méně.',
                        'Úložiště můžeš sdílet až s 5 členy rodiny bez příplatku.',
                        'Předplatné se kupuje na webu oscloud.photos (i z mobilu v prohlížeči), v aplikaci to nejde. Platí se kartou přes Stripe.',
                    ],
                    'links'      => [['Podrobně o Ente Photos', url('ente')], ['Návod v dokumentaci', doc('ente-photos')]],
                ],
                [
                    'heading'    => '📝 Trilium Next – vlastní poznámky',
                    'paragraphs' => ['Vlastní instance Trilium Next jen pro tebe: stromové poznámky, Markdown a přístup odkudkoli. **Včetně 5 GB úložiště.**'],
                    'list'       => [
                        'Každý zákazník má vlastní oddělenou instanci a zálohy.',
                        'Vlastní doména (například poznamky.mojedomena.cz) na vyžádání.',
                        'Vlastní doména a větší úložiště individuálně.',
                    ],
                    'links'      => [['Podrobně o Trilium Next', url('trilium')], ['Návod v dokumentaci', doc('triliumnext')]],
                ],
            ],
        ],
        [
            'type'  => 'columns',
            'flush' => true,
            'items' => [
                [
                    'type'    => 'table',
                    'caption' => 'Cena Ente Photos podle úložiště',
                    'heading' => 'Ente Photos',
                    'head'    => ['Úložiště', 'Měsíčně', 'Ročně'],
                    'rows'    => array_map(fn ($gb, $p) => [storage_label($gb), money($p[0]), money($p[1])], array_keys(ENTE_PRICES), ENTE_PRICES),
                    'notes'   => ['10 GB zdarma navždy. Předplatné se kupuje na [oscloud.photos](https://oscloud.photos).'],
                ],
                [
                    'type'    => 'table',
                    'caption' => 'Cena Trilium Next',
                    'heading' => 'Trilium Next',
                    'head'    => ['Plán', 'Cena', ''],
                    'rows'    => [
                        ['Základní', money($trilium['monthly']) . ' / měsíc', ['Objednat', url('join') . '?typ=trilium&period=monthly']],
                        ['Roční', money($trilium['yearly']) . ' / rok', ['Objednat', url('join') . '?typ=trilium&period=yearly']],
                    ],
                    'notes'   => ['Vlastní doména, větší úložiště individuálně.'],
                ],
            ],
        ],
        [
            'type'  => 'offers',
            'bg'    => 'ice',
            'id'    => 'pro-komunity',
            'title' => 'Pro spolky a komunity',
            'text'  => 'Vlastní služby na míru. Správu, aktualizace a zálohy necháš na nás.',
            'items' => [
                ['emoji' => '🐘', 'title' => 'Mastodon pro malé komunity', 'price' => 'od ' . money(PRICES['mastodon']) . ' / měsíc',
                    'text' => 'Vlastní Mastodon instance pro menší spolek nebo komunitu, počítej s desítkami aktivních uživatelů, ne stovkami. Správa, aktualizace a zálohy na nás. Možnost vlastní domény. Větší instanci na samostatném serveru domluvíme individuálně.'],
                ['emoji' => '💬', 'title' => 'Fórum pro komunity', 'price' => 'od ' . money(PRICES['forum']) . ' / měsíc',
                    'text' => 'Vlastní diskuzní fórum (Discourse nebo NodeBB) pro váš spolek, projekt nebo komunitu. Správa a zálohy na nás.'],
                ['emoji' => '📚', 'title' => 'Wiki pro komunity', 'price' => 'od ' . money(PRICES['wiki']) . ' / měsíc',
                    'text' => 'Vlastní wiki pro spolek, projekt nebo komunitu. Vybereš si z BookStack, DokuWiki, MediaWiki, Wiki.js nebo Docmost. Správa, aktualizace a zálohy na nás.'],
                ['emoji' => '🌐', 'title' => 'Webhosting a e-mail',
                    'text' => 'Na vlastní doméně, správa a zálohy na nás. E-mailová schránka se objednává jen k webhostingu.',
                    'list' => [
                        ['Statický web (Surfer), 1 GB **od ' . money(PRICES['hosting']['static']) . '/měs**', doc('surfer')],
                        ['LAMP (PHP + MySQL), 5 GB **od ' . money(PRICES['hosting']['lamp']) . '/měs**', doc('lamp')],
                        ['WordPress spravovaný, 5 GB **od ' . money(PRICES['hosting']['wordpress']) . '/měs**', doc('wordpress-managed')],
                        'E-mailová schránka 1 / 5 / 10 GB **' . implode(' / ', array_map(fn ($v) => (string) $v, array_values(PRICES['mail']))) . ' Kč/měs**',
                    ]],
                ['emoji' => '🧡', 'title' => 'Dobročinné spolky a dětské oddíly',
                    'text' => 'Podporujeme neziskové a dobročinné spolky, dětské oddíly, skauty a podobné komunity. Podmínky domluvíme individuálně.',
                    'link' => ['Ozvi se přes helpdesk', LINKS['helpdesk']]],
                ['emoji' => '🤝', 'title' => 'Sponzoring',
                    'text' => 'Logo na webu oscloud.cz. Podrobnosti domluvíme individuálně. Klikni na úroveň, otevře se e-mail.',
                    'list' => [
                        ['**Bronz** ' . money(PRICES['sponsor']['bronz']) . '/měs', 'mailto:info@oscloud.cz?subject=Sponzoring%20OSCloud%20-%20Bronz'],
                        ['**Stříbro** ' . money(PRICES['sponsor']['stribro']) . '/měs', 'mailto:info@oscloud.cz?subject=Sponzoring%20OSCloud%20-%20Stribro'],
                        ['**Zlato** ' . money(PRICES['sponsor']['zlato']) . '/měs', 'mailto:info@oscloud.cz?subject=Sponzoring%20OSCloud%20-%20Zlato'],
                    ]],
            ],
        ],
        [
            'type'       => 'donate',
            'id'         => 'podpora',
            'heading'    => '💙 Chceš jen podpořit OSCloud?',
            'paragraphs' => [
                'Služby nepotřebuješ, ale líbí se ti, co děláme? Můžeš nám poslat **libovolný dar**. Pomůže pokrýt server, zálohy a naši práci. Nejsme ziskoví, všechno jde do provozu.',
            ],
            'accounts'   => ['Transparentní účet', 'Netransparentní účet'],
            'after'      => [
                'Do zprávy napiš „dar“. IBAN najdeš na stránce [O nás](/o-nas#ucty).',
                'Potřebuješ doklad o daru? Napiš na [info@oscloud.cz](mailto:info@oscloud.cz) jméno nebo název, částku a datum platby a vystavíme ti potvrzení o přijetí daru. Je to doklad o platbě, nárok na daňový odpočet nezaručuje.',
            ],
            'qr_alt'     => 'QR kód pro platbu na transparentní účet OSCloudu',
            'qr_caption' => 'QR platba · transparentní účet',
        ],
        [
            'type'      => 'closing',
            'heading'   => 'Další služby se připravují.',
            'paragraphs' => ['Máš nápad, co by se hodilo? Napiš nám přes formulář nebo na Matrix. Nápady a zájem jsou vítané.'],
            'buttons'   => [['Chci se připojit', url('join')], ['Matrix chat', url('matrix')]],
        ],
    ],
];
