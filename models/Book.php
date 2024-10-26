<?php

class Book
{
    private int $id;
    private string $title;
    private string $author;
    private string $description;
    private string $image;
    private ?int $userId;
    private ?string $availabilityStatus = null;

    
    public function __construct(int $id, string $title, string $author, string $description, string $availabilityStatus, ?int $userId = null) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->availabilityStatus = $availabilityStatus;
        $this->userId = $userId; // User ID peut être null
    }

    // GETTERS
    public function getId(): int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getAuthor(): string { return $this->author; }
    public function getDescription(): string { return $this->description; }
    public function getImage(): string { return $this->image; }
    public function getUserId(): int { return $this->userId; }
    public function getAvailabilityStatus(): ?string { return $this->availabilityStatus; }

    // SETTERS
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function setAuthor(string $author): self { $this->author = $author; return $this; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function setImage(string $image): self { $this->image = $image; return $this; }
    public function setAvailabilityStatus(string $status): self { $this->availabilityStatus = $status; return $this; }
}
