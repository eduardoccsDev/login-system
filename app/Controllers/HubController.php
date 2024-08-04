<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Hub;
use PDO;

class HubController {

    public function index() {
        $database = new Database();
        $db = $database->connect();
        
        $hubModel = new Hub($db);
        $hubs = $hubModel->getAllHubs()->fetchAll(PDO::FETCH_ASSOC);
        // Adiciona a contagem de disciplinas para cada curso
        foreach ($hubs as &$hub) { 
            $hub['courseCount'] = $hubModel->getCountCourse($hub['hubId']);
        }
        
        require '../app/Views/hub.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $db = $database->connect();

            $hubModel = new Hub($db);
            
            $name = $_POST['hubName'];
            $creationDate = date('Y-m-d H:i:s');

            if ($hubModel->addHub($name, $creationDate)) {
                echo '<script>alert("Hub added successfully!"); window.location.href="index.php?router=hub";</script>';
            } else {
                echo '<script>alert("Error adding hub.123"); window.location.href="index.php?router=hub";</script>';
            }
        }
    }
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $_POST['delete'] === 'delete') {
            $database = new Database();
            $db = $database->connect();
            $hubModel = new Hub($db);
            
            $hubId = $_POST['hubId'];

            if ($hubModel->deleteHub($hubId)) {
                $_SESSION['message'] = 'Hub deleted successfully';
            } else {
                $_SESSION['message'] = 'Failed to delete hub';
            }

            header('Location: index.php?router=hub');
            exit;
        }
    }

    public function getCourses() {
        if (isset($_GET['hubId'])) {
            $hubId = $_GET['hubId'];
            
            $database = new Database();
            $db = $database->connect();
            $hubModel = new Hub($db);

            $hubs = $hubModel->getCourseByHubId($hubId);

            header('Content-Type: application/json');
            echo json_encode($hubs);
            exit;
        }
    }

}