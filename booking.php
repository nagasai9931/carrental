<?php
session_start();
include("config.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION['user'];
    $car_id = $_POST['car_id'];
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];

    $query = "INSERT INTO bookings (user_email, car_id, pickup_date, return_date) 
              VALUES ('$user', '$car_id', '$pickup_date', '$return_date')";
    if (mysqli_query($conn, $query)) {
        $success = "Car booked successfully!";
        $booking_id = mysqli_insert_id($conn); // Get the last inserted booking ID
        header("Location: confirmation.php?booking_id=$booking_id");
        exit();
    } else {
        $error = "Error booking car. Try again.";
    }
}

$car_id = $_GET['car_id'];
$query = "SELECT * FROM cars WHERE id='$car_id'";
$car_result = mysqli_query($conn, $query);
$car = mysqli_fetch_assoc($car_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Car | Car Rental</title>
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

<div class="booking-container">
    <h2>Book Your Car</h2>
    <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form method="POST" action="">
        <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
        <p>Car: <strong><?php echo $car['model']; ?></strong></p>
        <p>Price: <strong>$<?php echo $car['price_per_day']; ?>/day</strong></p>

        <label>Pickup Date:</label>
        <input type="date" name="pickup_date" required>

        <label>Return Date:</label>
        <input type="date" name="return_date" required>

        <button type="submit">Confirm Booking</button>
    </form>
</div>

</body>
</html>
