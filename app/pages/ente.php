<?php
// Stránka Ente Photos (česky).

return [
    'title'       => 'Ente Photos — alternativa ke Google Fotkám | OSCloud',
    'description' => 'Soukromý, end-to-end šifrovaný foto cloud na oscloud.photos. Alternativa ke Google Photos, 10 GB zdarma navždy, servery v Německu.',
    'nav'         => 'services',

    'hero' => [
        'breadcrumb' => [['Ceník', url('pricing')], ['Ente Photos', null]],
        'eyebrow'    => 'Šifrované fotky',
        'title'      => 'Ente Photos',
        'lead'       => 'Soukromý, end-to-end šifrovaný foto cloud na **oscloud.photos**. Alternativa ke Google Photos, kde jen ty máš přístup ke svým fotkám.',
        'paragraphs' => ['Fotky se šifrují přímo v tvém zařízení ještě před nahráním na server, takže **do nich nevidíme ani my**. Vlastní instance Ente běží na našich serverech v Německu (Hetzner, Falkenstein).'],
        'price'      => ['', '10 GB zdarma', 'navždy'],
        'buttons'    => [['Otevřít oscloud.photos', LINKS['photos']], ['Návod v dokumentaci', doc('ente-photos')]],
        'emoji'      => '📷',
        'chips'      => ['Šifrované', 'Android', 'iOS', 'Rodina'],
    ],

    'blocks' => [
        [
            'type'  => 'cards',
            'title' => 'Co umí',
            'columns' => 4,
            'items' => [
                ['icon' => 'sync', 'title' => 'Všude', 'text' => 'Aplikace pro web, Android, iOS i počítač.'],
                ['icon' => 'shield', 'title' => 'Zálohy z mobilu', 'text' => 'Automatické zálohování fotek z mobilu na pozadí.'],
                ['icon' => 'share', 'title' => 'Sdílení alb', 'text' => 'Šifrovaným odkazem, **i pro lidi bez účtu**.'],
                ['icon' => 'people', 'title' => 'Rodinný plán', 'text' => 'Úložiště až pro 5 členů rodiny **bez příplatku**.'],
            ],
        ],
        [
            'type'       => 'text',
            'flush'      => true,
            'note'       => '**Heslo je jediný klíč k datům.** Když zapomeneš heslo a ztratíš obnovovací klíč, jsou fotky nenávratně pryč. Nikdo je neobnoví, ani my. Obnovovací klíč si při registraci uschovej (nejlépe vytištěný) a důležité fotky měj zálohované ještě jinde, například na vlastním externím disku.',
        ],
        [
            'type'    => 'table',
            'bg'      => 'ice',
            'id'      => 'cenik',
            'title'   => 'Ceník',
            'text'    => 'Každý účet má **10 GB zdarma navždy**. Roční platba vyjde zhruba o dva měsíce levněji.',
            'caption' => 'Cena Ente Photos podle úložiště',
            'narrow'  => true,
            'head'    => ['Úložiště', 'Měsíčně', 'Ročně'],
            'rows'    => array_map(fn ($gb, $p) => [storage_label($gb), money($p[0]), money($p[1])], array_keys(ENTE_PRICES), ENTE_PRICES),
            'notes'   => ['Nejsme plátci DPH, ceny jsou konečné.'],
        ],
        [
            'type'  => 'columns',
            'items' => [
                [
                    'heading' => 'Registrace',
                    'steps'   => [
                        'Otevři [oscloud.photos](' . LINKS['photos'] . ') v prohlížeči a klikni na **Registrace**.',
                        'Zadej e-mail a heslo (dvakrát), potvrď souhlas s podmínkami a vytvoř účet.',
                        'Zadej ověřovací kód, který ti přijde e-mailem.',
                        'Uschovej si **obnovovací klíč**, který se zobrazí.',
                    ],
                    'after'   => ['Pokud vyskočí okno „Nastavení pro vývojáře / Koncový bod serveru“, dej Zrušit a nic nenastavuj.'],
                ],
                [
                    'heading'    => 'Předplatné',
                    'paragraphs' => ['Kupuje se **jen na webu oscloud.photos**, funguje to i z mobilu v prohlížeči (ne v aplikaci). Nativní aplikace platí přes Google Play a App Store, což u naší instance nejde. Hláška „nelze zaplatit, kontaktujte správce“ je v aplikaci normální.'],
                    'steps'      => [
                        'Přihlas se na oscloud.photos v prohlížeči.',
                        'Menu → Předplatné, vyber tarif (měsíčně nebo ročně).',
                        'Zaplať kartou přes Stripe. Úložiště se navýší hned.',
                        'V mobilní aplikaci se přihlas stejným účtem, předplatné se projeví samo.',
                    ],
                ],
            ],
        ],
        [
            'type'  => 'columns',
            'bg'    => 'ice',
            'items' => [
                [
                    'heading'    => 'Aplikace a nastavení serveru',
                    'paragraphs' => ['Web nepotřebuje žádné nastavení. V aplikacích pro Android, iOS a počítač musíš nejdřív **nastavit vlastní server**, jinak by se připojovaly k oficiálnímu Ente.'],
                    'steps'      => [
                        'Stáhni aplikaci: Google Play, F-Droid, App Store, nebo [ente.io/download](https://ente.io/download) pro počítač.',
                        'Na úvodní obrazovce klepni **7× rychle za sebou na logo**. Otevře se nastavení serveru.',
                        'Do pole Endpoint zadej přesně **https://oscloud.photos** a ulož.',
                        'Přihlas se nebo se zaregistruj, povol přístup k fotkám a zálohování se spustí.',
                    ],
                    'after'      => ['Když se 7 klepnutí nepovede, zkus to znovu, musí být rychle za sebou. Podrobnosti včetně videonávodů najdeš v [dokumentaci](' . doc('ente-photos') . ').'],
                ],
                [
                    'heading'    => 'Rodinný plán',
                    'paragraphs' => [
                        'Úložiště můžeš sdílet **až s 5 členy rodiny**. Každý má vlastní účet a vlastní šifrování, sdílí se jen kapacita. Fotky se mezi sebou nevidí.',
                        'Musíš mít aktivní placené předplatné. Pak: **Menu → Předplatné → Spravovat rodinu → Přidat člena** a zadat jeho e-mail.',
                    ],
                ],
            ],
        ],
        [
            'type'  => 'faq',
            'title' => 'Časté dotazy',
            'items' => [
                ['Vidíte moje fotky?', 'Ne. Na server se dostanou už zašifrované. Vidíme jen, kolik místa zabíráš.'],
                ['Co když zapomenu heslo?', 'Použiješ obnovovací klíč z registrace. Bez hesla i klíče se k datům nikdo nedostane.'],
                ['Můžu přejít z Google Photos?', 'Ano, Ente má návody na import z Google Photos a Apple Photos.'],
                ['Kde jsou data?', 'Na serverech Hetzner v Německu (Falkenstein), tedy v EU.'],
            ],
        ],
        [
            'type'       => 'closing',
            'heading'    => 'Potřebuješ pomoct?',
            'paragraphs' => ['Napiš na [podpora@oscloud.cz](mailto:podpora@oscloud.cz) nebo přes [helpdesk](' . LINKS['helpdesk'] . '). Videonávody vznikly ve spolupráci s infoek.cz, děkujeme.'],
            'buttons'    => [['Otevřít oscloud.photos', LINKS['photos']], ['Celý ceník', url('pricing')]],
        ],
    ],
];
