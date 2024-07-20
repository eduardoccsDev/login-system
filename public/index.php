<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../app/Models/Database.php';
require_once '../app/Models/User.php';
require_once '../app/Models/Professor.php';
require_once '../app/Controllers/HomeController.php';
require_once '../app/Controllers/LoginController.php';
require_once '../app/Controllers/LogoutController.php';
require_once '../app/Controllers/ProfessorController.php';
require_once '../app/Controllers/UserController.php';

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\ProfessorController;
use App\Controllers\UserController;

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
