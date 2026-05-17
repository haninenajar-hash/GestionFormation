<?php
require_once __DIR__ . '/../models/Inscription.php';
require_once __DIR__ . '/../models/Formation.php';

$erreurs    = [];
$formations = Formation::getAll();

// Pré-sélection depuis l'URL (?formation_id=N)
$formation_preselect = isset($_GET['formation_id']) ? (int) $_GET['formation_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom          = trim($_POST['nom']          ?? '');
    $prenom       = trim($_POST['prenom']       ?? '');
    $email        = trim($_POST['email']        ?? '');
    $age          = (int) ($_POST['age']        ?? 0);
    $formation_id = (int) ($_POST['formation_id'] ?? 0);

    // Validation serveur
    if (empty($nom))                                $erreurs[] = 'Le nom est obligatoire.';
    if (empty($prenom))                             $erreurs[] = 'Le prénom est obligatoire.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erreurs[] = 'Adresse email invalide.';
    if ($age > 0 && ($age < 16 || $age > 75))       $erreurs[] = 'L\'âge doit être compris entre 16 et 75 ans.';
    if ($formation_id <= 0)                         $erreurs[] = 'Veuillez choisir une formation.';

    if (empty($erreurs)) {
        try {
            $id = Inscription::ajouter($nom, $prenom, $email, $age, $formation_id);
            header('Location: index.php?page=paiement&id=' . $id);
            exit();
        } catch (Exception $e) {
            $erreurs[] = $e->getMessage();
        }
    }

    // Conservation des valeurs saisies après erreur
    $old = compact('nom', 'prenom', 'email', 'age', 'formation_id');

} else {
    $old = ['formation_id' => $formation_preselect];
}

require __DIR__ . '/../views/inscription.php';
