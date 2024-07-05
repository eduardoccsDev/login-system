<?php

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
        $query = 'SELECT userId, userName, userEmail, userPassword FROM ' . $this->table . ' WHERE userEmail = :userEmail';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userEmail', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "Usuário encontrado: " . $row['userEmail'] . "<br>"; // Depuração
            echo "Hash armazenado: " . $row['userPassword'] . "<br>"; // Depuração
            // Verifique a senha usando password_verify
            if (password_verify($password, $row['userPassword'])) {
                echo "Senha verificada com sucesso.<br>"; // Depuração
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
        return false;
    }
}
