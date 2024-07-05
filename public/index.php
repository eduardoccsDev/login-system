<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Initial section
session_start();

// Const control
define('CONTROL', true);

// Include the Database and User classes
require_once '../inc/Database.php';
require_once '../inc/User.php';

// Create a new Database instance and connect
$database = new Database();
$db = $database->connect();

// Create a new User instance
$userClass = new User($db);

// Check logged user
$user_logged = $_SESSION['userId'] ?? null;
$user_name = $_SESSION['userName'] ?? null;

// Check router
if (empty($user_logged)) {
    $router = 'login';
} else {
    $router = $_GET['router'] ?? 'home';
}

// Check user logged, go to home
if (!empty($user_logged) && $router == 'login') {
    $router = 'home';
}

// Analyze routers
$routers = [
    'login' => 'login.php',
    'home' => 'home.php',
    'about' => 'about.php',
    'contact' => 'contact.php',
    'logout' => 'logout.php',
];

if (!key_exists($router, $routers)) {
    die('Access denied');
}

// Include the requested router file
require_once $routers[$router];