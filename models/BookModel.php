<?php

class BookModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // RECUPERATION DES 4 DERNIERS LIVRES A AFFICHER 
    public function getLastBooks(int $limit = 4): array
    {
        $query = $this->db->prepare("
            SELECT book.*, users.username 
            FROM book
            INNER JOIN user_books ON book.id = user_books.book_id
            INNER JOIN users ON users.id = user_books.user_id
            ORDER BY book.date_creation DESC 
            LIMIT :limit
        ");
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllBooks() : array
    {
        $query = $this->db->prepare("
            SELECT book.*, users.username 
            FROM book
            INNER JOIN user_books ON book.id = user_books.book_id
            INNER JOIN users ON users.id = user_books.user_id
        ");
        $query->execute();

        // Renvoyer les résultats sous forme de tableau associatif
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // METHODE FORMULAIRE RECHERCHE
    public function searchBooks(string $query) : array
    {
        $query = "%" . $query . "%";
        $stmt = $this->db->prepare("SELECT * FROM book WHERE title LIKE :query OR author LIKE :query");
        $stmt->bindValue(':query', $query, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBookTitles(): array
    {
        $query = $this->db->prepare("SELECT title FROM book WHERE availability_status = 'disponible'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }



    public function getBookDetails(int $id) : array
    {
        $query = $this->db->prepare("SELECT * FROM book WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addBook(string $title, string $description, string $imagePath, int $userId): bool
    {
        $stmt = $this->db->prepare("INSERT INTO book (title, description, image, user_id) VALUES (:title, :description, :image, :user_id)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $imagePath);
        $stmt->bindParam(':user_id', $userId);  // Lier le livre à l'utilisateur
        return $stmt->execute();
    }


}
