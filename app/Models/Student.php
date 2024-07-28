<?php

namespace App\Models;

use PDO;
use PDOException;

class Student {
    private $conn;
    private $table = 'students';

    public $studentId;
    public $studentName;
    public $studentEmail;
    public $studentCreationDate;
    public $studentCPF;
    public $studentHub;
    public $studentRegistrationCode;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllStudents() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function addStudent($name, $email, $cpf, $hub, $registrationCode, $creationDate) {
        $query = "INSERT INTO $this->table (studentName, studentEmail, studentCreationDate, studentCPF, studentHub, studentRegistrationCode) VALUES (:studentName, :studentEmail, :studentCreationDate, :studentCPF, :studentHub, :studentRegistrationCode)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':studentName', $name);
        $stmt->bindParam(':studentEmail', $email);
        $stmt->bindParam(':studentCreationDate', $creationDate);
        $stmt->bindParam(':studentCPF', $cpf);
        $stmt->bindParam(':studentHub', $hub);
        $stmt->bindParam(':studentRegistrationCode', $registrationCode);


        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error adding student: " . $e->getMessage();  // Adicionado para exibir a mensagem de erro
            return false;
        }
    }
    public function deleteStudent($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE studentId = :studentId';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':studentId', $id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting student: " . $e->getMessage();
            return false;
        }
    }
}
