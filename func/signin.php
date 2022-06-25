<?php
session_start();
include("../../backend/connect.php");
$email = $_POST['smail'];
$pass = $_POST['spass'];

$email = stripslashes($email);
$pass = stripslashes($pass);

$email = $conn -> real_escape_string($email);
$pass = $conn -> real_escape_string($pass);

$sql = "SELECT `id`,`first_name`,`last_name`,`user_type`,`assigned_doc` FROM `appoint_users` WHERE `email`='$email' AND `password`='$pass' ";
if($result=mysqli_query($conn, $sql)) {
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
                 $_SESSION["uid"] = $row['id'];
                 $_SESSION["fname"] = $row['first_name'];
                 $_SESSION["lname"] = $row['last_name'];
                 $_SESSION["usertype"] = $row['user_type'];
                 $_SESSION["assigned_doc"] = $row['assigned_doc'];

        
        echo "success";
        
        } 
        mysqli_free_result($result);
    }else{
        echo "error";
    }
} 

    
?>