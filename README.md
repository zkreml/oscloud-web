# Oscloud Web

Oscloud je váš bezpečný cloud. Naším cílem je ukázat lidem výhody bezpečného internetu a Open Source technologií. Tento repozitář obsahuje zdrojový kód hlavního webu projektu Oscloud (oscloud.cz).

## Obsah

- `index.html` - jednostránkový web (služby, proč Oscloud, komunita, ceník, formulář „Chci se připojit“).
- `submit.php` - zpracování formuláře: validace, honeypot, CSRF token, rate limit, odeslání e-mailu na `fediverse@oscloud.cz` (schránka FreeScoutu).
- `config.sample.php` - vzor konfigurace. Skutečný `config.php` s tajným klíčem je v `.gitignore` a nikdy se necommituje.
- `assets/` - logo, OG obrázek, fonty (hostované u nás, licence OFL), sdílená navigace `nav.js` a `nav.css`.
- `favicon.ico`, `favicon-32.png`, `apple-touch-icon.png` - ikony webu.
- `robots.txt`, `sitemap.xml`, `.htaccess`.
- `DEPLOY.md` - postup nasazení.

## Sdílená navigace

Stejná lišta je na oscloud.cz, blog.oscloud.cz a docs.oscloud.cz. Na blogu a v dokumentaci stačí do `<head>` vložit `<script src="https://oscloud.cz/assets/nav.js" defer></script>`, skript si lištu vloží sám a dotáhne `nav.css`.

## Lokální vývoj

V kořeni repozitáře spusťte `php -S 127.0.0.1:8080` a otevřete http://127.0.0.1:8080.

Aby fungoval formulář, zkopírujte `config.sample.php` na `config.php` a nastavte `secret` (min. 32 znaků), `allowed_origins` na `http://127.0.0.1:8080` a `dry_run_dir` na libovolnou složku. E-maily se pak jen ukládají do souborů a neodesílají se.

## Nasazení

Web je určený pro aplikaci Cloudron LAMP na oscloud.cz. Postup je v `DEPLOY.md`.

## Jak přispět

Pokud máte zájem přispět k našemu projektu, rádi vás přivítáme. Hledáme vývojáře, dokumentaristy, a každého, kdo má zájem o bezpečný a otevřený internet.

1. Forkněte tento repozitář.
2. Vytvořte novou větev (`git checkout -b feature/nova-funkce`).
3. Commitněte své změny (`git commit -am 'Přidání nové funkce'`).
4. Pushněte větev (`git push origin feature/nova-funkce`).
5. Otevřete Pull Request.

## Licence

Tento projekt je licencován pod licencí MIT - podrobnosti naleznete v souboru [LICENSE](LICENSE).

## Kontakt

Pro více informací nás můžete kontaktovat na [info@oscloud.cz](mailto:info@oscloud.cz).
