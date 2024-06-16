<?php
// initial section
session_start();

//const control
define('CONTROL', true);

//check logged user
$user_logged = $_SESSION['user'] ?? null;

//check router
if(empty($user_logged)){
    $router = 'login';
}else{
    $router = $_GET['router'] ?? 'home';
}
// check user logged go to home
if(!empty($user_logged) && $router == 'login'){
    $router == 'home';
}

// analise routers
$routers = [
    'login' => 'login.php',
    'home' => 'home.php',
    'about' => 'about.php',
    'contact' => 'contact.php',
    'logout' => 'logout.php',
];

if(!key_exists($router, $routers)){
    die('Access denied');
}

require_once $routers[$router];