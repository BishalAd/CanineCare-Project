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
    $user_profile = json_decode($product['user_profile'], true);
} else {
    die("Product not found.");
}

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $user_id = $_GET['id']; // Replace with the actual logged-in user ID
    $comment = $conn->real_escape_string($_POST['comment']);
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;

    $sql = "INSERT INTO comments (product_id, user_id, comment, rating, created_at) VALUES ($product_id, $user_id, '$comment', $rating, NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New comment posted successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
    </main>


    <div class="lastPart">
        <div class="you-may-also-like">
            <h2>You May Also Like</h2>
            <div class="similar-product">
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if (isset($product['category'])) {
                    $category = $product['category'];
                    $stmt = $conn->prepare("SELECT * FROM product WHERE category = ? AND product_id != ? LIMIT 3");
                    $stmt->bind_param("si", $category, $product_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $product_id_similar = $row['product_id'];
                            $name = $row['name'];
                            $price = $row['price'];
                            $img1 = isset($row['img1']) ? $row['img1'] : 'default_image_path.jpg';

                            echo '    <a class="BoxCover" href="AddProductDetails.php?id=' . $product_id . '">';
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
                            echo '        <button class="view-details">View Details</button>';
                            echo '</div>';
                            echo '</a>';
                        }
                    } else {
                        echo '<p>No similar products found.</p>';
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>

        <div class="comments-section">
            <h2>Customer Reviews</h2>
            <form action="" method="post" class="comment-form">
                <div class="star-rating">
                    <input type="radio" id="5-stars" name="rating" value="5" />
                    <label for="5-stars" class="star">&#9733;</label>
                    <input type="radio" id="4-stars" name="rating" value="4" />
                    <label for="4-stars" class="star">&#9733;</label>
                    <input type="radio" id="3-stars" name="rating" value="3" />
                    <label for="3-stars" class="star">&#9733;</label>
                    <input type="radio" id="2-stars" name="rating" value="2" />
                    <label for="2-stars" class="star">&#9733;</label>
                    <input type="radio" id="1-star" name="rating" value="1" />
                    <label for="1-star" class="star">&#9733;</label>
                </div>
                <textarea name="comment" rows="4" placeholder="Write your review here..." required></textarea>
                <button type="submit">Post Comment</button>
            </form>

            <div class="comment-list">
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT c.*, u.FullName FROM comments c JOIN users u ON c.user_id = u.id WHERE c.product_id = $product_id ORDER BY c.created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="comment">';
                        echo '    <div class="comment-header">';
                        echo '        <span>' . htmlspecialchars($row['FullName']) . '</span>';
                        echo '        <span>' . str_repeat('&#9733;', $row['rating']) . str_repeat('&#9734;', 5 - $row['rating']) . '</span>';
                        echo '    </div>';
                        echo '    <div class="comment-body">';
                        echo '        <p>' . nl2br(htmlspecialchars($row['comment'])) . '</p>';
                        echo '        <small>Posted on ' . htmlspecialchars($row['created_at']) . '</small>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No comments yet. Be the first to comment!</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        let currentImageIndex = 0;
        const images = document.querySelectorAll('.carousel-image');

        function showImage(index) {
            images[currentImageIndex].classList.remove('active');
            images[index].classList.add('active');
            currentImageIndex = index;
        }

        function prevImage() {
            const index = (currentImageIndex - 1 + images.length) % images.length;
            showImage(index);
        }

        function nextImage() {
            const index = (currentImageIndex + 1) % images.length;
            showImage(index);
        }

        function updateQuantity() {
            const quantity = document.getElementById('number').innerText;
            document.getElementById('quantity').value = quantity;
        }

        function increase() {
            const numberElement = document.getElementById('number');
            numberElement.innerText = parseInt(numberElement.innerText) + 1;
        }

        function decrease() {
            const numberElement = document.getElementById('number');
            const currentValue = parseInt(numberElement.innerText);
            if (currentValue > 1) {
                numberElement.innerText = currentValue - 1;
            }
        }
    </script>
</body>

</html>