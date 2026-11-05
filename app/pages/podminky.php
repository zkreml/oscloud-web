<?php
// Převzato z původního webu oscloud.cz (/podminky). Odstavec = řetězec, seznam = ['list' => [...]], **tučně**, [odkaz](adresa).

return [
    'template'    => 'legal',
    'title'       => 'Obchodní a provozní podmínky — OSCloud',
    'description' => 'Obchodní a provozní podmínky pro všechny služby OSCloud, z. s.',
    'nav'         => null,

    'heading'   => 'Obchodní a provozní podmínky',
    'lead'      => 'Podmínky platí pro všechny služby OSCloud, z. s. Platné znění je vždy na této stránce.',
    'effective' => '18. října 2026',

    'sections' => [
        [
            'title' => 'Poskytovatel a pojmy',
            'body'  => [
                ['list' => [
                    '**Poskytovatel:** OSCloud, z. s. (dále „poskytovatel“)',
                    '**IČO / DIČ:** 29991145 / CZ29991145 (poskytovatel není plátcem DPH)',
                    '**Sídlo:** Pionýrů 1332, 356 01 Sokolov',
                    '**Rejstřík:** spolkový rejstřík, Krajský soud v Plzni, oddíl L, vložka 11449',
                    '**Kontakt:** [info@oscloud.cz](mailto:info@oscloud.cz), [helpdesk.oscloud.cz](https://helpdesk.oscloud.cz/help/3271740098)',
                ]],
                'Pojmy použité v podmínkách:',
                ['list' => [
                    '**Služba** je každá služba provozovaná poskytovatelem podle článku 2.',
                    '**Uživatel** je každý, kdo služby používá.',
                    '**Zákazník** je uživatel, který s poskytovatelem uzavřel smlouvu o placené službě.',
                    '**Spotřebitel** je fyzická osoba, která uzavírá smlouvu mimo svou podnikatelskou nebo jinou výdělečnou činnost.',
                    '**Podnikatel** je zákazník, který není spotřebitelem, zejména spolek, firma nebo osoba samostatně výdělečně činná.',
                ]],
            ],
        ],
        [
            'title' => 'Služby',
            'body'  => [
                'Poskytovatel provozuje zejména tyto služby: Nextcloud, Ente Photos, chat Matrix (mxchat.cz), služby fediverse (Mastodon, PeerTube, Pixelfed, FitPub), komunitní nástroje (CryptPad, HedgeDoc, Trilium, Vaultwarden, SearXNG, PrivateBin, FreshRSS, Miniflux, Wallabag, Linkwarden, MiroTalk, ntfy), diskuzní fórum, wiki pro komunity, webhosting (statické stránky, LAMP, spravovaný WordPress) a e-mailovou schránku jako doplněk k webhostingu. Aktuální přehled a ceny jsou na [úvodní stránce](/#sluzby) a v [ceníku](/#cenik).',
                'Některé služby jsou dostupné jen po registraci v OSCloud (například PrivateBin). Bezplatné služby se poskytují bez nároku na jejich trvání a bez záruky dostupnosti. Poskytovatel je může změnit nebo ukončit, přičemž to předem oznámí způsobem uvedeným v článku 15.',
            ],
        ],
        [
            'title' => 'Uzavření smlouvy',
            'body'  => [
                ['list' => [
                    'Placená služba se objednává formulářem na webu. Údaje je možné před odesláním opravit.',
                    'Smlouva vzniká tím, že poskytovatel objednávku potvrdí e-mailem. Poskytovatel může objednávku odmítnout.',
                    'Ke dni potvrzení se zákazníkovi zašle znění podmínek v textové podobě (odkaz nebo příloha e-mailu).',
                    'Smlouva se uzavírá v českém jazyce. Údaje o objednávce poskytovatel uchovává po dobu uvedenou v [zásadách ochrany osobních údajů](/ochrana-osobnich-udaju).',
                    'Bezplatné služby se zpřístupňují registrací nebo pozvánkou. Uživatel se registrací zavazuje dodržovat tyto podmínky.',
                ]],
            ],
        ],
        [
            'title' => 'Cena a platba',
            'body'  => [
                ['list' => [
                    'Ceny stanoví ceník na webu platný ke dni potvrzení objednávky. Poskytovatel není plátcem DPH, ceny jsou konečné.',
                    'Za každou placenou službu se vystavuje faktura, která se zasílá e-mailem. U podnikatelů se uvádí IČO a údaje z objednávky.',
                    'Platí se předem za zvolené období (měsíc nebo rok) bankovním převodem na účet uvedený na faktuře, s variabilním symbolem. Splatnost je 14 dnů od vystavení.',
                    'Předplatné Ente Photos se platí kartou přes zprostředkovatele Stripe (viz příloha A).',
                    'Změnu ceny poskytovatel oznámí nejméně 30 dnů předem. Zákazník může smlouvu do účinnosti změny vypovědět.',
                ]],
            ],
        ],
        [
            'title' => 'Trvání a ukončení',
            'body'  => [
                ['list' => [
                    'Smlouva se uzavírá na dobu neurčitou a plní se po zaplacených obdobích (měsíc nebo rok).',
                    'Změna tarifu, například velikosti úložiště, se provádí k začátku dalšího období, případně dříve po dohodě.',
                    'Zákazník může smlouvu vypovědět kdykoli e-mailem. Výpověď je účinná ke konci zaplaceného období. Cena za nevyužitou část období se nevrací, pokud zákon nestanoví jinak (zejména při odstoupení podle článku 12).',
                    'Poskytovatel může smlouvu vypovědět s výpovědní dobou 30 dnů. Při podstatném porušení podmínek (články 6 a 7) ji může vypovědět s okamžitou účinností.',
                    'Po ukončení smlouvy je možné data stáhnout po dobu 14 dnů, poté se smažou. Ze záloh se odstraní postupně podle rotace záloh.',
                    'Po skončení placeného úložiště se uplatní bezplatný limit služby. Pokud data tento limit přesahují, je potřeba je před koncem období snížit nebo stáhnout. Data nad limit je pak možné pouze stáhnout po dobu 30 dnů, poté se mohou smazat.',
                ]],
            ],
        ],
        [
            'title' => 'Neplacení',
            'body'  => [
                ['list' => [
                    'Po splatnosti se zákazníkovi zašle upomínka e-mailem.',
                    'Není-li faktura uhrazena do 14 dnů po splatnosti, služba se pozastaví. Přístup se omezí, data zůstávají zachována.',
                    'Není-li dlužná částka uhrazena do 30 dnů od pozastavení, data se smažou, pokud se strany nedohodnou jinak.',
                    'Do smazání je možné službu po úhradě obnovit.',
                ]],
            ],
        ],
        [
            'title' => 'Pravidla používání',
            'body'  => [
                'Služby nelze používat k těmto činnostem:',
                ['list' => [
                    'ukládání, zveřejňování nebo šíření nezákonného obsahu, zejména obsahu zobrazujícího sexuální zneužívání dětí, podpory terorismu a násilí nebo nenávisti vůči skupinám osob,',
                    'šíření škodlivého kódu, phishing, podvody a útoky na jiné systémy,',
                    'rozesílání nevyžádaných nebo hromadných zpráv (spam),',
                    'obcházení kvót a omezení služby, nebo zneužívání cizích účtů,',
                    'porušování práv třetích osob, včetně autorských práv.',
                ]],
                'Poskytovatel může při podezření z porušení těchto pravidel účet, schránku nebo obsah okamžitě zablokovat nebo odstranit, a to i bez předchozího upozornění. Závažné případy se oznamují orgánům činným v trestním řízení.',
                'U e-mailu platí limit odesílání stanovený poskytovatelem (hodnota je uvedena v potvrzení objednávky). Rozesílání zpráv většímu počtu příjemců bez jejich souhlasu je zakázáno. Při podezření na zneužití nebo napadení schránky se odesílání ihned zablokuje, aby nebyla poškozena pověst společné odesílací adresy ostatních služeb.',
                'Služby fediverse a chat se řídí navíc pravidly příslušné instance, která mohou být přísnější (viz příloha B).',
            ],
        ],
        [
            'title' => 'Obsah, účet a nahlášení',
            'body'  => [
                ['list' => [
                    'Uživatel odpovídá za obsah, který ukládá nebo zveřejňuje, a za zabezpečení svých přihlašovacích údajů. Doporučuje se silné jedinečné heslo a dvoufázové ověření.',
                    'Poskytovatel obsah uživatelů nevyhledává ani aktivně nekontroluje. Reaguje na oznámení a na zjištěná porušení.',
                    '**Nahlášení nezákonného obsahu:** e-mailem na [info@oscloud.cz](mailto:info@oscloud.cz). Oznámení má obsahovat adresu (URL) obsahu, popis důvodu a kontakt na oznamovatele. Poskytovatel oznámení posoudí a rozhodnutí, včetně důvodů, sdělí dotčeným osobám.',
                ]],
            ],
        ],
        [
            'title' => 'Dostupnost, zálohy a odpovědnost',
            'body'  => [
                ['list' => [
                    'Poskytovatel provozuje služby s přiměřenou péčí. Plánované odstávky se oznamují předem, kdykoli je to možné. Konkrétní míra dostupnosti se negarantuje, pokud nebyla výslovně sjednána.',
                    '**Zálohy** serveru se ukládají na samostatné úložiště a slouží k obnově provozu. Nejsou archivem a obnovu jednotlivých souborů nezaručují. Synchronizace souborů není záloha. Za vlastní kopie důležitých dat odpovídá uživatel. Doporučuje se uchovávat kopii důležitých dat vždy i mimo OSCloud, například na vlastním externím disku.',
                    '**Podpora:** uživatelé komunitních služeb mohou využít chat Matrix, zákazníci e-mail a helpdesk. U tarifu pro firmy poskytovatel zahájí reakci na požadavek do 24 hodin v pracovní dny. Jde o lhůtu pro reakci, nikoli pro vyřešení.',
                    'Poskytovatel odpovídá za škodu v rozsahu stanoveném zákonem. U podnikatelů se odpovědnost omezuje na částku zaplacenou za dotčenou službu za posledních 12 měsíců a vylučuje se náhrada ušlého zisku, v rozsahu, v jakém to zákon dovoluje. Omezení odpovědnosti se nevztahuje na újmu způsobenou úmyslně nebo z hrubé nedbalosti ani na újmu na přirozených právech člověka. Práva spotřebitelů stanovená zákonem tímto nejsou dotčena.',
                ]],
            ],
        ],
        [
            'title' => 'Týmy a více uživatelů',
            'body'  => [
                ['list' => [
                    'Tarify pro spolky a firmy zahrnují orientační počet uživatelů a společné úložiště. Při větším počtu členů týmu je třeba kontaktovat podporu.',
                    'Tarif Rodina je určen pro domácnost a zahrnuje čtyři uživatele Nextcloudu se společným úložištěm. Úložiště se mezi uživatele dělí a tarif není určen k provozování služeb pro třetí osoby.',
                    'Za tým odpovídá jeho vedoucí (správce), který si členy přidává sám. Zákazník odpovídá za to, že členové dodržují tyto podmínky.',
                    'Každý člen týmu potřebuje vlastní e-mailovou adresu. Účet v Nextcloudu vzniká při prvním přihlášení člena.',
                ]],
            ],
        ],
        [
            'title' => 'Doména, webhosting a e-mail',
            'body'  => [
                ['list' => [
                    'Vlastní doména zůstává majetkem zákazníka. Zákazník odpovídá za její registraci, prodlužování a za nastavení DNS u svého správce domény. Přesné hodnoty DNS záznamů zákazník obdrží po schválení objednávky.',
                    'Webhosting se poskytuje podle objednaného tarifu jako statické stránky (HTML, CSS, JavaScript), LAMP hosting (PHP a MySQL) nebo spravovaný WordPress. Za obsah webu odpovídá zákazník, platí pravidla článků 7 a 8.',
                    'E-mailová schránka se poskytuje pouze jako doplněk k webhostingu, v objednané velikosti. Provoz na vlastní doméně vyžaduje záznamy MX, SPF, DKIM a DMARC.',
                    'U služeb s vlastní doménou, zejména Mastodonu, se název domény po spuštění instance nedá změnit.',
                ]],
            ],
        ],
        [
            'title' => 'Spotřebitelé',
            'body'  => [
                ['list' => [
                    '**Odstoupení od smlouvy:** spotřebitel může od smlouvy uzavřené na dálku odstoupit do 14 dnů od jejího uzavření bez udání důvodu. Odstoupení se oznamuje e-mailem na [info@oscloud.cz](mailto:info@oscloud.cz), vzorový formulář je k dispozici na vyžádání.',
                    'Pokud spotřebitel požádal o zahájení poskytování služby před uplynutím této lhůty, uhradí při odstoupení poměrnou část ceny za dobu, po kterou mu byla služba poskytována.',
                    '**Reklamace:** vady služby se oznamují na [info@oscloud.cz](mailto:info@oscloud.cz). Poskytovatel reklamaci vyřídí do 30 dnů. Práva z vadného plnění se řídí občanským zákoníkem.',
                    '**Mimosoudní řešení sporů:** subjektem určeným k mimosoudnímu řešení spotřebitelských sporů je Česká obchodní inspekce ([www.coi.cz](https://www.coi.cz)).',
                    'Žádné ustanovení těchto podmínek nezkracuje práva spotřebitele stanovená zákonem.',
                ]],
            ],
        ],
        [
            'title' => 'Podnikatelé, spolky a firmy',
            'body'  => [
                ['list' => [
                    'Ustanovení článku 12 se na podnikatele nevztahují.',
                    'Faktura se vystavuje na IČO zákazníka z objednávky.',
                    'Pokud zákazník ukládá osobní údaje třetích osob (například členů, zaměstnanců, klientů), je jejich správcem a poskytovatel je zpracovatelem. Vztah upravuje [zpracovatelská smlouva](/zpracovatelska-smlouva), která se uzavírá spolu s objednávkou.',
                    'Reakční doba podpory a omezení odpovědnosti jsou uvedeny v článku 9.',
                ]],
            ],
        ],
        [
            'title' => 'Osobní údaje',
            'body'  => [
                'Zpracování osobních údajů popisují [zásady ochrany osobních údajů](/ochrana-osobnich-udaju).',
            ],
        ],
        [
            'title' => 'Změny podmínek',
            'body'  => [
                'Poskytovatel může podmínky aktualizovat. O změně zveřejní nové znění na této stránce a zákazníky informuje e-mailem nejméně 30 dnů před účinností. Zákazník může do účinnosti změny smlouvu vypovědět. Změna se nedotýká již zaplaceného období.',
            ],
        ],
        [
            'title' => 'Závěrečná ustanovení',
            'body'  => [
                'Smlouvy a podmínky se řídí právem České republiky. Kontakt: [info@oscloud.cz](mailto:info@oscloud.cz). Podmínky nabývají účinnosti dnem 18. října 2026.',
            ],
        ],
        [
            'title' => 'Příloha A: Ente Photos (oscloud.photos)',
            'body'  => [
                ['list' => [
                    '**Šifrování:** soubory se šifrují přímo v zařízení uživatele ještě před nahráním na server. Poskytovatel k obsahu nemá přístup a nedokáže jej dešifrovat. Vidí pouze množství využitého úložiště a šifrovaná metadata nezbytná pro provoz.',
                    '**Heslo a obnovovací klíč** jsou jediným způsobem přístupu k datům. Při jejich ztrátě nelze data obnovit, ani poskytovatelem. Uživatel odpovídá za jejich uschování a je vhodné mít důležitá data zálohovaná i mimo službu.',
                    '**Předplatné** se kupuje pouze na webu oscloud.photos (v mobilní aplikaci to technicky nejde), platí se kartou přes Stripe. Předplatné se automaticky obnovuje (měsíčně nebo ročně), dokud ho uživatel nezruší. Ceny jsou v [ceníku](/#ente).',
                    '**Zrušení předplatného:** data se nemažou a zůstávají v rámci bezplatného limitu (10 GB). Pokud je limit překročen, nelze nahrávat nové soubory, dokud se data nesníží nebo se předplatné neobnoví.',
                    '**Umístění dat:** servery Hetzner Online GmbH v Německu, v rámci EU.',
                    'Stripe zpracovává platební údaje samostatně. Poskytovatel čísla karet nevidí ani neukládá, obdrží jen informaci o stavu platby.',
                ]],
            ],
        ],
        [
            'title' => 'Příloha B: Chat Matrix a služby fediverse',
            'body'  => [
                ['list' => [
                    'Matrix (mxchat.cz) a služby fediverse jsou **federované**. Zprávy a veřejné příspěvky se přenášejí na servery ostatních účastníků. Po smazání na serveru poskytovatele se nemusí smazat na serverech třetích stran, na které poskytovatel nemá vliv.',
                    'Registrace na mxchat.cz probíhá po schválení správcem, aby se zabránilo zneužití.',
                    'Moderátoři mohou obsah, který porušuje pravidla instance nebo tyto podmínky, skrýt nebo odstranit a účet omezit či zablokovat. Instance mohou blokovat servery, které šíří zneužívající obsah.',
                    'U instancí s vlastní doménou se název domény po spuštění nemění (viz článek 11).',
                ]],
            ],
        ],
        [
            'title' => 'Příloha C: Správce hesel (Vaultwarden, pass.oscloud.cz)',
            'body'  => [
                ['list' => [
                    '**Šifrování:** obsah trezoru (hesla, poznámky, soubory) je šifrován v zařízení uživatele ještě před odesláním na server. Poskytovatel k obsahu trezoru nemá přístup. Vidí jen e-mailovou adresu, čas registrace a přihlášení a šifrovaná data.',
                    '**Hlavní heslo:** je jediným způsobem přístupu k trezoru. Při jeho ztrátě nelze data obnovit, ani poskytovatelem. Uživatel odpovídá za jeho uschování. Doporučuje se zapnout dvoufázové přihlášení a uložit záložní kód mimo trezor.',
                    '**Registrace:** je otevřená a probíhá bez schválení. Poskytovatel může účet omezit nebo zrušit při zneužití služby, například při hromadných automatizovaných registracích nebo šíření spamu.',
                    '**Vlastní kopie:** uživatel si trezor pravidelně exportuje a ukládá mimo službu. Zálohy serveru neslouží k obnově jednotlivých trezorů (viz článek 9).',
                    '**Zrušení účtu:** poskytovatel na žádost smaže účet a všechna šifrovaná data. Ze záloh se odstraní postupně podle rotace záloh.',
                    'Pokud ceník neurčuje jinak, platí pro službu ustanovení o bezplatných službách v článku 2.',
                ]],
            ],
        ],
    ],
];

