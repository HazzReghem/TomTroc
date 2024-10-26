<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $createdAt;
    private $profilePicture;

    public function __construct(int $id, string $username, string $email, string $password, ?string $createdAt, ?string $profilePicture = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->profilePicture = $profilePicture;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getCreatedAt(): ?string { return $this->createdAt; }
    public function getProfilePicture(): ?string { return $this->profilePicture; }

    public function setUsername(string $username): void { $this->username = $username; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setProfilePicture(?string $profilePicture): void { $this->profilePicture = $profilePicture; }
}
