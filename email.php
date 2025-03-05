<?php
$to = $_SESSION['user'];
$subject = "Car Rental Booking Confirmation";
$message = "Your car booking has been confirmed. Thank you for choosing us!";
$headers = "From: noreply@carrental.com";

mail($to, $subject, $message, $headers);
?>
