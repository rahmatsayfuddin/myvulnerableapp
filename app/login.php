<?php
session_start();
require 'dbconnection.php';
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Hash the password with MD5

        // Prepare and execute the SQL query
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);

        // Check if any results were returned
        if ($stmt->rowCount() == 1) {
            // Fetch the user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php');
            exit;
        } else {
            echo "Invalid username or password.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
