<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        $this->pdo = new PDO($dsn, $user, $pass);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo; 
    }



    private function __clone() {}
    public function __wakeup() {}
}
