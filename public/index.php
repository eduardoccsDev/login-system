<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../app/Models/Database.php';
require_once '../app/Models/User.php';
require_once '../app/Models/Professor.php';
require_once '../app/Controllers/HomeController.php';
require_once '../app/Controllers/LoginController.php';
require_once '../app/Controllers/LogoutController.php';

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;

if (!isset($_SESSION['userId']) && $_GET['router'] !== 'login') {
    header('Location: index.php?router=login');
    exit;
}

$router = $_GET['router'] ?? 'login';

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
    default:
        die("Access denied: Rota '$router' não reconhecida.");
}
