<?php
// checkout.php

session_start();
if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit; // Ensure script execution stops after redirection
}

if (isset($_POST['place_order'])) {
    // Handle the order placement logic here
    // Save order details to the database, process payment, etc.

    // For simplicity, let's just clear the cart for now
    $_SESSION['cart'] = [];
    header("Location: order_success.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'nav.php' ?>
<main class="checkout-section">
    <h1>Checkout</h1>
    <form action="checkout.php" method="post">
        <h2>Select Payment Method</h2>
        <label>
            <input type="radio" name="payment_method" value="khalti" required> Khalti
        </label>
        <label>
            <input type="radio" name="payment_method" value="esewa" required> eSewa
        </label>
        <label>
            <input type="radio" name="payment_method" value="visa" required> Visa Card
        </label>
        <label>
            <input type="radio" name="payment_method" value="cod" required> Cash on Delivery
        </label>
        <button type="submit" name="place_order">Place Order</button>
    </form>
</main>
</body>
</html>
