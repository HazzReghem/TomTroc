<?php

class BookModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getLastBooks(int $limit = 4)
    {
        $stmt = $this->db->prepare("SELECT * FROM book ORDER BY date_creation DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
