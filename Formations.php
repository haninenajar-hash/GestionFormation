<?php
$formations = ["Développement Web", "Réseaux", "Sécurité", "Base de données"];

foreach ($formations as $formation) {
    echo $formation . "<br>";
}

echo "<hr>";

$utilisateur = [
    "nom" => "Najar",
    "prenom" => "Hanine",
    "email" => "hanine.najar@edu.isetcom.tn",
    "formation" => "Développement Web"
];

echo "Nom : " . $utilisateur["nom"] . "<br>";
echo "Prénom : " . $utilisateur["prenom"] . "<br>";
echo "Email : " . $utilisateur["email"] . "<br>";
echo "Formation : " . $utilisateur["formation"] . "<br>";
?>