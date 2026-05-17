<?php
require_once __DIR__ . '/../models/Inscription.php';

$erreur_profil   = '';
$inscriptions    = [];
$email_recherche = '';

// ── Déjà connecté : recharger les inscriptions depuis la session ──
if (!empty($_SESSION['profil_connecte']) && !empty($_SESSION['etudiant_email'])) {
    $inscriptions = Inscription::getByEmail($_SESSION['etudiant_email']);
}

// ── Traitement du formulaire de recherche ──
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_recherche = trim($_POST['email'] ?? '');

    if (!filter_var($email_recherche, FILTER_VALIDATE_EMAIL)) {
        $erreur_profil = 'Veuillez saisir une adresse email valide.';
    } else {
        $result = Inscription::getByEmail($email_recherche);

        if (empty($result)) {
            $erreur_profil = 'Aucune inscription trouvée pour cet email.';
        } else {
            // ✅ Connexion automatique
            $_SESSION['profil_connecte'] = true;
            $_SESSION['etudiant_email']  = $email_recherche;
            $_SESSION['etudiant_nom']    = $result[0]['etudiant_nom'] ?? 'Étudiant';

            // Redirect propre pour éviter re-soumission du formulaire
            header('Location: index.php?page=profil');
            exit;
        }
    }
}

require __DIR__ . '/../views/profil.php';