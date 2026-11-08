<?php
// Převzato z původního webu oscloud.cz (/ochrana-osobnich-udaju). Odstavec = řetězec, seznam = ['list' => [...]], **tučně**, [odkaz](adresa).

return [
    'template'    => 'legal',
    'title'       => 'Ochrana osobních údajů — OSCloud',
    'description' => 'Jak OSCloud, z. s. zpracovává osobní údaje uživatelů svých služeb a návštěvníků webu.',
    'nav'         => null,

    'heading'   => 'Zásady ochrany osobních údajů',
    'lead'      => 'Jaké osobní údaje OSCloud zpracovává, proč, jak dlouho a jaká práva mají dotčené osoby.',
    'effective' => '4. listopadu 2026',

    'sections' => [
        [
            'title' => 'Správce údajů',
            'body'  => [
                ['list' => [
                    '**Správce:** OSCloud, z. s., IČO 29991145, Pionýrů 1332, 356 01 Sokolov',
                    '**Kontakt ve věci osobních údajů:** [info@oscloud.cz](mailto:info@oscloud.cz)',
                ]],
                'Pokud zákazník ukládá do služeb osobní údaje třetích osob (členy, zaměstnance, klienty), je jejich správcem zákazník a OSCloud je zpracovatelem. Vztah upravuje [zpracovatelská smlouva](/zpracovatelska-smlouva).',
            ],
        ],
        [
            'title' => 'Účely, údaje a doba uložení',
            'body'  => [
                ['table' => [
                    'head' => ['Účel', 'Údaje', 'Právní základ', 'Doba uložení'],
                    'rows' => [
                        ['Vyřízení žádosti z formuláře', 'jméno nebo přezdívka, e-mail, zvolená služba a tarif, zpráva, záznam o souhlasu s podmínkami; u placených služeb jméno a příjmení a adresa pro fakturu; u spolků a firem název, IČO, adresa, kontaktní osoba', 'jednání o uzavření smlouvy (čl. 6 odst. 1 písm. b GDPR)', 'do vyřízení žádosti, nejdéle 6 měsíců, pokud nedojde k uzavření smlouvy'],
                        ['Poskytování služeb (účet, e-mail, obsah uložený uživatelem)', 'přihlašovací a kontaktní údaje, obsah, který uživatel do služby vloží', 'plnění smlouvy (čl. 6 odst. 1 písm. b)', 'po dobu trvání smlouvy; po jejím skončení podle článku 5 podmínek'],
                        ['Fakturace a účetnictví', 'jméno a příjmení nebo název, adresa, IČO (u spolků a firem), údaje o platbách; jako účastník účetního případu musí být odběratel na faktuře označen', 'zákonná povinnost (čl. 6 odst. 1 písm. c)', 'po dobu stanovenou právními předpisy (zpravidla několik let)'],
                        ['Podpora a komunikace', 'zprávy, e-maily a tikety v helpdesku', 'plnění smlouvy, oprávněný zájem na řádné podpoře a obhajobě nároků (čl. 6 odst. 1 písm. b, f)', 'po dobu smlouvy a nejdéle 3 roky po jejím skončení (promlčecí doba)'],
                        ['Zasílání newsletteru', 'e-mailová adresa, potvrzení přihlášení (double opt-in)', 'souhlas (čl. 6 odst. 1 písm. a)', 'do odvolání souhlasu (odhlášení z newsletteru)'],
                        ['Bezpečnost a provoz', 'IP adresa, typ prohlížeče a zařízení, čas přístupu (serverové logy)', 'oprávněný zájem na bezpečnosti a stabilitě (čl. 6 odst. 1 písm. f)', 'nejdéle 14 dnů, poté se automaticky mažou'],
                        ['Statistika návštěvnosti webu', 'anonymní počty návštěv bez cookies a bez osobních identifikátorů (vlastní instance Umami na našem serveru)', 'oprávněný zájem na zlepšování webu (čl. 6 odst. 1 písm. f)', 'nejdéle 12 měsíců'],
                    ],
                ]],
                'Údaje se nepoužívají k automatizovanému rozhodování, profilování ani k reklamě. Telefonní číslo se nesbírá.',
            ],
        ],
        [
            'title' => 'Příjemci údajů',
            'body'  => [
                ['list' => [
                    '**Hetzner Online GmbH** (Německo): hosting serverů a záloh, zpracovatel.',
                    '**Contabo GmbH** (Německo): hosting serveru s chatem Matrix (mxchat.cz), zpracovatel. Server je v Mnichově.',
                    '**netcup GmbH** (Německo): hosting služby FitPub (makni.cz), zpracovatel. Datacentrum je v Norimberku.',
                    '**Stripe** (Stripe Payments Europe, Ltd., Irsko): zpracování plateb kartou u Ente Photos. Poskytovatel čísla karet nevidí ani neukládá. Stripe může údaje předávat do USA, k čemuž využívá certifikaci v rámci EU-U.S. Data Privacy Framework a standardní smluvní doložky. Další informace: [zásady ochrany osobních údajů Stripe](https://stripe.com/privacy).',
                    '**Banka**: platby převodem. Účetnictví vede spolek sám, bez externího zpracovatele.',
                    'Orgány veřejné moci, pokud to ukládá zákon.',
                ]],
                'Poskytovatel provozuje helpdesk, e-mail a další nástroje na vlastních serverech. Údaje se nepředávají dalším společnostem pro marketing. Další zpracovatele uvedených poskytovatelů najdeš v [zpracovatelské smlouvě](/zpracovatelska-smlouva).',
            ],
        ],
        [
            'title' => 'Předávání mimo EU',
            'body'  => [
                'Servery se nacházejí v Německu (Hetzner, Contabo, netcup). Osobní údaje se do třetích zemí nepředávají, s výhradou zpracování plateb zprostředkovatelem uvedeným v článku 3.',
            ],
        ],
        [
            'title' => 'Fediverse a chat',
            'body'  => [
                'Veřejné příspěvky a zprávy ve federovaných službách (Mastodon, PeerTube, Pixelfed, Matrix) se přenášejí na servery jiných provozovatelů. Po smazání na serveru OSCloud nemusí být smazány u třetích stran, které OSCloud neovládá.',
            ],
        ],
        [
            'title' => 'Zabezpečení',
            'body'  => [
                'Přenos dat je chráněn HTTPS, přístup k serverům mají jen oprávněné osoby a zálohy jsou ukládány na samostatné úložiště. Fotografie v Ente Photos jsou šifrovány end-to-end, poskytovatel k nim nemá přístup.',
            ],
        ],
        [
            'title' => 'Cookies',
            'body'  => [
                'Web oscloud.cz nepoužívá cookies ani nástroje třetích stran, proto nevyžaduje souhlas s cookies. Statistiku návštěvnosti zajišťuje Umami, které běží na našem serveru, měří anonymně a nepoužívá cookies.',
                'Jednotlivé služby (například Nextcloud, Mastodon nebo Matrix) používají jen technické cookies přihlašovacích relací, které jsou nutné k jejich provozu. Žádné reklamní ani sledovací cookies nepoužíváme. Data o používání webu ani služeb neposíláme reklamním ani analytickým službám třetích stran (například Google nebo Amazon). Data zpracovávají jen nástroje na našich serverech a poskytovatelé uvedení v části o zpracovatelích (hosting u Hetzner, zpracování plateb u Ente Photos přes Stripe).',
            ],
        ],
        [
            'title' => 'Práva dotčených osob',
            'body'  => [
                'Dotčená osoba má právo na přístup k údajům, na opravu, výmaz, omezení zpracování, přenositelnost údajů a právo vznést námitku proti zpracování založenému na oprávněném zájmu. Souhlas, byl-li udělen, lze kdykoli odvolat. Žádosti se podávají e-mailem na [info@oscloud.cz](mailto:info@oscloud.cz) a vyřizují se do jednoho měsíce.',
                'Dotčená osoba má také právo podat stížnost u dozorového úřadu: Úřad pro ochranu osobních údajů, Pplk. Sochora 27, 170 00 Praha 7, [www.uoou.gov.cz](https://www.uoou.gov.cz).',
            ],
        ],
        [
            'title' => 'Ente Photos',
            'body'  => [
                'Fotografie a soubory v Ente Photos jsou šifrovány v zařízení uživatele ještě před nahráním. Poskytovatel vidí pouze množství využitého úložiště a šifrovaná metadata nezbytná pro provoz a nemůže tedy zajistit přístup k obsahu ani jeho přenos. Data si uživatel stahuje sám v aplikaci pomocí hesla a obnovovacího klíče. Poskytovatel může na žádost smazat účet a všechna zašifrovaná data. Servery jsou v Německu (Hetzner, Falkenstein).',
            ],
        ],
        [
            'title' => 'Správce hesel (Vaultwarden)',
            'body'  => [
                'Obsah trezoru na pass.oscloud.cz (hesla, poznámky, soubory) je šifrován v zařízení uživatele ještě před odesláním na server. Poskytovatel k němu nemá přístup a nemůže ho obnovit při ztrátě hlavního hesla. Zpracovává se e-mailová adresa, otisk hlavního hesla (nikoli samotné heslo), čas registrace a přihlášení, IP adresa v serverových logách (nejdéle 14 dnů) a šifrovaná data trezoru. Právním základem je plnění smlouvy o poskytování služby (čl. 6 odst. 1 písm. b GDPR). Údaje se uchovávají po dobu existence účtu. Po jeho zrušení se data smažou a ze záloh se odstraní postupně podle rotace záloh. Servery jsou v Německu (Hetzner).',
            ],
        ],
        [
            'title' => 'Změny zásad',
            'body'  => [
                'Zásady se mohou měnit. Aktuální znění je vždy na této stránce, podstatné změny se oznamují na webu. Účinnost od: 4. listopadu 2026.',
            ],
        ],
    ],
];

