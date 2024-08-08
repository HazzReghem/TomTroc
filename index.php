<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/autoload.php';
require_once __DIR__ . '/controllers/MainController.php';

$action = $_GET['action'] ?? 'home';

try {
    switch ($action) {
        case 'home':
            $mainController = new MainController();
            $mainController->showHome();
            break;
        default:
        throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    http_response_code($e->getCode());
    echo "Erreur : " . $e->getMessage();
}
