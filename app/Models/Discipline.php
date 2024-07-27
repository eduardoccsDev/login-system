<?php

namespace App\Models;

use PDO;
use PDOException;

class Discipline {
    private $conn;
    private $table = 'discipline';

    public $disciplineId;
    public $disciplineName;
    public $disciplineDescription;
    public $disciplineCreationDate;
    public $disciplineStatus;
    public $disciplineModality;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllDiscipline() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function addDiscipline($name, $description, $creationDate, $modality) {
        $query = "INSERT INTO $this->table (disciplineName, disciplineDescription, disciplineCreationDate, disciplineModality) VALUES (:disciplineName, :disciplineDescription, :disciplineCreationDate, :disciplineModality)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':disciplineName', $name);
        $stmt->bindParam(':disciplineDescription', $description);
        $stmt->bindParam(':disciplineCreationDate', $creationDate);
        $stmt->bindParam(':disciplineModality', $modality);


        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error adding discipline: " . $e->getMessage();  // Adicionado para exibir a mensagem de erro
            return false;
        }
    }
    public function deleteDiscipline($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE disciplineId = :disciplineId';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':disciplineId', $id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting discipline: " . $e->getMessage();
            return false;
        }
    }
}
