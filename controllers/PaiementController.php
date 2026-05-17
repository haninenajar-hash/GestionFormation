<?php
require_once __DIR__ . '/../models/Inscription.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php?page=home');
    exit();
}

$inscription = Inscription::getById($id);

if (!$inscription) {
    header('Location: index.php?page=home');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mode = $_POST['mode'] ?? '';

    if ($mode === 'payer') {
        // Mise à jour en base
        Inscription::marquerPaye($id);

        // Stockage en session
        $_SESSION['paiement_ok']     = true;
        $_SESSION['inscription_id']  = $id;
        $_SESSION['formation_titre'] = $inscription['formation_titre'];
        $_SESSION['etudiant_nom']    = $inscription['prenom'] . ' ' . $inscription['nom'];
        $_SESSION['etudiant_email']  = $inscription['email'];

        header('Location: index.php?page=succes');
        exit();
    }
}

require __DIR__ . '/../views/paiement.php';
