<?php $current = $_GET['page'] ?? 'home'; ?>

<header class="site-header" id="site-header">

    <nav class="navbar">

        <!-- Logo -->
        <a href="index.php?page=home" class="nav-logo">

            <span class="logo-mark">L</span>

            <span class="logo-text">LearnNOW</span>

        </a>

        <!-- Navigation -->
        <ul class="nav-links" id="nav-links">

            <li>
                <a href="index.php?page=home"
                   class="nav-link <?= $current === 'home' ? 'active' : '' ?>">
                    Accueil
                </a>
            </li>

            <li>
                <a href="index.php?page=formations"
                   class="nav-link <?= $current === 'formations' ? 'active' : '' ?>">
                    Formations
                </a>
            </li>

            <li>
                <a href="index.php?page=profil"
                   class="nav-link <?= $current === 'profil' ? 'active' : '' ?>">
                    Mon profil
                </a>
            </li>

            <?php if (!empty($_SESSION['paiement_ok'])): ?>

            <li>
                <a href="index.php?page=cours"
                   class="nav-link <?= $current === 'cours' ? 'active' : '' ?>">
                    Mes cours
                </a>
            </li>

            <?php endif; ?>

        </ul>

        <!-- Right -->
        <div class="nav-right">

            <!-- Nom utilisateur -->
            <?php if (!empty($_SESSION['paiement_ok'])): ?>

                <span class="nav-user">
                    <?= htmlspecialchars($_SESSION['etudiant_nom'] ?? '') ?>
                </span>

            <?php endif; ?>

            <!-- Bouton commencer -->
            <a href="index.php?page=formations"
               class="btn btn-primary nav-cta">

                Commencer

            </a>

            <!-- Bouton logout -->
            <?php if (!empty($_SESSION['paiement_ok'])): ?>

                <a href="index.php?page=logout"
                   class="btn btn-logout">

                    Déconnexion

                </a>

            <?php endif; ?>

            <!-- Burger -->
            <button class="nav-burger"
                    id="nav-burger"
                    aria-label="Menu">

                <span></span>
                <span></span>
                <span></span>

            </button>

        </div>

    </nav>

</header>