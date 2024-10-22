<?php

class MessageController {
    private $messageModel;
    private $userModel;

    public function __construct() {
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $db = new PDO($dsn, $user, $pass);
        $this->messageModel = new MessageModel($db);
        $this->userModel = new UserModel($db);
    }

    public function showMessages($conversationId = null): void
    {
        $userId = $_SESSION['user_id'];
        $otherUserId = $_GET['user_id'] ?? 0; // Récupère l'ID de l'autre utilisateur depuis l'URL

        $currentUser = $this->userModel->getUserById($userId);

        // Si aucun autre utilisateur n'est spécifié, récupère la première conversation par défaut
        if ($otherUserId == 0) {
            $conversations = $this->messageModel->getUserConversations($userId);

            if (!empty($conversations)) {
                // Récupère la première conversation par défaut
                $conversationId = $conversations[0]['conversation_id'];
                $otherUserId = $conversations[0]['participant_id']; // L'autre utilisateur de la première conversation
            } else {
                echo "Aucune conversation disponible.";
                return;
            }
        } else {
            // Récupère l'ID de la conversation entre l'utilisateur connecté et l'autre utilisateur
            $conversation = $this->messageModel->getConversationByUserIds($userId, $otherUserId);
            
            if ($conversation) {
                $conversationId = $conversation['id'];
            } else {
                // Créer une nouvelle conversation
                $conversationId = $this->messageModel->createConversation($userId, $otherUserId);
                if (!$conversationId) {
                    echo "Erreur lors de la création de la conversation.";
                    return;
                }
            }
        }

        // Récupérer les messages de la conversation active
        $messages = $this->messageModel->getMessages($conversationId);

        // Identifier l'autre participant dans la conversation active
        $otherUser = $this->userModel->getUserById($otherUserId); // Récupère les informations de l'autre utilisateur

        $view = new View('Messages');
        $view->render('messages', [
            'conversations' => $this->messageModel->getUserConversations($userId), // Liste des conversations
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

            $this->messageModel->sendMessage($conversationId, $senderId, $message);
            header("Location: index.php?action=messages&conversation_id=$conversationId");
        }
    }
}

