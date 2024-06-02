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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
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
                echo 'window.location.href = "index.php";';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'alert("Invalid email or password.");';
                echo 'window.location.href = "login.php";';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'alert("Invalid email or password.");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
        }

        $stmt->close();
    } elseif (isset($_POST['signup'])) {
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
            echo '<script>';
            echo 'alert("Email already exists.");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
        }

        $target_dir = "Profile_uploads/";
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

        // Check for file upload errors
        if ($_FILES["profile"]["error"] != UPLOAD_ERR_OK) {
            die("File upload error: " . $_FILES["profile"]["error"]);
        }

        // Ensure the target directory exists
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                die("Failed to create target directory.");
            }
        }

        // Attempt to move the uploaded file
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
            echo 'setTimeout(function(){ window.location.href = "index.php"; }, 1000);';
            echo '</script>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Canine Care | Login/Registration</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <button class="close-btn">X</button>
            <form action="" method="POST" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <label for="FullName">Full Name</label>
                <input type="text" placeholder="Full Name" name="FullName" id="FullName" required>
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="User">User</option>
                    <option value="Trainer">Trainer</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Business">Saller</option>
                    <option value="Other">Other</option>
                </select>
                <label for="email">Email</label>
                <input type="email" placeholder="Email" name="email" id="email" required>
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" id="password" required>
                <label for="profile">Profile Image</label>
                <input type="file" name="profile" id="profile" accept="image/*" required><br>
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <button class="close-btn">X</button>
            <form action="" method="POST">
                <h1>Sign In</h1>
                <label for="email">Email</label>
                <input type="email" placeholder="Email" name="email" id="email">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" id="password">
                <a href="#">Forget Your Password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('register').addEventListener('click', () => {
            document.getElementById('container').classList.add('active');
        });

        document.getElementById('login').addEventListener('click', () => {
            document.getElementById('container').classList.remove('active');
        });

        document.querySelectorAll('.close-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('container').classList.remove('active');
            });
        });
    </script>
</body>

</html>