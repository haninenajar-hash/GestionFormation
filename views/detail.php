<?php
$pageTitle = $formation['titre'] ?? 'Détail Formation';

require 'views/partials/header.php';
require 'views/partials/navbar.php';
?>

<!-- Couverture -->
<div class="detail-hero">
    <div 
        class="detail-hero-bg" 
        style="background-image: url('assets/images/<?= htmlspecialchars($formation['image'] ?? 'default.jpg') ?>')">
    </div>

    <div class="detail-hero-overlay"></div>

    <div class="container detail-hero-content">

        <p class="breadcrumb breadcrumb-white">
            <a href="index.php?page=home">Accueil</a> /
            <a href="index.php?page=formations">Formations</a> /
            <?= htmlspecialchars($formation['titre'] ?? '') ?>
        </p>

        <span class="badge badge-white-outline">
            <?= htmlspecialchars($formation['categorie'] ?? '') ?>
        </span>

        <h1><?= htmlspecialchars($formation['titre'] ?? '') ?></h1>

        <div class="detail-hero-meta">

            <span><?= htmlspecialchars($formation['niveau'] ?? '') ?></span>

            <span class="sep">·</span>

            <span><?= htmlspecialchars($formation['duree'] ?? '') ?></span>

            <?php if (!empty($formation['certificat'])): ?>
                <span class="sep">·</span>
                <span>Certificat inclus</span>
            <?php endif; ?>

        </div>

    </div>
</div>

<!-- Corps -->
<div class="container detail-layout">

    <!-- Main -->
    <main class="detail-main">

        <!-- Description -->
        <section class="detail-section">

            <h2>A propos de cette formation</h2>

            <p class="detail-description">
                <?= htmlspecialchars($formation['description'] ?? '') ?>
            </p>

        </section>

        <!-- Objectifs -->
        <?php if (!empty($objectifs)): ?>

        <section class="detail-section">

            <h2>Ce que vous apprendrez</h2>

            <ul class="detail-list detail-list-check">

                <?php foreach ($objectifs as $obj): ?>

                <li>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>

                    <?= htmlspecialchars($obj) ?>
                </li>

                <?php endforeach; ?>

            </ul>

        </section>

        <?php endif; ?>

        <!-- Programme -->
        <?php if (!empty($modules)): ?>

        <section class="detail-section">

            <h2>Programme de la formation</h2>

            <div class="accordion" id="accordion-programme">

                <?php foreach ($modules as $i => $module): ?>

                <div class="accordion-item <?= $i === 0 ? 'open' : '' ?>">

                    <button class="accordion-trigger" type="button">

                        <span class="accordion-num">
                            <?= $i + 1 ?>
                        </span>

                        <span class="accordion-label">
                            <?= htmlspecialchars($module) ?>
                        </span>

                        <svg class="accordion-icon"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">

                            <polyline points="6 9 12 15 18 9"/>
                        </svg>

                    </button>

                    <div class="accordion-panel">

                        <div class="accordion-body">

                            <p>
                                Ce module inclut des leçons théoriques,
                                des exercices pratiques et un mini-projet.
                            </p>

                            <ul class="lesson-list">
                                <li>Introduction et concepts fondamentaux</li>
                                <li>Mise en pratique guidée</li>
                                <li>Exercices et quiz</li>
                                <li>Mini-projet</li>
                            </ul>

                        </div>

                    </div>

                </div>

                <?php endforeach; ?>

            </div>

        </section>

        <?php endif; ?>

        <!-- Technologies -->
        <?php if (!empty($technologies)): ?>

        <section class="detail-section">

            <h2>Technologies et outils</h2>

            <div class="tech-tags tech-tags-lg">

                <?php foreach ($technologies as $tech): ?>

                <span class="tech-tag">
                    <?= htmlspecialchars($tech) ?>
                </span>

                <?php endforeach; ?>

            </div>

        </section>

        <?php endif; ?>

        <!-- Prérequis -->
        <?php if (!empty($prerequis)): ?>

        <section class="detail-section">

            <h2>Prérequis</h2>

            <ul class="detail-list">

                <?php foreach ($prerequis as $pre): ?>

                <li><?= htmlspecialchars($pre) ?></li>

                <?php endforeach; ?>

            </ul>

        </section>

        <?php endif; ?>

        <!-- Instructeur -->
        <?php if (!empty($formation['instructeur'])): ?>

        <section class="detail-section">

            <h2>Votre instructeur</h2>

            <div class="instructor-card">

                <div class="instructor-avatar">
                    <?= strtoupper(substr($formation['instructeur'], 0, 1)) ?>
                </div>

                <div class="instructor-info">

                    <strong>
                        <?= htmlspecialchars($formation['instructeur']) ?>
                    </strong>

                    <p>
                        <?= htmlspecialchars($formation['bio_instr'] ?? '') ?>
                    </p>

                </div>

            </div>

        </section>

        <?php endif; ?>

    </main>

    <!-- Sidebar -->
    <aside class="detail-sidebar">

        <div class="sidebar-sticky-card">

            <!-- Image -->
            <div class="sidebar-image">

                <img
                    src="assets/images/<?= htmlspecialchars($formation['image'] ?? 'default.jpg') ?>"
                    alt="<?= htmlspecialchars($formation['titre'] ?? '') ?>"
                    onerror="this.style.display='none'"
                >

            </div>

            <!-- Card body -->
            <div class="sidebar-card-body">

                <div class="sidebar-prix">
                    <?= number_format($formation['prix'] ?? 0, 0, ',', ' ') ?> DT
                </div>

                <a
                    href="index.php?page=inscription&formation_id=<?= $formation['id'] ?? 0 ?>"
                    class="btn btn-primary btn-full">

                    S'inscrire maintenant

                </a>

                <ul class="sidebar-features">

                    <li>
                        <svg width="15" height="15" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">

                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>

                        </svg>

                        Durée :
                        <?= htmlspecialchars($formation['duree'] ?? '') ?>
                    </li>

                    <li>

                        <svg width="15" height="15" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">

                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"/>

                        </svg>

                        Niveau :
                        <?= htmlspecialchars($formation['niveau'] ?? '') ?>

                    </li>

                    <?php if (!empty($formation['certificat'])): ?>

                    <li>

                        <svg width="15" height="15" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">

                            <circle cx="12" cy="8" r="6"/>
                            <path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>

                        </svg>

                        Certificat de réussite

                    </li>

                    <?php endif; ?>

                    <li>

                        <svg width="15" height="15" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">

                            <polyline points="20 6 9 17 4 12"/>

                        </svg>

                        Accès illimité au contenu

                    </li>

                    <li>

                        <svg width="15" height="15" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">

                            <rect x="2" y="3" width="20" height="14" rx="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>

                        </svg>

                        Accessible sur tous les appareils

                    </li>

                </ul>

            </div>

        </div>

    </aside>

</div>

<?php require 'views/partials/footer.php'; ?>