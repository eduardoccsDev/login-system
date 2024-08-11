<?php

namespace App\Controllers;

use App\Models\Database;
use App\Models\User;

class LoginController {
    public function index() {
        // Renderiza a view de login
        require_once '../app/Views/login.php';
    }

    public function authenticate() {
        // Inicializa as variáveis de sessão

        // Conecta ao banco de dados
        $database = new Database();
        $db = $database->connect();
        $userClass = new User($db);

        // Verifica o envio do formulário
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verifique usuário e senha
            $userEmail = $_POST['user'] ?? null;
            $password = $_POST['password'] ?? null;
            $erro = null;

            if (empty($userEmail) || empty($password)) {
                $erro = "User and password are required";
            }

            // Verifique se o usuário e senha correspondem
            if (empty($erro)) {
                $user = $userClass->authenticate($userEmail, $password);
                if ($user) {
                    // Faça o login
                    $_SESSION['userId'] = $user['userId'];
                    $_SESSION['userName'] = $user['userName'];
                    $_SESSION['userEmail'] = $user['userEmail'];
                    // Redirecione para a página inicial
                    header('Location: index.php?router=home');
                    exit;
                } else {
                    // Login inválido
                    $erro = "User and/or password invalid";
                }
            }
        }

        // Renderiza a view de login com erro
        require_once '../app/Views/login.php';
    }
}
