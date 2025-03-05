<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $email;
            header("Location: cars.php");
            exit();
        } else {
            $error = "🚨 Invalid email or password!";
        }
    } else {
        $error = "🚨 Invalid email or password!";
    }
}

// Show success message from signup
if (isset($_SESSION['signup_success'])) {
    $success = $_SESSION['signup_success'];
    unset($_SESSION['signup_success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Car Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">CarRental</div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php" class="active">Login</a></li>
        </ul>
    </nav>
</header>

<div class="login-container">
    <h2>Login</h2>
    
    <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>

    <p>New customer? <a href="signup.php" class="btn-secondary">Sign Up</a></p>
</div>

</body>
</html>
