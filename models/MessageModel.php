<?php

class MessageModel 
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserConversations($userId) {
        $stmt = $this->db->prepare("
            SELECT c.id as conversation_id, 
               u.id as participant_id, 
               u.username, 
               m.message, 
               m.sent_at
        FROM conversations c
        JOIN users u ON (c.user1_id = u.id OR c.user2_id = u.id)
        LEFT JOIN messages m ON c.id = m.conversation_id
        WHERE (c.user1_id = :userId OR c.user2_id = :userId)
        AND u.id != :userId
        ORDER BY m.sent_at DESC
        ");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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
