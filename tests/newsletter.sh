#!/bin/bash
# Test newsletteru proti falešnému Listmonku (lokálně, nic se nikam neposílá).
#   tests/newsletter.sh        – spustí vlastní kopii webu a falešné API na portech 8101/8102
cd "$(dirname "$0")/.."; bad=0
TMP=$(mktemp -d); trap 'kill $WEB $MOCK 2>/dev/null; rm -rf "$TMP"' EXIT
tar --exclude=.git --exclude=config/config.php --exclude='storage/*' -cf - . | tar -xf - -C "$TMP"
mkdir -p "$TMP/storage/ratelimit" "$TMP/mock"
cat > "$TMP/mock/index.php" <<'PHP'
<?php
file_put_contents(__DIR__ . '/last.json', ($_SERVER['REQUEST_URI'] ?? '') . "\n" . file_get_contents('php://input'));
http_response_code((int) (@file_get_contents(__DIR__ . '/status') ?: 200));
echo '{"data":true}';
PHP
sed "s/'driver'     => 'cloudron'/'driver'     => 'log'/; s#'url'       => ''#'url'       => 'http://127.0.0.1:8102'#; s/'list_uuid' => ''/'list_uuid' => 'uuid-test-1234'/" config/config.example.php > "$TMP/config/config.php"
php -d opcache.enable_cli=0 -S 127.0.0.1:8102 -t "$TMP/mock" >/dev/null 2>&1 & MOCK=$!
php -d opcache.enable_cli=0 -S 127.0.0.1:8101 -t "$TMP/public" "$TMP/public/index.php" >/dev/null 2>&1 & WEB=$!
sleep 1; B=http://127.0.0.1:8101
ok(){ [ "$1" = "$2" ] || { echo "CHYBA $3: čekáno '$2', je '$1'"; bad=1; }; }
tok(){ curl -s "$B/cenik" | grep -o 'name="t" value="[^"]*"' | head -1 | sed 's/.*value="//;s/"//'; }
post(){ curl -s -o /dev/null -w "%{http_code} %{redirect_url}" -X POST "$B/newsletter" --data-urlencode "email=$1" --data-urlencode "t=$2" --data-urlencode "back=${3:-/cenik}" --data-urlencode "web=${4:-}"; }

curl -s "$B/cenik" | grep -q 'id="newsletter"' || { echo "CHYBA formulář v patičce chybí"; bad=1; }
curl -s "$B/en" | grep -q 'id="newsletter"' && { echo "CHYBA formulář je i v angličtině"; bad=1; }
ok "$(curl -s -o /dev/null -w '%{http_code}' "$B/newsletter")" 303 "GET /newsletter"

T=$(tok); sleep 3
ok "$(post ok1@example.com "$T")" "303 $B/cenik?newsletter=ok#newsletter" "platná přihláška"
grep -q '"email":"ok1@example.com"' "$TMP/mock/last.json" && grep -q '"list_uuids":\["uuid-test-1234"\]' "$TMP/mock/last.json" && grep -q '^/api/public/subscription' "$TMP/mock/last.json" || { echo "CHYBA požadavek na Listmonk: $(cat "$TMP/mock/last.json")"; bad=1; }
ok "$(post ok1@example.com "$T")" "303 $B/cenik?newsletter=limit#newsletter" "druhý pokus na stejný e-mail (limit)"
ok "$(post spatny "$T")" "303 $B/cenik?newsletter=email#newsletter" "špatný e-mail"
ok "$(post ok2@example.com "$T" /cenik robot)" "303 $B/cenik?newsletter=znovu#newsletter" "honeypot"
ok "$(post ok3@example.com "x.y")" "303 $B/cenik?newsletter=znovu#newsletter" "špatný token"
T2=$(curl -s "$B/cenik" | grep -o 'name="t" value="[^"]*"' | head -1 | sed 's/.*value="//;s/"//')
ok "$(post ok4@example.com "$T2")" "303 $B/cenik?newsletter=znovu#newsletter" "odeslání do 3 s"
ok "$(post ok5@example.com "$T" "//evil.example")" "303 $B/?newsletter=ok#newsletter" "cizí adresa v back"
echo 500 > "$TMP/mock/status"
ok "$(post ok6@example.com "$T")" "303 $B/cenik?newsletter=chyba#newsletter" "Listmonk vrátí 500"
curl -s "$B/cenik?newsletter=ok" | grep -q 'newsletter__msg--ok' || { echo "CHYBA hláška po odeslání"; bad=1; }
curl -s "$B/cenik?newsletter=<script>" | grep -q '<script>' && { echo "CHYBA XSS v hlášce"; bad=1; }
curl -s "$B/robots.txt" | grep -q '^Disallow: /newsletter' || { echo "CHYBA robots.txt bez /newsletter"; bad=1; }
[ $bad = 0 ] && echo "OK"; exit $bad
