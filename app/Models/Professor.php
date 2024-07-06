<?php

namespace App\Models;

use PDO;
use PDOException;

class Professor {
    private $conn;
    private $table = 'profesors';

    public $professorId;
    public $professorName;
    public $professorEmail;
    public $professorCreationDate;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProfessors() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
