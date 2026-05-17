<?php
$pageTitle = 'Formations';

require 'views/partials/header.php';
require 'views/partials/navbar.php';
?>

<?php
// Associer automatiquement une image selon le titre de la formation
function getFormationImage($titre) {

    $titre = strtolower($titre);

    if (strpos($titre, 'data science') !== false) {
        return 'data.jpg';
    }

    if (strpos($titre, 'intelligence artificielle') !== false || strpos($titre, 'ia') !== false) {
        return 'ia.jpg';
    }

    if (strpos($titre, 'développement web') !== false || strpos($titre, 'developpement web') !== false) {
        return 'web.jpg';
    }

    if (strpos($titre, 'cybersécurité') !== false || strpos($titre, 'cybersecurite') !== false) {
        return 'cyber.jpg';
    }

    // image par défaut
    return 'default.jpg';
}
?>

<div class="page-header">
    <div class="container">

        <p class="breadcrumb">
            <a href="index.php?page=home">Accueil</a> / Formations
        </p>

        <h1>Catalogue des formations</h1>

        <p>
            Choisissez le programme qui correspond à vos ambitions.
        </p>

    </div>
</div>

<section class="section">

    <div class="container">

        <div class="cards-grid cards-grid-large">

            <?php foreach ($formations as $f): ?>

            <?php
                // choisir automatiquement l'image
                $image = getFormationImage($f['titre']);
            ?>

            <div class="card">

                <div class="card-image">

                    <img
                        src="assets/images/<?= htmlspecialchars($image) ?>"
                        alt="<?= htmlspecialchars($f['titre']) ?>"
                        onerror="this.parentElement.classList.add('card-image-fallback')"
                    >

                    <span class="card-categorie">
                        <?= htmlspecialchars($f['categorie'] ?? '') ?>
                    </span>

                    <?php if (!empty($f['certificat'])): ?>
                        <span class="card-cert-badge">
                            Certificat inclus
                        </span>
                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <div class="card-meta">

                        <span class="badge badge-niveau">
                            <?= htmlspecialchars($f['niveau'] ?? '') ?>
                        </span>

                        <span class="card-duree">
                            <?= htmlspecialchars($f['duree'] ?? '') ?>
                        </span>

                    </div>

                    <h3 class="card-title">
                        <?= htmlspecialchars($f['titre'] ?? '') ?>
                    </h3>

                    <p class="card-desc">
                        <?= htmlspecialchars(mb_substr($f['description'] ?? '', 0, 120)) ?>...
                    </p>

                    <?php if (!empty($f['technologies'])): ?>

                    <div class="tech-tags">

                        <?php foreach (
                            array_slice(
                                array_map('trim', explode(',', $f['technologies'])),
                                0,
                                4
                            ) as $tech
                        ): ?>

                        <span class="tech-tag">
                            <?= htmlspecialchars($tech) ?>
                        </span>

                        <?php endforeach; ?>

                    </div>

                    <?php endif; ?>

                    <div class="card-footer">

                        <span class="card-prix">
                            <?= number_format($f['prix'] ?? 0, 0, ',', ' ') ?> DT
                        </span>

                        <div class="card-actions">

                            <a
                                href="index.php?page=detail&id=<?= $f['id'] ?>"
                                class="btn btn-secondary btn-sm">

                                Détails

                            </a>

                            <a
                                href="index.php?page=inscription&formation_id=<?= $f['id'] ?>"
                                class="btn btn-primary btn-sm">

                                S'inscrire

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<?php require 'views/partials/footer.php'; ?>