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
    <link rel="stylesheet" href="AddProduct.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'?>

    <div class="container">
        <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
        <div class="product-price">RS <?php echo htmlspecialchars($product['price']); ?></div>
        <div class="product-images">
            <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img1']); ?>" alt="Product Image 1">
            <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img2']); ?>" alt="Product Image 2">
            <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img3']); ?>" alt="Product Image 3">
        </div>
        <div class="product-description">
            <h2>Description</h2>
            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        </div>
        <!-- New fields added -->
        <div class="product-details">
            <h2>Product Details</h2>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
            <p><strong>Delivery Option:</strong> <?php echo htmlspecialchars($product['delivery_option']); ?></p>
            <p><strong>Delivery Charge:</strong> <?php echo htmlspecialchars($product['delivery_charge']); ?></p>
            <p><strong>Payment Option:</strong> <?php echo htmlspecialchars($product['payment_option']); ?></p>
        </div>
        <div class="add-to-cart">Add to cart</div>
    </div>
    <script src="../script.js"></script>
</body>
</html>
