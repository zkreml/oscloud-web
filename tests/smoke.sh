#!/bin/bash
# Smoke test: všechny stránky musí vrátit 200 (404 jen pro neexistující).
#   Jedna doména:   tests/smoke.sh https://test.oscloud.cz            (angličtina pod /en)
#   Dvě domény:     tests/smoke.sh https://oscloud.cz https://oscloud.online   (angličtina na druhé doméně bez /en)
B=${1:-http://127.0.0.1:8095}; EN=${2:-}; bad=0
for u in / /cenik /degooglizace /nextcloud /ente-photos /trilium /matrix /o-nas /pripojit /podminky /ochrana-osobnich-udaju /zpracovatelska-smlouva /en /en/pricing /en/degoogle /en/nextcloud /en/ente-photos /en/trilium /en/matrix /en/about /en/join /en/terms /en/privacy /en/data-processing; do
  base=$B; path=$u
  if [ -n "$EN" ] && [[ $u == /en || $u == /en/* ]]; then base=$EN; path=${u#/en}; [ -z "$path" ] && path=/; fi
  c=$(curl -s -o /dev/null -w "%{http_code}" "$base$path"); [ "$c" = 200 ] || { echo "CHYBA $c $base$path"; bad=1; }
done
c=$(curl -s -o /dev/null -w "%{http_code}" "$B/neexistuje"); [ "$c" = 404 ] || { echo "CHYBA 404 $c"; bad=1; }
[ $bad = 0 ] && echo "OK"; exit $bad
