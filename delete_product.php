<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_product'])) {
    $product_id = intval($_POST['product_id']);

    if ($product_id <= 0) {
        die("Invalid product ID.");
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "caninecare_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM product WHERE product_id = $product_id";

    if ($conn->query($sql) === TRUE) {
        header('Location: shop.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
