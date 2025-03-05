<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental | Home</title>
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
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                
                <?php if (isset($_SESSION['user'])) { ?>
                    <li><a href="booking.php">Book a Car</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                <?php } ?>

                <?php if (isset($_SESSION['admin'])) { ?>
                    <li><a href="admin.php">Admin Panel</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Rent Your Dream Car Today</h1>
        <p>Affordable and reliable car rental services.</p>
        <a href="cars.php" class="btn">View Cars</a>
    </section>

    <!-- Car Listings -->
    <section class="car-list">
        <h2>Available Cars</h2>
        <div class="car-container">
            <div class="car">
                <img src="https://media.ed.edmunds-media.com/toyota/corolla/2023/oem/2023_toyota_corolla_sedan_xse_fq_oem_1_1280.jpg" alt="Car 1">
                <h3>Toyota Corolla</h3>
                <p>$50/day</p>
                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="booking.php?car_id=1" class="btn">Rent Now</a>
                <?php } else { ?>
                    <a href="login.php" class="btn">Login to Book</a>
                <?php } ?>
            </div>
            <div class="car">
                <img src="https://hips.hearstapps.com/hmg-prod/images/2025-honda-civic-si-113-66e83d9bc4d8a.jpg?crop=0.596xw:0.671xh;0.199xw,0.257xh&resize=768:*" alt="Car 2">
                <h3>Honda Civic</h3>
                <p>$60/day</p>
                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="booking.php?car_id=2" class="btn">Rent Now</a>
                <?php } else { ?>
                    <a href="login.php" class="btn">Login to Book</a>
                <?php } ?>
            </div>
            <div class="car">
                <img src="https://www.vdm.ford.com/content/dam/na/ford/en_us/images/mustang/2025/jellybeans/Ford_Mustang_2025_100A_PYZ_88D_89W_13A_COU_64F_99H_44U_EBST_DEFAULT_EXT_4.png" alt="Car 3">
                <h3>Ford Mustang</h3>
                <p>$120/day</p>
                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="booking.php?car_id=3" class="btn">Rent Now</a>
                <?php } else { ?>
                    <a href="login.php" class="btn">Login to Book</a>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Car Rental Service | All Rights Reserved</p>
    </footer>

</body>
</html>
