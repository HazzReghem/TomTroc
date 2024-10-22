<?php

class MainController
{
    private $bookModel;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $db = new PDO($dsn, $user, $pass);
        
        $this->bookModel = new BookModel($db);
    }

    public function showHome() : void
    {
        $lastBooks = $this->bookModel->getLastBooks();
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
