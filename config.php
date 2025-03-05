<?php
$host = "localhost";
$user = "root"; // Change if needed
$password = ""; // Change if your MySQL has a password
$database = "car_rental";

// Establish database connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check if connection is successful
if (!$conn) {
    die("🚨 Database connection failed: " . mysqli_connect_error());
}

// Set UTF-8 encoding for better character handling
mysqli_set_charset($conn, "utf8mb4");
?>
