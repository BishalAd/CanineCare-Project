<?php
// cart.php

session_start();
if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit; // Ensure script execution stops after redirection
}

if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $index => $quantity) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
    }
}

if (isset($_POST['remove_item'])) {
    $remove_index = $_POST['remove_item'];
    array_splice($_SESSION['cart'], $remove_index, 1);
}
?>
<!DOCTYPE html>
<html lang="en">

<style>
    /* style.css */

/* Add your existing styles here */

.cart-section {
    padding: 20px;
}

.cart-section h1 {
    margin: 25px;
    text-align: center;
    margin-bottom: 20px;
}

.cart-section table {
    width: 100%;
    border-collapse: collapse;
}

.cart-section th, .cart-section td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.cart-section th {
    background-color: #f4f4f4;
}

.cart-section .cart-img {
    width: 50px;
    height: 50px;
}

.cart-section .cart-link {
    position: relative;
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

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include 'nav.php' ?>
<main class="cart-section">
    <h1>Shopping Cart</h1>
    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo '<form action="cart.php" method="post">';
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
        echo '<h2>Total: RS ' . $total_price . '</h2>';
        echo '<button type="submit" name="update_cart">Update Cart</button>';
        echo '</form>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
    ?>
</main>
</body>

</html>
