<?php

class MainController
{
    private $bookModel;

    public function __construct()
    {
        $db = new PDO('mysql:host=localhost;dbname=tom_troc', 'root', '');
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
}
