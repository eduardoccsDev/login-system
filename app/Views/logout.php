<?php
    defined('CONTROL') or die('Access denied');

    //logout
    session_destroy();

    //back to initial page
    header('Location: index.php?router=login');