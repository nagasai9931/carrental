<?php
session_start();
include("config.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $price_per_day = mysqli_real_escape_string($conn, $_POST['price_per_day']);

    // Handle Image Upload
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Insert into database
        $query = "INSERT INTO cars (model, brand, year, price_per_day, image) 
                  VALUES ('$model', '$brand', '$year', '$price_per_day', '$image')";
        if (mysqli_query($conn, $query)) {
            $success = "✅ Car added successfully!";
        } else {
            $error = "🚨 Failed to add car: " . mysqli_error($conn);
        }
    } else {
        $error = "🚨 Image upload failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car | Car Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">CarRental - Admin</div>
    <nav>
        <ul>
            <li><a href="admin.php">Admin Panel</a></li>
            <li><a href="cars.php">View Cars</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="admin-container">
    <h2>Add a New Car</h2>

    <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="model" placeholder="Car Model (e.g., Civic)" required>
        <input type="text" name="brand" placeholder="Brand (e.g., Honda)" required>
        <input type="number" name="year" placeholder="Year (e.g., 2022)" required>
        <input type="number" name="price_per_day" placeholder="Price Per Day ($)" required>
        <input type="file" name="image" required>
        <button type="submit">Add Car</button>
    </form>
</div>

</body>
</html>
