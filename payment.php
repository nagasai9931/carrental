<?php
session_start();
include("config.php");

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Validate POST request
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['booking_id'], $_POST['total_amount'])) {
    die("Error: Invalid payment request.");
}

$booking_id = intval($_POST['booking_id']); // Convert to integer
$total_amount = floatval($_POST['total_amount']); // Convert to float

// Check if the booking exists and is unpaid
$query = "SELECT b.*, p.status AS payment_status 
          FROM bookings b 
          LEFT JOIN payments p ON b.id = p.booking_id 
          WHERE b.id = ? AND b.user_email = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "is", $booking_id, $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    die("Error: Booking not found.");
}

// Check if payment is already made
if ($booking['payment_status'] === 'Paid') {
    die("Error: This booking has already been paid for.");
}

// Mock Payment Processing (Replace with actual payment gateway logic)
$payment_success = true; // Simulate a successful payment

if ($payment_success) {
    // Insert payment record
    $insert_query = "INSERT INTO payments (booking_id, user_email, total_amount, status) 
                     VALUES (?, ?, ?, 'Paid')";
    $stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt, "isd", $booking_id, $user, $total_amount);
    
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to success page
        header("Location: payment_success.php?booking_id=$booking_id");
        exit();
    } else {
        echo "Error processing payment. Please try again.";
    }
} else {
    echo "Payment failed. Please try again.";
}
?>
