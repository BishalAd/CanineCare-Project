<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "caninecare_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$FullName = trim($_POST['FullName']);
$role = $_POST['role'];
$email = trim($_POST['email']);
$newPassword = $_POST['password'];

if (empty($FullName) || empty($role) || empty($email) || empty($newPassword) || empty($_FILES['profile']['name'])) {
    die("All fields are required.");
}

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Email already exists.");
}

$target_dir = "../uploads/";
$imageFileType = strtolower(pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION));
$unique_file_name = $target_dir . uniqid() . '.' . $imageFileType;
$check = getimagesize($_FILES["profile"]["tmp_name"]);

if ($check === false) {
    die("File is not an image.");
}

if ($_FILES["profile"]["size"] > 5000000) {
    die("Sorry, your file is too large.");
}

$allowed_formats = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowed_formats)) {
    die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
}

if (!move_uploaded_file($_FILES["profile"]["tmp_name"], $unique_file_name)) {
    die("Sorry, there was an error uploading your file.");
}

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (FullName, role, email, password, profileImage) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $FullName, $role, $email, $hashedPassword, $unique_file_name);

if ($stmt->execute() === TRUE) {
    $_SESSION['id'] = $stmt->insert_id;
    $_SESSION['profile_img'] = $unique_file_name;

    echo '<script>';
    echo 'alert("Successfully signed up! Redirecting to home page...");';
    echo 'setTimeout(function(){ window.location.href = "../index.php"; }, 1000);';
    echo '</script>';
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
