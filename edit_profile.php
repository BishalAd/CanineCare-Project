<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profile</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        background-color: #fff;
        padding: 20px;
        margin: 20px auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 5px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .error {
        color: red;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Edit Profile</h2>
    
    <?php
    // Define variables and initialize with empty values
    $fullName = $email = $phone = "";
    $fullNameErr = $emailErr = $phoneErr = "";

    // Process form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate Full Name
        if (empty($_POST["fullName"])) {
            $fullNameErr = "Full Name is required";
        } else {
            $fullName = test_input($_POST["fullName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fullName)) {
                $fullNameErr = "Only letters and white space allowed";
            }
        }

        // Validate email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Validate phone number
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone number is required";
        } else {
            $phone = test_input($_POST["phone"]);
            // check if phone number is well-formed
            if (!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $phone)) {
                $phoneErr = "Invalid phone number format. Use xxx-xxxx-xxxx";
            }
        }

        // If no errors, proceed to update database
        if (empty($fullNameErr) && empty($emailErr) && empty($phoneErr)) {
            // Placeholder for database update
            echo "<div class='success'>Profile updated successfully!</div>";
        }
    }

    // Function to sanitize and validate input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" value="<?php echo $fullName;?>">
        <span class="error"><?php echo $fullNameErr;?></span>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email;?>">
        <span class="error"><?php echo $emailErr;?></span>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone;?>">
        <span class="error"><?php echo $phoneErr;?></span>

        <label for="profileImage">Profile Image:</label>
        <input type="file" id="profileImage" name="profileImage">

        <input type="submit" value="Save Changes">
    </form>
</div>

</body>
</html>
