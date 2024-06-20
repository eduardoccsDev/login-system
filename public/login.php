<?php
    defined('CONTROL') or die('Access denied');
    // check form submission
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // check user and password
        $user = $_POST['user'] ?? null;
        $password = $_POST['password'] ?? null;
        $erro = null;

        if(empty($user) || empty($password)){
            $erro = "User and password are required";
        }

        //check user match
        if(empty($erro)){
            $users = require_once __DIR__ . '/../inc/users.php';
            foreach($users as $u){
                if($u['user'] == $user && password_verify($password, $u['password'])){
                    // do login
                    $_SESSION['user'] = $user;
                    // back to home page
                    header('location: index.php?router=home');
                }
            }
            //invalid login 
            $erro = "User and/or password invalid";
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
            <?php if(!empty($erro)): ?>
                <p class="error"><?= $erro; ?></p>
            <?php endif ?>
        </form>
    </section>
</body>
</html>