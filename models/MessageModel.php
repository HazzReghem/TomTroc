<?php

class MessageModel 
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer les conversations d'un utilisateur
    public function getUserConversations($userId) {
        $stmt = $this->db->prepare("
            SELECT c.id as conversation_id, 
                   u.id as participant_id, 
                   u.username, 
                   u.profile_picture,
                   (SELECT m.message FROM messages m WHERE m.conversation_id = c.id ORDER BY m.sent_at DESC LIMIT 1) as message,
                   (SELECT m.sent_at FROM messages m WHERE m.conversation_id = c.id ORDER BY m.sent_at DESC LIMIT 1) as sent_at
            FROM conversations c
            JOIN users u ON (c.user1_id = u.id OR c.user2_id = u.id)
            WHERE (c.user1_id = :userId OR c.user2_id = :userId)
            AND u.id != :userId
            ORDER BY sent_at DESC
        ");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getOtherUserInConversation($conversationId, $currentUserId) {
        $stmt = $this->db->prepare("
            SELECT u.id as user_id, u.username, u.profile_picture
            FROM users u
            JOIN conversations c ON (c.user1_id = u.id OR c.user2_id = u.id)
            WHERE c.id = :conversationId
            AND u.id != :currentUserId
        ");
        $stmt->bindParam(':conversationId', $conversationId);
        $stmt->bindParam(':currentUserId', $currentUserId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    

    // Récupérer les messages dans une conversation
    public function getMessages($conversationId) {
        $stmt = $this->db->prepare("
            SELECT m.id, m.message, m.sender_id, u.username, m.sent_at
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE m.conversation_id = :conversationId
            ORDER BY m.sent_at ASC
        ");
        $stmt->bindParam(':conversationId', $conversationId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Envoyer un message
    public function sendMessage($conversationId, $senderId, $message) {
        $stmt = $this->db->prepare("
            INSERT INTO messages (conversation_id, sender_id, message)
            VALUES (:conversationId, :senderId, :message)
        ");
        $stmt->bindParam(':conversationId', $conversationId);
        $stmt->bindParam(':senderId', $senderId);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    // Créer une nouvelle conversation
    public function createConversation($user1Id, $user2Id) {
        $stmt = $this->db->prepare("
            INSERT INTO conversations (user1_id, user2_id)
            VALUES (:user1Id, :user2Id)
        ");
        $stmt->bindParam(':user1Id', $user1Id);
        $stmt->bindParam(':user2Id', $user2Id);
        $stmt->execute();
        return $this->db->lastInsertId();
    }
}
