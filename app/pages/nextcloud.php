<?php
// Stránka Nextcloud (česky). Ceny jsou v app/pricing.php.

return [
    'title'       => 'Nextcloud — soubory, kalendář, kontakty v EU | OSCloud',
    'description' => 'Soubory, kalendář a kontakty na jednom místě, na serverech v Německu. 2 GB zdarma, větší úložiště od 15 Kč měsíčně. Včetně Collabora Online.',
    'nav'         => 'services',

    'hero' => [
        'breadcrumb' => [['Ceník', url('pricing')], ['Nextcloud', null]],
        'eyebrow'    => 'Vlastní cloud',
        'title'      => 'Nextcloud',
        'lead'       => 'Tvoje soubory, kalendář a kontakty na jednom místě, na serverech v Německu.',
        'paragraphs' => ['Open source alternativa k Google Drive, iCloudu nebo Dropboxu, **bez reklam a sledování**.'],
        'price'      => ['', '2 GB zdarma', '· větší od ' . money(PRICES['nc']['5']) . ' / měsíc'],
        'buttons'    => [['Chci se připojit', url('join') . '?sluzba=free'], ['Návod v dokumentaci', doc('nextcloud')]],
        'emoji'      => '🗂️',
        'chips'      => ['Soubory', 'Kalendář', 'Kontakty', 'Collabora'],
    ],

    'blocks' => [
        [
            'type'  => 'cards',
            'title' => 'Co umí',
            'columns' => 3,
            'items' => [
                ['icon' => 'sync', 'title' => 'Soubory všude', 'text' => 'Dostupné z webu, mobilu i počítače a **synchronizované mezi zařízeními**.'],
                ['icon' => 'share', 'title' => 'Sdílení odkazem', 'text' => 'Soubory a složky sdílíš odkazem, volitelně **s heslem a platností**.'],
                ['icon' => 'calendar', 'title' => 'Kalendář a kontakty', 'text' => 'Synchronizovatelné s mobilem přes CalDAV a CardDAV.'],
                ['icon' => 'tasks', 'title' => 'Online kancelář', 'text' => 'Dokumenty, tabulky a prezentace přímo v prohlížeči přes **Collabora Online**, i několik lidí najednou. Ne každý poskytovatel ho nabízí, u nás je v ceně.'],
                ['icon' => 'globe', 'title' => 'Data v EU', 'text' => 'Data zůstávají v EU, **zálohy máme na samostatném úložišti**.'],
                ['icon' => 'heart', 'title' => '2 GB zdarma', 'text' => 'Nextcloud si vyzkoušíš zdarma. Když ti místo nestačí, přidáš si větší úložiště.'],
            ],
            'id'     => 'collabora',
        ],
        [
            'type'  => 'nextcloud-prices',
            'bg'    => 'ice',
            'id'    => 'cenik',
            'title' => 'Ceník',
            'text'  => 'Cena za měsíc podle velikosti úložiště. Rodina je od ' . money(PRICES['family_base']) . ' se společným úložištěm ' . PRICES['nc_family_min'] . ' GB (větší podle tabulky), spolky od ' . money(plan_from('spolek')) . ' a firmy od ' . money(plan_from('firma')) . ' (cena úložiště + příplatek ' . money(ORG_SURCHARGE['spolek']) . ' a ' . money(ORG_SURCHARGE['firma']) . ').',
            'notes' => [
                'Ceny ve sloupcích Spolek a Firma jsou **celkové**: cena úložiště + příplatek za tarif.',
                '**Společný balík.** Rodina, Spolek i Firma mají jedno úložiště vybrané velikosti. Správce týmu rozděluje místo mezi členy a tým dohromady balík nepřekročí. Týmová složka 10 GB je v ceně, na domluvu větší (vždy v rozsahu balíku).',
                'Větší úložiště než 1 TB je možné po domluvě jako externí úložiště. Nejsme plátci DPH, všechny ceny jsou konečné.',
            ],
        ],
        [
            'type'  => 'stories',
            'title' => 'Tarify podrobně',
            'items' => [
                ['highlight' => ['1 účet', 'úložiště podle tabulky'], 'title' => 'Jednotlivec', 'paragraphs' => ['Jeden účet, úložiště od 5 GB do 1 TB podle tabulky.']],
                ['highlight' => ['až 6 lidí', 'od ' . money(PRICES['family_base']) . ' / měsíc'], 'title' => 'Rodina', 'paragraphs' => [
                    'Až 6 uživatelů Nextcloudu, každý s vlastním účtem, a **společné úložiště od 5 GB** (velikost podle tabulky). Správce týmu rozdělí místo mezi členy podle potřeby, celek balík nepřekročí. **Týmová složka 10 GB** je v ceně. Sdílené kalendáře a kontakty, podpora přes Matrix.',
                ]],
                ['highlight' => ['až 10 lidí', 'od ' . money(plan_from('spolek')) . ' / měsíc'], 'title' => 'Pro spolky', 'paragraphs' => ['Až 10 uživatelů Nextcloudu se společným úložištěm, týmová složka 10 GB, sdílené kalendáře a kontakty, fakturace s IČO, podpora e-mailem a přes Matrix.']],
                ['highlight' => ['až 10 lidí', 'od ' . money(plan_from('firma')) . ' / měsíc'], 'title' => 'Firemní', 'paragraphs' => ['Až 10 uživatelů se společným úložištěm, týmová složka 10 GB, sdílené kalendáře a kontakty, fakturace s IČO, podpora e-mailem a přes Matrix, **reakce do 24 hodin**.', 'Počet uživatelů je orientační. Při větším týmu se ozvi na [info@oscloud.cz](mailto:info@oscloud.cz) nebo přes [helpdesk](' . LINKS['helpdesk'] . ') a domluvíme se.']],
            ],
        ],
        [
            'type'       => 'text',
            'heading'    => 'Jak fungují týmové tarify',
            'paragraphs' => ['Rodina, Spolek i Firma fungují jako **jeden společný balík úložiště**, o který se dělí celý tým. Platíš za velikost balíku, uživatelé v něm jsou zdarma.'],
            'list'       => [
                '**Společný strop.** Tým má jeden limit podle zvoleného balíku. Správce rozdělí místo mezi členy (třeba jednomu 35 GB, jinému 5 GB), nebo nechá čerpání volné. Dohromady tým balík nepřekročí.',
                '**Týmová složka je součástí balíku.** Sdílená složka pro všechny členy se počítá do velikosti balíku, není navíc. Výchozí velikost 10 GB, po domluvě jiný poměr. Příklad: balík 50 GB = 40 GB pro členy + 10 GB sdílená složka.',
                '**Správce týmu.** Členy přidává a jejich místo nastavuje sám vedoucí týmu, nemusíš nám psát za každého zvlášť.',
                '**Za co platíš.** Cena = úložiště (balík) + správa. U spolku a firmy je v příplatku fakturace s IČO a zpracovatelská smlouva, u firmy navíc reakce do 24 hodin. Příplatek je za administrativu, ne za gigabajty.',
                '**Velká úložiště (1 TB a výš).** Řešíme individuálně po domluvě. Napiš nám, co potřebuješ.',
            ],
        ],
        [
            'type'  => 'columns',
            'bg'    => 'ice',
            'items' => [
                [
                    'heading'    => 'Tým pro spolky a firmy',
                    'paragraphs' => ['U tarifů pro spolky a firmy stačí, aby se k OSCloudu přihlásil **jen vedoucí týmu**. Ostatní členy si přidává sám, nemusíš nám psát za každého zvlášť.'],
                    'steps'      => [
                        'Vedoucí týmu dostane OSCloud účet (žádost přes [formulář](' . url('join') . '?typ=spolek)).',
                        'Přihlásí se do Nextcloudu.',
                        'My mu vytvoříme tým vaší firmy nebo spolku s dohodnutým úložištěm a uděláme ho správcem týmu.',
                        'Správce týmu si do něj sám přidává lidi.',
                    ],
                    'after'      => ['Maximum je 6 uživatelů u rodiny a 10 u spolku a firmy. Pokud potřebujete víc, není to problém, jen se ozvěte na podporu.'],
                ],
                [
                    'heading' => 'Jak začít',
                    'steps'   => [
                        'Vyplň [formulář Chci se připojit](' . url('join') . ') a napiš, co potřebuješ (zdarma, nebo větší úložiště).',
                        'Ozveme se ti e-mailem s pozvánkou a údaji k přihlášení.',
                        'Přihlas se, nastav si silné heslo a zapni **dvoufázové ověření** (Nastavení → Zabezpečení).',
                    ],
                    'buttons' => [['Chci se připojit', url('join')]],
                ],
            ],
        ],
        [
            'type'       => 'text',
            'heading'    => 'Aplikace a synchronizace',
            'paragraphs' => ['Pro pohodlnou synchronizaci si nainstaluj [oficiální aplikaci Nextcloud](https://nextcloud.com/install/#install-clients). Při přihlášení zadej adresu našeho serveru a svůj účet.'],
            'list'       => [
                '**Počítač** (Linux, Windows, macOS): desktopový klient synchronizuje vybrané složky.',
                '**Android a iOS**: aplikace Nextcloud, volitelně s automatickým nahráváním fotek.',
                '**Kalendář a kontakty**: přes CalDAV a CardDAV, na Androidu například přes DAVx5.',
            ],
            'note'       => '**Synchronizace není záloha.** Smažeš-li soubor na jednom zařízení, zmizí i jinde. Důležité věci si proto zálohuj ještě samostatně a mimo OSCloud, například na vlastní externí disk.',
            'links'      => [['Podrobné kroky a screenshoty v dokumentaci', doc('nextcloud')]],
        ],
        [
            'type'  => 'faq',
            'bg'    => 'ice',
            'title' => 'Časté dotazy',
            'items' => [
                ['Kolik je zdarma?', 'Každý má 2 GB. Větší úložiště je od 15 Kč měsíčně, až do 1 TB.'],
                ['Můžu to použít pro rodinu?', 'Ano. Tarif Rodina je pro domácnost, až 6 lidí. Každý má vlastní účet a všichni sdílíte jedno úložiště (od 5 GB), které rozděluje správce. K tomu týmová složka 10 GB a sdílené kalendáře a kontakty.'],
                ['Jak se dělí místo v týmu?', 'Týmový tarif je jedno společné úložiště. Správce rozdělí místo mezi členy (třeba jednomu 35 GB, jinému 5 GB) a víc než velikost balíku se dohromady nevyužije. Potřebuješ-li víc, vybereš větší balík.'],
                ['Čím se liší Rodina od Jednotlivce?', 'Jednotlivec je jeden účet. Rodina je až šest oddělených účtů propojené společnou skupinou a složkou. Nextcloud totiž povolí sdílení mezi uživateli jen ve společné skupině. Bez Rodiny můžete soubory dál posílat odkazem (volitelně s heslem a platností), ale nesdílíte kalendář s úpravami ani společnou složku.'],
                ['Můžu to použít pro spolek nebo firmu?', 'Ano. Spolkový a firemní tarif zahrnuje více uživatelů a fakturu s IČO.'],
                ['Kde jsou data?', 'Na serverech Hetzner v Německu, tedy v EU.'],
                ['Můžu tarif změnit?', 'Napiš nám a úložiště upravíme.'],
            ],
        ],
        [
            'type'       => 'closing',
            'heading'    => 'Potřebuješ pomoct?',
            'paragraphs' => ['Napiš na [info@oscloud.cz](mailto:info@oscloud.cz), přes [helpdesk](' . LINKS['helpdesk'] . ') nebo na [Matrixu](' . url('matrix') . ').'],
            'buttons'    => [['Chci se připojit', url('join')], ['Celý ceník', url('pricing')]],
        ],
    ],
];
