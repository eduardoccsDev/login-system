<?php defined('CONTROL') or die('Access denied'); ?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Login'; require 'components/customHead.php'; ?>
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
