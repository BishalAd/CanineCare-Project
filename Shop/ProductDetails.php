<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "caninecare_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from query string
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    die("Invalid product ID.");
}

// SQL query to retrieve product data
$sql = "SELECT * FROM product WHERE product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die("Product not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Product Details</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }
        .product-price {
            font-size: 20px;
            color: #b12704;
            margin-bottom: 10px;
        }
        .product-images {
            display: flex;
        }
        .product-images img {
            max-width: 150px;
            margin-right: 10px;
        }
        .product-description {
            margin-top: 20px;
        }
        .add-to-cart {
            background-color: #f0c14b;
            border: 1px solid #a88734;
            padding: 10px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .add-to-cart:hover {
            background-color: #e2b33c;
        }
    </style>
</head>
<body>
    <?php include  '../nav.php'?>

    <div class="container">
        <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
        <div class="product-price">RS <?php echo htmlspecialchars($product['price']); ?></div>
        <div class="product-images">
            <img src="uploads/<?php echo htmlspecialchars($product['img1']); ?>" alt="Product Image 1">
            <img src="uploads/<?php echo htmlspecialchars($product['img2']); ?>" alt="Product Image 2">
            <img src="uploads/<?php echo htmlspecialchars($product['img3']); ?>" alt="Product Image 3">
        </div>
        <div class="product-description">
            <h2>Description</h2>
            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        </div>
        <div class="add-to-cart">Add to cart</div>
    </div>
    <script src="../script.js"></script>
</body>
</html>
