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
        }

        // Si aucune conversation n'existe
        if (!$conversationId) {
            echo "Aucune conversation disponible.";
            return;
        }

        // Récupérer les messages de la conversation active
        $messages = $this->messageModel->getMessages($conversationId);

        // Récupérer les participants de la conversation
        $participants = $this->messageModel->getUserConversations($userId);

        // Identifier l'autre participant
        $otherUser = null;
        foreach ($participants as $participant) {
            if ($participant['participant_id'] !== $userId) {
                $otherUser = $participant;
                break;
            }
        }

        $view = new View('Messages');
        $view->render('messages', [
            'conversations' => $conversations,
            'messages' => $messages,
            'activeConversationId' => $conversationId, 
            'currentUser' => $currentUser,
            'otherUser' => $otherUser  
        ]);
    }

    public function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conversationId = $_POST['conversation_id'];
            $senderId = $_SESSION['user_id'];
            $message = $_POST['message_content'];

            $this->messageModel->sendMessage($conversationId, $senderId, $message);
            header("Location: index.php?action=showMessages&conversation_id=$conversationId");
        }
    }
}

