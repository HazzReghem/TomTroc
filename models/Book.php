<?php

class Book
{
    private int $id;
    private string $title;
    private string $author;
    private string $description;
    private string $image;
    private ?int $userId;
    private ?string $availabilityStatus;
    private ?string $profilePicture;
    private ?string $username; 

    public function __construct(int $id, string $title, string $author, string $description, string $image, ?int $userId = null, ?string $availabilityStatus = null, ?string $profilePicture = null, ?string $username = null) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->image = $image;
        $this->userId = $userId;
        $this->availabilityStatus = $availabilityStatus;
        $this->profilePicture = $profilePicture;
        $this->username = $username; 
    }

    // GETTERS
    public function getId(): int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getAuthor(): string { return $this->author; }
    public function getDescription(): string { return $this->description; }
    public function getImage(): string { return $this->image; }
    public function getUserId(): ?int { return $this->userId; }
    public function getAvailabilityStatus(): ?string { return $this->availabilityStatus; }
    public function getProfilePicture(): ?string { return $this->profilePicture; }
    public function getUsername(): ?string { return $this->username; } 



    // SETTERS
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function setAuthor(string $author): self { $this->author = $author; return $this; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function setImage(string $image): self { $this->image = $image; return $this; }
    public function setAvailabilityStatus(string $status): self { $this->availabilityStatus = $status; return $this; }
}
