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
}
