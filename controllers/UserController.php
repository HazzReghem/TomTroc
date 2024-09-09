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
                $view = new View("Erreur");
                $view->render("error", [
                    'message' => "L'email ou le nom d'utilisateur est déjà utilisé. </br>
                    <a href='index.php?action=register' class='submit'>Retour à la page d'inscription</a>"
                ]);
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
        $userId = $_SESSION['user_id']; 
        $user = $this->userModel->getUserById($userId);
        $userBooks = $this->userModel->getUserBooks($userId); 

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
            $username = $_POST['username'];
            $email = $_POST['email'];
            $newPassword = $_POST['password'];

            // Vérifier si un nouveau mot de passe est fourni
            if (!empty($newPassword)) {
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $this->userModel->updateUserInfo($userId, $email, $username, $hashedPassword);
            } else {
                $this->userModel->updateUserInfo($userId, $email, $username);
            }

            echo "Informations mises à jour avec succès.";
            Utils::redirect('account');
        }
    }

    public function updateProfilePicture(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
            $userId = $_SESSION['user_id'];

            // Traitement du téléchargement du fichier
            $file = $_FILES['profile_picture'];
            $fileName = uniqid() . "_" . basename($file['name']);  // Nom unique
            $targetDir = "./css/user_pic/";
            $targetFile = $targetDir . $fileName;  // Chemin complet pour l'upload

            // Déplacer l'image uploadée vers le répertoire cible
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                // Ne sauvegarder que le nom de fichier dans la base de données
                $this->userModel->updateProfilePicture($userId, $fileName);
            }


            Utils::redirect('account');
        }
    }


}
