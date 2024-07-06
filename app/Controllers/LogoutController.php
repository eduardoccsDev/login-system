<?php

namespace App\Controllers;

class LogoutController {
    public function index() {
        // Inicia a sessão, se ainda não estiver iniciada
        session_start();

        // Limpa todas as variáveis de sessão
        $_SESSION = [];

        // Destroi a sessão
        session_destroy();

        // Redireciona para a página de login após o logout
        header('Location: index.php?router=login');
        exit;
    }
}