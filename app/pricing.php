<?php
declare(strict_types=1);

/*
 * Ceny služeb (v Kč za měsíc, pokud není uvedeno jinak).
 * Odsud čerpá ceník, stránky služeb i formulář Chci se připojit – cena se mění jen tady.
 */

/*
 * Zdroj všech cen je app/prices.json (stejný soubor, ze kterého se ceny berou i jinde v OSCloudu).
 * Cenu stačí změnit tam – ceník, stránky služeb i formulář se přepočítají samy.
 */
$prices = json_decode((string) file_get_contents(__DIR__ . '/prices.json'), true, 512, JSON_THROW_ON_ERROR);
define('PRICES', $prices);

// Nextcloud: úložiště v GB => [jednotlivec, rodina, spolek, firma]; null = tarif tuto velikost nemá.
// Rodina = cena jednotlivce + rozdíl family_base - cena nc_family_min; spolek a firma = cena + příplatek za tarif.
$ncRows = [];
$familyDiff = $prices['family_base'] - $prices['nc'][(string) $prices['nc_family_min']];
foreach ($prices['nc'] as $gb => $price) {
    $gb = (int) $gb;
    $ncRows[$gb] = [
        $price,
        $gb >= $prices['nc_family_min'] ? $price + $familyDiff : null,
        $gb >= $prices['nc_org_min'] ? $price + $prices['plan']['spolek'] : null,
        $gb >= $prices['nc_org_min'] ? $price + $prices['plan']['firma'] : null,
    ];
}
define('NEXTCLOUD_PRICES', $ncRows);

// Pořadí sloupců v NEXTCLOUD_PRICES – kód tarifu (používá se i v odkazech ?typ=…)
const NEXTCLOUD_PLANS = ['jednotlivec', 'rodina', 'spolek', 'firma'];

// Příplatek za tarif spolek / firma k ceně úložiště jednotlivce
define('ORG_SURCHARGE', ['spolek' => $prices['plan']['spolek'], 'firma' => $prices['plan']['firma']]);

// Ente Photos: úložiště v GB => [měsíčně, ročně]
define('ENTE_PRICES', array_combine(array_map('intval', array_keys($prices['ente'])), array_values($prices['ente'])));

// Trilium Next: [měsíčně, ročně]
define('TRILIUM_PRICES', ['monthly' => $prices['trilium']['month'], 'yearly' => $prices['trilium']['year']]);

/** Nejnižší cena pro tarif spolek / firma (nejmenší úložiště tarifu + příplatek) – pro „od … Kč“. */
function plan_from(string $plan): int
{
    return min(array_filter(array_column(NEXTCLOUD_PRICES, array_search($plan, NEXTCLOUD_PLANS, true)), fn ($v) => $v !== null));
}

/** Velikost úložiště čitelně: 50 GB, 1 TB. */
function storage_label(int $gb): string
{
    return $gb >= 1000 ? ($gb / 1000) . ' TB' : $gb . ' GB';
}

/** Cena Nextcloudu pro tarif a úložiště, nebo null, když kombinace neexistuje. */
function nextcloud_price(string $plan, int $gb): ?int
{
    $col = array_search($plan, NEXTCLOUD_PLANS, true);
    return $col === false ? null : (NEXTCLOUD_PRICES[$gb][$col] ?? null);
}

/** Velikosti úložiště dostupné v tarifu. */
function nextcloud_sizes(string $plan): array
{
    $col = array_search($plan, NEXTCLOUD_PLANS, true);
    return $col === false ? [] : array_keys(array_filter(NEXTCLOUD_PRICES, fn ($row) => $row[$col] !== null));
}
