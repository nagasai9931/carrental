<?php
session_start();
include("config.php");

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Debug: Check if `booking_id` is passed in the URL
if (!isset($_GET['booking_id']) || !is_numeric($_GET['booking_id'])) {
    die("Error: Invalid booking ID.");
}

$booking_id = intval($_GET['booking_id']); // Convert to integer


// Fetch booking details for the provided booking_id
$query = "SELECT b.*, c.model, c.brand, c.price_per_day 
          FROM bookings b
          JOIN cars c ON b.car_id = c.id
          WHERE b.id = ? AND b.user_email = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "is", $booking_id, $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);

// Debugging: Check if query returned any results
if (!$booking) {
    die("Error: No booking found. Please check if the booking exists in the database.");
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation | Car Rental</title>
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
    <h2>Booking Confirmation</h2>
    <p>Thank you for booking your car. Below are the details of your reservation:</p>

    <div class="booking-details">
        <p><strong>Car:</strong> <?php echo htmlspecialchars($booking['brand'] . " " . $booking['model']); ?></p>
        <p><strong>Price per day:</strong> $<?php echo htmlspecialchars($booking['price_per_day']); ?></p>
        <p><strong>Pickup Date:</strong> <?php echo htmlspecialchars($booking['pickup_date']); ?></p>
        <p><strong>Return Date:</strong> <?php echo htmlspecialchars($booking['return_date']); ?></p>
        <p><strong>Total Days:</strong> 
            <?php 
                $pickup = new DateTime($booking['pickup_date']);
                $return = new DateTime($booking['return_date']);
                $days = $return->diff($pickup)->days;
                echo $days;
            ?>
        </p>
        <p><strong>Total Price:</strong> $<?php echo $days * $booking['price_per_day']; ?></p>
    </div>

    <form action="payment.php" method="POST">
        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
        <input type="hidden" name="total_amount" value="<?php echo $days * $booking['price_per_day']; ?>">
        <button type="submit" class="pay-btn">Pay Now</button>
    </form>
</div>

</body>
</html>
