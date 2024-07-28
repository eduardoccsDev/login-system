<?php

namespace App\Models;

use PDO;
use PDOException;

class Course {
    private $conn;
    private $table = 'courses';

    public $courseId;
    public $courseName;
    public $courseDescription;
    public $courseType;
    public $courseCreationDate;
    public $courseStatus;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllCourses() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function addCourse($name, $description, $creationDate, $type) {
        $query = "INSERT INTO $this->table (courseName, courseDescription, courseCreationDate, courseType) VALUES (:courseName, :courseDescription, :courseCreationDate, :courseType)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':courseName', $name);
        $stmt->bindParam(':courseDescription', $description);
        $stmt->bindParam(':courseCreationDate', $creationDate);
        $stmt->bindParam(':courseType', $type);


        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error adding course: " . $e->getMessage();  // Adicionado para exibir a mensagem de erro
            return false;
        }
    }
    public function deleteCourse($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE courseId = :courseId';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':courseId', $id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting course: " . $e->getMessage();
            return false;
        }
    }
}
