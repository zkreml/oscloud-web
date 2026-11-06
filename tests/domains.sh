#!/bin/bash
# Test režimu dvou domén. V config/config.php nastav canonical_host=oscloud.cz a canonical_host_en=oscloud.online,
# spusť  php -S 127.0.0.1:8095 -t public public/index.php  a pak  tests/domains.sh
B=${1:-http://127.0.0.1:8095}; bad=0
# Neznámé domény a aliasy bez záznamu v Cloudronu se k aplikaci vůbec nedostanou, jejich přesměrování jde ověřit jen lokálně.
case "$B" in http://127.0.0.1*|http://localhost*) LOCAL=1;; *) LOCAL=0;; esac
chk(){ # host cesta očekávaný_kód očekávaná_Location(volitelně)
  out=$(curl -s -o /dev/null -w "%{http_code} %{redirect_url}" -H "Host: $1" "$B$2")
  code=${out%% *}; loc=${out#* }
  [ "$code" = "$3" ] || { echo "CHYBA $1$2: čekal jsem $3, je $code"; bad=1; return; }
  [ -z "$4" ] || [ "${loc#http://127.0.0.1:*}" != "$loc" -a "${loc#*$4}" != "$loc" ] || [ "$loc" = "$4" ] || { echo "CHYBA $1$2: Location '$loc' != '$4'"; bad=1; }
}
chk oscloud.cz / 200;           chk oscloud.cz /cenik 200
chk oscloud.online / 200;       chk oscloud.online /pricing 200;  chk oscloud.online /join 200
chk www.oscloud.cz /cenik 301 https://oscloud.cz/cenik
[ $LOCAL = 1 ] && { chk www.oscloud.online /pricing 301 https://oscloud.online/pricing; chk neznama.example / 301 https://oscloud.cz/; }
chk oscloud.cz /en 301 https://oscloud.online/
chk oscloud.cz /en/pricing 301 https://oscloud.online/pricing
chk oscloud.online /en/pricing 301 https://oscloud.online/pricing
chk oscloud.cz /pricing 404;    chk oscloud.online /cenik 404
h=$(curl -s -H "Host: oscloud.online" "$B/pricing")
echo "$h" | grep -q '<html lang="en"' || { echo "CHYBA oscloud.online není anglicky"; bad=1; }
echo "$h" | grep -q 'rel="canonical" href="https://oscloud.online/pricing"' || { echo "CHYBA canonical na .online"; bad=1; }
echo "$h" | grep -q 'hreflang="cs" href="https://oscloud.cz/cenik"' || { echo "CHYBA hreflang cs"; bad=1; }
h=$(curl -s -H "Host: oscloud.cz" "$B/cenik")
echo "$h" | grep -q 'class="lang-switch" href="https://oscloud.online/pricing"' || { echo "CHYBA přepínač jazyka"; bad=1; }
h=$(curl -s -H "Host: oscloud.online" "$B/terms")
echo "$h" | grep -q 'rel="canonical" href="https://oscloud.online/terms"' || { echo "CHYBA canonical přeložených právních stránek"; bad=1; }
echo "$h" | grep -q 'hreflang="cs" href="https://oscloud.cz/podminky"' || { echo "CHYBA hreflang právních stránek"; bad=1; }
echo "$h" | grep -q '<article class="legal" lang="en"' || { echo "CHYBA právní stránka nemá lang=en"; bad=1; }
n=$(curl -s -H "Host: oscloud.cz" "$B/sitemap.xml" | grep -c '<loc>');     [ "$n" = 12 ] || { echo "CHYBA sitemap cs má 12, má $n"; bad=1; }
n=$(curl -s -H "Host: oscloud.online" "$B/sitemap.xml" | grep -c '<loc>'); [ "$n" = 12 ]  || { echo "CHYBA sitemap en má 12, má $n"; bad=1; }
[ $bad = 0 ] && echo "OK"; exit $bad
