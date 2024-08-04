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
    public $disciplinePeriod;
    public $courseId;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllDiscipline() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function addDiscipline($name, $description, $creationDate, $modality, $period) {
        $query = "INSERT INTO $this->table (disciplineName, disciplineDescription, disciplineCreationDate, disciplineModality, disciplinePeriod) VALUES (:disciplineName, :disciplineDescription, :disciplineCreationDate, :disciplineModality, :disciplinePeriod)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':disciplineName', $name);
        $stmt->bindParam(':disciplineDescription', $description);
        $stmt->bindParam(':disciplineCreationDate', $creationDate);
        $stmt->bindParam(':disciplineModality', $modality);
        $stmt->bindParam(':disciplinePeriod', $period);


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
    public function addDisciplineToCourse($disciplineId, $courseId) {
        $query = "INSERT INTO disciplineToCourse (disciplineId, courseId, disciplineToCourseCreationData) VALUES (:disciplineId, :courseId, NOW())";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':disciplineId', $disciplineId);
        $stmt->bindParam(':courseId', $courseId);
    
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error adding discipline to course: " . $e->getMessage();
            return false;
        }
    }
    
}
