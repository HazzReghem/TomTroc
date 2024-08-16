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
    public function searchBooks(string $searchTerm) : array
    {
        // Requête SQL pour rechercher les livres disponibles avec un titre correspondant au terme de recherche
        $query = $this->db->prepare("SELECT * FROM book WHERE availability_status = 'disponible' AND title LIKE :searchTerm");
        $query->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $query->execute();

        // Renvoyer les résultats sous forme de tableau associatif
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
