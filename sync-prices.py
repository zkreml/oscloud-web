#!/usr/bin/env python3
"""Synchronizuje ceny z prices.json do HTML souborů.

Použití:
  python3 sync-prices.py           přepíše soubory
  python3 sync-prices.py --check   jen ověří, nic nezapíše (exit 1 při rozdílu)

V HTML se hledají tyto značky:
  <!--p "text s {nc.50} a {plan.spolek}"-->…<!--/p-->    obsah se přepíše šablonou
  <!--prices:rows-->…<!--/prices-->                      řádky tabulky Nextcloudu
  <!--prices:opt-ind-->…<!--/prices-->                   volby úložiště (jednotlivec)
  <!--prices:opt-org-->…<!--/prices-->                   volby úložiště (spolek/firma)
  <!--prices:opt-fam-->…<!--/prices-->                   volby úložiště (rodina)
  <!--prices:opt-plan-->…<!--/prices-->                  volby tarifu
  /*prices:js*/…/*/prices*/                             data pro skript ve formuláři
V šabloně {nc.min} je nejnižší cena úložiště a {nc.SIZE} cena dané velikosti.
"""
import json, re, sys, pathlib

ROOT = pathlib.Path(__file__).resolve().parent
FILES = ["index.html", "nextcloud.html", "degooglizace.html", "trilium.html",
         "en/index.html", "en/degooglizace.html", "en/trilium.html", "en/nextcloud.html"]

# Texty generovaných bloků v anglické verzi (soubory v en/)
EN = {
    "order": "Order", "from": "from", "mo": "CZK/mo", "none": "–",
    "who": {"jednotlivec": "individual", "rodina": "Family plan", "spolek": "Association plan", "firma": "Company plan"},
    "aria": "Order Nextcloud {label}, {who}, price {price} CZK",
    "plan": "{label} (+{v} CZK per month)",
    "plan_labels": {"spolek": "Association", "firma": "Company"},
    "base": "/en/",
}
CS = {
    "order": "Objednat", "from": "od", "mo": "Kč/měs", "none": "–",
    "who": {"jednotlivec": "jednotlivec", "rodina": "tarif rodina", "spolek": "tarif spolek", "firma": "tarif firma"},
    "aria": "Objednat Nextcloud {label}, {who}, cena {price} Kč",
    "plan": "{label} (+{v} Kč měsíčně)",
    "plan_labels": None,
    "base": "/",
}
P = json.loads((ROOT / "prices.json").read_text(encoding="utf-8"))

SEP = " "

def fmt(n):
    return f"{n:,}".replace(",", SEP)

def flat(prefix, d, out):
    for k, v in d.items():
        if isinstance(v, dict):
            flat(f"{prefix}{k}.", v, out)
        elif isinstance(v, (int, float)):
            out[f"{prefix}{k}"] = v

VALUES = {}
flat("", {k: v for k, v in P.items() if not k.endswith("_labels") and not k.startswith("_")}, VALUES)
VALUES["nc.min"] = min(P["nc"].values())

def tpl(s):
    def r(m):
        key = m.group(1)
        if key not in VALUES:
            sys.exit(f"Neznámý klíč ceny: {{{key}}}")
        return fmt(VALUES[key])
    return re.sub(r"\{([A-Za-z0-9_.]+)\}", r, s)

def cell(typ, gb, label, who, price, L=CS):
    aria = L["aria"].format(label=label, who=who, price=price)
    cur = "CZK" if L is EN else "Kč"
    return (f'<td><a class="order-link" href="{L["base"]}?typ={typ}&amp;gb={gb}#pripojit" '
            f'aria-label="{aria}">'
            f'<span class="o-price">{price} {cur}</span>'
            f'<span class="o-cta" aria-hidden="true">{L["order"]} →</span></a></td>')

def rows(indent, L=CS):
    omin = P.get("nc_org_min", 0)
    fmin = P.get("nc_family_min", 0)
    fam = P["family_base"] - P["nc"][str(fmin)]
    out = []
    for gb, base in P["nc"].items():
        label = P["nc_labels"][gb]
        W = L["who"]
        r = (f'{indent}<tr><th scope="row">{label}</th>'
             + cell("jednotlivec", gb, label, W["jednotlivec"], base, L))
        if int(gb) >= fmin:
            r += cell("rodina", gb, label, W["rodina"], base + fam, L)
        else:
            r += '<td class="o-na">–</td>'
        if int(gb) >= omin:
            r += (cell("spolek", gb, label, W["spolek"], base + P["plan"]["spolek"], L)
                  + cell("firma", gb, label, W["firma"], base + P["plan"]["firma"], L))
        else:
            r += '<td class="o-na">–</td><td class="o-na">–</td>'
        out.append(r + "</tr>")
    return "\n".join(out)

