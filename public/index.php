<?php

declare(strict_types=1);
define('ENVIRONMENT', 'development'); // Altere para 'production' em produção
// Exibição de erros com base no ambiente
match (ENVIRONMENT) {
    'development' => ini_set('display_errors', '1'),
    'production' => ini_set('display_errors', '0')
};
ini_set('display_startup_errors', ENVIRONMENT === 'development' ? '1' : '0');
error_reporting(ENVIRONMENT === 'development' ? E_ALL : 0);
// Inicia a sessão de forma segura
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
    session_regenerate_id(true); // Regenera o ID da sessão para segurança
}
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Controllers\{HomeController, LoginController, LogoutController, ProfessorController, UserController, DisciplineController, StudentController, HubController, CourseController};
// Carregar variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad(); // Use safeLoad para evitar exceções se o arquivo .env não existir

$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbPort = $_ENV['DB_PORT'];
// Função para lidar com redirecionamentos
function redirect(string $location): void {
    header("Location: $location");
    exit;
}
// Verificação de sessão e redirecionamento para login se não autenticado
$router = $_GET['router'] ?? 'login';
$action = $_GET['action'] ?? 'index';
// Sanitize router and action input
$router = preg_replace('/[^a-zA-Z0-9_-]/', '', $router);
$action = preg_replace('/[^a-zA-Z0-9_-]/', '', $action);

if (!isset($_SESSION['userId']) && $router !== 'login') {
    redirect('index.php?router=login');
}

// Mapeamento das rotas para os controladores correspondentes
$controllerMap = [
    'home' => HomeController::class,
    'login' => LoginController::class,
    'logout' => LogoutController::class,
    'professor' => ProfessorController::class,
    'discipline' => DisciplineController::class,
    'student' => StudentController::class,
    'hub' => HubController::class,
    'course' => CourseController::class,
    'user' => UserController::class
];

// Verifica se o controlador existe
if (!array_key_exists($router, $controllerMap)) {
    throw new RuntimeException("Access denied: Rota '$router' não reconhecida.");
}

$controllerClass = $controllerMap[$router] ?? null;

// Verifica se a classe do controlador existe
if (!class_exists($controllerClass)) {
    die("Erro: Controlador '$controllerClass' não encontrado.");
}

// Instancia o controlador
$controller = new $controllerClass();
// Mapeamento das ações por método HTTP
$actionsMap = [
    'POST' => [
        'add' => fn() => $controller->add(),
        'delete' => fn() => $controller->delete(),
    ],
    'GET' => [
        'getCourses' => fn() => $controller->getCourses(),
        'getDisciplines' => fn() => $controller->getDisciplines(),
        'index' => fn() => $controller->index(),
    ]
];

// Obtém o método de solicitação
$method = $_SERVER['REQUEST_METHOD'];
// Define a ação padrão se não estiver mapeada
$actionHandler = $actionsMap[$method][$action] ?? fn() => $controller->index();
// Verifica se a ação existe e executa
if (!is_callable($actionHandler)) {
    die("Erro: Ação '$action' não encontrada para o método '$method'.");
}
// Executa a ação
$actionHandler();