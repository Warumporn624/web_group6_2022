<?php
session_start();
require_once 'config/db.php';

if (isset($_POST['submit'])) { 
    $id = $_POST['id'];
    $subject = $_POST['subject'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $hour = $_POST['hour'];
    $lecturer = $_POST['lecturer'];
    $detail = $_POST['detail'];

    $sql = $conn->prepare("INSERT INTO courses(id, subject, title, price, hour, lecturer, detail) 
                            VALUES(:id, :subject, :title, :price, :hour, :lecturer, :detail)");
    
    $sql->bindParam(":id", $id);
    $sql->bindParam(":subject", $subject);
    $sql->bindParam(":title", $title);
    $sql->bindParam(":price", $price);
    $sql->bindParam(":hour", $hour);
    $sql->bindParam(":lecturer", $lecturer);
    $sql->bindParam(":detail", $detail);
    $sql->execute();
    if ($sql){
        $_SESSION['success'] = 'Inserted successfully';
        header("location: manage.php");
    }else {
        $_SESSION['error'] = 'Inserted unsuccessfully';
        header("location: manage.php");
    }
}
?>