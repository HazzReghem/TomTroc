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
        $titles = $this->bookModel->getAllBookTitles();
        $books = $this->bookModel->getAllBooks();

        $view = new View("Nos livres à l'échange");
        $view->render("books", [
            'books' => $books,
            'titles' => $titles,
            'activePage' => 'books'
        ]);
    }

    public function searchBooks() : void
{
    $searchTerm = $_GET['search'] ?? '';

    if (!empty($searchTerm)) {
        // Rechercher les livres qui correspondent au terme de recherche
        $books = $this->bookModel->searchBooks($searchTerm);

        // Si un seul livre correspond, rediriger directement vers la page de détails du livre
        if (count($books) === 1) {
            $bookId = $books[0]['id'];
            header("Location: index.php?action=bookDetails&id=$bookId");
            exit; 
        }
        
        // Si plusieurs livres correspondent, on affiche la liste
        $view = new View("Résultats de la recherche");
        $view->render("books", [
            'books' => $books,
            'activePage' => 'books'
        ]);

    } else {
        // Si la recherche est vide, on retourne une liste vide
        $view = new View("Résultats de la recherche");
        $view->render("books", [
            'books' => [],
            'activePage' => 'books'
        ]);
    }
}


    public function showBookDetails() : void
    {
        // Récupération de l'ID du livre depuis l'URL
        $bookId = $_GET['id'] ?? null;

        // Vérification si un ID a bien été passé
        if ($bookId) {
            // Récupération des détails du livre
            $book = $this->bookModel->getBookDetails((int)$bookId);
            
            if ($book) {
                $view = new View("Détails du livre");
                $view->render("bookDetails", [
                    'book' => $book,
                    'activePage' => ''
                ]);
            } else {
                echo "Livre non trouvé.";
            }
        } else {
            echo "ID de livre manquant.";
        }
    }

}
