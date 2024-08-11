<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Course;
use PDO;

class CourseController {

    public function index() {
        $database = new Database();
        $db = $database->connect();
        
        $courseModel = new Course($db);
        $courses = $courseModel->getAllCourses()->fetchAll(PDO::FETCH_ASSOC);
        // Adiciona a contagem de disciplinas para cada curso
        foreach ($courses as &$course) { 
            $course['disciplineCount'] = $courseModel->getCountDiscipline($course['courseId']);
        }
        
        require '../app/Views/course.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $db = $database->connect();

            $courseModel = new Course($db);
            
            $name = $_POST['courseName'];
            $description = $_POST['courseDescription'];
            $type = $_POST['courseType'];
            $creationDate = date('Y-m-d H:i:s');
            $hubId = $_POST['hubId'];
            
            if ($courseModel->addCourse($name, $description, $creationDate, $type)) {
                $courseId = $db->lastInsertId();
                if ($courseModel->addCourseToHub($courseId, $hubId)) {
                    echo '<script>alert("Course added successfully with hub association!"); window.location.href="index.php?router=course";</script>';
                } else {
                    echo '<script>alert("Error associating course with hub.");</script>';
                }
            } else {
                echo '<script>alert("Error adding course."); window.location.href="index.php?router=course";</script>';
            }
        }
    }
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $_POST['delete'] === 'delete') {
            $database = new Database();
            $db = $database->connect();
            $courseModel = new Course($db);
            
            $courseId = $_POST['courseId'];

            if ($courseModel->deleteCourse($courseId)) {
                $_SESSION['message'] = 'Course deleted successfully';
            } else {
                $_SESSION['message'] = 'Failed to delete course';
            }

            header('Location: index.php?router=course');
            exit;
        }
    }

    public function getDisciplines() {
        if (isset($_GET['courseId'])) {
            $courseId = $_GET['courseId'];
            
            $database = new Database();
            $db = $database->connect();
            $courseModel = new Course($db);

            $disciplines = $courseModel->getDisciplineByCourseId($courseId);

            header('Content-Type: application/json');
            echo json_encode($disciplines);
            exit;
        }
    }

}