<?php
session_start();
include 'db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: login.html?error=emptyfields");
        exit();
    }

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userEmail'] = $row['email'];
            header("Location: BeePlantHouse.html?login=success");
            exit();
        } else {
            header("Location: login.html?error=wrongpassword");
            exit();
        }
    } else {
        header("Location: login.html?error=nouser");
        exit();
    }
} else {
    header("Location: login.html");
    exit();
}
?>
