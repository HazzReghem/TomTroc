<?php

class UserManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function registerUser(string $username, string $email, string $password): bool
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }

    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new User($data['id'], $data['username'], $data['email'], $data['password'], $data['profile_picture']) : null;
    }

    public function getUserById(int $userId): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
            return new User(
                $data['id'],
                $data['username'],
                $data['email'],
                $data['password'],
                $data['created_at'],
                $data['profile_picture']
            );
        }
        
        return null;  
    }

    public function updateUserInfo(int $userId, string $email, string $username, ?string $newPassword = null): bool
    {
        if ($newPassword !== null) {
            $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE users SET email = :email, username = :username, password = :newPassword WHERE id = :id");
            $stmt->bindParam(':newPassword', $newPassword);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET email = :email, username = :username WHERE id = :id");
        }

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function updateProfilePicture(int $userId, string $profilePicturePath): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET profile_picture = :profile_picture WHERE id = :id");
        $stmt->bindParam(':profile_picture', $profilePicturePath);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function getUserBooks(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT book.*, users.username, users.profile_picture
            FROM book
            LEFT JOIN users ON book.user_id = users.id
            WHERE book.user_id = :user_id
        ");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $booksData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];

        foreach ($booksData as $data) {
            $books[] = new Book(
                $data['id'],
                $data['title'],
                $data['author'],
                $data['description'],
                $data['image'],
                $data['user_id'],
                $data['availability_status'], // Assurez-vous que cette colonne existe
                $data['profile_picture'],
                $data['username']
            );
        }

        return $books;
    }



    public function addBookToUser(int $userId, int $bookId): bool
    {
        $stmt = $this->db->prepare("UPDATE book SET user_id = :user_id WHERE id = :book_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':book_id', $bookId);
        return $stmt->execute();
    }

    public function countUserBooks(int $userId): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as book_count FROM book WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['book_count'];
    }
}
