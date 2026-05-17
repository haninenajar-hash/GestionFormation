<?php
// Connexion PDO — patron Singleton
// Une seule connexion partagée dans toute l'application

class Database
{
    private static $instance = null;

    private function __construct() {}

    public static function connect(): PDO
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host=localhost;dbname=gestion_formations;charset=utf8mb4',
                    'root',
                    '',
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                    ]
                );
            } catch (PDOException $e) {
                die('<p style="font-family:sans-serif;color:#b91c1c;padding:2rem;">Erreur de connexion : ' . $e->getMessage() . '</p>');
            }
        }

        return self::$instance;
    }
}
