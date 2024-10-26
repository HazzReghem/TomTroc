<?php

require_once 'Book.php';

class BookManager
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Récupérer les 4 derniers livres
    public function getLastBooks(int $limit = 4): array
    {
        $stmt = $this->db->prepare("
            SELECT book.*, users.username 
            FROM book
            INNER JOIN users ON book.user_id = users.id
            ORDER BY book.date_creation DESC 
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les livres
    public function getAllBooks(): array
    {
        $stmt = $this->db->prepare("
            SELECT book.*, users.username 
            FROM book
            INNER JOIN users ON book.user_id = users.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Recherche de livres par titre
    public function searchBooks(string $query): array
    {
        $query = "%" . $query . "%";
        $stmt = $this->db->prepare("
            SELECT book.*, users.username 
            FROM book 
            INNER JOIN users ON book.user_id = users.id
            WHERE book.title LIKE :query
        ");
        $stmt->bindValue(':query', $query, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un livre
    public function addBook(Book $book): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO book (title, author, description, image, user_id) 
            VALUES (:title, :author, :description, :image, :user_id)
        ");
        $stmt->bindValue(':title', $book->getTitle());
        $stmt->bindValue(':author', $book->getAuthor());
        $stmt->bindValue(':description', $book->getDescription());
        $stmt->bindValue(':image', $book->getImage());
        $stmt->bindValue(':user_id', $book->getUserId());
        return $stmt->execute();
    }

    // Mise à jour d'un livre
    public function updateBook(Book $book): bool
    {
        $stmt = $this->db->prepare("
            UPDATE book 
            SET title = :title, author = :author, description = :description, availability_status = :status
            WHERE id = :id
        ");
        $stmt->bindValue(':title', $book->getTitle());
        $stmt->bindValue(':author', $book->getAuthor());
        $stmt->bindValue(':description', $book->getDescription());
        $stmt->bindValue(':status', $book->getAvailabilityStatus());
        $stmt->bindValue(':id', $book->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Mise à jour de l'image d'un livre
    public function updateBookImage(int $bookId, string $image): bool
    {
        $stmt = $this->db->prepare("UPDATE book SET image = :image WHERE id = :id");
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un livre
    public function deleteBook(int $bookId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM book WHERE id = :id");
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupérer les détails d'un livre par ID
    public function getBookDetails(int $id): ?Book
    {
        $stmt = $this->db->prepare("
            SELECT book.*, users.username, users.profile_picture
            FROM book
            INNER JOIN users ON book.user_id = users.id
            WHERE book.id = :id
        ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Créez et retournez un objet Book
            return new Book(
                $result['id'],
                $result['title'],
                $result['author'],
                $result['description'],
                $result['image'],
                $result['user_id'], // Assurez-vous que user_id est dans le résultat
                $result['availability_status'] ?? null,
                $result['profile_picture'] ?? null,
                $result['username'] ?? null // Ajoutez cette ligne
            );
        }
        
        return null;
    }
    


    // Récupérer tous les titres de livres
    public function getAllBookTitles(): array
    {
        $stmt = $this->db->prepare("SELECT title FROM book");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
