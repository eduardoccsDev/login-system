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
}
