<?php
session_start();

$page = isset($_GET['page'])
    ? preg_replace('/[^a-z0-9_]/', '', $_GET['page'])
    : 'home';


// Protection accès cours
if ($page === 'cours') {

    if (empty($_SESSION['paiement_ok'])) {

        header('Location: index.php?page=home');

        exit();
    }
}


// Protection page succès
if ($page === 'succes') {

    if (empty($_SESSION['inscription_id'])) {

        header('Location: index.php?page=home');

        exit();
    }
}


// ROUTING
switch ($page) {

    case 'formations':

        require_once 'controllers/FormationController.php';

        break;


    case 'detail':

        require_once 'controllers/DetailController.php';

        break;


    case 'inscription':

        require_once 'controllers/InscriptionController.php';

        break;


    case 'paiement':

        require_once 'controllers/PaiementController.php';

        break;


    case 'cours':

        require_once 'views/cours.php';

        break;


    case 'succes':

        require_once 'views/succes.php';

        break;


    case 'profil':

        require_once 'controllers/ProfilController.php';

        break;


    case 'logout':

        require_once 'controllers/LogoutController.php';

        $controller = new LogoutController();

        $controller->logout();

        break;


    case 'home':

    default:

        require_once 'views/home.php';

        break;
}