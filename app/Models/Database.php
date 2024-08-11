<?php

namespace App\Models;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost'; 
    private $db_name = 'school_dash';
    private $username = 'root';
    private $password = '';
    private $port = '3308';
    public $conn;

    // Conexão com o banco de dados
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo 'Connection Error: ' . $exception->getMessage();
        }

        return $this->conn;
    }
}
