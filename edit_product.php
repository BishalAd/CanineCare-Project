<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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

$sql = "SELECT * FROM product WHERE product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die("Product not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);

    $img1 = $product['img1'];
    $img2 = $product['img2'];
    $img3 = $product['img3'];

    if (!empty($_FILES['img1']['name'])) {
        $img1 = basename($_FILES['img1']['name']);
        move_uploaded_file($_FILES['img1']['tmp_name'], "Product_Img_uploads/$img1");
    }

    if (!empty($_FILES['img2']['name'])) {
        $img2 = basename($_FILES['img2']['name']);
        move_uploaded_file($_FILES['img2']['tmp_name'], "Product_Img_uploads/$img2");
    }

    if (!empty($_FILES['img3']['name'])) {
        $img3 = basename($_FILES['img3']['name']);
        move_uploaded_file($_FILES['img3']['tmp_name'], "Product_Img_uploads/$img3");
    }

    $sql = "UPDATE product SET name='$name', price=$price, description='$description', category='$category', img1='$img1', img2='$img2', img3='$img3' WHERE product_id=$product_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: AddProductDetails.php?id=$product_id");
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
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="AddProduct.css">
</head>
<style>
    /* AddProduct.css */

/* General styling */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.main {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.product-form {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
    font-size: 28px;
    color: #333;
    text-align: center;
}

form {
    display: flex;
    flex-wrap: wrap;
}

label {
    margin-bottom: 8px;
    display: block;
    width: 100%;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
textarea {
    width: calc(100% - 12px);
    padding: 8px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

textarea {
    resize: vertical;
}

input[type="file"] {
    margin-bottom: 16px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

img {
    display: block;
    margin-top: 8px;
    border-radius: 4px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

/* Responsive design */
@media screen and (max-width: 600px) {
    input[type="text"],
    input[type="number"],
    textarea,
    input[type="file"] {
        width: 100%;
    }
}

/* Navigation and footer styles can be added separately */

</style>
<body>
    <?php include 'nav.php'; ?>

    <main>
        <div class="product-form">
            <h2>Edit Product</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>

                <label for="img1">Image 1:</label>
                <input type="file" id="img1" name="img1">
                <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img1']); ?>" alt="Product Image 1" width="100">

                <label for="img2">Image 2:</label>
                <input type="file" id="img2" name="img2">
                <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img2']); ?>" alt="Product Image 2" width="100">

                <label for="img3">Image 3:</label>
                <input type="file" id="img3" name="img3">
                <img src="Product_Img_uploads/<?php echo htmlspecialchars($product['img3']); ?>" alt="Product Image 3" width="100">

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
