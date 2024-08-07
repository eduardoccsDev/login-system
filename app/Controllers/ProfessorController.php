<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Professor;

class ProfessorController {

    public function index() {
        $database = new Database();
        $db = $database->connect();
        
        $professorModel = new Professor($db);
        $professors = $professorModel->getAllProfessors();
        
        // Passa os dados para a view home.php
        require '../app/Views/professor.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $db = $database->connect();

            $professorModel = new Professor($db);
            
            $name = $_POST['professorName'];
            $email = $_POST['professorEmail'];
            $creationDate = date('Y-m-d H:i:s');

            if ($professorModel->addProfessor($name, $email, $creationDate)) {
                echo '<script>alert("Professor added successfully!"); window.location.href="index.php?router=professor";</script>';
            } else {
                echo '<script>alert("Error adding professor."); window.location.href="index.php?router=professor";</script>';
            }
        }
    }
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $_POST['delete'] === 'delete') {
            $database = new Database();
            $db = $database->connect();
            $professorModel = new Professor($db);
            
            $professorId = $_POST['professorId'];

            if ($professorModel->deleteProfessor($professorId)) {
                $_SESSION['message'] = 'Professor deleted successfully';
            } else {
                $_SESSION['message'] = 'Failed to delete professor';
            }

            header('Location: index.php?router=professor');
            exit;
        }
    }

}