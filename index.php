<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/autoload.php';


$action = $_GET['action'] ?? 'home';

try {
    switch ($action) {
        case 'home':
            $mainController = new MainController();
            $mainController->showHome();
            break;
        
        case 'books':
            $bookController = new BookController();
            $bookController->showBooks();
            break;  
            
        case 'bookDetails':
            $bookcontroller = new BookController();
            $bookcontroller->showBookDetails();
            break;    
        
        case 'searchBooks':
            $bookcontroller = new BookController();
            $bookcontroller->searchBooks();
            break;
         
        case 'register':
            $userController = new UserController();
            $userController->showRegisterForm();
            break;

        case 'registerUser':
            $userController = new UserController();
            $userController->registerUser();
            break;

        case 'login':
            $userController = new UserController();
            $userController->showLoginForm();
            break;

        case 'loginUser':
            $userController = new UserController();
            $userController->loginUser();
            break;

        case 'logout':
            $userController = new UserController();
            $userController->logoutUser();
            break;

        case 'account':
            $userController = new UserController();
            $userController->showAccount();
            break;
    
        case 'updateUserInfo':
            $userController = new UserController();
            $userController->updateUserInfo();
            break;
    
        case 'updateProfilePicture':
            $userController = new UserController();
            $userController->updateProfilePicture();
            break;    
            
        case 'deleteBook':
            $bookController = new BookController();
            $bookController->deleteBook();
            break;

        case 'editBook':
            $bookController = new BookController();
            $bookId = $_GET['book_id'] ?? 0; 
            $bookController->editBook((int)$bookId);
            break;
    
        case 'updateBookDetails':
            $bookController = new BookController();
            
            $bookId = isset($_POST['book_id']) ? (int)$_POST['book_id'] : null;
        
            if ($bookId !== null) {
                $bookController->updateBookDetails($bookId);
            } else {
                echo "Erreur : aucun ID de livre spécifié pour la mise à jour.";
            }
            break;
        
        case 'updateBookImage':
            $bookController = new BookController();
            
            $bookId = isset($_POST['book_id']) ? (int)$_POST['book_id'] : null;
        
            if ($bookId !== null) {
                $bookController->updateBookImage($bookId);
            } else {
                echo "Erreur : aucun ID de livre spécifié pour la mise à jour.";
            }
            break;

        case 'userBooks':
            $userController = new UserController();
            $userController->showUserBooks();
            break;

        case 'messages':
            $conversationId = $_GET['conversation_id'] ?? 0;
            $messageController = new MessageController();
            $messageController->showMessages($conversationId);
            break;
        
        case 'sendMessage':
            $messageController = new MessageController();
            $messageController->sendMessage();
            break;
        
            
        default:
        // Si aucune route ne correspond
            $mainController = new MainController();
            $mainController->showError(404, "Oops... la page demandée est introuvable.");
            break;
    }
} catch (Exception $e) {
    // http_response_code($e->getCode());
    echo "Erreur : " . $e->getMessage();
}
