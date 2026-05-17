<?php
require_once __DIR__ . '/Database.php';

class Formation
{
    public static function getAll()
    {
        $pdo  = Database::connect();
        $stmt = $pdo->query('SELECT * FROM formations ORDER BY id ASC');
        return $stmt->fetchAll();
    }

    public static function getById(int $id)
    {
        $pdo  = Database::connect();
        $stmt = $pdo->prepare('SELECT * FROM formations WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Retourne les objectifs sous forme de tableau
    public static function parseList(string $str): array
    {
        if (empty(trim($str))) return [];
        return array_filter(array_map('trim', explode('|', $str)));
    }
}
