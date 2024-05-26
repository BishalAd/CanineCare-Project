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

$email = trim($_POST['email']);
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    die("Email and password are required.");
}

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['profile_img'] = $user['profileImage'];
        
        echo '<script>';
        echo 'alert("Login successful!");';
        echo 'window.location.href = "../index.php";';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Invalid email or password.");';
        echo 'window.location.href = "login.html";';
        echo '</script>';
    }
} else {
    echo '<script>';
    echo 'alert("Invalid email or password.");';
    echo 'window.location.href = "login.html";';
    echo '</script>';
}

$stmt->close();
$conn->close();
?>
