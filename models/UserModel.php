<?php

class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Enregistrer un nouvel utilisateur
    public function registerUser(string $username, string $email, string $password): bool
    {
        // Vérifier si l'email ou le nom d'utilisateur existe déjà
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            return false;  // L'utilisateur existe déjà
        }

        // Hash du mdp avec Bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }

    // Récupérer un utilisateur par email
    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Récupérer un utilisateur par ID
    public function getUserById(int $userId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Mettre à jour les informations d'un utilisateur
    public function updateUserInfo(int $userId, string $email, string $username): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET email = :email, username = :username WHERE id = :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    // Mettre à jour la photo de profil d'un utilisateur
    public function updateProfilePicture(int $userId, string $profilePicturePath): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET profile_picture = :profile_picture WHERE id = :id");
        $stmt->bindParam(':profile_picture', $profilePicturePath);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
}