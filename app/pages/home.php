<?php
// Texty úvodní stránky (česky). **tučně** = zvýrazněný text.
// Odkazy na služby: [název, adresa]; adresa začínající http se otevře v novém okně.

return [
    'hero' => [
        'eyebrow'  => 'Komunita pro digitální svobodu',
        'title'    => 'Tvoje data.',
        'title_2'  => 'Tvoje pravidla.',
        'lead'     => 'OSCloud je česká komunita, která provozuje open source služby.',
        'text'     => 'Žádné reklamy, žádné sledování, žádný vendor lock-in. **Jen nástroje, které fungují.** Cloud, fotky, chat, hesla i sociální sítě – na serveru v EU a bez Googlu.',
        'buttons'  => ['Chci se připojit', 'Co nabízíme'],
        'facts'    => [['Zdarma', 'základní služby'], ['Data v EU', '(Německo)'], ['100 %', 'open source']],
        'bubbles'  => ['Nextcloud', 'Matrix', 'Mastodon', 'Ente Photos', 'Vaultwarden', 'PeerTube'],
    ],

    'services' => [
        'title' => 'Co u nás najdeš',
        'text'  => 'Neříkáme ti, jaký software používat. Říkáme ti, jaký problém vyřešíš.',
        'items' => [
            ['💬', 'Chceš psát bezpečně?', 'Šifrované zprávy, skupiny, hovory. Žádný Meta, žádný sběr dat. Prostě napíšeš a víš, že to čte jen ten druhý.',
                [['Matrix / Element', url('matrix')], ['MiroTalk', null], ['Ntfy', null]]],
            ['🌐', 'Chceš sociální sítě bez reklam?', 'Fediverse – decentralizované sítě, kde neexistuje algoritmus, který ti říká, co máš číst.',
                [['Mastodon', LINKS['mamutovo']], ['PeerTube', LINKS['peertube']], ['Pixelfed', LINKS['pixelfed']], ['FitPub', LINKS['fitpub']]]],
            ['☁️', 'Chceš vlastní cloud?', 'Soubory, kalendář, kontakty a online kancelář Collabora na jednom místě. Fotky šifrovaně v Ente Photos. Žádný Google Drive, žádný iCloud.',
                [['Nextcloud', url('nextcloud')], ['Ente Photos', url('ente')]]],
            ['📝', 'Chceš spolupracovat?', 'Sdílené dokumenty, tabulky, prezentace i kód. V reálném čase, bez Googlu. Šifrovaně.',
                [['CryptPad', LINKS['cryptpad']], ['HedgeDoc', doc('hedgedoc')], ['Trilium', url('trilium')], ['Collabora Online', url('nextcloud') . '#collabora'], ['Forgejo', LINKS['git']]]],
            ['🔒', 'Chceš mít hesla v bezpečí?', 'Správce hesel, soukromý vyhledávač, jednorázové sdílení textů. Bezpečnost bez kompromisů.',
                [['Vaultwarden', doc('vaultwarden')], ['SearXNG', doc('searxng')], ['PrivateBin (po registraci)', doc('privatebin')]]],
            ['📰', 'Chceš číst bez algoritmů?', 'RSS čtečky, bookmarky, čtení offline. Ty si vybíráš, co čteš – ne algoritmus.',
                [['FreshRSS', doc('freshrss')], ['Miniflux', null], ['Wallabag', doc('wallabag')], ['Linkwarden', doc('linkwarden')]]],
        ],
        'helper' => '**Nevíš, kde začít?** Základní služby jsou zdarma. Stačí krátký formulář.',
        'button' => 'Prohlédnout ceník',
    ],

    'reasons' => [
        'title' => 'Proč zrovna OSCloud?',
        'text'  => 'Protože soukromí má být výchozí stav, ne prémiová funkce.',
        'items' => [
            ['eye-off', 'Žádné sledování', 'Na oscloud.cz nepoužíváme cookies, takže nemusíš nic odklikávat. Návštěvnost měříme jen anonymně, vlastním nástrojem Umami na našem serveru. Naše služby používají jen technické cookies nutné k přihlášení, žádné reklamní ani sledovací. Neposíláme data Googlu, Amazonu ani jiným reklamním a analytickým službám. **Není tu reklama.** Tvoje soukromí je výchozí stav, ne prémiová funkce.'],
            ['code', 'Open source', 'Všechno, co provozujeme, je open source. Kdokoliv může zkontrolovat kód. **Žádné černé skříňky.**'],
            ['globe', 'Data v EU', 'Servery běží v Německu (Hetzner, Contabo, netcup). Tvoje data neopouští Evropu. **GDPR není marketingový trik, je to realita.**'],
            ['people', 'Komunita, ne firma', 'OSCloud je spolek. Žádní investoři, žádný exit plan. **Děláme to, protože věříme, že to má smysl.**'],
        ],
    ],

    'degoogle' => [
        'terminal' => '$ oscloud --degoogle --postupně',
        'title'    => 'Degooglizace',
        'text'     => 'Co čím nahradit: fotky, soubory, e-mail, chat, hesla i sociální sítě. **Postupně a bez stresu**, a je tu i plakát ke stažení.',
        'swaps'    => [['Google Photos', 'Ente Photos'], ['Google Drive', 'Nextcloud'], ['WhatsApp', 'Matrix'], ['YouTube', 'PeerTube'], ['X (Twitter)', 'Mastodon']],
        'button'   => 'Podívej se',
    ],

    'community' => [
        'eyebrow' => 'Komunita',
        'title'   => 'Potkej lidi, co řeší to samé.',
        'text'    => 'Linux, selfhosting, soukromí, Fediverse. **Žádný gatekeeping.** Ptát se tu může každý, i úplný začátečník.',
        'links'   => [
            ['💬', 'Matrix — mxchat.cz', 'Komunitní chat a podpora', LINKS['matrix']],
            ['🐘', 'Mastodon', '@oscloud@mamutovo.cz', LINKS['mastodon']],
            ['🔧', 'Forgejo', 'Náš kód a konfigurace', LINKS['git_org']],
            ['📖', 'Blog', 'Novinky a návody', LINKS['blog']],
        ],
    ],

    'costs' => [
        'title'  => 'Transparentní provoz',
        'text'   => 'Nechceme se tvářit, že je to zadarmo. Server stojí peníze. Tady je, jak to funguje.',
        'label'  => 'Měsíční náklady serveru',
        'amount' => '~8 500 Kč',
        'unit'   => '/ měsíc',
        'specs'  => 'Dedikovaný server Hetzner · Intel Core i9-13900 · 64 GB RAM · zálohy na samostatném úložišti',
        'after'  => 'Provoz platíme sami. Pokud chceš pomoct, můžeš přispět – ale **není to podmínka. Služby jsou pro všechny.**',
        'buttons' => ['Podpořit OSCloud', 'O spolku'],
    ],

    'cta' => [
        'title'      => 'Vyzkoušej to. Zdarma.',
        'paragraphs' => [
            'Tarif Komunita je zdarma pro každého: Mastodon, Pixelfed, PeerTube, SearXNG, CryptPad, FreshRSS, HedgeDoc, Vaultwarden, Forgejo a **Nextcloud s 2 GB**.',
        ],
        'ticks'   => ['Krátký formulář, odpověď e-mailem.', 'Žádné ověřování telefonem.', 'Podpora přes Matrix a helpdesk.'],
        'buttons' => ['Chci se připojit', 'Celý ceník'],
    ],
];
