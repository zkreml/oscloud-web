<?php
// Stránka Degooglizace (česky) – co čím nahradit.

return [
    'title'       => 'Degooglizace — čím nahradit služby Googlu | OSCloud',
    'description' => 'Co čím nahradit: fotky, soubory, e-mail, chat, hesla i sociální sítě. Postupně a bez stresu, s plakátem ke stažení.',
    'nav'         => 'degoogle',

    'hero' => [
        'breadcrumb' => [['Degooglizace', null]],
        'eyebrow'    => '$ oscloud --degoogle --postupně',
        'title'      => 'Degooglizace',
        'lead'       => 'Postupně a bez stresu.',
        'paragraphs' => ['Co čím nahradit. Všechno, co tu vidíš, provozujeme my, **neziskový spolek**. Nemusíš přejít na všechno najednou, začni třeba fotkami.'],
        'buttons'    => [['Začni zdarma', url('join') . '?sluzba=free'], ['Plakát ke stažení', '#plakat']],
        'emoji'      => '🧹',
        'chips'      => ['Bez Googlu', 'Postupně', 'Zdarma', 'V EU'],
    ],

    'blocks' => [
        [
            'type'    => 'swaps',
            'title'   => 'Co čím nahradit',
            'instead' => 'Místo',
            'use'     => 'použij:',
            'items'   => [
                ['from' => 'Google Photos', 'to' => 'Ente Photos', 'host' => 'oscloud.photos', 'text' => 'Fotky se šifrují přímo ve tvém zařízení, nevidíme do nich ani my.', 'badge' => '10 GB zdarma navždy', 'href' => url('ente')],
                ['from' => 'Google Drive, Kalendář', 'to' => 'Nextcloud', 'host' => '', 'text' => 'Soubory, sdílení, kalendáře a kontakty na jednom místě.', 'badge' => '2 GB zdarma · od 15 Kč/měs', 'href' => url('nextcloud')],
                ['from' => 'Gmail', 'to' => 'Vlastní e-mail', 'host' => '', 'text' => 'Schránka na tvé vlastní doméně. Správu a zálohy máme na starosti my. Objednává se k webhostingu.', 'badge' => 'od 19 Kč/měs', 'href' => url('pricing') . '#pro-komunity'],
                ['from' => 'Google Chat, WhatsApp', 'to' => 'Matrix', 'host' => 'mxchat.cz', 'text' => 'Federace: píšeš i lidem z jiných serverů. Přes Matrix funguje i podpora OSCloud.', 'badge' => '', 'href' => url('matrix')],
                ['from' => 'správce hesel', 'to' => 'Vaultwarden', 'host' => 'pass.oscloud.cz', 'text' => 'Kompatibilní s klienty Bitwarden: web, desktop, mobil i rozšíření do prohlížeče.', 'badge' => 'otevřená registrace', 'href' => LINKS['pass']],
                ['from' => 'Google vyhledávání', 'to' => 'SearXNG', 'host' => 'searxng.cz', 'text' => 'Vyhledávač, který dotazy posílá více zdrojům.', 'badge' => 'otevřeno všem', 'href' => LINKS['searxng']],
                ['from' => 'Google Docs', 'to' => 'CryptPad, HedgeDoc', 'host' => '', 'text' => 'Společné dokumenty se soukromím a společné poznámky v Markdownu.', 'badge' => 'zdarma · SSO, jedno heslo', 'href' => LINKS['cryptpad']],
                ['from' => 'YouTube', 'to' => 'PeerTube', 'host' => 'vhsky.cz', 'text' => 'Sdílení videí bez centrální platformy.', 'badge' => 'otevřená registrace', 'href' => LINKS['peertube']],
                ['from' => 'Instagram', 'to' => 'Pixelfed', 'host' => 'pixelfed.cz', 'text' => 'Sdílení fotek ve fediverse.', 'badge' => 'otevřená registrace', 'href' => LINKS['pixelfed']],
                ['from' => 'X (Twitter)', 'to' => 'Mastodon', 'host' => 'mamutovo.cz', 'text' => 'Decentralizovaná sociální síť.', 'badge' => 'otevřená registrace', 'href' => LINKS['mamutovo']],
                ['from' => 'GitHub', 'to' => 'Forgejo', 'host' => 'git.oscloud.cz', 'text' => 'Vlastní Git hosting: soukromé i veřejné repozitáře, issues, pull requesty. Přihlášení přes SSO.', 'badge' => 'zdarma · otevřená registrace', 'href' => LINKS['git']],
                ['from' => 'Strava', 'to' => 'FitPub', 'host' => 'makni.cz', 'text' => 'Sportovní aktivity ve fediverse.', 'badge' => 'otevřená registrace', 'href' => LINKS['fitpub']],
                ['from' => 'algoritmické feedy', 'to' => 'FreshRSS', 'host' => '', 'text' => 'Čtečka RSS kanálů místo algoritmem řazených zpráv.', 'badge' => 'zdarma · SSO, jedno heslo', 'href' => doc('freshrss')],
            ],
        ],
        [
            'type'  => 'cards',
            'bg'    => 'ice',
            'title' => 'Začni zdarma',
            'text'  => ['Vyzkoušej tarif Komunita: Mastodon, Pixelfed, PeerTube, SearXNG, CryptPad, PrivateBin (po registraci), FreshRSS, HedgeDoc, Vaultwarden, Forgejo a Nextcloud s 2 GB.'],
            'columns' => 3,
            'items' => [
                ['icon' => 'heart', 'title' => 'Neziskový provoz', 'text' => 'Spolek OSCloud, z. s. Žádní investoři.'],
                ['icon' => 'server', 'title' => 'Server v Hetzneru', 'text' => 'Německo, pravidelné zálohy.'],
                ['icon' => 'chat', 'title' => 'Podpora', 'text' => 'Přes Matrix a helpdesk ve všech tarifech.'],
            ],
        ],
        [
            'type'    => 'downloads',
            'id'      => 'plakat',
            'heading' => 'Plakát ke stažení',
            'text'    => 'Stejný přehled jako plakát, který můžeš sdílet nebo vytisknout.',
            'image'   => 'plakat-degooglizace-nahled.png',
            'alt'     => 'Náhled plakátu Degooglizace – co čím nahradit',
            'items'   => [
                ['Stáhnout PNG', 'plakat-degooglizace.png', '663 kB'],
                ['Stáhnout PDF', 'plakat-degooglizace.pdf', '357 kB'],
                ['PDF pro tisk (světlý, šetří barvu)', 'plakat-degooglizace-tisk.pdf', '242 kB'],
            ],
        ],
        [
            'type'       => 'closing',
            'bg'         => 'ice',
            'heading'    => 'Nemusíš všechno najednou.',
            'paragraphs' => ['Začni jednou službou a uvidíš, jak ti to sedne. Když se zasekneš, poradíme na Matrixu.'],
            'buttons'    => [['Chci se připojit', url('join')], ['Komunita na Matrixu', url('matrix')]],
        ],
    ],
];
