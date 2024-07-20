<?php

namespace App\Models;

use PDO;
use PDOException;

class User {
    private $conn;
    private $table = 'users';

    public $userId;
    public $userName;
    public $userEmail;
    public $userPassword;
    public $userLevel;
    public $userStatus;
    public $userCreatingDate;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para autenticar usuário
    public function authenticate($email, $password) {
        try {
            $query = 'SELECT userId, userName, userEmail, userPassword FROM ' . $this->table . ' WHERE userEmail = :userEmail';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':userEmail', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // Verifique a senha usando password_verify
                if (password_verify($password, $row['userPassword'])) {
                    return [
                        'userId' => $row['userId'],
                        'userName' => $row['userName'],
                        'userEmail' => $row['userEmail'],
                    ];
                } else {
                    echo "Falha na verificação da senha.<br>"; // Depuração
                }
            } else {
                echo "Usuário não encontrado.<br>"; // Depuração
            }
        } catch (PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage() . "<br>";
        }
        return false;
    }
    //call all users
    public function getAllUsers() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function addUser($name, $email, $creationDate, $level, $password) {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO $this->table (userName, userEmail, userCreationDate, userLevel, userPassword) VALUES (:userName, :userEmail, :userCreationDate, :userLevel, :userPassword)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':userName', $name);
        $stmt->bindParam(':userEmail', $email);
        $stmt->bindParam(':userCreationDate', $creationDate);
        $stmt->bindParam(':userLevel', $level);
        $stmt->bindParam(':userPassword', $hashedPassword);



        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error adding user: " . $e->getMessage();  // Adicionado para exibir a mensagem de erro
            return false;
        }
    }
    public function deleteUser($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE userId = :userId';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $id);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting user: " . $e->getMessage();
            return false;
        }
    }
}
