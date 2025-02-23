<?php
$servername = "localhost";
$username = "root";      // Update if necessary
$password = "";          // Update if necessary
$dbname = "campus_sphere";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
