<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Discipline;

class DisciplineController {

    public function index() {
        $database = new Database();
        $db = $database->connect();
        
        $disciplineModel = new Discipline($db);
        $discipline = $disciplineModel->getAllDiscipline();
        
        // Passa os dados para a view
        require '../app/Views/discipline.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $db = $database->connect();
    
            $disciplineModel = new Discipline($db);
            
            $name = $_POST['disciplineName'];
            $description = $_POST['disciplineDescription'];
            $creationDate = date('Y-m-d H:i:s');
            $modality = $_POST['disciplineModality'];
            $courseId = $_POST['courseId'];

            if ($disciplineModel->addDiscipline($name, $description, $creationDate, $modality)) {
                $disciplineId = $db->lastInsertId();
                if ($disciplineModel->addDisciplineToCourse($disciplineId, $courseId)) {
                    echo '<script>alert("Discipline added successfully with course association!"); window.location.href="index.php?router=discipline";</script>';
                } else {
                    echo '<script>alert("Error associating discipline with course."); window.location.href="index.php?router=discipline";</script>';
                }
            } else {
                echo '<script>alert("Error adding discipline."); window.location.href="index.php?router=discipline";</script>';
            }
        }
    }
     
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $_POST['delete'] === 'delete') {
            $database = new Database();
            $db = $database->connect();
            $disciplineModel = new Discipline($db);
            
            $disciplineId = $_POST['disciplineId'];

            if ($disciplineModel->deleteDiscipline($disciplineId)) {
                $_SESSION['message'] = 'Discipline deleted successfully';
            } else {
                $_SESSION['message'] = 'Failed to delete discipline';
            }

            header('Location: index.php?router=discipline');
            exit;
        }
    }

}