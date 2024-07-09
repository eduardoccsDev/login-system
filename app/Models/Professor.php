<?php

namespace App\Models;

use PDO;
use PDOException;

class Professor {
    private $conn;
    private $table = 'professors';

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
    public function addProfessor($name, $email, $creationDate) {
        $query = "INSERT INTO $this->table (professorName, professorEmail, professorCreationDate) VALUES (:professorName, :professorEmail, :professorCreationDate)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':professorName', $name);
        $stmt->bindParam(':professorEmail', $email);
        $stmt->bindParam(':professorCreationDate', $creationDate);


        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error adding professor: " . $e->getMessage();  // Adicionado para exibir a mensagem de erro
            return false;
        }
    }
}
