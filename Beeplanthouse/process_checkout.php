<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beeplanthouse";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $cardName = $_POST['cardName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];

    // Store billing details
    $stmt = $conn->prepare("INSERT INTO orders (full_name, email, address, city, state, zip, country, card_name, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $fullName, $email, $address, $city, $state, $zip, $country, $cardName, $cardNumber, $expiryDate, $cvv);

    // Execute statement
    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
