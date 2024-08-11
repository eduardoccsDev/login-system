<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sessão
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\ProfessorController;
use App\Controllers\UserController;
use App\Controllers\DisciplineController;
use App\Controllers\StudentController;
use App\Controllers\HubController;
use App\Controllers\CourseController;

// Verifique se a sessão está configurada e a rota é válida
if (!isset($_SESSION['userId']) && $_GET['router'] !== 'login') {
    header('Location: index.php?router=login');
    exit;
}

$router = $_GET['router'] ?? 'login';
$action = $_GET['action'] ?? 'index';

switch ($router) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'login':
        $controller = new LoginController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->authenticate();
        } else {
            $controller->index();
        }
        break;
    case 'logout':
        $controller = new LogoutController();
        $controller->index();
        break;
    case 'professor':
        $controller = new ProfessorController();
        if ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->add();
        } elseif ($action == 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->delete();
        } else {
            $controller->index();
        }
        break;
    case 'discipline':
        $controller = new DisciplineController();
        if ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->add();
        } elseif ($action == 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->delete();
        } else {
            $controller->index();
        }
        break;
    case 'student':
        $controller = new StudentController();
        if ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->add();
        } elseif ($action == 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->delete();
        } else {
            $controller->index();
        }
        break;
    case 'hub':
        $controller = new HubController();
        if ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->add();
        } elseif ($action == 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->delete();
        }elseif ($action == 'getCourses') {
            $controller->getCourses();
        } else {
            $controller->index();
        }
        break;
    case 'course':
        $controller = new CourseController();
        if ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->add();
        } elseif ($action == 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->delete();
        } elseif ($action == 'getDisciplines') {
            $controller->getDisciplines();
        } else {
            $controller->index();
        }
        break;
    case 'user':
        $controller = new UserController();
        if ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->add();
        } elseif ($action == 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->delete();
        } else {
            $controller->index();
        }
        break;
    default:
        die("Access denied: Rota '$router' não reconhecida.");
}
