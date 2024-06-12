<?php
session_start();

if (!isset($_SESSION['id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];
        $product_quantity = 1;

        $item = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'img1' => $product_img,
            'quantity' => $product_quantity
        ];

        $_SESSION['cart'][] = $item;
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

    header("Location: cart.php");
    exit;
}
?>
