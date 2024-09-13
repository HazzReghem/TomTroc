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
            INNER JOIN users ON book.user_id = users.id
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
            INNER JOIN users ON book.user_id = users.id
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
        $query = $this->db->prepare("
        SELECT book.*, users.username, users.email, users.profile_picture
        FROM book
        INNER JOIN users ON book.user_id = users.id
        WHERE book.id = :id
        ");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addBook(string $title, string $description, string $imagePath, int $userId): bool
    {
        $stmt = $this->db->prepare("INSERT INTO book (title, author, description, image, user_id) VALUES (:title, :author, :description, :image, :user_id)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $imagePath);
        $stmt->bindParam(':user_id', $userId); 
        return $stmt->execute();
    }


}
