<?php 
    session_start();
    unset($_SESSION['user_login']);
    unset($_SESSION['admin_login']);
    header('location: /registeration-system/registeration-system/index.php');
?>