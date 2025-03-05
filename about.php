<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Car Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation Bar -->
<header>
    <div class="logo">CarRental</div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="about.php" class="active">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user'])) { ?>
                <li><a href="booking.php">Book a Car</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>

<!-- About Section -->
<section class="about">
    <div class="container">
        <h2>About Car Rental</h2>
        <p>Welcome to CarRental, your trusted partner for reliable and affordable car rentals. We provide high-quality vehicles at competitive prices to ensure a smooth and comfortable ride for our customers.</p>

        <h3>Our Mission</h3>
        <p>Our mission is to make car rentals simple, convenient, and accessible for everyone. Whether you need a car for a business trip, a vacation, or a daily commute, we've got you covered.</p>

        <h3>Why Choose Us?</h3>
        <ul>
            <li>🚗 Wide range of well-maintained vehicles</li>
            <li>💰 Affordable rental prices</li>
            <li>🛠 24/7 customer support</li>
            <li>📍 Convenient pick-up & drop-off locations</li>
            <li>🔒 Safe and secure transactions</li>
        </ul>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Car Rental Service | All Rights Reserved</p>
</footer>

</body>
</html>
