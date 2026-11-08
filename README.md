# OSCloud – web

Web komunity OSCloud v čistém PHP 8 (bez frameworku). Technologií, strukturou i vzhledem vychází
z webu Pibbo (pibbo.pro), místo oranžové používá inkoustově tmavou modrou `#1B1F6B`.
Obsah je převzatý z původního oscloud.cz (stažená kopie je v `podklady/oscloud.cz-stazeno/`).

## Spuštění lokálně

```bash
php -S localhost:8091 -t public public/index.php
```

Pak otevřít http://localhost:8091

## Struktura

- `public/` – kořen webu (document root): `index.php` (router), `assets/` (CSS, JS, fonty, obrázky,
  plakát Degooglizace v `assets/files/`), favicony
- `templates/` – šablony: `home.php` (úvod), `page.php` (obsahové stránky z bloků), `join.php`
  (formulář Chci se připojit), `legal.php` (právní texty), `partials/` hlavička, patička a úvod podstránky
- `templates/blocks/` – bloky obsahových stránek: `tiers` (tarify), `nextcloud-prices` (ceník Nextcloudu),
  `table`, `text`, `columns`, `cards`, `offers`, `faq`, `donate`, `swaps` (degooglizace), `downloads`,
  `facts`, `stories`, `intro`, `closing`
- `app/pages/*.php` – texty a skladba stránek (česky), `app/pages/en/*.php` anglicky
- `app/prices.json` – **zdroj všech cen** (Nextcloud, Ente Photos, Trilium, příplatky spolek/firma, Mastodon, fórum, wiki,
  hosting, e-mail, sponzoring). Cenu stačí změnit tady; `app/pricing.php` z něj počítá tabulky (Rodina = cena jednotlivce +
  rozdíl `family_base`, Spolek/Firma = cena + příplatek), „od“ ceny na kartách i volby ve formuláři
- `app/bootstrap.php` – údaje spolku (`ORG`), hlavní menu (`MAIN_NAV`), odkazy na služby (`LINKS`),
  pomocné funkce
- `app/i18n.php` – adresy stránek v obou jazycích (`ROUTES`), `app/lang/cs.php` a `en.php` texty rozhraní
- `app/join.php` – zpracování formuláře Chci se připojit
- barvy jsou CSS proměnné v `:root` v `public/assets/css/style.css` (`--os-navy` je hlavní tmavě modrá)

V textech stránek funguje `**tučně**` a odkazy `[popisek](adresa)`.

## Stránky

| Česky | Anglicky |
|---|---|
| `/` | `/en` |
| `/cenik` | `/en/pricing` |
| `/degooglizace` | `/en/degoogle` |
| `/nextcloud`, `/ente-photos`, `/trilium`, `/matrix` | `/en/nextcloud`, `/en/ente-photos`, `/en/trilium`, `/en/matrix` |
| `/o-nas` | `/en/about` |
| `/pripojit` | `/en/join` |
| `/podminky`, `/ochrana-osobnich-udaju`, `/zpracovatelska-smlouva` | `/en/terms`, `/en/privacy`, `/en/data-processing` (česky s poznámkou) |

Staré adresy původního webu (`/nextcloud.html`, `/en/ente.html`, `/o-nas.html`…) se trvale
přesměrují (301) na nové.

## Formulář Chci se připojit

- `/pripojit` – jednotlivec (zdarma, Nextcloud, Rodina, Trilium, Matrix, jiné) nebo spolek/firma
- ceny v ceníku jsou odkazy, které formulář předvyplní: `/pripojit?typ=jednotlivec|rodina|spolek|firma&gb=…`,
  `?typ=trilium&period=monthly|yearly`, `?sluzba=matrix|free`
- žádost jde e-mailem do FreeScoutu: česká na `registrace@oscloud.cz`, anglická (`/en/join`) na `en@oscloud.cz`
  (`config.php` → `mail.to`, `mail.to_en`); `Reply-To` je žadatel. Potvrzení žadateli posílá automatická odpověď
  FreeScoutu, web ho neposílá podruhé. Předmět: `Žádost (jednotlivec) — jméno`, `Žádost (spolek/firma) — název`,
  anglicky `Request (individual) — …`
- ochrana: CSRF token v session, skryté pole pro roboty, min. 3 s na vyplnění, hrubý limit pokusů, limity odeslaných
  žádostí (3/h a 10/den z jedné IP, 60/den celkem, 1/h a 3/den na e-mailovou adresu), kontrola UTF-8, odstranění
  řídicích znaků a zalomení z jednořádkových polí (hlavičky e-mailu nejdou podvrhnout), přísná validace e-mailu
- cena a velikost úložiště se na serveru znovu ověřují proti `prices.json`, hodnoty z formuláře se nevěří
- do e-mailu se neukládá IP adresa žadatele
- chyby odesílání se zapisují do `storage/mail-error.log`

