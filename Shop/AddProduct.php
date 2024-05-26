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

// Retrieve form data
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

// Validate input fields
if (empty($name) || empty($price) || empty($description)) {
    die("Name, price, and description are required.");
}

// Handle image uploads
$uploadDir = 'uploads/';
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
$sql = "INSERT INTO product (name, price, img1, img2, img3, description) 
        VALUES ('$name', $price, '$img1', '$img2', '$img3', '$description')";

if ($conn->query($sql) === TRUE) {
    echo '<script>';
    echo "New product created successfully";
    echo 'setTimeout(function(){ window.location.href = "../index.html"; }, 1000);';
    echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
