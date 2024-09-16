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

        if ($bookId) {
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

    public function deleteBook(): void
    {
        $bookId = isset($_GET['book_id']) ? (int)$_GET['book_id'] : null;

        if ($bookId && $this->bookModel->deleteBook($bookId)) {
            echo "Le livre a été supprimé avec succès.";
            Utils::redirect('account'); 
        } else {
            echo "Erreur lors de la suppression du livre.";
        }
    }

    public function editBook(int $id): void
    {

        var_dump($id);
        $book = $this->bookModel->getBookDetails($id);
    
        if ($book) {
            $view = new View("Modifier le livre");
            $view->render("editBook", ['book' => $book]);
        } else {
            echo "Erreur : Livre non trouvé.";
        }
    }

    public function updateBook(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookId = (int)$_POST['book_id'];
            $title = $_POST['title'];
            $author = $_POST['author'];
            $description = $_POST['description'];
            $availabilityStatus = $_POST['availability_status'];

            $photo = $_FILES['image'];
            $fileName = basename($photo['name']);
            if ($fileName) {
                $targetDir = "./css/assets/";
                $targetFile = $targetDir . uniqid() . "_" . $fileName;
                move_uploaded_file($photo['tmp_name'], $targetFile);
            } else {
                // Si pas de nouvelle photo, conserver l'ancienne
                $targetFile = $_POST['existing_image'];
            }

            if ($this->bookModel->updateBook($bookId, $title, $author, $description, $availabilityStatus, $targetFile)) {
                echo "Le livre a été mis à jour avec succès.";
                Utils::redirect('account');
            } else {
                echo "Erreur lors de la mise à jour du livre.";
            }
        }
    }

}
