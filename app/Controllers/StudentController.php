<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\Student;

class StudentController {

    public function index() {
        $database = new Database();
        $db = $database->connect();
        
        $studentModel = new Student($db);
        $students = $studentModel->getAllStudents();
        
        require '../app/Views/student.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $db = $database->connect();

            $studentModel = new Student($db);
            
            $name = $_POST['studentName'];
            $email = $_POST['studentEmail'];
            $cpf = $_POST['studentCPF'];
            $hub = $_POST['studentHub'];
            $registrationCode =  $this->generateRandomCode();
            $creationDate = date('Y-m-d H:i:s');

            if ($studentModel->addStudent($name, $email, $cpf, $hub, $registrationCode, $creationDate)) {
                echo '<script>alert("Student added successfully!"); window.location.href="index.php?router=student";</script>';
            } else {
                echo '<script>alert("Error adding student."); window.location.href="index.php?router=student";</script>';
            }
        }
    }

    private function generateRandomCode($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomCode = '';

        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, $charactersLength - 1);
            $randomCode .= $characters[$index];
        }

        return $randomCode;
    }
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $_POST['delete'] === 'delete') {
            $database = new Database();
            $db = $database->connect();
            $studentModel = new Student($db);
            
            $studentId = $_POST['studentId'];

            if ($studentModel->deleteStudent($studentId)) {
                $_SESSION['message'] = 'Student deleted successfully';
            } else {
                $_SESSION['message'] = 'Failed to delete student';
            }

            header('Location: index.php?router=student');
            exit;
        }
    }

}