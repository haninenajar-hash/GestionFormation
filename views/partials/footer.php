    <footer class="site-footer">
        <div class="footer-top">
            <div class="container footer-grid">
                <div class="footer-brand-col">
                    <a href="index.php?page=home" class="nav-logo footer-logo">
                        <span class="logo-mark">L</span>
                        <span class="logo-text">LearnNOW</span>
                    </a>
                    <p class="footer-slogan">مستقبلك يبدا توا.</p>
                    <p class="footer-desc">La plateforme de formation professionnelle pour les étudiants et professionnels tunisiens.</p>
                </div>
                <div class="footer-nav-col">
                    <h4>Formations</h4>
                    <ul>
                        <li><a href="index.php?page=formations">Développement Web</a></li>
                        <li><a href="index.php?page=formations">Data Science</a></li>
                        <li><a href="index.php?page=formations">Intelligence Artificielle</a></li>
                        <li><a href="index.php?page=formations">Cybersécurité</a></li>
                    </ul>
                </div>
                <div class="footer-nav-col">
                    <h4>Plateforme</h4>
                    <ul>
                        <li><a href="index.php?page=home">Accueil</a></li>
                        <li><a href="index.php?page=formations">Catalogue</a></li>
                        <li><a href="index.php?page=profil">Mon profil</a></li>
                        <?php if (!empty($_SESSION['paiement_ok'])): ?>
                        <li><a href="index.php?page=cours">Mes cours</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container footer-bottom-inner">
                <span>LearnNOW — Projet TP6, ISET'COM L2-GTIC, 2025</span>
                <span>مستقبلك يبدا توا.</span>
            </div>
        </div>
    </footer>
    <script src="assets/app.js"></script>
</body>
</html>
