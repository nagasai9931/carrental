<?php
session_start();
include("config.php");

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['booking_id'])) {
    die("Error: Invalid request.");
}

$booking_id = intval($_GET['booking_id']); // Convert to integer
$user = $_SESSION['user'];

// Fetch booking details
$query = "SELECT b.*, c.model, c.brand, c.price_per_day 
          FROM bookings b
          JOIN cars c ON b.car_id = c.id
          WHERE b.id = ? AND b.user_email = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "is", $booking_id, $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    die("Error: Booking not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success | Car Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">CarRental</div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="booking_info.php">My Bookings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="confirmation-container">
    <h2>Payment Successful 🎉</h2>
    <p>Your payment has been processed successfully. Here are your booking details:</p>

    <div class="booking-details">
        <p><strong>Car:</strong> <?php echo htmlspecialchars($booking['brand'] . " " . $booking['model']); ?></p>
        <p><strong>Pickup Date:</strong> <?php echo htmlspecialchars($booking['pickup_date']); ?></p>
        <p><strong>Return Date:</strong> <?php echo htmlspecialchars($booking['return_date']); ?></p>
        <p><strong>Total Amount Paid:</strong> $<?php echo htmlspecialchars($_GET['total_amount'] ?? '0'); ?></p>
    </div>

    <a href="booking_info.php" class="btn">View My Bookings</a>
</div>

</body>
</html>
