<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" type="x-con" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="AddProduct.css"> -->
</head>

<body>
<?php include 'nav.php'?>
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
        <a href="AddProduct.php"><button>Add Product</button></a>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "caninecare_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        echo '<div id="products">';
        // SQL query to retrieve product data
        $sql = "SELECT * FROM product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product_id = $row['product_id'];
                $name = $row['name'];
                $price = $row['price'];
                $img1 = $row['img1'];
                $description = $row['description'];

                // HTML structure for displaying product
                echo '<div class="box">';
                echo '    <div class="imgbox">';
                echo '        <img src="Product_Img_uploads/' . $img1 . '" alt="' . htmlspecialchars($name) . '" class="product-img">';
                echo '    </div>';
                echo '    <h2 class="product-title">' . htmlspecialchars($name) . '</h2><br>';
                echo '    <span class="price">RS ' . htmlspecialchars($price) . '</span>';
                echo '    <button class="add-cart">Add to cart</button>';
                echo '    <a href="AddProductDetails.php?id=' . $product_id . '">';
                echo '        <button class="view-details">View Details</button>';
                echo '    </a>';
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
</body>

</html>