## Bezpečnost

- hlavičky z PHP (`app/bootstrap.php`): přísná CSP (jen vlastní zdroje + `analytics.oscloud.cz`), `X-Frame-Options`,
  `nosniff`, `Referrer-Policy`, `Permissions-Policy`, HSTS (při HTTPS, i za proxy přes `X-Forwarded-Proto`)
- šablony vše escapují (`e()`, `rich()` povolí jen odkazy `http(s):`, `mailto:`, `/`, `#`), žádné inline skripty ani styly
- `.htaccess` v kořeni i složkách `app/`, `templates/`, `config/`, `storage/` brání přímému přístupu
- heslo k poště v souborech není: driver `cloudron` bere přihlášení z proměnných prostředí `CLOUDRON_MAIL_*`
- databázi ani přihlašování web nemá

## Nasazení na server

1. Nahrát obsah ZIPu do kořene webu (document root buď `public/`, nebo kořen s `.htaccess`,
   který vše přesměruje do `public/`).
2. Na serveru zkopírovat `config/config.example.php` jako `config/config.php`. Na Cloudron LAMP stačí ponechat
   `'driver' => 'cloudron'` (SMTP údaje dodá platforma, nic se nevyplňuje). `config/config.php` v repozitáři není
   (`.gitignore`), takže se při aktualizaci nepřepíše.
3. Složka `storage/` musí být zapisovatelná pro PHP (logy a ochrana formulářů proti spamu).

Lokálně má `config/config.php` driver `log` – e-maily se neodesílají, jen zapisují do `storage/mail.log`.

### Nginx (pokud server neběží na Apache)

Současný oscloud.cz běží na nginx, který `.htaccess` nečte. Document root nastavit na `public/` a:

```nginx
root /cesta/k/webu/public;
index index.php;
location / { try_files $uri /index.php$is_args$args; }
location ~ \.php$ { include fastcgi_params; fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; fastcgi_pass unix:/run/php/php8.3-fpm.sock; }
```

## Zbývá

- obrázky jsou zatím jen emoji a kreslený obláček (`public/assets/img/hero-cloud.svg`) – až budou
  vlastní ilustrace OSCloudu, stačí je dát do `page-hero` (klíč `emoji` v `app/pages/*.php`)

## Hlavní doména a aliasy

V `config/config.php` nastav `'canonical_host' => 'oscloud.cz'`. Požadavky na jiné adresy téhož webu (www., oscloud.online) se pak přesměrují 301 na hlavní doménu a canonical, sitemap i náhledy míří vždy na ni. Na testovací instanci nech hodnotu prázdnou.

### Dvě domény (česky a anglicky)

Přidej `'canonical_host_en' => 'oscloud.online'`. Česky se pak zobrazuje na `canonical_host`, anglicky na této doméně a adresy nemají předponu `/en` (např. `oscloud.online/pricing`). Staré adresy `/en/…` se přesměrují na anglickou doménu, `www.` a neznámé domény na hlavní. Obě domény musí být v Cloudronu (Location a Aliases) u téže aplikace. Test: `tests/domains.sh`.

Po změně configu nebo `git pull` počítej s tím, že PHP (OPcache) si může stará data podržet i několik minut; pomůže restart aplikace.

## PDF právních dokumentů

Podmínky a zpracovatelská smlouva (CS i EN) mají tlačítko „Stáhnout PDF“. Soubory jsou v `public/assets/files/oscloud-*.pdf` a jsou součástí repozitáře. Po každé změně textu těchto stránek je znovu vygenerujte a commitněte:

```bash
tools/build-pdfs.sh      # potřebuje php a Chromium/Chrome (nebo proměnnou CHROME)
```

Tlačítko se zobrazí jen tehdy, když soubor existuje. Stránka pro tisk (`@media print` ve `style.css`) skryje menu, patičku a obsah.

## Newsletter (Listmonk)

Formulář v patičce českých stránek posílá e-mail na `/newsletter`, server ho předá veřejnému API Listmonku (`/api/public/subscription`) a Listmonk pošle potvrzovací e-mail (double opt-in). Zapíná se v `config/config.php`:

```php
'newsletter' => ['url' => 'https://…', 'list_uuid' => '…'],
```

Bez obou hodnot se formulář nezobrazí. V Listmonku musí být zapnuté Settings → General → Enable public subscription page a seznam musí být Public. Ochrana: honeypot, podepsané časové razítko (minimálně 3 s), limity na IP (5/h, 20/den) a na e-mail (1/h, 3/den). Test: `tests/newsletter.sh` (běží proti falešnému Listmonku, nic neodesílá). Anglická verze formulář zatím nemá.
