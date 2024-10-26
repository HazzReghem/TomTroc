<?php

class MainController
{
    private $bookManager;

    public function __construct()
    {
        $db = Database::getInstance(); // Utilisation du Singleton

        $this->bookManager = new BookManager($db);
    }

    public function showHome(): void
    {
        $lastBooks = $this->bookManager->getLastBooks(4);
        $view = new View("Accueil");
        $view->render("home", [
            'lastBooks' => $lastBooks,
            'activePage' => 'home'
        ]);
    }

    public function showError($errorCode = 404, $errorMessage = null): void
    {
        $view = new View('Erreur');
        $view->render('error', [
            'errorCode' => $errorCode,
            'errorMessage' => $errorMessage ?? 'La page que vous recherchez est introuvable.'
        ]);
    }
}
