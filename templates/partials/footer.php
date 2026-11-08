</main>

<footer class="site-footer">
    <?= wave('top') ?>
    <div class="site-footer__body">
        <?php if (newsletter_enabled()): ?>
            <?php
            $nlCode = is_string($_GET['newsletter'] ?? null) && in_array($_GET['newsletter'], ['ok', 'email', 'limit', 'chyba', 'znovu'], true) ? $_GET['newsletter'] : '';
            $nlBack = (string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);
            ?>
            <div class="container">
                <section class="newsletter" id="newsletter" aria-labelledby="newsletter-title">
                    <div class="newsletter__text">
                        <h2 class="site-footer__title" id="newsletter-title"><?= e(t('newsletter.title')) ?></h2>
                        <p><?= e(t('newsletter.text')) ?></p>
                    </div>
                    <form class="newsletter__form" method="post" action="/newsletter">
                        <label class="visually-hidden" for="nl-email"><?= e(t('newsletter.label')) ?></label>
                        <input id="nl-email" type="email" name="email" required maxlength="190" autocomplete="email" placeholder="<?= e(t('newsletter.label')) ?>">
                        <input type="hidden" name="t" value="<?= e(newsletter_token()) ?>">
                        <input type="hidden" name="back" value="<?= e($nlBack) ?>">
                        <div class="hp" aria-hidden="true"><label><?= e(t('form.honeypot')) ?> <input type="text" name="web" tabindex="-1" autocomplete="off"></label></div>
                        <button class="btn btn--primary" type="submit"><?= e(t('newsletter.button')) ?></button>
                    </form>
                    <?php if ($nlCode !== ''): ?>
                        <p class="newsletter__msg newsletter__msg--<?= $nlCode === 'ok' ? 'ok' : 'err' ?>" role="status"><?= e(t('newsletter.' . $nlCode)) ?></p>
                    <?php endif; ?>
                    <p class="newsletter__note"><?= e(t('newsletter.consent')) ?> <a href="<?= url('privacy') ?>"><?= e(t('newsletter.privacy')) ?></a></p>
                </section>
            </div>
        <?php endif; ?>
        <div class="container site-footer__grid">
            <div class="site-footer__brand">
                <img src="<?= asset('img/logo-horizontal.png') ?>" alt="OSCloud" width="794" height="108">
                <p><?= e(t('footer.tagline')) ?></p>
                <p><a href="mailto:<?= e(ORG['email']) ?>"><?= e(ORG['email']) ?></a></p>
            </div>

            <div>
                <h2 class="site-footer__title"><?= e(t('footer.services')) ?></h2>
                <ul>
                    <li><a href="<?= url('nextcloud') ?>">Nextcloud</a></li>
                    <li><a href="<?= url('ente') ?>">Ente Photos</a></li>
                    <li><a href="<?= url('trilium') ?>">Trilium Next</a></li>
                    <li><a href="<?= e(LINKS['cryptpad']) ?>" target="_blank" rel="noopener">CryptPad</a></li>
                    <li><a href="<?= e(doc('vaultwarden')) ?>" target="_blank" rel="noopener">Vaultwarden</a></li>
                    <li><a href="<?= e(doc('searxng')) ?>" target="_blank" rel="noopener">SearXNG</a></li>
                    <li><a href="<?= e(doc('freshrss')) ?>" target="_blank" rel="noopener">FreshRSS</a></li>
                </ul>
            </div>

            <div>
                <h2 class="site-footer__title"><?= e(t('footer.fediverse')) ?></h2>
                <ul>
                    <li><a href="<?= e(LINKS['mamutovo']) ?>" target="_blank" rel="noopener">Mastodon</a></li>
                    <li><a href="<?= e(LINKS['peertube']) ?>" target="_blank" rel="noopener">PeerTube</a></li>
                    <li><a href="<?= e(LINKS['pixelfed']) ?>" target="_blank" rel="noopener">Pixelfed</a></li>
                    <li><a href="<?= e(LINKS['fitpub']) ?>" target="_blank" rel="noopener">FitPub (makni.cz)</a></li>
                </ul>
            </div>

            <div>
                <h2 class="site-footer__title"><?= e(t('footer.community')) ?></h2>
                <ul>
                    <li><a href="<?= url('matrix') ?>"><?= e(t('footer.chat')) ?></a></li>
                    <li><a href="<?= e(LINKS['blog']) ?>" target="_blank" rel="noopener"><?= e(t('footer.blog')) ?></a></li>
                    <li><a href="<?= e(LINKS['docs']) ?>" target="_blank" rel="noopener"><?= e(t('footer.docs')) ?></a></li>
                    <li><a href="<?= url('degoogle') ?>"><?= e(t('nav.degoogle')) ?></a></li>
                    <li><a href="<?= e(LINKS['mastodon']) ?>" target="_blank" rel="noopener me">@oscloud@mamutovo.cz</a></li>
                </ul>
            </div>

            <div>
                <h2 class="site-footer__title"><?= e(t('footer.project')) ?></h2>
                <ul>
                    <li><a href="<?= url('about') ?>"><?= e(t('footer.about')) ?></a></li>
                    <li><a href="<?= e(LINKS['helpdesk']) ?>" target="_blank" rel="noopener"><?= e(t('footer.helpdesk')) ?></a></li>
                    <li><a href="<?= e(LINKS['git']) ?>" target="_blank" rel="noopener"><?= e(t('footer.git')) ?></a></li>
                    <li><a href="<?= url('pricing') ?>"><?= e(t('nav.pricing')) ?></a></li>
                </ul>
            </div>
        </div>

        <div class="container site-footer__legal">
            <p>
                © 2024–<?= date('Y') ?> <?= e(ORG['name']) ?> · <?= e(t('footer.ids', ['ico' => ORG['ico'], 'dic' => ORG['dic']])) ?> · <?= e(ORG['street']) ?>, <?= e(ORG['city']) ?><br>
                <?= e(t('footer.register')) ?> <?= e(t('footer.made')) ?> 💙
            </p>
            <ul class="site-footer__legal-links">
                <li><a href="<?= url('terms') ?>"><?= e(t('footer.terms')) ?></a></li>
                <li><a href="<?= url('privacy') ?>"><?= e(t('footer.privacy')) ?></a></li>
                <li><a href="<?= url('dpa') ?>"><?= e(t('footer.dpa')) ?></a></li>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>
