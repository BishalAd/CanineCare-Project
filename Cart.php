<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart and Order Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Cart.css">
    <style>
        /* Additional CSS for hiding/showing sections */
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <?php include 'nav.php' ?>

    <div id="cart-section">
        <main class="cart-section">
            <h1>Shopping Cart</h1>
            <?php
            if (!empty($_SESSION['cart'])) {
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
                echo '<a href="#billing-details" id="order-now-button" class="order-now-button">Order Now</a>';
                echo '</div>';
                echo '</form>';
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </main>
    </div>

    <div id="order-section" class="hidden">
        <div class="Cart-container" id="billing-details">
            <div class="billing-details">
                <h2>Billing Details</h2>
                <form action="submit_order.php" method="post">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required>

                    <label for="address">Address *</label>
                    <textarea id="address" name="address" required></textarea>

                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Phone *</label>
                    <input type="tel" id="phone" name="phone" required>

                    <label for="notes">Order Notes</label>
                    <textarea id="notes" name="notes"></textarea>

                    <button type="submit">Order</button>
                </form>
            </div>
            <div class="order-summary">
                <h2>Your Order</h2>
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    $total_price = 0; // Reinitialize $total_price for order summary

                    foreach ($_SESSION['cart'] as $item) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($item['name']) . ' x ' . htmlspecialchars($item['quantity']) . '</td>';
                        echo '<td><img src="Product_Img_uploads/' . htmlspecialchars($item['img1']) . '" alt="' . htmlspecialchars($item['name']) . '"></td>';
                        echo '<td>RS ' . htmlspecialchars($item['price'] * $item['quantity']) . '</td>';
                        echo '</tr>';

                        $total_price += $item['price'] * $item['quantity'];
                    }
                    ?>
                </table>
                <div class="cart-subtotal">
                    <strong>Cart Subtotal</strong>
                    <span>RS <?php echo $total_price; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="footerPart">
        <?php include 'Footer.php'; ?>
    </div>
    <script>
        // JavaScript to handle showing/hiding sections
        document.getElementById('order-now-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            document.getElementById('cart-section').classList.add('hidden');
            document.getElementById('order-section').classList.remove('hidden');
        });
    </script>

</body>

</html>