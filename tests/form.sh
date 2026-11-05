#!/bin/bash
# usage: formtest.sh PATH key=val ...   (načte formulář, počká 3 s, odešle)
B=${B:-http://127.0.0.1:8095}; P=$1; shift; J=$(mktemp)
H=$(curl -s -c $J -b $J $B$P); T=$(echo "$H" | grep -o 'name="_token" value="[^"]*"' | head -1 | sed 's/.*value="//;s/"//')
sleep 3.2
args=(); for kv in "$@"; do args+=(--data-urlencode "$kv"); done
curl -s -o /tmp/out.html -D /tmp/hdr.txt -c $J -b $J "${args[@]}" --data-urlencode "_token=${NOTOKEN:-$T}" $B$P
head -1 /tmp/hdr.txt; grep -i '^location' /tmp/hdr.txt
grep -o 'class="[^"]*error[^"]*"[^<]*<[^<]*' /tmp/out.html | head -3; grep -o 'form-error[^<]*<[^<]*' /tmp/out.html | head -3
