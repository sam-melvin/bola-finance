<?php
/**
 * Database configuration
 */
$dbHost     = 'localhost';
$dbUsername = 'u419103131_bolaswerte';
$dbPassword = 'B0la@2k22';
$dbName     = 'u419103131_bolaswerte';

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/**
 * Return database configuration settings, retain the above code for
 * backward compatibility
 */
return [
    'DataSources' => [
        'default' => [
            'driver' => 'mysql',
            'host' => $dbHost,
            'database' => $dbName,
            'username' => $dbUsername,
            'password' => $dbPassword
        ]
    ]
];
?>
