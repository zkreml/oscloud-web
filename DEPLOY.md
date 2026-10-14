# Nasazení oscloud.cz

Jedna appka: Cloudron **LAMP** na `oscloud.cz`. Statické soubory i `submit.php` leží vedle sebe v `/app/data/public/`. Surfer se nepoužívá, protože neumí PHP.

## 1. Záloha a uvolnění domény

```
Cloudron → WordPress (oscloud.cz) → Backups → Create backup now
Cloudron → WordPress → Configuration → Location: old   # old.oscloud.cz, nebo po záloze odinstalovat
```

## 2. LAMP na oscloud.cz

```
Cloudron → App Store → LAMP → Location: (prázdné = oscloud.cz)
```

HTTPS řeší Cloudron (Let's Encrypt) sám. `www.oscloud.cz` přidej jako alias nebo redirect v nastavení appky.

## 3. Nahrání souborů

Do `/app/data/public/` nahraj (File manager, SFTP nebo rsync; přístupové údaje najdeš v nastavení appky):

```
index.html  submit.php  config.sample.php  .htaccess  robots.txt  sitemap.xml
favicon.ico  favicon-32.png  apple-touch-icon.png  assets/
```

`DEPLOY.md` nenahrávej. Výchozí soubory LAMP appky v `public/` (např. `index.php`) smaž, jinak přebijí `index.html`.

```bash
# příklad, host a port si ověř v Cloudron → appka → Access control / SFTP
rsync -av --exclude DEPLOY.md -e 'ssh -p 222' ./ USER@HOST:/app/data/public/
```

## 4. Konfigurace formuláře

Web terminal u LAMP appky:

```bash
cd /app/data/public
cp config.sample.php config.php
php -r 'echo bin2hex(random_bytes(32)), PHP_EOL;'      # vlož do 'secret' v config.php
nano config.php
```

`allowed_origins` nech na `https://oscloud.cz` a `https://www.oscloud.cz`. `mail_from` nech prázdné (použije se `CLOUDRON_MAIL_FROM`, jinak `noreply@oscloud.cz`). Pokud mail neprojde, dej tam adresu skutečné schránky z Cloudron mailu.

Rate limit se ukládá do `/app/data/oscloud-forms-data/` (mimo webroot).

Test z libovolného stroje:

```bash
O='Origin: https://oscloud.cz'; U=https://oscloud.cz/submit.php
TOK=$(curl -s -H "$O" "$U?token=1" | jq -r .token); sleep 4
curl -s -H "$O" -d name=Test -d email=ty@example.cz -d type=individual -d service=free -d consent=1 -d message=ahoj -d token="$TOK" "$U"
# → {"ok":true,...}   a ticket ve FreeScoutu (schránka fediverse@oscloud.cz)
```

## 5. FreeScout

Formulář posílá na `fediverse@oscloud.cz` (`mail_to` v `config.php`), což je schránka FreeScoutu. Pošli testovací žádost a podívej se, kdo je v ticketu zákazník. Mail jde `From: OSCloud web <noreply@…>` s `Reply-To` na adresu zájemce. Jestli FreeScout vytvoří zákazníka z `noreply@`, odpovídání půjde správně (Reply-To), ale zákazník v kartě bude špatně. Údaje zájemce jsou vždy i v těle zprávy. Tohle jde ověřit jen naživo.

## 6. Sdílená navigace

Všude stačí jeden řádek, skript si sám vloží lištu a dotáhne `nav.css`:

```html
<script src="https://oscloud.cz/assets/nav.js" defer></script>
```

**docs.oscloud.cz (MkDocs Material)** — `mkdocs.yml`:

```yaml
extra_javascript:
  - path: https://oscloud.cz/assets/nav.js
    defer: true
```

**blog.oscloud.cz** — patička blogu říká „Postaveno na ./blog.sh“, tedy ne Hugo/PaperMod. Vlož ten `<script>` řádek do `<head>` šablony blogu. Kdyby šlo o Hugo PaperMod: `layouts/partials/extend_head.html`.

Lišta je na blogu a v docs nad stránkou (nelepí se), protože jejich vlastní hlavička je sticky.

## 7. Kontrola po nasazení

```bash
curl -sI https://oscloud.cz | head -3
curl -s https://oscloud.cz | grep -E 'og:(title|image)'
curl -sI https://oscloud.cz/assets/og-image.png | grep -i content-type
curl -s https://oscloud.cz/robots.txt
curl -sI https://oscloud.cz/config.php | head -1        # musí být 403
```

Náhled odkazu zkus poslat do Matrixu a na Mastodon.

## Rollback

Změň Location WordPressu zpátky na `oscloud.cz` a LAMP přesuň nebo odinstaluj. Záloha z kroku 1 je pojistka.
