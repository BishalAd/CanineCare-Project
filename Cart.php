<?php
// cart.php

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
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* style.css */

/* Base styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

nav {
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
}

nav a {
    color: white;
    margin: 0 15px;
    text-decoration: none;
}

.cart-section {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.cart-section h1 {
    text-align: center;
    margin-bottom: 20px;
}

.cart-section table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.cart-section th, .cart-section td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

.cart-section th {
    background-color: #f4f4f4;
}

.cart-section .cart-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
}

.cart-section .cart-count {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 5px;
    font-size: 12px;
}

.cart-section .cart-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-section .cart-buttons button {
    padding: 10px 20px;
    border: none;
    background-color: #333;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

.cart-section .cart-buttons button:hover {
    background-color: #555;
}

.cart-section .total-price {
    text-align: right;
    font-size: 1.2em;
    margin-bottom: 20px;
}

</style>
<body>
<?php include 'nav.php' ?>
<main class="cart-section">
    <h1>Shopping Cart</h1>
    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo '<form action="cart_actions.php" method="post">';
        echo '<table>';
        echo '<tr><th>Image</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr>';

        $total_price = 0;
        foreach ($_SESSION['cart'] as $index => $item) {
            $total_price += $item['price'] * $item['quantity'];
            echo '<tr>';
            echo '<td><img src="Product_Img_uploads/' . htmlspecialchars($item['img1']) . '" alt="' . htmlspecialchars($item['name']) . '" class="cart-img"></td>';
            echo '<td>' . htmlspecialchars($item['name']) . '</td>';
            echo '<td>RS ' . htmlspecialchars($item['price']) . '</td>';
            echo '<td><input type="number" name="quantity[' . $index . ']" value="' . htmlspecialchars($item['quantity']) . '" min="1"></td>';
            echo '<td>RS ' . htmlspecialchars($item['price'] * $item['quantity']) . '</td>';
            echo '<td><button type="submit" name="remove_item" value="' . $index . '">Remove</button></td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '<div class="total-price">Total: RS ' . $total_price . '</div>';
        echo '<div class="cart-buttons">';
        echo '<button type="submit" name="update_cart">Update Cart</button>';
        echo '<a href="check_out.php" class="order-now-button">Order Now</a>';
        echo '</div>';
        echo '</form>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
    ?>
</main>
</body>
</html>
