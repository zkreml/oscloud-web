#!/bin/bash
# SEO kontrola: canonical, Open Graph, titulek a popis na každé stránce + sitemap a přesměrování lomítka.
# Spuštění: php -S 127.0.0.1:8095 -t public public/index.php  &&  tests/seo.sh
B=${1:-http://127.0.0.1:8095}; bad=0
for u in / /cenik /degooglizace /nextcloud /ente-photos /trilium /matrix /o-nas /pripojit /podminky /ochrana-osobnich-udaju /zpracovatelska-smlouva /en /en/pricing /en/degoogle /en/nextcloud /en/ente-photos /en/trilium /en/matrix /en/about /en/join /en/terms /en/privacy /en/data-processing; do
  h=$(curl -s "$B$u")
  for need in '<link rel="canonical"' 'property="og:title"' 'property="og:image"' 'name="twitter:card"' '<meta name="description"'; do
    echo "$h" | grep -q "$need" || { echo "CHYBA $u chybí $need"; bad=1; }
  done
  [ "$(echo "$h" | grep -c '<h1')" = 1 ] || { echo "CHYBA $u: počet h1 není 1"; bad=1; }
done
c=$(curl -s -o /dev/null -w "%{http_code}" "$B/cenik/"); [ "$c" = 301 ] || { echo "CHYBA /cenik/ má vracet 301, vrací $c"; bad=1; }
n=$(curl -s "$B/sitemap.xml" | grep -c '<loc>'); [ "$n" = 21 ] || { echo "CHYBA sitemap má 21 adres, má $n"; bad=1; }
curl -s "$B/robots.txt" | grep -q '^Sitemap: ' || { echo "CHYBA robots.txt bez Sitemap"; bad=1; }
[ $bad = 0 ] && echo "OK"; exit $bad
