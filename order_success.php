<?php
// order_success.php

session_start();
if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit; // Ensure script execution stops after redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'nav.php' ?>
<main class="success-section">
    <h1>Order Success</h1>
    <p>Your order has been placed successfully. Thank you for shopping with us!</p>
</main>
</body>
</html>
