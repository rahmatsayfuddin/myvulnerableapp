<?php
// Start a session
session_start();
require 'dbconnection.php';
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($password != $confirm_password) {
            echo "Passwords do not match.";
            exit;
        }

        // Hash the password with MD5
        $hashed_password = md5($password);

        // Prepare and execute the SQL query to insert the new user
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, 'user')");
        $stmt->execute(['username' => $username, 'password' => $hashed_password]);

        echo "Registration successful. You can now <a href='loginui.php'>login</a>.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
