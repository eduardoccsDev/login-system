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

}