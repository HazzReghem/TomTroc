<?php

class BookController
{
    private $bookModel;

    public function __construct()
    {
        $db = new PDO('mysql:host=localhost;dbname=tom_troc', 'root', '');
        $this->bookModel = new BookModel($db);
    }

    public function showBooks() : void
    {
        // Récupération du terme de recherche depuis l'URL
        $searchTerm = $_GET['search'] ?? '';

        // Si un terme de recherche est présent, effectuer une recherche
        if (!empty($searchTerm)) {
            $books = $this->bookModel->searchBooks($searchTerm);
        } else {
            $books = $this->bookModel->getAvailableBooks();
        }

        $books = $this->bookModel->getAvailableBooks();
        $view = new View("Nos livres à l'échange");
        $view->render("books", [
            'books' => $books,
            'activePage' => 'books'
        ]);
    }
}
