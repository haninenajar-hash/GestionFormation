<?php
$pageTitle = 'Mes cours';
require 'views/partials/header.php';

$formation    = $_SESSION['formation_titre'] ?? 'Ma formation';
$etudiant     = $_SESSION['etudiant_nom']    ?? '';

$chapitres = [
    [
        'titre'    => 'Introduction et mise en place',
        'duree'    => '1h 20min',
        'statut'   => 'termine',
        'lecons'   => [
            ['titre' => 'Présentation du programme',  'duree' => '12min', 'type' => 'video',  'fait' => true],
            ['titre' => 'Installation des outils',    'duree' => '18min', 'type' => 'video',  'fait' => true],
            ['titre' => 'Premiers pas pratiques',     'duree' => '25min', 'type' => 'video',  'fait' => true],
            ['titre' => 'Support PDF du chapitre 1',  'duree' => '',      'type' => 'pdf',    'fait' => true],
        ],
    ],
    [
        'titre'    => 'Les fondamentaux',
        'duree'    => '2h 45min',
        'statut'   => 'en_cours',
        'lecons'   => [
            ['titre' => 'Concepts théoriques essentiels', 'duree' => '30min', 'type' => 'video',  'fait' => true],
            ['titre' => 'Exercices pratiques guidés',     'duree' => '40min', 'type' => 'video',  'fait' => false],
            ['titre' => 'Quiz de validation',             'duree' => '10min', 'type' => 'quiz',   'fait' => false],
            ['titre' => 'Ressources complémentaires',     'duree' => '',      'type' => 'pdf',    'fait' => false],
        ],
    ],
    [
        'titre'    => 'Approfondissement',
        'duree'    => '3h 10min',
        'statut'   => 'verrouille',
        'lecons'   => [
            ['titre' => 'Techniques avancées',   'duree' => '45min', 'type' => 'video', 'fait' => false],
            ['titre' => 'Cas réels commentés',   'duree' => '35min', 'type' => 'video', 'fait' => false],
            ['titre' => 'Travaux dirigés',       'duree' => '50min', 'type' => 'video', 'fait' => false],
            ['titre' => 'Quiz d\'évaluation',    'duree' => '15min', 'type' => 'quiz',  'fait' => false],
        ],
    ],
    [
        'titre'    => 'Projet final',
        'duree'    => '4h 00min',
        'statut'   => 'verrouille',
        'lecons'   => [
            ['titre' => 'Cahier des charges',  'duree' => '20min', 'type' => 'video', 'fait' => false],
            ['titre' => 'Développement guidé', 'duree' => '120min','type' => 'video', 'fait' => false],
            ['titre' => 'Revue de code',       'duree' => '30min', 'type' => 'video', 'fait' => false],
            ['titre' => 'Soutenance finale',   'duree' => '30min', 'type' => 'video', 'fait' => false],
        ],
    ],
];

$total_lecons   = 0;
$lecons_faites  = 0;
foreach ($chapitres as $ch) {
    foreach ($ch['lecons'] as $l) {
        $total_lecons++;
        if ($l['fait']) $lecons_faites++;
    }
}
$progression = $total_lecons > 0 ? round(($lecons_faites / $total_lecons) * 100) : 0;
?>

