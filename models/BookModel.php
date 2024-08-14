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
}
