<?php
$pageTitle = 'Inscription confirmée';
require 'views/partials/header.php';
require 'views/partials/navbar.php';
?>

<main>
    <section class="section">
        <div class="container container-sm">
            <div class="succes-card">
                <div class="succes-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <h1>Paiement confirmé</h1>
                <p>
                    Votre inscription à <strong><?= htmlspecialchars($_SESSION['formation_titre'] ?? '') ?></strong>
                    est validée. Vous pouvez maintenant accéder à vos cours.
                </p>

                <div class="succes-details">
                    <div class="detail-row">
                        <span>Etudiant</span>
                        <span><?= htmlspecialchars($_SESSION['etudiant_nom'] ?? '') ?></span>
                    </div>
                    <div class="detail-row">
                        <span>Email</span>
                        <span><?= htmlspecialchars($_SESSION['etudiant_email'] ?? '') ?></span>
                    </div>
                    <div class="detail-row">
                        <span>Formation</span>
                        <span><?= htmlspecialchars($_SESSION['formation_titre'] ?? '') ?></span>
                    </div>
                    <div class="detail-row">
                        <span>Statut</span>
                        <span class="badge badge-success">Payé</span>
                    </div>
                </div>

                <div class="succes-actions">
                    <a href="index.php?page=cours" class="btn btn-primary">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
        </svg>
        <span>Accéder aux cours</span>
    </a>

    <a href="index.php?page=profil" class="btn btn-profil">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
        </svg>
        <span>Accéder à mon profil</span>
    </a>

    <a href="index.php?page=home" class="btn btn-secondary">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12l9-9 9 9"/>
            <path d="M5 10v10h14V10"/>
        </svg>
        <span>Retour à l'accueil</span>
    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require 'views/partials/footer.php'; ?>
