<?php
session_start();
include 'db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if (empty($email) || empty($password) || empty($confirmPassword)) {
        header("Location: register.html?error=emptyfields");
        exit();
    }

    if ($password !== $confirmPassword) {
        header("Location: register.html?error=passwordcheck");
        exit();
    }

    $sql = "SELECT email FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        header("Location: register.html?error=usertaken");
        exit();
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashedPassword);
        $stmt->execute();
        header("Location: login.html?register=success");
        exit();
    }
} else {
    header("Location: register.html");
    exit();
}
?>
