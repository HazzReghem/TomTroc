<?php

class MessageController {
    private $messageModel;
    private $userModel;

    public function __construct() {
        $db = Database::getConnection();
        $this->messageModel = new MessageModel($db);
        $this->userModel = new UserModel($db);
    }

    public function showMessages($conversationId = null): void
    {
        $userId = $_SESSION['user_id'];

        $currentUser = $this->userModel->getUserById($userId);
        
        // Récupérer les conversations de l'utilisateur
        $conversations = $this->messageModel->getUserConversations($userId);
        
        // Si aucune conversation n'est sélectionnée, prendre la première par défaut
        if (!$conversationId && !empty($conversations)) {
            $conversationId = $conversations[0]['conversation_id'];
        }else {
            echo "Aucune conversation disponible.";
            return; 
        }
        
        // Récupérer les messages de la conversation active
        $messages = $conversationId ? $this->messageModel->getMessages($conversationId) : [];

        $view = new View('Messages');
        $view->render('messages', [
            'conversations' => $conversations,
            'messages' => $messages,
            'activeConversationId' => $conversationId, 
            'currentUser' => $currentUser // Passe l'utilisateur courant à la vue
        ]);
    }


    public function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conversationId = $_POST['conversation_id'];
            $senderId = $_SESSION['user_id'];
            $message = $_POST['message'];

            $this->messageModel->sendMessage($conversationId, $senderId, $message);
            header("Location: index.php?action=showMessages&conversation_id=$conversationId");
        }
    }
}
