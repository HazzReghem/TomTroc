<?php

class BookModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // RECUPERATION DES 4 DERNIERS LIVRES A AFFICHER 
    public function getLastBooks(int $limit = 4)
    {
        $query = $this->db->prepare("SELECT * FROM book ORDER BY date_creation DESC LIMIT :limit");
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAvailableBooks() : array
    {
        // Requête SQL pour récupérer les livres disponibles à l'échange
        $query = $this->db->prepare("SELECT * FROM book WHERE availability_status = 'disponible'");
        $query->execute();

        // Renvoyer les résultats sous forme de tableau associatif
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // METHODE FORMULAIRE RECHERCHE
    public function searchBooks(string $query) : array
    {
        $query = "%" . $query . "%";
        $stmt = $this->db->prepare("SELECT * FROM book WHERE title LIKE :query OR author LIKE :query");
        $stmt->bindValue(':query', $query, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBookTitles(): array
    {
        $query = $this->db->prepare("SELECT title FROM book WHERE availability_status = 'disponible'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }



    public function getBookDetails(int $id) : array
    {
        // Requête SQL pour récupérer les détails du livre par son ID
        $query = $this->db->prepare("SELECT * FROM book WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        // Retourner le résultat sous forme de tableau associatif
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}
