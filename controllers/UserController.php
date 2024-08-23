<?php

class UserController
{
    private $db;

    public function __construct()
    {
        // Connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=tom_troc', 'root', '');
    }

    public function showRegisterForm(): void
    {
        $view = new View("Inscription");
        $view->render("register"); 
    }

    public function registerUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            // $confirmPassword = $_POST['confirm_password'];

            // if ($password !== $confirmPassword) {
            //     echo "Les mots de passe ne correspondent pas.";
            //     return;
            // }

            // Hash du mdp avec Bcrypt
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                Utils::redirect('login');
            } else {
                echo "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
    }

    public function showLoginForm(): void
    {
        $view = new View("Connexion");
        $view->render("login");
    }

    public function loginUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                Utils::redirect('home');
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    }

    public function logoutUser(): void
    {
        session_start();
        session_destroy();
        Utils::redirect('home');
    }
}
