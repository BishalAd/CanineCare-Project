<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "caninecare_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $delivery_option = $_POST['delivery_option'];
    $delivery_charge = $_POST['delivery_charge'];
    $payment_option = $_POST['payment_option'];

    // Validate input fields
    if (empty($name) || empty($price) || empty($description) || empty($category) || empty($delivery_option) || empty($delivery_charge) || empty($payment_option)) {
        die("All fields are required.");
    }

    // Handle image uploads
    $uploadDir = 'Product_Img_uploads/';
    $img1 = $img2 = $img3 = null;

    function uploadImage($fileKey, $uploadDir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $imageName = $_FILES[$fileKey]['name'];
            $imageUniqueName = uniqid() . '_' . $imageName;
            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $uploadDir . $imageUniqueName)) {
                return $imageUniqueName;
            } else {
                die("Error moving file: $fileKey");
            }
        } else {
            die("Image upload failed: $fileKey");
        }
    }

    $img1 = uploadImage('img1', $uploadDir);
    $img2 = uploadImage('img2', $uploadDir);
    $img3 = uploadImage('img3', $uploadDir);

    // Insert product data into the database
    $sql = "INSERT INTO product (name, price, img1, img2, img3, description, category, delivery_option, delivery_charge, payment_option) 
            VALUES ('$name', $price, '$img1', '$img2', '$img3', '$description', '$category', '$delivery_option', '$delivery_charge', '$payment_option')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>';
        echo "alert('New product created successfully');";
        echo 'setTimeout(function(){ window.location.href = "index.html"; }, 1000);';
        echo '</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="AddProduct.css">
</head>
<body>

<div class="form-container">
    <h2>Add New Product</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" placeholder="Enter product name" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" placeholder="Enter product price" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select category</option>
                <option value="Food">Food</option>
                <option value="Toys">Toys</option>
                <option value="Accessories">Accessories</option>
                <option value="Health">Health</option>
            </select>
        </div>
        <div class="form-group">
            <label for="delivery_option">Delivery Option</label>
            <select id="delivery_option" name="delivery_option" required>
                <option value="" disabled selected>Select delivery option</option>
                <option value="Standard">Standard</option>
                <option value="Express">Express</option>
            </select>
        </div>
        <div class="form-group">
            <label for="delivery_charge">Delivery Charge</label>
            <input type="number" id="delivery_charge" name="delivery_charge" step="0.01" placeholder="Enter delivery charge" required>
        </div>
        <div class="form-group">
            <label for="payment_option">Payment Option</label>
            <select id="payment_option" name="payment_option" required>
                <option value="" disabled selected>Select payment option</option>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select>
        </div>
        <div class="form-group">
            <label for="img1">Image 1</label>
            <input type="file" id="img1" name="img1" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="img2">Image 2</label>
            <input type="file" id="img2" name="img2" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="img3">Image 3</label>
            <input type="file" id="img3" name="img3" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter product description" required></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>

</body>
</html>
