// Mobilní menu
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.nav-toggle');
    const nav = document.getElementById('hlavni-menu');
    if (!toggle || !nav) return;

    const setOpen = (open) => {
        toggle.setAttribute('aria-expanded', String(open));
        nav.classList.toggle('is-open', open);
    };

    toggle.addEventListener('click', () => {
        setOpen(toggle.getAttribute('aria-expanded') !== 'true');
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') setOpen(false);
    });

    // Odkaz na sekci stejné stránky (Služby, Komunita) – menu po kliknutí zavřít
    nav.addEventListener('click', (e) => {
        if (e.target.closest('a')) setOpen(false);
    });

    // Po přechodu na desktopovou šířku menu zavřít
    window.matchMedia('(min-width: 961px)').addEventListener('change', (e) => {
        if (e.matches) setOpen(false);
    });
});

// Formulář Chci se připojit – ukazuje jen pole, která patří k vybrané volbě.
// Skrytá pole se vypnou (disabled), takže se neodešlou a prohlížeč je nekontroluje.
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('[data-join-form]');
    if (!form) return;

    const service = form.querySelector('#j-service');
    const setShown = (el, shown) => {
        el.hidden = !shown;
        el.querySelectorAll('input, select, textarea').forEach((f) => { f.disabled = !shown; });
    };

    const update = () => {
        const typ = form.querySelector('input[name="typ"]:checked')?.value || 'person';
        const current = typ === 'person' ? service.value : '';
        form.querySelectorAll('[data-part]').forEach((part) => setShown(part, part.dataset.part === typ));
        form.querySelectorAll('[data-part="person"] [data-show]').forEach((el) => {
            if (typ === 'person') setShown(el, el.dataset.show.split(' ').includes(current));
        });
        // Nápověda k poznámce (Matrix) je mimo části formuláře
        form.querySelectorAll(':scope > .field [data-show]').forEach((el) => { el.hidden = !el.dataset.show.split(' ').includes(current); });
    };

    form.addEventListener('change', update);
    update();
});

// Tlačítka a odkazy zatím nikam nevedou – zabráníme skoku na začátek stránky
document.addEventListener('click', (e) => {
    const link = e.target.closest('a[href="#"]');
    if (link) e.preventDefault();
});
