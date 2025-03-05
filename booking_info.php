<?php
session_start();
include("config.php");

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Fetch all bookings for the logged-in user
$query = "SELECT b.*, c.model, c.brand, c.price_per_day, p.status AS payment_status 
          FROM bookings b
          JOIN cars c ON b.car_id = c.id
          LEFT JOIN payments p ON b.id = p.booking_id
          WHERE b.user_email = ?
          ORDER BY b.id DESC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings | Car Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">CarRental</div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="booking_info.php" class="active">My Bookings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="booking-container">
    <h2>My Bookings</h2>

    <table border="1">
        <tr>
            <th>Car</th>
            <th>Pickup Date</th>
            <th>Return Date</th>
            <th>Price/Day</th>
            <th>Total Price</th>
            <th>Payment Status</th>
            <th>Action</th>
        </tr>
        
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $pickup = new DateTime($row['pickup_date']);
                $return = new DateTime($row['return_date']);
                $days = $return->diff($pickup)->days;
                $total_price = $days * $row['price_per_day'];
                $payment_status = $row['payment_status'] ?? 'Pending'; // Default to Pending if no payment record exists
                
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['brand'] . " " . $row['model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['pickup_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['return_date']) . "</td>";
                echo "<td>$" . htmlspecialchars($row['price_per_day']) . "</td>";
                echo "<td>$" . $total_price . "</td>";
                echo "<td>" . htmlspecialchars($payment_status) . "</td>";
                echo "<td>";

                if ($payment_status === 'Pending') {
                    echo "<form action='payment.php' method='POST'>";
                    echo "<input type='hidden' name='booking_id' value='" . $row['id'] . "'>";
                    echo "<input type='hidden' name='total_amount' value='" . $total_price . "'>";
                    echo "<button type='submit' class='pay-btn'>Pay Now</button>";
                    echo "</form>";
                } else {
                    echo "<span class='paid'>Paid</span>";
                }

                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No bookings found.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
