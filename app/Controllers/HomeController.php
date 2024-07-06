<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Professor;

class HomeController {

    public function index() {
        $database = new Database();
        $db = $database->connect();
        
        $professorModel = new Professor($db);
        $professors = $professorModel->getAllProfessors();
        
        // Passa os dados para a view home.php
        require '../app/Views/home.php';
    }

}