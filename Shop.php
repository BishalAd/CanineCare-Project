<?php
// shop.php

session_start();

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $img1 = $_POST['img1'];
    $quantity = 1;

    $cart_item = array(
        'product_id' => $product_id,
        'name' => $name,
        'price' => $price,
        'img1' => $img1,
        'quantity' => $quantity
    );

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $item_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity']++;
            $item_exists = true;
            break;
        }
    }

    if (!$item_exists) {
        $_SESSION['cart'][] = $cart_item;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" type="x-con" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include 'nav.php' ?>
<main class="Product-list">
    <div class="heroSection">
        <video autoplay muted loop id="video-background">
            <source src="Resources/Video2.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="black-overlay"></div>
        <div class="content">
            <p>Welcome to </p>
            <h1>CanineCare!</h1>
            <p>Your pet's health and <br>wellbeing is our top priority.</p>
        </div>
    </div>

    <?php
    // Check if user is logged in and is a business account
    if (!isset($_SESSION['id']) || (isset($_SESSION['role']) && $_SESSION['role'] != 'business')) {
        $hideButton = true;
    } else {
        $hideButton = false;
    }

    if (!$hideButton):
        echo '<a href="AddProduct.php" class="AddProductBtn"><button>Add Product</button></a>';
    endif;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "caninecare_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

    echo '<form method="GET" id="filter-form">';
    echo '<label for="filter">Filter by category:</label>';
    echo '<select name="filter" id="filter" onchange="document.getElementById(\'filter-form\').submit();">';
    echo '<option value="all"'.($filter == 'all' ? ' selected' : '').'>All</option>';
    echo '<option value="food"'.($filter == 'food' ? ' selected' : '').'>Food</option>';
    echo '<option value="accessories"'.($filter == 'accessories' ? ' selected' : '').'>Accessories</option>';
    echo '<option value="health"'.($filter == 'health' ? ' selected' : '').'>Health</option>';
    echo '<option value="toy"'.($filter == 'toy' ? ' selected' : '').'>Toy</option>';
    echo '</select>';
    echo '</form>';

    echo '<div id="products">';
    $sql = "SELECT * FROM product";
    if ($filter == 'food') {
        $sql .= " WHERE category = 'food'";
    } elseif ($filter == 'accessories') {
        $sql .= " WHERE category = 'accessories'";
    } elseif ($filter == 'health') {
        $sql .= " WHERE category = 'health'";
    } elseif ($filter == 'toy') {
        $sql .= " WHERE category = 'toy'";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $name = $row['name'];
            $price = $row['price'];
            $img1 = $row['img1'];
            $description = $row['description'];

            echo '<div class="box">';
            echo '    <div class="imgbox">';
            echo '        <img src="Product_Img_uploads/' . $img1 . '" alt="' . htmlspecialchars($name) . '" class="product-img">';
            echo '    </div>';
            echo '    <h2 class="product-title">' . htmlspecialchars($name) . '</h2><br>';
            echo '    <span class="price">RS ' . htmlspecialchars($price) . '</span>';
            echo '    <form action="shop.php" method="post">';
            echo '        <input type="hidden" name="product_id" value="' . $product_id . '">';
            echo '        <input type="hidden" name="name" value="' . htmlspecialchars($name) . '">';
            echo '        <input type="hidden" name="price" value="' . htmlspecialchars($price) . '">';
            echo '        <input type="hidden" name="img1" value="' . htmlspecialchars($img1) . '">';
            echo '        <button type="submit" name="add_to_cart" class="add-cart">Add to cart</button>';
            echo '    </form>';
            echo '    <a href="AddProductDetails.php?id=' . $product_id . '">';
            echo '        <button class="view-details">View Details</button>';
            echo '</div>';
        }
    } else {
        echo "No products found.";
    }
    echo '</div>';

    $conn->close();
    ?>
</main>
<script src="script.js"></script>
<script>
        // Get all add to cart buttons
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        // Function to handle add to cart button click
        function handleAddToCartClick(event) {
            // Check if user is logged in
            <?php if (!isset($_SESSION['id'])) : ?>
                // If not logged in, show confirmation dialog
                if (!confirm("Please log in first to add items to the cart. Do you want to log in now?")) {
                    // If user cancels, prevent default action (adding to cart)
                    event.preventDefault();
                }
            <?php endif; ?>
        }

        // Attach click event listener to all add to cart buttons
        addToCartButtons.forEach(button => {
            button.addEventListener('click', handleAddToCartClick);
        });
    </script>
</body>

</html>
