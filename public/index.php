<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../app/Models/Database.php';
require_once '../app/Models/User.php';
require_once '../app/Controllers/HomeController.php';
require_once '../app/Controllers/LoginController.php';

use App\Controllers\HomeController;
use App\Controllers\LoginController;

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
    // Adicionar outros casos conforme necessário
    default:
        echo 'Access denied';
        break;
}