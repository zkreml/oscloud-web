<?php
// Převzato z původního webu oscloud.cz (/zpracovatelska-smlouva). Odstavec = řetězec, seznam = ['list' => [...]], **tučně**, [odkaz](adresa).

return [
    'template'    => 'legal',
    'title'       => 'Zpracovatelská smlouva — OSCloud',
    'description' => 'Smlouva o zpracování osobních údajů (čl. 28 GDPR) pro zákazníky OSCloud, z. s.',
    'nav'         => null,

    'heading'   => 'Zpracovatelská smlouva',
    'lead'      => 'Smlouva podle čl. 28 GDPR mezi zákazníkem (správcem) a OSCloud, z. s. (zpracovatelem). Uzavírá se spolu s objednávkou placené služby, pokud zákazník ukládá osobní údaje třetích osob.',
    'effective' => '18. října 2026',

    'sections' => [
        [
            'title' => 'Smluvní strany',
            'body'  => [
                '**Správce:** zákazník podle objednávky (název, IČO a adresa jsou uvedeny v objednávce a potvrzení). **Zpracovatel:** OSCloud, z. s., IČO 29991145, Pionýrů 1332, 356 01 Sokolov.',
            ],
        ],
        [
            'title' => 'Předmět a doba zpracování',
            'body'  => [
                'Zpracovatel pro správce poskytuje službu podle objednávky (například Nextcloud, fórum, webhosting nebo e-mail) a v jejím rámci zpracovává osobní údaje, které do služby vloží správce. Zpracování trvá po dobu trvání smlouvy o službě.',
            ],
        ],
        [
            'title' => 'Povaha, účel a rozsah',
            'body'  => [
                ['list' => [
                    '**Povaha zpracování:** ukládání, zálohování a zpřístupňování údajů ve službě.',
                    '**Účel:** poskytování objednané služby správci.',
                    '**Typy údajů:** údaje obsažené v souborech, zprávách a obsahu, který správce do služby vloží; identifikační a kontaktní údaje členů týmu.',
                    '**Kategorie osob:** členové, zaměstnanci, klienti a další osoby, o nichž správce údaje do služby vloží.',
                ]],
            ],
        ],
        [
            'title' => 'Povinnosti zpracovatele',
            'body'  => [
                ['list' => [
                    'Zpracovávat údaje pouze podle doložených pokynů správce, mezi něž patří tato smlouva a objednávka.',
                    'Zajistit mlčenlivost osob, které mají k údajům přístup.',
                    'Přijmout vhodná technická a organizační opatření: šifrovaný přenos (HTTPS), omezení přístupu na oprávněné osoby, zálohování na samostatné úložiště a pravidelné aktualizace.',
                    'Zapojit další zpracovatele jen za podmínek podle článku 5.',
                    'Pomáhat správci s vyřizováním žádostí dotčených osob a s plněním povinností podle GDPR, v rozumné míře a s ohledem na povahu zpracování.',
                    'Bez zbytečného odkladu, nejpozději do 48 hodin od zjištění, oznámit správci porušení zabezpečení osobních údajů.',
                    'Po ukončení smlouvy údaje smazat podle článku 5 podmínek (po lhůtě pro stažení), případně je správci vrátit, a to dle jeho volby.',
                    'Poskytnout správci informace potřebné k doložení plnění povinností a umožnit audit, na požádání, v dohodnutém termínu a tak, aby nebyl ohrožen provoz ani bezpečnost ostatních zákazníků.',
                ]],
            ],
        ],
        [
            'title' => 'Další zpracovatelé',
            'body'  => [
                'Správce uděluje obecný souhlas se zapojením dalších zpracovatelů. K datu této smlouvy je to:',
                'O změně seznamu zpracovatel informuje správce e-mailem nejméně 30 dnů předem. Správce může proti změně vznést námitku, a pokud se nedohodnou, může smlouvu o službě vypovědět.',
            ],
        ],
        [
            'title' => 'Povinnosti správce',
            'body'  => [
                'Správce odpovídá za zákonnost zpracování a za to, že má k vkládání údajů do služby právní základ a splnil informační povinnosti vůči dotčeným osobám. Správce je povinen nevkládat do služby údaje, k jejichž zpracování zpracovatel není vybaven, bez předchozí dohody (zejména zvláštní kategorie osobních údajů).',
            ],
        ],
        [
            'title' => 'Závěrečná ustanovení',
            'body'  => [
                'Tato smlouva je nedílnou součástí smlouvy o službě. V případě rozporu má přednost tato smlouva, pokud jde o zpracování osobních údajů. Smlouva se řídí právem České republiky. Kontakt ve věci osobních údajů: [info@oscloud.cz](mailto:info@oscloud.cz). Účinnost od: 18. října 2026.',
            ],
        ],
    ],
];

