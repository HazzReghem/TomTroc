<?php

class UserController
{
    private $db;
    private $userManager;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->userManager = new UserManager($db);
    }

    public function showRegisterForm(): void
    {
        $view = new View("Inscription");
        $view->render("register", ['activePage' => 'register']);
    }

    public function registerUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userManager->registerUser($username, $email, $password)) {
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
        $view->render("login", ['activePage' => 'login']);
    }

    public function loginUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userManager->getUserByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['email'] = $user->getEmail();
                Utils::redirect('account');
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
        $user = $this->userManager->getUserById($userId);
        $userBooks = $this->userManager->getUserBooks($userId);

        $timeSinceCreation = $this->getTimeSinceCreation($user->getCreatedAt());
        $bookCount = $this->userManager->countUserBooks($userId);

        $view = new View("Mon compte");
        $view->render("account", [
            'user' => $user,
            'userBooks' => $userBooks,
            'timeSinceCreation' => $timeSinceCreation,
            'bookCount' => $bookCount,
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

            if (!empty($newPassword)) {
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $this->userManager->updateUserInfo($userId, $email, $username, $hashedPassword);
            } else {
                $this->userManager->updateUserInfo($userId, $email, $username);
            }

            echo "Informations mises à jour avec succès.";
            Utils::redirect('account');
        }
    }

    public function updateProfilePicture(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
            $userId = $_SESSION['user_id'];

            $file = $_FILES['profile_picture'];
            $fileName = uniqid() . "_" . basename($file['name']);  
            $targetDir = "./css/user_pic/";
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $this->userManager->updateProfilePicture($userId, $fileName);
            }

            Utils::redirect('account');
        }
    }

    public function getTimeSinceCreation(string $createdAt): string
    {
        $createdDate = new DateTime($createdAt);
        $currentDate = new DateTime();
        $interval = $createdDate->diff($currentDate);

        if ($interval->y > 0) return $interval->y . " année" . ($interval->y > 1 ? "s" : "");
        if ($interval->m > 0) return $interval->m . " mois";
        if ($interval->d > 0) return $interval->d . " jour" . ($interval->d > 1 ? "s" : "");
        if ($interval->h > 0) return $interval->h . " heure" . ($interval->h > 1 ? "s" : "");
        if ($interval->i > 0) return $interval->i . " minute" . ($interval->i > 1 ? "s" : "");
        return "moins d'une minute";
    }

    public function showUserBooks(): void
    {
        if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
            $userId = (int)$_GET['user_id'];
        } else {
            echo "Erreur : utilisateur non spécifié.";
            return;
        }

        $user = $this->userManager->getUserById($userId);
        $userBooks = $this->userManager->getUserBooks($userId);

        $timeSinceCreation = $this->getTimeSinceCreation($user->getCreatedAt());
        $bookCount = $this->userManager->countUserBooks($userId);

        $view = new View("Mon compte");
        $view->render("userBooks", [
            'user' => $user,
            'userBooks' => $userBooks,
            'timeSinceCreation' => $timeSinceCreation,
            'bookCount' => $bookCount,
            'activePage' => 'account'
        ]);
    }
}
