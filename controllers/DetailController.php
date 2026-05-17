<?php
require_once __DIR__ . '/../models/Formation.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php?page=formations');
    exit();
}

$formation = Formation::getById($id);

if (!$formation) {
    header('Location: index.php?page=formations');
    exit();
}

$objectifs    = Formation::parseList($formation['objectifs']   ?? '');
$prerequis    = Formation::parseList($formation['prerequis']   ?? '');
$modules      = Formation::parseList($formation['programme']   ?? '');
$technologies = !empty($formation['technologies'])
    ? array_map('trim', explode(',', $formation['technologies']))
    : [];

require __DIR__ . '/../views/detail.php';
