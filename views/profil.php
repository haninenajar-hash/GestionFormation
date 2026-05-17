<?php
$pageTitle = 'Mon profil';
require 'views/partials/header.php';
require 'views/partials/navbar.php';

// Connecté si paiement_ok (flux normal) OU profil_connecte (recherche email)
$estConnecte = !empty($_SESSION['paiement_ok']) || !empty($_SESSION['profil_connecte']);
$nomEtudiant = $_SESSION['etudiant_nom']   ?? 'Étudiant';
$emailEtudiant = $_SESSION['etudiant_email'] ?? '';
$nbFormations = count($inscriptions);
?>

<div class="page-header">
    <div class="container">
        <p class="breadcrumb"><a href="index.php?page=home">Accueil</a> / Mon profil</p>
        <h1>Mon espace</h1>
        <p>Retrouvez vos inscriptions, votre progression et vos certificats.</p>
    </div>
</div>

<section class="section">
    <div class="container">

        <?php if ($estConnecte): ?>
        <!-- ════════════════════════════════════
             DASHBOARD ÉTUDIANT CONNECTÉ
        ════════════════════════════════════ -->
        <div class="dashboard-layout">

            <!-- Sidebar -->
            <aside class="dashboard-sidebar">
                <div class="profil-card">
                    <div class="profil-avatar">
                        <?= strtoupper(substr($nomEtudiant, 0, 1)) ?>
                    </div>
                    <strong class="profil-name"><?= htmlspecialchars($nomEtudiant) ?></strong>
                    <span class="profil-email"><?= htmlspecialchars($emailEtudiant) ?></span>
                    <div class="profil-stats">
                        <div class="p-stat">
                            <span><?= $nbFormations ?></span>
                            <small>Formation<?= $nbFormations > 1 ? 's' : '' ?></small>
                        </div>
                        <div class="p-stat">
                            <span>
                                <?= count(array_filter($inscriptions, fn($i) => ($i['statut_paiement'] ?? '') === 'paye')) ?>
                            </span>
                            <small>Payée<?= $nbFormations > 1 ? 's' : '' ?></small>
                        </div>
                        <div class="p-stat">
                            <span>0</span>
                            <small>Certificats</small>
                        </div>
                    </div>
                </div>

                <nav class="dashboard-nav">
                    <a href="#section-formations" class="dash-nav-link active">Mes formations</a>
                    <a href="#section-historique" class="dash-nav-link">Historique</a>
                    <?php if (!empty($_SESSION['paiement_ok'])): ?>
                    <a href="index.php?page=cours" class="dash-nav-link">Reprendre les cours</a>
                    <?php endif; ?>
                    <a href="index.php?page=logout" class="dash-nav-link" style="color:#ef4444">
                        Se déconnecter
                    </a>
                </nav>
            </aside>

            <!-- Contenu -->
            <div class="dashboard-content">

                <!-- Section : formations -->
                <div id="section-formations" class="dash-section">
                    <h2>Mes formations (<?= $nbFormations ?>)</h2>

                    <?php if (empty($inscriptions)): ?>
                    <div class="alert alert-info">
                        Aucune formation inscrite pour le moment.
                        <a href="index.php?page=formations">Voir le catalogue →</a>
                    </div>

                    <?php else: ?>
                        <?php foreach ($inscriptions as $ins):
                            $estPayee = ($ins['statut_paiement'] ?? '') === 'paye';
                        ?>
                        <div class="enrolled-card" style="margin-bottom:1rem">
                            <div class="enrolled-info">
                                <span class="badge <?= $estPayee ? 'badge-success' : 'badge-pending' ?>">
                                    <?= $estPayee ? 'Payé' : 'En attente' ?>
                                </span>
                                <h3><?= htmlspecialchars($ins['formation_titre'] ?? '') ?></h3>
                                <p style="font-size:.85rem;color:var(--muted);margin-top:4px">
                                    Inscrit le <?= date('d/m/Y', strtotime($ins['date_inscription'])) ?>
                                    &mdash; Niveau <?= htmlspecialchars($ins['niveau'] ?? '') ?>
                                    &mdash; <strong><?= number_format($ins['prix'] ?? 0, 0, ',', ' ') ?> DT</strong>
                                </p>
                            </div>

                            <?php if ($estPayee): ?>
                            <div class="enrolled-progress">
                                <div class="enrolled-prog-header">
                                    <span>Progression</span>
                                    <strong>25%</strong>
                                </div>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" style="width:25%"></div>
                                </div>
                            </div>
                            <div class="enrolled-actions">
                                <a href="index.php?page=cours" class="btn btn-primary btn-sm">▶ Reprendre</a>
                            </div>
                            <?php else: ?>
                            <div class="enrolled-actions">
                                <a href="index.php?page=paiement&inscription_id=<?= $ins['id'] ?? '' ?>"
                                   class="btn btn-secondary btn-sm">Payer maintenant</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Section : historique -->
                <div id="section-historique" class="dash-section">
                    <h2>Historique des paiements</h2>
                    <?php if (empty($inscriptions)): ?>
                        <p style="color:var(--muted)">Aucun historique disponible.</p>
                    <?php else: ?>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Formation</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inscriptions as $ins):
                                $estPayee = ($ins['statut_paiement'] ?? '') === 'paye';
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($ins['formation_titre'] ?? '') ?></td>
                                <td><?= date('d/m/Y', strtotime($ins['date_inscription'])) ?></td>
                                <td><strong><?= number_format($ins['prix'] ?? 0, 0, ',', ' ') ?> DT</strong></td>
                                <td>
                                    <span class="badge <?= $estPayee ? 'badge-success' : 'badge-pending' ?>">
                                        <?= $estPayee ? 'Payé' : 'En attente' ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <?php else: ?>
        <!-- ════════════════════════════════════
             FORMULAIRE DE RECHERCHE
        ════════════════════════════════════ -->
        <div class="container-sm">
            <div class="form-card">
                <h3>Rechercher mes inscriptions</h3>

                <?php if (!empty($erreur_profil)): ?>
                <div class="alert alert-error"><?= htmlspecialchars($erreur_profil) ?></div>
                <?php endif; ?>

                <form method="POST" action="index.php?page=profil">
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="vous@exemple.com"
                            value="<?= htmlspecialchars($email_recherche ?? '') ?>"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">
                        Rechercher mes inscriptions
                    </button>
                </form>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require 'views/partials/footer.php'; ?>