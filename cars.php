<?php
session_start();
include("config.php");

// Fetch up to 15 cars from the database
$query = "SELECT * FROM cars LIMIT 15";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars | Car Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">CarRental</div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cars.php" class="active">Cars</a></li>
            <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user'])) { ?>
                <li><a href="booking_info.php">My Bookings</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>

<section class="car-list">
    <h2>Available Cars</h2>
    <div class="car-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="car">
                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['model']); ?>">
                    <h3><?php echo htmlspecialchars($row['brand']) . " " . htmlspecialchars($row['model']); ?></h3>
                    <p>Year: <?php echo htmlspecialchars($row['year']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars($row['price_per_day']); ?>/day</p>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <a href="booking.php?car_id=<?php echo $row['id']; ?>" class="btn">Book Now</a>
                    <?php } else { ?>
                        <a href="login.php" class="btn">Login to Book</a>
                    <?php } ?>
                </div>
            <?php } 
        } else {
            echo "<p>No cars available at the moment.</p>";
        }
        ?>
    </div>
</section>

</body>
</html>
