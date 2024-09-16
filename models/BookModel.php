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



    public function getBookDetails(int $id): array
    {
        $query = $this->db->prepare("
            SELECT book.*, users.username, users.email, users.profile_picture
            FROM book
            INNER JOIN users ON book.user_id = users.id
            WHERE book.id = :id
        ");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($result === false) {
            return [];
        }
    
        return $result;
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

    public function deleteBook(int $bookId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM book WHERE id = :id");
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateBook(int $bookId, string $title, string $author, string $description, string $availabilityStatus, string $image): bool
    {
        $stmt = $this->db->prepare("
            UPDATE book 
            SET title = :title, author = :author, description = :description, availability_status = :availability_status, image = :image 
            WHERE id = :id
        ");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':availability_status', $availabilityStatus);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);

        return $stmt->execute();
    }

}
