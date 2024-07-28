<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Course;

class CourseController {

    public function index() {
        $database = new Database();
        $db = $database->connect();
        
        $courseModel = new Course($db);
        $course = $courseModel->getAllCourses();
        
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
            
            if ($courseModel->addCourse($name, $description, $creationDate, $type)) {
                echo '<script>alert("Course added successfully!"); window.location.href="index.php?router=course";</script>';
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

}