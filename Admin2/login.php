<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header('Location: dashboard.php');
    } else {
        $error = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* styles.css */

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 50%, #FF0099 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .input-container input {
            width: 90%;
            padding: 15px 15px 15px 40px;
            /* Adjusted padding */
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            outline: none;
            transition: border 0.3s;
            background: #f9f9f9;
            /* Added background color */
        }

        .input-container input:focus {
            border: 1px solid #6B73FF;
        }

        .input-container i {
            position: absolute;
            left: 15px;
            /* Adjusted position */
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 50%, #FF0099 100%);
            border: none;
            border-radius: 25px;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        button:hover {
            transform: translateY(-3px);
        }

        p {
            color: #d9534f;
            font-size: 14px;
            margin-top: 20px;
        }

        .forgot-password {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #888;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #000DFF;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Admin <br>Login</h1>
        <form method="post">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Type your username" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Type your password" required>
            </div>
            <a href="#" class="forgot-password">Forgot password?</a>
            <button type="submit">LOGIN</button>
            <?php if (isset($error)) {
                echo "<p>$error</p>";
            } ?>
        </form>
    </div>
</body>

</html>