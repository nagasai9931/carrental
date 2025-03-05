<?php
session_start();
include("config.php");

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch users
$users = mysqli_query($conn, "SELECT * FROM users");

// Fetch bookings
$bookings = mysqli_query($conn, "SELECT bookings.*, cars.model FROM bookings INNER JOIN cars ON bookings.car_id = cars.id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Car Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">Admin Panel</div>
    <nav>
        <ul>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h2>Users</h2>
    <table border="1">
        <tr>
            <th>Email</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($users)) { ?>
        <tr>
            <td><?php echo $row['email']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Bookings</h2>
    <table border="1">
        <tr>
            <th>User Email</th>
            <th>Car</th>
            <th>Pickup</th>
            <th>Return</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($bookings)) { ?>
        <tr>
            <td><?php echo $row['user_email']; ?></td>
            <td><?php echo $row['model']; ?></td>
            <td><?php echo $row['pickup_date']; ?></td>
            <td><?php echo $row['return_date']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
