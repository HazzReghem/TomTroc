<?php

class BookController
{
    private $bookManager;

    public function __construct()
    {
        $db = Database::getInstance(); // Utilisation du Singleton

        $this->bookManager = new BookManager($db);
    }

    public function showBooks(): void
    {
        $titles = $this->bookManager->getAllBookTitles();
        $books = $this->bookManager->getAllBooks();

        $view = new View("Nos livres à l'échange");
        $view->render("books", [
            'books' => $books,
            'titles' => $titles,
            'activePage' => 'books'
        ]);
    }

    public function searchBooks(): void
    {
        $searchTerm = $_GET['search'] ?? '';

        if (!empty($searchTerm)) {
            $books = $this->bookManager->searchBooks($searchTerm);

            if (count($books) === 1) {
                $bookId = $books[0]['id'];
                header("Location: index.php?action=bookDetails&id=$bookId");
                exit;
            }

            $view = new View("Résultats de la recherche");
            $view->render("books", [
                'books' => $books,
                'activePage' => 'books'
            ]);
        } else {
            $view = new View("Résultats de la recherche");
            $view->render("books", [
                'books' => [],
                'activePage' => 'books'
            ]);
        }
    }

    public function showBookDetails(): void
    {
        $bookId = $_GET['id'] ?? null;

        if ($bookId) {
            $book = $this->bookManager->getBookDetails((int)$bookId);

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

        if ($bookId && $this->bookManager->deleteBook($bookId)) {
            echo "Le livre a été supprimé avec succès.";
            Utils::redirect('account');
        } else {
            echo "Erreur lors de la suppression du livre.";
        }
    }

    public function editBook(int $id): void
    {
        $book = $this->bookManager->getBookDetails($id);

        if ($book) {
            $view = new View("Modifier le livre");
            $view->render("editBook", [
                'book' => $book,
                'activePage' => 'account'
            ]);
        } else {
            echo "Erreur : Livre non trouvé.";
        }
    }

    public function updateBookDetails(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookId = (int)$_POST['book_id'];
            $title = $_POST['title'];
            $author = $_POST['author'];
            $description = $_POST['description'];
            $availabilityStatus = $_POST['availability_status'];

            if ($this->bookManager->updateBook(new Book($bookId, $title, $author, $description, $availabilityStatus))) {
                echo "Les détails du livre ont été mis à jour avec succès.";
                Utils::redirect('account');
            } else {
                echo "Erreur lors de la mise à jour des détails du livre.";
            }
        }
    }

    public function updateBookImage(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookId = (int)$_POST['book_id'];
            $photo = $_FILES['book_picture'];
            $fileName = uniqid() . "_" . basename($photo['name']);
            $targetDir = "./css/assets/";
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
                $this->bookManager->updateBookImage($bookId, $fileName);
            }

            Utils::redirect('account');
        }
    }
}
