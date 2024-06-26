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

// SQL query to retrieve product data along with user data
$sql = "
    SELECT p.*, u.FullName as user_fullname, u.email as user_email, u.profileImage as user_profile
    FROM product p
    JOIN users u ON p.created_by = u.id
    WHERE p.product_id = $product_id
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $user_profile = json_decode($product['user_profile'], true); // Assuming profile is stored as JSON
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="AddProduct.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <main>
        <div class="productInfo">
            <div class="ProductImg">
                <div class="carousel">
                    <button class="prev" onclick="prevImage()">&#10094;</button>
                    <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img1']); ?>" alt="Product Image 1" class="carousel-image active">
                    <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img2']); ?>" alt="Product Image 2" class="carousel-image">
                    <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img3']); ?>" alt="Product Image 3" class="carousel-image">
                    <button class="next" onclick="nextImage()">&#10095;</button>
                </div>
            </div>
            <div class="ProductInfo">
                <div class="Title-Price">
                    <h2><?php echo htmlspecialchars($product['category']); ?></h2>
                    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                    <h2> Rs. <?php echo htmlspecialchars($product['price']); ?></h2>
                </div>
                <div class="counter-box">
                    <button class="count" onclick="increase()">+</button>
                    <span id="number">1</span>
                    <button class="count" onclick="decrease()">-</button>
                </div>
                <form action="cart_actions.php" method="post" class="add-to-cart-form" onsubmit="updateQuantity()">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantity" id="quantity" value="1">
                    <button type="submit" name="add_to_cart" class="AddToCart">Add To Cart</button>
                </form>
                <div class="product-Description">
                    <h2>Product Details</h2>
                    <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                </div>
            </div>
        </div>

        <div class="businessInfo">
            <div class="PostInfo">
                <h2>Business Information</h2>
                <h3><i class="fas fa-user"></i> Name: <?php echo htmlspecialchars($product['user_fullname']); ?></h3>
                <h3><i class="fas fa-envelope"></i> Email: <?php echo htmlspecialchars($product['user_email']); ?></h3>
            </div>
        </div>

        <h2>Product Rating</h2>
        <div class="rating">
            <input type="radio" name="star" id="star1"><label for="star1">&#9733;</label>
            <input type="radio" name="star" id="star2"><label for="star2">&#9733;</label>
            <input type="radio" name="star" id="star3"><label for="star3">&#9733;</label>
            <input type="radio" name="star" id="star4"><label for="star4">&#9733;</label>
            <input type="radio" name="star" id="star5"><label for="star5">&#9733;</label>
        </div>

        <h2>Leave a Comment</h2>
        <div class="comment-section">
            <textarea placeholder="Write your comment here..."></textarea>
            <button type="button">Submit Comment</button>
        </div>

        <h2>Comments</h2>
        <div class="comments-display">
            <div class="comment">
                <p><strong>John Doe:</strong> Great product! Highly recommend.</p>
                <span class="comment-time">2 hours ago</span>
            </div>
            <div class="comment">
                <p><strong>Jane Smith:</strong> Not satisfied with the quality.</p>
                <span class="comment-time">1 day ago</span>
            </div>
        </div>
    </main>

    <script>
        let currentNumber = 1;

        function increase() {
            currentNumber++;
            document.getElementById('number').textContent = currentNumber;
        }

        function decrease() {
            if (currentNumber > 1) {
                currentNumber--;
                document.getElementById('number').textContent = currentNumber;
            }
        }

        function updateQuantity() {
            document.getElementById('quantity').value = currentNumber;
        }

        // Carousel functionality
        let currentIndex = 0;
        const images = document.querySelectorAll('.carousel-image');

        function showImage(index) {
            images.forEach((img, i) => {
                img.classList.toggle('active', i === index);
            });
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }
    </script>
</body>
</html>
