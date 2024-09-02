<?php

class UserController
{
    private $db;
    private $userModel;

    public function __construct()
    {
        // Connexion à la base de données
        $this->db = new PDO('mysql:host=localhost;dbname=tom_troc', 'root', '');
        $this->userModel = new UserModel($this->db);
    }

    public function showRegisterForm(): void
    {
        $view = new View("Inscription");
        $view->render("register", [
            'activePage' => 'register'
        ]);
    }

    public function registerUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->registerUser($username, $email, $password)) {
                echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                Utils::redirect('login');
            } else {
                echo "L'email ou le nom d'utilisateur est déjà utilisé ou erreur lors de l'inscription.";
            }
        }
    }

    public function showLoginForm(): void
    {
        $view = new View("Connexion");
        $view->render("login", [
            'activePage' => 'login'
        ]);
    }

    public function loginUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
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

    public function showAccount(): void
    {
        $userId = $_SESSION['user_id'];  // Supposons que l'ID de l'utilisateur est stocké dans la session
        $user = $this->userModel->getUserById($userId);
        $userBooks = $this->getUserBooks($userId);

        $view = new View("Mon compte");
        $view->render("account", [
            'user' => $user,
            'userBooks' => $userBooks,
            'activePage' => 'account'
        ]);
    }

    public function updateUserInfo(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $email = $_POST['email'];
            $username = $_POST['username'];

            if ($this->userModel->updateUserInfo($userId, $email, $username)) {
                Utils::redirect('account');
            } else {
                echo "Erreur lors de la mise à jour des informations.";
            }
        }
    }

    public function updateProfilePicture(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
            $userId = $_SESSION['user_id'];

            // Traitement du téléchargement du fichier
            $file = $_FILES['profile_picture'];
            $fileName = basename($file['name']);
            $targetDir = "uploads/profile_pictures/";
            $targetFile = $targetDir . uniqid() . "_" . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $this->userModel->updateProfilePicture($userId, $targetFile);
            }

            Utils::redirect('account');
        }
    }

    private function getUserBooks(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT book.* 
            FROM book 
            INNER JOIN user_books ON book.id = user_books.book_id 
            WHERE user_books.user_id = :user_id
        ");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
