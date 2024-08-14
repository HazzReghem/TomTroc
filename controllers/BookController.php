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
        $books = $this->bookModel->getAvailableBooks();
        $view = new View("Nos livres à l'échange");
        $view->render("books", [
            'books' => $books,
            'activePage' => 'books'
        ]);
    }
}