<div class="elearning-layout">

    <!-- Sidebar cours -->
    <aside class="elearning-sidebar" id="elearning-sidebar">
        <div class="esb-header">
            <a href="index.php?page=home" class="nav-logo">
                <span class="logo-mark">L</span>
                <span class="logo-text">LearnNOW</span>
            </a>
            <button class="esb-close" id="esb-close" aria-label="Fermer">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="esb-formation">
            <p class="esb-label">Formation en cours</p>
            <strong><?= htmlspecialchars($formation) ?></strong>
        </div>

        <div class="esb-progression">
            <div class="esb-prog-header">
                <span>Progression</span>
                <span><?= $progression ?>%</span>
            </div>
            <div class="progress-bar-wrap">
                <div class="progress-bar" style="width: <?= $progression ?>%"></div>
            </div>
            <span class="progress-label"><?= $lecons_faites ?> / <?= $total_lecons ?> leçons</span>
        </div>

        <nav class="esb-nav">
            <?php foreach ($chapitres as $ci => $ch): ?>
            <div class="esb-chapter <?= $ch['statut'] ?>" id="chapter-<?= $ci ?>">
                <button class="esb-chapter-btn" onclick="toggleChapter(<?= $ci ?>)">
                    <div class="esb-chapter-left">
                        <?php if ($ch['statut'] === 'termine'): ?>
                            <span class="ch-dot ch-done"></span>
                        <?php elseif ($ch['statut'] === 'en_cours'): ?>
                            <span class="ch-dot ch-current"></span>
                        <?php else: ?>
                            <span class="ch-dot ch-locked"></span>
                        <?php endif; ?>
                        <span class="esb-chapter-title"><?= htmlspecialchars($ch['titre']) ?></span>
                    </div>
                    <svg class="esb-arrow" id="arrow-<?= $ci ?>" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <ul class="esb-lessons" id="lessons-<?= $ci ?>" style="<?= ($ch['statut'] !== 'verrouille') ? '' : 'display:none' ?>">
                    <?php foreach ($ch['lecons'] as $li => $lecon): ?>
                    <li class="esb-lesson <?= $lecon['fait'] ? 'done' : '' ?> <?= ($ch['statut'] === 'en_cours' && !$lecon['fait'] && $li === 1) ? 'current-lesson' : '' ?>">
                        <span class="lesson-icon">
                            <?php if ($lecon['type'] === 'pdf'): ?>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            <?php elseif ($lecon['type'] === 'quiz'): ?>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            <?php else: ?>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                            <?php endif; ?>
                        </span>
                        <span class="lesson-title"><?= htmlspecialchars($lecon['titre']) ?></span>
                        <?php if ($lecon['duree']): ?>
                        <span class="lesson-duree"><?= $lecon['duree'] ?></span>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </nav>
    </aside>

    <!-- Zone principale -->
    <main class="elearning-main">

        <!-- Topbar -->
        <div class="elearning-topbar">
            <button class="topbar-menu-btn" id="topbar-menu-btn" aria-label="Menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
            <span class="topbar-title"><?= htmlspecialchars($formation) ?></span>
            <div class="topbar-right">
                <div class="topbar-progress">
                    <div class="progress-bar-wrap topbar-bar">
                        <div class="progress-bar" style="width: <?= $progression ?>%"></div>
                    </div>
                    <span><?= $progression ?>% terminé</span>
                </div>
                <a href="index.php?page=profil" class="btn btn-secondary btn-sm">Mon profil</a>
            </div>
        </div>

        <!-- Lecteur vidéo -->
        <div class="video-player">
            <div class="video-placeholder">
                <button class="video-play-btn" aria-label="Lire la vidéo">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                </button>
                <div class="video-info">
                    <span class="video-chapter-label">Chapitre 2 — Les fondamentaux</span>
                    <h3>Concepts théoriques essentiels</h3>
                    <span class="video-duration">30 min</span>
                </div>
            </div>
        </div>

        <!-- Tabs contenu -->
        <div class="cours-content-area">
            <div class="cours-tabs-nav">
                <button class="cours-tab active" data-tab="contenu">Contenu</button>
                <button class="cours-tab" data-tab="ressources">Ressources</button>
                <button class="cours-tab" data-tab="quiz">Quiz</button>
                <button class="cours-tab" data-tab="certificat">Certificat</button>
            </div>

            <!-- Tab : contenu -->
            <div class="cours-tab-panel active" id="tab-contenu">
                <h3>A propos de cette leçon</h3>
                <p>Dans ce module, vous apprendrez les concepts fondamentaux indispensables à la suite de la formation. Chaque notion est illustrée par des exemples concrets tirés de projets réels.</p>
                <h4>Points clés</h4>
                <ul class="key-points">
                    <li>Compréhension des bases théoriques</li>
                    <li>Application sur des exemples réels</li>
                    <li>Bonnes pratiques professionnelles</li>
                    <li>Exercices de consolidation</li>
                </ul>
                <div class="lesson-nav">
                    <button class="btn btn-secondary" disabled>Leçon précédente</button>
                    <button class="btn btn-primary">Marquer comme terminé</button>
                    <button class="btn btn-secondary">Leçon suivante</button>
                </div>
            </div>

            <!-- Tab : ressources -->
            <div class="cours-tab-panel" id="tab-ressources">
                <h3>Ressources du module</h3>
                <div class="resources-list">
                    <div class="resource-item">
                        <div class="resource-icon icon-pdf">PDF</div>
                        <div class="resource-info">
                            <strong>Support de cours — Chapitre 2</strong>
                            <span>PDF · 1.8 Mo</span>
                        </div>
                        <button class="btn btn-secondary btn-sm">Télécharger</button>
                    </div>
                    <div class="resource-item">
                        <div class="resource-icon icon-zip">ZIP</div>
                        <div class="resource-info">
                            <strong>Exercices corrigés</strong>
                            <span>ZIP · 940 Ko</span>
                        </div>
                        <button class="btn btn-secondary btn-sm">Télécharger</button>
                    </div>
                    <div class="resource-item">
                        <div class="resource-icon icon-lien">URL</div>
                        <div class="resource-info">
                            <strong>Documentation officielle</strong>
                            <span>Lien externe</span>
                        </div>
                        <button class="btn btn-secondary btn-sm">Ouvrir</button>
                    </div>
                </div>
            </div>

            <!-- Tab : quiz -->
            <div class="cours-tab-panel" id="tab-quiz">
                <h3>Quiz de validation</h3>
                <p class="quiz-intro">Répondez aux questions suivantes pour valider vos acquis du module.</p>
                <form id="quiz-form" class="quiz-form">
                    <div class="quiz-question">
                        <p class="q-text"><strong>Question 1 :</strong> Quelle est la principale fonction de ce module ?</p>
                        <label class="quiz-option"><input type="radio" name="q1" value="a"> Apprendre les bases de la théorie</label>
                        <label class="quiz-option"><input type="radio" name="q1" value="b"> Déployer une application</label>
                        <label class="quiz-option"><input type="radio" name="q1" value="c"> Créer une base de données</label>
                    </div>
                    <div class="quiz-question">
                        <p class="q-text"><strong>Question 2 :</strong> Combien de leçons contient ce chapitre ?</p>
                        <label class="quiz-option"><input type="radio" name="q2" value="a"> 2 leçons</label>
                        <label class="quiz-option"><input type="radio" name="q2" value="b"> 4 leçons</label>
                        <label class="quiz-option"><input type="radio" name="q2" value="c"> 6 leçons</label>
                    </div>
                    <div class="quiz-question">
                        <p class="q-text"><strong>Question 3 :</strong> Quelle ressource est disponible dans ce module ?</p>
                        <label class="quiz-option"><input type="radio" name="q3" value="a"> Un support PDF</label>
                        <label class="quiz-option"><input type="radio" name="q3" value="b"> Une vidéo bonus</label>
                        <label class="quiz-option"><input type="radio" name="q3" value="c"> Un examen oral</label>
                    </div>
                    <div id="quiz-result"></div>
                    <button type="button" class="btn btn-primary" onclick="submitQuiz()">Valider le quiz</button>
                </form>
            </div>

            <!-- Tab : certificat -->
            <div class="cours-tab-panel" id="tab-certificat">
                <div class="certificat-area">
                    <?php if ($progression >= 100): ?>
                        <div class="cert-card">
                            <div class="cert-header">
                                <span class="cert-brand">LearnNOW</span>
                                <span class="cert-sub">Certificat de réussite</span>
                            </div>
                            <div class="cert-body">
                                <p>Ce certificat atteste que</p>
                                <h2><?= htmlspecialchars($etudiant) ?></h2>
                                <p>a complété avec succès la formation</p>
                                <h3><?= htmlspecialchars($formation) ?></h3>
                            </div>
                            <div class="cert-footer">
                                <div class="cert-sign">
                                    <div class="cert-sign-line"></div>
                                    <span>Directeur pédagogique</span>
                                </div>
                                <div class="cert-seal">L</div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Télécharger le certificat</button>
                    <?php else: ?>
                        <div class="cert-locked">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <h3>Certificat non disponible</h3>
                            <p>Terminez l'ensemble des modules pour débloquer votre certificat de réussite.</p>
                            <div class="cert-prog">
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" style="width: <?= $progression ?>%"></div>
                                </div>
                                <span><?= $progression ?>% terminé — encore <?= 100 - $progression ?>% à compléter</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>
</div>

<?php require 'views/partials/footer.php'; ?>
