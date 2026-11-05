<?php
// Stránka Trilium Next (česky).

$p = TRILIUM_PRICES;

return [
    'title'       => 'Trilium Next — vlastní poznámky a Markdown | OSCloud',
    'description' => 'Vlastní poznámky na jednom místě: stromová struktura, Markdown, přístup odkudkoli. Vlastní oddělená instance od 65 Kč měsíčně.',
    'nav'         => 'services',

    'hero' => [
        'breadcrumb' => [['Ceník', url('pricing')], ['Trilium Next', null]],
        'eyebrow'    => 'Vlastní poznámky',
        'title'      => 'Trilium Next',
        'lead'       => 'Tvoje vlastní poznámky na jednom místě: stromová struktura, Markdown, přístup odkudkoli.',
        'paragraphs' => ['Každý zákazník má **vlastní oddělenou instanci**.'],
        'price'      => ['od', money($p['monthly']), '/ měsíc'],
        'buttons'    => [['Objednat', url('join') . '?typ=trilium&period=monthly'], ['Dokumentace', doc('triliumnext')]],
        'emoji'      => '📝',
        'chips'      => ['Strom', 'Markdown', 'Šifrování', '5 GB'],
    ],

    'blocks' => [
        [
            'type'       => 'intro',
            'paragraphs' => [
                'Trilium Next je open source nástroj na hierarchické poznámky a osobní znalostní bázi.',
                'Je to webová aplikace a k ní existuje i desktopový klient. Poznámky mohou být texty, Markdown, kód, tabulky nebo diagramy a můžeš je organizovat do stromu.',
            ],
        ],
        [
            'type'  => 'cards',
            'title' => 'Co umí',
            'columns' => 3,
            'items' => [
                ['icon' => 'tasks', 'title' => 'Stromová struktura', 'text' => 'Jedna poznámka může být na více místech (klonování).'],
                ['icon' => 'shield', 'title' => 'Šifrování', 'text' => 'Vybrané poznámky můžeš zašifrovat.'],
                ['icon' => 'sync', 'title' => 'Verzování', 'text' => 'Automaticky, takže se ke starší verzi poznámky vrátíš.'],
                ['icon' => 'share', 'title' => 'Vztahy a hledání', 'text' => 'Grafy vztahů mezi poznámkami a fulltextové vyhledávání.'],
                ['icon' => 'code', 'title' => 'Markdown a kód', 'text' => 'Markdown, kód, tabulky, diagramy a vzorce. Pro pokročilé skripty v JavaScriptu.'],
                ['icon' => 'cloud', 'title' => 'Web i desktop', 'text' => 'Synchronizace mezi webem a desktopovým klientem.'],
            ],
        ],
        [
            'type'    => 'table',
            'bg'      => 'ice',
            'id'      => 'cenik',
            'title'   => 'Cena',
            'text'    => 'V ceně je vlastní instance s **5 GB úložiště**, HTTPS a pravidelné zálohy.',
            'caption' => 'Cena Trilium Next',
            'narrow'  => true,
            'head'    => ['Plán', 'Cena', ''],
            'rows'    => [
                ['Základní', money($p['monthly']) . ' / měsíc', ['Objednat', url('join') . '?typ=trilium&period=monthly']],
                ['Roční', money($p['yearly']) . ' / rok', ['Objednat', url('join') . '?typ=trilium&period=yearly']],
            ],
            'notes'   => ['Vlastní doména a větší úložiště individuálně. OSCloud, z. s. není plátce DPH, ceny jsou konečné.'],
        ],
        [
            'type'    => 'table',
            'title'   => 'Čím se liší od Notes v Nextcloudu',
            'caption' => 'Srovnání Notes v Nextcloudu a Trilium Next',
            'head'    => ['', 'Notes v Nextcloudu', 'Trilium Next'],
            'rows'    => [
                ['Uspořádání', 'Seznam poznámek a složky', 'Strom, klonování poznámek, vztahy'],
                ['Pro koho', 'Rychlé zápisky', 'Větší znalostní báze a archiv'],
                ['Cena', 'V ceně Nextcloudu', 'Samostatná instance od ' . money($p['monthly']) . ' měsíčně'],
            ],
            'notes'   => ['Pokud ti stačí jednoduché zápisky, vystačíš si s [Nextcloudem](' . url('nextcloud') . '). Trilium se hodí, když poznámek máš hodně a chceš mezi nimi vidět souvislosti.'],
        ],
        [
            'type'  => 'faq',
            'bg'    => 'ice',
            'title' => 'Časté otázky',
            'items' => [
                ['Jak se objednává?', 'Vyplníš [žádost o připojení](' . url('join') . '?typ=trilium), kde zvolíš Trilium Next a platbu měsíčně nebo ročně. Instanci zakládáme ručně a ozveme se ti e-mailem.'],
                ['Můžu mít vlastní doménu?', 'Ano, například poznamky.mojedomena.cz. Řeší se to individuálně po objednání.'],
                ['Co když potřebuju víc než 5 GB?', 'Napiš nám a domluvíme se. Větší úložiště se řeší individuálně.'],
                ['Kde najdu návod?', 'V [dokumentaci Trilium Next](' . doc('triliumnext') . ') je popis funkcí, srovnání s jinými nástroji i nastavení.'],
                ['Jsou moje poznámky v bezpečí?', 'Každý zákazník má vlastní oddělenou instanci a data zálohujeme. Citlivé poznámky můžeš v Triliu navíc zašifrovat. Důležitá data je vhodné zálohovat i mimo OSCloud.'],
            ],
        ],
        [
            'type'    => 'closing',
            'heading' => 'Chceš vlastní Trilium?',
            'buttons' => [['Chci Trilium Next', url('join') . '?typ=trilium&period=monthly'], ['Celý ceník', url('pricing')]],
        ],
    ],
];
