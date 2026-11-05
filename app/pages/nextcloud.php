<?php
// Stránka Nextcloud (česky). Ceny jsou v app/pricing.php.

return [
    'title'       => 'Nextcloud — OSCloud',
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
            'text'  => 'Cena za měsíc podle velikosti úložiště. Rodina je od ' . money(PRICES['family_base']) . ' včetně společné složky ' . PRICES['nc_family_min'] . ' GB (větší složka stojí víc podle tabulky), spolky od ' . money(plan_from('spolek')) . ' a firmy od ' . money(plan_from('firma')) . ' (cena úložiště + příplatek ' . money(ORG_SURCHARGE['spolek']) . ' a ' . money(ORG_SURCHARGE['firma']) . ').',
            'notes' => [
                'Ceny ve sloupcích Spolek a Firma jsou **celkové**: cena úložiště + příplatek za tarif.',
                '**Vše jde kombinovat.** V tarifu Rodina je v ceně společná složka vybrané velikosti a každý člen má navíc 2 GB zdarma. Kdo potřebuje víc místa pro sebe, přikoupí si vlastní úložiště za cenu tarifu Jednotlivec, společná složka se tím nemění.',
                'Větší úložiště než 1 TB je možné po domluvě jako externí úložiště. Nejsme plátci DPH, všechny ceny jsou konečné.',
            ],
        ],
        [
            'type'  => 'stories',
            'title' => 'Tarify podrobně',
            'items' => [
                ['highlight' => ['1 účet', 'úložiště podle tabulky'], 'title' => 'Jednotlivec', 'paragraphs' => ['Jeden účet, úložiště od 5 GB do 1 TB podle tabulky.']],
                ['highlight' => ['4 lidé', 'od ' . money(PRICES['family_base']) . ' / měsíc'], 'title' => 'Rodina', 'paragraphs' => [
                    '4 uživatelé Nextcloudu, každý s vlastním účtem a 2 GB zdarma, a **společná složka 50 GB** pro všechny. Větší složka stojí víc podle tabulky. Sdílené kalendáře a kontakty, podpora přes Matrix.',
                    'Kdo potřebuje víc místa pro sebe, může si osobní úložiště přikoupit za cenu tarifu Jednotlivec, společná složka se tím nemění.',
                ]],
                ['highlight' => ['5 lidí', 'od ' . money(plan_from('spolek')) . ' / měsíc'], 'title' => 'Pro spolky', 'paragraphs' => ['5 uživatelů Nextcloudu se společným úložištěm, sdílené kalendáře a kontakty, fakturace s IČO, podpora e-mailem a přes Matrix.']],
                ['highlight' => ['10 lidí', 'od ' . money(plan_from('firma')) . ' / měsíc'], 'title' => 'Firemní', 'paragraphs' => ['10 uživatelů se společným úložištěm, sdílené kalendáře a kontakty, fakturace s IČO, podpora e-mailem a přes Matrix, **reakce do 24 hodin**.', 'Počet uživatelů je orientační. Při větším týmu se ozvi na [info@oscloud.cz](mailto:info@oscloud.cz) nebo přes [helpdesk](' . LINKS['helpdesk'] . ') a domluvíme se.']],
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
                    'after'      => ['Maximum je 5 uživatelů u spolku a 10 u firmy. Pokud potřebujete víc, není to problém, jen se ozvěte na podporu.'],
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
                ['Můžu to použít pro rodinu?', 'Ano. Tarif Rodina je pro čtyři lidi ve stejné domácnosti. Každý má vlastní účet s 2 GB zdarma a všichni mají společnou složku 50 GB (větší za příplatek). K tomu sdílené kalendáře a kontakty.'],
                ['Dá se to kombinovat?', 'Ano. Rodina má společnou složku (od 50 GB) a každý člen 2 GB zdarma. Kdo potřebuje víc místa jen pro sebe, přikoupí si vlastní úložiště za cenu tarifu Jednotlivec. Ostatní členové mohou zůstat na 2 GB zdarma a společná složka se nemění.'],
                ['Čím se liší Rodina od Jednotlivce?', 'Jednotlivec je jeden účet. Rodina jsou čtyři oddělené účty propojené společnou skupinou a složkou. Nextcloud totiž povolí sdílení mezi uživateli jen ve společné skupině. Bez Rodiny můžete soubory dál posílat odkazem (volitelně s heslem a platností), ale nesdílíte kalendář s úpravami ani společnou složku.'],
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
