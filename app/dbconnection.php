<?php
// Define database connection parameters
$host = 'mysql';
$dbname = 'vapp';
$username = 'root';
$password = 'root';

try {
    // Create a new PDO instance
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Set default fetch mode to associative array
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation of prepared statements
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

    // Connection successful message (for testing purposes, can be removed in production)
    // echo "Database connection successful!<br>";
} catch (PDOException $e) {
    // Catch any errors and display the error message
    echo "Database connection failed: " . $e->getMessage();
    exit; // Stop further execution if the connection fails
}
?>
