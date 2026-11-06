#!/bin/bash
# SEO kontrola: canonical, Open Graph, titulek a popis na každé stránce + sitemap, robots a přesměrování lomítka.
#   Jedna doména:   tests/seo.sh https://test.oscloud.cz
#   Dvě domény:     tests/seo.sh https://oscloud.cz https://oscloud.online
B=${1:-http://127.0.0.1:8095}; EN=${2:-}; bad=0
for u in / /cenik /degooglizace /nextcloud /ente-photos /trilium /matrix /o-nas /pripojit /podminky /ochrana-osobnich-udaju /zpracovatelska-smlouva /en /en/pricing /en/degoogle /en/nextcloud /en/ente-photos /en/trilium /en/matrix /en/about /en/join /en/terms /en/privacy /en/data-processing; do
  base=$B; path=$u
  if [ -n "$EN" ] && [[ $u == /en || $u == /en/* ]]; then base=$EN; path=${u#/en}; [ -z "$path" ] && path=/; fi
  h=$(curl -s "$base$path")
  for need in '<link rel="canonical"' 'property="og:title"' 'property="og:image"' 'name="twitter:card"' '<meta name="description"'; do
    echo "$h" | grep -q "$need" || { echo "CHYBA $base$path chybí $need"; bad=1; }
  done
  [ "$(echo "$h" | grep -c '<h1')" = 1 ] || { echo "CHYBA $base$path: počet h1 není 1"; bad=1; }
done
c=$(curl -s -o /dev/null -w "%{http_code}" "$B/cenik/"); [ "$c" = 301 ] || { echo "CHYBA /cenik/ má vracet 301, vrací $c"; bad=1; }
if [ -n "$EN" ]; then
  n=$(curl -s "$B/sitemap.xml" | grep -c '<loc>');  [ "$n" = 12 ] || { echo "CHYBA sitemap $B má 12 adres, má $n"; bad=1; }
  n=$(curl -s "$EN/sitemap.xml" | grep -c '<loc>'); [ "$n" = 12 ]  || { echo "CHYBA sitemap $EN má 12 adres, má $n"; bad=1; }
  curl -s "$EN/robots.txt" | grep -q "^Sitemap: https://.*/sitemap.xml" || { echo "CHYBA robots.txt na $EN bez Sitemap"; bad=1; }
else
  n=$(curl -s "$B/sitemap.xml" | grep -c '<loc>');  [ "$n" = 24 ] || { echo "CHYBA sitemap má 24 adres, má $n"; bad=1; }
fi
curl -s "$B/robots.txt" | grep -q '^Sitemap: ' || { echo "CHYBA robots.txt bez Sitemap"; bad=1; }
[ $bad = 0 ] && echo "OK"; exit $bad
