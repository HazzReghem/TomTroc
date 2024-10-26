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
    public function getLastBooks(int $limit): array
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

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book(
                $row['id'],
                $row['title'],
                $row['author'],
                $row['description'],
                $row['image'],
                $row['user_id'],
                $row['availability_status'] ?? null,
                $row['profile_picture'] ?? null,
                $row['username'] ?? null 
            );
        }

        return $books;
    }


    // Récupérer tous les livres
    public function getAllBooks(): array
    {
        $stmt = $this->db->query("
            SELECT book.*, users.username, users.profile_picture  
            FROM book 
            INNER JOIN users ON book.user_id = users.id
        ");
        $booksData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];

        foreach ($booksData as $data) {
            // var_dump($data); 
            $books[] = new Book(
                $data['id'],
                $data['title'],
                $data['author'],
                $data['description'],
                $data['image'],
                $data['user_id'],
                $data['availability_status'],
                $data['profile_picture'],
                $data['username'] 
            );
        }

        return $books;
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
            SELECT book.*, users.username, users.email, users.profile_picture
            FROM book
            INNER JOIN users ON book.user_id = users.id
            WHERE book.id = :id
        ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $bookData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($bookData) {
            return new Book(
                $bookData['id'],
                $bookData['title'],
                $bookData['author'],
                $bookData['description'],
                $bookData['image'],
                $bookData['user_id'],
                $bookData['availability_status'],
                $bookData['profile_picture'],
                $bookData['username']
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
