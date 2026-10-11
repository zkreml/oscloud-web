/* OSCloud sdílená navigace.
   Na oscloud.cz je lišta přímo v HTML (skript jen ovládá mobilní menu).
   Na blogu a v docs ji skript vloží na začátek <body> a dotáhne si nav.css.
   Zdroj: https://oscloud.cz/assets/nav.js */
(function () {
  'use strict';

  var SITE = 'https://oscloud.cz';
  var script = document.currentScript;
  var base = (script && script.src) ? script.src.replace(/[^\/]*$/, '') : SITE + '/assets/';

  var LINKS = [
    ['Služby', SITE + '/#sluzby'],
    ['Proč OSCloud', SITE + '/#proc'],
    ['Ceník', SITE + '/#cenik'],
    ['Komunita', SITE + '/#komunita'],
    ['Dokumentace', 'https://docs.oscloud.cz', 'docs.oscloud.cz'],
    ['Blog', 'https://blog.oscloud.cz', 'blog.oscloud.cz']
  ];

  function build() {
    var header = document.createElement('header');
    header.className = 'os-nav os-nav--static';
    header.setAttribute('data-os-nav', '');

    var html = '<div class="os-nav__inner">' +
      '<a class="os-logo" href="' + SITE + '/"><img src="' + base + 'logo-horizontal.png" alt="OSCloud" width="176" height="24"></a>' +
      '<button class="os-toggle" type="button" aria-expanded="false" aria-controls="os-links" aria-label="Menu"><span></span><span></span><span></span></button>' +
      '<nav class="os-links" id="os-links" aria-label="Hlavní navigace">';

    LINKS.forEach(function (l) {
      var current = l[2] && l[2] === location.hostname ? ' aria-current="page"' : '';
      html += '<a href="' + l[1] + '"' + current + '>' + l[0] + '</a>';
    });
    html += '<a class="os-cta" href="' + SITE + '/#pripojit">Chci se připojit</a></nav></div>';

    header.innerHTML = html;
    return header;
  }

  function ensureCss() {
    if (document.querySelector('link[href*="nav.css"]')) return;
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = base + 'nav.css';
    document.head.appendChild(link);
  }

  function bind(header) {
    var btn = header.querySelector('.os-toggle');
    var links = header.querySelector('.os-links');
    if (!btn || !links) return;

    function set(open) {
      links.classList.toggle('open', open);
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    }
    btn.addEventListener('click', function () {
      set(btn.getAttribute('aria-expanded') !== 'true');
    });
    links.addEventListener('click', function (e) {
      if (e.target.closest && e.target.closest('a')) set(false);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') set(false);
    });
  }

  function init() {
    var header = document.querySelector('[data-os-nav]');
    if (!header) {
      ensureCss();
      header = build();
      document.body.insertBefore(header, document.body.firstChild);
    }
    bind(header);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
