#!/bin/bash
# Smoke test: všechny stránky musí vrátit 200 (404 jen pro neexistující). Spuštění: php -S 127.0.0.1:8095 -t public  &&  tests/smoke.sh
B=${1:-http://127.0.0.1:8095}; bad=0
for u in / /cenik /degooglizace /nextcloud /ente-photos /trilium /matrix /o-nas /pripojit /podminky /ochrana-osobnich-udaju /zpracovatelska-smlouva /en/ /en/pricing /en/degoogle /en/nextcloud /en/ente-photos /en/trilium /en/matrix /en/about /en/join /en/terms /en/privacy /en/data-processing; do
  c=$(curl -s -o /dev/null -w "%{http_code}" "$B$u"); [ "$c" = 200 ] || { echo "CHYBA $c $u"; bad=1; }
done
c=$(curl -s -o /dev/null -w "%{http_code}" "$B/neexistuje"); [ "$c" = 404 ] || { echo "CHYBA 404 $c"; bad=1; }
[ $bad = 0 ] && echo "OK"; exit $bad
