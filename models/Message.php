<?php

class Message 
{
    private int $id;
    private int $conversationId;
    private int $senderId;
    private string $content;
    private string $sentAt;

    public function __construct(int $id, int $conversationId, int $senderId, string $content, string $sentAt) {
        $this->id = $id;
        $this->conversationId = $conversationId;
        $this->senderId = $senderId;
        $this->content = $content;
        $this->sentAt = $sentAt;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getConversationId(): int {
        return $this->conversationId;
    }

    public function getSenderId(): int {
        return $this->senderId;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getSentAt(): string {
        return $this->sentAt;
    }
}
