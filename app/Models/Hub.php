<?php

namespace App\Models;

use PDO;
use PDOException;

class Hub {
    private $conn;
    private $table = 'hubs';

    public $hubId;
    public $hubName;
    public $hubCreationDate;
    public $hubStatus;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllHubs() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function addHub($name, $creationDate) {
        $query = "INSERT INTO $this->table (hubName, hubCreationDate) VALUES (:hubName, :hubCreationDate)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':hubName', $name);
        $stmt->bindParam(':hubCreationDate', $creationDate);


        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error adding hub: " . $e->getMessage();  // Adicionado para exibir a mensagem de erro
            return false;
        }
    }
    public function deleteHub($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE hubId = :hubId';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hubId', $id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting hub: " . $e->getMessage();
            return false;
        }
    }
    public function getCourseByHubId($hubId) {
        $query = "SELECT CTH.*,CS.courseName, CS.courseDescription, CS.courseType
                    FROM courseToHub CTH 
                    LEFT JOIN courses CS 
                    ON CS.courseId = CTH.courseId
                    WHERE 
                    CTH.hubId =:hubId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hubId', $hubId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCountCourse($hubId) {
        $query = "SELECT 
                    COUNT(CS.courseId) AS totalCourses
                  FROM 
                    courseToHub CTH
                  LEFT JOIN 
                    courses CS ON CS.courseId = CTH.courseId
                  WHERE 
                    CTH.hubId = :hubId;";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hubId', $hubId, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['totalCourses']; // Retorna apenas a contagem
    }
}
