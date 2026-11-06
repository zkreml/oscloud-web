#!/bin/bash
# Vygeneruje PDF verze právních dokumentů (podmínky, zpracovatelská smlouva; česky i anglicky) do public/assets/files/.
# Spouští se jen při změně textu (na serveru nic nenainstalujete, PDF jsou v repozitáři).
# Potřebuje php a Chromium nebo Chrome (proměnná CHROME přepíše automatické hledání). Config ani hesla se nepoužívají.
set -euo pipefail
cd "$(dirname "$0")/.."
CHROME=${CHROME:-$(command -v chromium chromium-browser google-chrome-stable google-chrome 2>/dev/null | head -1)}
[ -n "$CHROME" ] || { echo "Chybí Chromium/Chrome (nastav proměnnou CHROME)"; exit 1; }
PORT=${PORT:-8097}
TMP=$(mktemp -d); trap 'kill $PID 2>/dev/null || true; rm -rf "$TMP"' EXIT
tar --exclude=.git --exclude=config/config.php --exclude='storage/*' -cf - . | tar -xf - -C "$TMP"
cp "$TMP/config/config.example.php" "$TMP/config/config.php"
sed -i "s/'driver'     => 'cloudron'/'driver'     => 'log'/" "$TMP/config/config.php"
mkdir -p "$TMP/storage/ratelimit"
php -d opcache.enable_cli=0 -S 127.0.0.1:$PORT -t "$TMP/public" "$TMP/public/index.php" >/dev/null 2>&1 & PID=$!
sleep 1
build(){ # cesta  soubor
  "$CHROME" --headless=new --no-sandbox --disable-gpu --no-pdf-header-footer --virtual-time-budget=5000 \
    --print-to-pdf="$PWD/public/assets/files/$2" "http://127.0.0.1:$PORT$1" >/dev/null 2>&1
  echo "$2  $(du -k "public/assets/files/$2" | cut -f1) kB"
}
build /podminky               oscloud-podminky.pdf
build /zpracovatelska-smlouva oscloud-zpracovatelska-smlouva.pdf
build /en/terms               oscloud-terms-en.pdf
build /en/data-processing     oscloud-data-processing-agreement-en.pdf
