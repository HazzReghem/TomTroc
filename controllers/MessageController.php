<?php

class MessageController {
    private $messageManager; 
    private $userManager; 

    public function __construct() {
        $db = Database::getInstance();
        $this->messageManager = new MessageManager($db); 
        $this->userManager = new UserManager($db); 
    }

    public function showMessages($conversationId = null): void
    {
        $userId = $_SESSION['user_id'];
        $otherUserId = $_GET['user_id'] ?? 0;

        $currentUser = $this->userManager->getUserById($userId);

        if ($otherUserId == 0) {
            $conversations = $this->messageManager->getUserConversations($userId);

            if (!empty($conversations)) {
                // Récupère la première conversation par défaut
                $conversationId = $conversations[0]['conversation_id'];
                $otherUserId = $conversations[0]['participant_id']; 
            } else {
                echo "Aucune conversation disponible.";
                return;
            }
        } else {
            $conversation = $this->messageManager->getConversationByUserIds($userId, $otherUserId);
            
            if ($conversation) {
                $conversationId = $conversation['id'];
            } else {
                $conversationId = $this->messageManager->createConversation($userId, $otherUserId);
                if (!$conversationId) {
                    echo "Erreur lors de la création de la conversation.";
                    return;
                }
            }
        }

        $messages = $this->messageManager->getMessages($conversationId);

        $otherUser = $this->userManager->getUserById($otherUserId); 

        $userConversations = $this->messageManager->getUserConversations($userId);

        $view = new View('Messages');
        $view->render('messages', [
            'conversations' => $userConversations,
            'messages' => $messages,
            'activeConversationId' => $conversationId,
            'currentUser' => $currentUser,
            'otherUser' => $otherUser,
            'activePage' => 'messages'
        ]);
    }



    public function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conversationId = $_POST['conversation_id'];
            $senderId = $_SESSION['user_id'];
            $message = $_POST['message_content'];

            $this->messageManager->sendMessage($conversationId, $senderId, $message);
            header("Location: index.php?action=messages&conversation_id=$conversationId");
        }
    }
}