def opt_ind(L=CS):
    return "".join(f'<option value="{gb}">{P["nc_labels"][gb]} · {base} {L["mo"]}</option>'
                   for gb, base in P["nc"].items())

def opt_org(L=CS):
    extra = min(P["plan"].values())
    omin = P.get("nc_org_min", 0)
    return "".join(f'<option value="{gb}">{P["nc_labels"][gb]} · {L["from"]} {base + extra} {L["mo"]}</option>'
                   for gb, base in P["nc"].items() if int(gb) >= omin)

def opt_fam(L=CS):
    fmin = P.get("nc_family_min", 0)
    fam = P["family_base"] - P["nc"][str(fmin)]
    return "".join(f'<option value="{gb}">{P["nc_labels"][gb]} · {base + fam} {L["mo"]}</option>'
                   for gb, base in P["nc"].items() if int(gb) >= fmin)

def opt_plan(L=CS):
    labels = L["plan_labels"] or P["plan_labels"]
    return "".join(f'<option value="{k}">{L["plan"].format(label=labels[k], v=v)}</option>'
                   for k, v in P["plan"].items())

def js_data():
    labels = json.dumps(P["nc_labels"], ensure_ascii=False)
    return (f'var NC_PRICES = {json.dumps(P["nc"])}, NC_LABELS = {labels}, '
            f'PLAN_EXTRA = {json.dumps(P["plan"])};')

def process(text, L=CS):
    global SEP
    SEP = "," if L is EN else " "
    # inline značky
    text = re.sub(r'(<!--p "([^"]*)"-->)(.*?)(<!--/p-->)',
                  lambda m: m.group(1) + tpl(m.group(2)) + m.group(4), text, flags=re.S)
    # blokové značky
    def block(m):
        name, body = m.group(2), m.group(3)
        if name == "rows":
            ind = re.match(r"\s*", body).group(0).lstrip("\n") or "          "
            # odsazení podle prvního řádku v těle
            first = re.search(r"\n?([ \t]*)<tr", body)
            ind = first.group(1) if first else "          "
            return m.group(1) + "\n" + rows(ind, L) + "\n" + ind[:-2] + m.group(4)
        if name == "opt-ind":
            return m.group(1) + opt_ind(L) + m.group(4)
        if name == "opt-org":
            return m.group(1) + opt_org(L) + m.group(4)
        if name == "opt-fam":
            return m.group(1) + opt_fam(L) + m.group(4)
        if name == "opt-plan":
            return m.group(1) + opt_plan(L) + m.group(4)
        sys.exit(f"Neznámý blok: {name}")
    text = re.sub(r"(<!--prices:([\w-]+)-->)(.*?)(<!--/prices-->)", block, text, flags=re.S)
    text = re.sub(r"(/\*prices:js\*/)(.*?)(/\*/prices\*/)",
                  lambda m: m.group(1) + " " + js_data() + " " + m.group(3), text, flags=re.S)
    return text

def meta_warn(name, text):
    """Meta popisky nelze značkovat, jen hlídáme nejnižší cenu v nich."""
    for m in re.finditer(r'<meta[^>]*content="[^"]*od (\d+)[ \u00a0]Kč[^"]*"', text):
        if int(m.group(1)) != VALUES["nc.min"]:
            print(f"POZOR: {name}: meta popisek uvádí od {m.group(1)} Kč, ale nejnižší cena je {VALUES['nc.min']} Kč. Uprav ručně.")

def main():
    check = "--check" in sys.argv
    changed = False
    for name in FILES:
        path = ROOT / name
        if not path.exists():
            continue
        old = path.read_text(encoding="utf-8")
        new = process(old, EN if name.startswith("en/") else CS)
        meta_warn(name, new)
        if new != old:
            changed = True
            print(("Rozdíl: " if check else "Upraveno: ") + name)
            if not check:
                path.write_text(new, encoding="utf-8")
    if not changed:
        print("Beze změn.")
    sys.exit(1 if (check and changed) else 0)

if __name__ == "__main__":
    main()
