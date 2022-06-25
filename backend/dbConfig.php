<?php
// Database configuration
// $dbHost     = "localhost";
// $dbUsername = "u419103131_bolaswerte";
// $dbPassword = "B0la@2k22";
// $dbName     = "u419103131_bolaswerte";

$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "bola_swerte";

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>