<?php
    defined('CONTROL') or die('Access denied');
?>

<p>Wellcome! <span>User: <strong><?= $_SESSION['user'] ?></strong></span></p>

<nav>
    <a href="?router=home">Home</a>
    <a href="?router=about">About</a>
    <a href="?router=contact">Contact us</a>
    <a href="?router=logout">Logout</a>
</nav>