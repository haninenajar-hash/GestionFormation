<?php

$pageTitle = 'Accueil';

require 'views/partials/header.php';

require 'views/partials/navbar.php';

require_once 'models/Formation.php';

$formations = Formation::getAll();

?>

<!-- ===== HERO ===== -->

<section class="hero">

    <div class="hero-bg" style="background-image: url('assets/images/hero.jpg')"></div>

    <div class="hero-overlay"></div>

    <div class="hero-content container">

        <p class="hero-slogan" dir="rtl">مستقبلك يبدا توا.</p>

        <h1 class="hero-title">Formez-vous aux métiers<br>du numérique.</h1>

        <p class="hero-subtitle">

            Des formations courtes, intensives et pratiques.

            Conçues par des experts, pour vous préparer au marché de l'emploi.

        </p>

        <div class="hero-actions">

            <a href="index.php?page=formations" class="btn btn-white">Découvrir les formations</a>

            <a href="index.php?page=inscription" class="btn btn-outline-white">Commencer</a>

        </div>

        <div class="hero-stats">

            <div class="hero-stat">

                <strong>4</strong>

                <span>Formations</span>

            </div>

            <div class="hero-stat-divider"></div>

            <div class="hero-stat">

                <strong>100%</strong>

                <span>En ligne</span>

            </div>

            <div class="hero-stat-divider"></div>

            <div class="hero-stat">

                <strong>Certifié</strong>

                <span>A la fin</span>

            </div>

        </div>

    </div>

</section>

<!-- ===== FORMATIONS ===== -->

<section class="section">

    <div class="container">

        <div class="section-head">

            <div>

                <h2 class="section-title">Nos formations</h2>

                <p class="section-desc">Choisissez parmi nos programmes certifiants.</p>

            </div>

            <a href="index.php?page=formations" class="btn btn-secondary">Voir tout</a>

        </div>

        <?php
        $imagesFormations = [
            'data.jpg',
            'ia.jpg',
            'web.jpg',
            'cyber.jpg'
        ];
        ?>

        <div class="cards-grid">

            <?php foreach ($formations as $index => $f): ?>

                <?php
                $imageFormation = $imagesFormations[$index] ?? 'web.jpg';
                ?>

                <div class="card">

                    <div class="card-image">

                        <img
                            src="assets/images/<?= htmlspecialchars($imageFormation) ?>"
                            alt="<?= htmlspecialchars($f['titre']) ?>"
                            onerror="this.parentElement.classList.add('card-image-fallback')"
                        >

                        <span class="card-categorie"><?= htmlspecialchars($f['categorie'] ?? '') ?></span>

                    </div>

                    <div class="card-body">

                        <div class="card-meta">

                            <span class="badge badge-niveau"><?= htmlspecialchars($f['niveau']) ?></span>

                            <span class="card-duree"><?= htmlspecialchars($f['duree']) ?></span>

                        </div>

                        <h3 class="card-title"><?= htmlspecialchars($f['titre']) ?></h3>

                        <p class="card-desc"><?= htmlspecialchars(mb_substr($f['description'], 0, 95)) ?>...</p>

                        <div class="card-footer">

                            <span class="card-prix"><?= number_format($f['prix'], 0, ',', ' ') ?> DT</span>

                            <a href="index.php?page=detail&id=<?= $f['id'] ?>" class="btn btn-secondary btn-sm">

                                Voir les détails

                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<!-- ===== COMMENT CA MARCHE ===== -->

<section class="section section-alt">

    <div class="container">

        <h2 class="section-title text-center">Comment ca fonctionne</h2>

        <p class="section-desc text-center">Quatre étapes simples pour commencer votre parcours.</p>

        <div class="steps">

            <div class="step">

                <span class="step-num">1</span>

                <h4>Choisissez</h4>

                <p>Parcourez notre catalogue et trouvez la formation qui correspond à votre projet.</p>

            </div>

            <div class="step">

                <span class="step-num">2</span>

                <h4>Inscrivez-vous</h4>

                <p>Remplissez le formulaire en quelques secondes.</p>

            </div>

            <div class="step">

                <span class="step-num">3</span>

                <h4>Payez</h4>

                <p>Finalisez votre paiement de manière simple et sécurisée.</p>

            </div>

            <div class="step">

                <span class="step-num">4</span>

                <h4>Apprenez</h4>

                <p>Accédez immédiatement à votre espace cours et commencez.</p>

            </div>

        </div>

    </div>

</section>

<!-- ===== CTA FINAL ===== -->

<section class="section section-cta">

    <div class="container">

        <div class="cta-block">

            <p class="cta-slogan" dir="rtl">مستقبلك يبدا توا.</p>

            <h2>Prêt à démarrer ?</h2>

            <p>Rejoignez des centaines d'étudiants qui ont fait confiance à LearnNOW pour lancer leur carrière dans le numérique.</p>

            <a href="index.php?page=formations" class="btn btn-primary">Voir les formations</a>

        </div>

    </div>

</section>

<?php require 'views/partials/footer.php'; ?>