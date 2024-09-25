<?php

class Database {
    private static $db;

    public static function getConnection()
    {
        if (self::$db === null) {
            try {
                self::$db = new PDO('mysql:host=localhost;dbname=tom_troc', 'root', '');
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$db;
    }
}

?>
