<?php
// Include the database connection file
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $name    = trim($_POST['name']);
    $phone   = trim($_POST['phone']);
    $email   = trim($_POST['email']);
    $college = trim($_POST['college']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match. Please go back and try again.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to insert the data securely
    $stmt = $conn->prepare("INSERT INTO users (name, phone, email, college, password) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssss", $name, $phone, $email, $college, $hashed_password);

    // Execute the statement and display a success/error message
    if ($stmt->execute()) {
        echo "Registration successful. Data saved in the database.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>