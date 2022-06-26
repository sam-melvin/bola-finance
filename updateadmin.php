<?php
session_start();
include 'dbConfig.php';
$ids = $_POST['ids'];
$pass = $_POST['pass'];
$pass  = password_hash($pass,PASSWORD_DEFAULT);

    $sql = "UPDATE `admin_user` SET 
    `password`='$pass'  
    WHERE `id`='$ids'";

    if ($conn->query($sql) === TRUE) {
    echo "success";
    } else {
    echo "error";
    }

$conn->close();
?>