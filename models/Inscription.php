<?php
require_once __DIR__ . '/Database.php';

class Inscription
{
    // Insère une nouvelle inscription
    // Lève une Exception si l'email est déjà inscrit à cette formation
    public static function ajouter(string $nom, string $prenom, string $email, int $age = 0, int $formation_id = 0): int
    {
        $pdo = Database::connect();

        // Vérification doublon
        $check = $pdo->prepare(
            'SELECT id FROM inscriptions WHERE email = ? AND formation_id = ?'
        );
        $check->execute([$email, $formation_id]);
        if ($check->fetch()) {
            throw new Exception('Cet email est déjà inscrit à cette formation.');
        }

        $stmt = $pdo->prepare(
            'INSERT INTO inscriptions (nom, prenom, email, age, formation_id, statut_paiement, date_inscription)
             VALUES (?, ?, ?, ?, ?, "en_attente", NOW())'
        );
        $stmt->execute([$nom, $prenom, $email, $age > 0 ? $age : null, $formation_id]);

        return (int) $pdo->lastInsertId();
    }

    // Retourne une inscription avec les infos de la formation associée
    public static function getById(int $id)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare(
            'SELECT i.*, f.titre AS formation_titre, f.prix, f.duree, f.niveau
             FROM inscriptions i
             JOIN formations f ON i.formation_id = f.id
             WHERE i.id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Retourne toutes les inscriptions d'un email
    public static function getByEmail(string $email): array
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare(
            'SELECT i.*, f.titre AS formation_titre, f.prix, f.niveau
             FROM inscriptions i
             JOIN formations f ON i.formation_id = f.id
             WHERE i.email = ?
             ORDER BY i.date_inscription DESC'
        );
        $stmt->execute([$email]);
        return $stmt->fetchAll();
    }

    // Met à jour le statut de paiement
    public static function marquerPaye(int $id): void
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare(
            'UPDATE inscriptions SET statut_paiement = "paye" WHERE id = ?'
        );
        $stmt->execute([$id]);
    }
}
