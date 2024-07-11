<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\User;

class UserController {

    public function index() {
        $database = new Database();
        $db = $database->connect();
        
        $userModel = new User($db);
        $users = $userModel->getAllUsers();
        
        // Passa os dados para a view home.php
        require '../app/Views/user.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $db = $database->connect();

            $professorModel = new User($db);
            
            $name = $_POST['userName'];
            $email = $_POST['userEmail'];
            $creationDate = date('Y-m-d H:i:s');
            $level = $_POST['userLevel'];
            $password = $_POST['userPassword'];

            if ($professorModel->addUser($name, $email, $creationDate, $level, $password)) {
                echo '<script>alert("User added successfully!"); window.location.href="index.php?router=user";</script>';
            } else {
                echo '<script>alert("Error adding user."); window.location.href="index.php?router=user";</script>';
            }
        }
    }

}