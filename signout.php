<?php 
    session_start();
    unset($_SESSION['user_login']);
    unset($_SESSION['admin_login']);
    header('location: /thebrain/registeration-system/signin.php');

?>