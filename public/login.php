<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

defined('CONTROL') or die('Access denied');

// Inclua as classes Database e User
require_once '../inc/Database.php';
require_once '../inc/User.php';

// Crie uma nova instância da classe Database e conecte-se ao banco de dados
$database = new Database();
$db = $database->connect();

// Crie uma nova instância da classe User
$userClass = new User($db);

// Verifique o envio do formulário
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
        echo "Tentando autenticar usuário: " . $userEmail . "<br>"; // Depuração
        $user = $userClass->authenticate($userEmail, $password);
        if ($user) {
            echo "Autenticação bem-sucedida. Usuário ID: " . $user['userId'] . "<br>"; // Depuração
            // Faça o login
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['userEmail'] = $user['userEmail'];
            // Volte para a página inicial
            header('location: index.php?router=home');
            exit;
        } else {
            echo "Falha na autenticação.<br>"; // Depuração
            // Login inválido
            $erro = "User and/or password invalid";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Login'; require '../components/customHead.php'; ?>
<body>
    <section class="sec-login">
        <form action="index.php?router=login" method="post">
            <h3>Login</h3>
            <div>
                <label for="user">User:</label>
                <input type="email" name="user" id="user" placeholder="example@example.com">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="********">
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
            <?php if (!empty($erro)): ?>
                <p class="error"><?= $erro; ?></p>
            <?php endif ?>
        </form>
    </section>
</body>
</html>
