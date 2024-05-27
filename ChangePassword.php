<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "caninecare_db";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if new password matches the confirm password
    if ($new_password !== $confirm_password) {
        $error_message = "New password and confirm password do not match.";
    } else {
        // Get the current user's ID from session
        $user_id = $_SESSION['id'];

        // Get the stored password for the user from the database
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            // Validate old password
            if (password_verify($old_password, $stored_password)) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $sql = "UPDATE users SET password = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $hashed_password, $user_id);

                if ($stmt->execute()) {
                    $success_message = "Password changed successfully.";
                    echo '<script>';
                    echo 'window.location.href = "index.php";';
                    echo '</script>';
                } else {
                    $error_message = "Error updating password. Please try again.";
                }
            } else {
                $error_message = "Old password is incorrect.";
            }
        } else {
            $error_message = "User not found.";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .Change_Password_container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .Change_Password_container h2 {
            text-align: center;
        }

        .change_pass {
            display: block;
            margin-bottom: 5px;
        }

        #confirm_password, #new_password, #old_password {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .change_pass_button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .change_pass_button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="Change_Password_container">
        <h2>Change Password</h2>
        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        }
        if (isset($success_message)) {
            echo "<div class='success-message'>$success_message</div>";
        }
        ?>
        <form action="" method="post">
            <label for="old_password" class="change_pass">Old Password:</label>
            <input type="password" id="old_password" name="old_password" required><br>

            <label for="new_password" class="change_pass">New Password:</label>
            <input type="password" id="new_password" name="new_password" required><br>

            <label for="confirm_password" class="change_pass">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br>

            <button type="submit" class="change_pass_button">Change Password</button>
        </form>
    </div>
</body>

</html>