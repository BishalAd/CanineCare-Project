<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Details</title>
    <link rel="stylesheet" href="style.css">
    <!-- Include additional CSS if needed -->
</head>

<body>

    <main class="container">
        <?php
        // Enable error reporting
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "caninecare_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if dog_id is set
        if (isset($_GET['dog_id']) && !empty($_GET['dog_id'])) {
            $dog_id = $_GET['dog_id'];

            // Prepare statement
            $stmt = $conn->prepare("SELECT dogs.*, users.FullName as owner_name, users.email as owner_email, users.profileImage as owner_image FROM dogs JOIN users ON dogs.user_id = users.id WHERE dogs.dog_id = ?");
            $stmt->bind_param("i", $dog_id);

            // Execute statement
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are any results
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = htmlspecialchars($row['name']);
                    $age = htmlspecialchars($row['age']);
                    $breed = htmlspecialchars($row['breed']);
                    $image = htmlspecialchars($row['image']);
                    $description = htmlspecialchars($row['description']);
                    $price = htmlspecialchars($row['price']);
                    $vaccination_status = htmlspecialchars($row['vaccination_status']);
                    $state = htmlspecialchars($row['state']);
                    $district = htmlspecialchars($row['district']);
                    $location = htmlspecialchars($row['location']);
                    $owner_name = htmlspecialchars($row['owner_name']);
                    $owner_email = htmlspecialchars($row['owner_email']);
                    $owner_image = htmlspecialchars($row['owner_image']);

                    // Display dog details and owner information
                    echo '<div class="dog-card">';
                    echo '    <div class="dog-image">';
                    echo '        <img src="' . $image . '" alt="' . $name . '">';
                    echo '    </div>';
                    echo '    <div class="dog-info">';
                    echo '        <h1>' . $name . '</h1>';
                    echo '        <p>Age: ' . $age . '</p>';
                    echo '        <p>Breed: ' . $breed . '</p>';
                    echo '        <p>Description: ' . $description . '</p>';
                    echo '        <p>Price: $' . $price . '</p>';
                    echo '        <p>Vaccination Status: ' . $vaccination_status . '</p>';
                    echo '        <p>Location: ' . $location . ', ' . $district . ', ' . $state . '</p>';
                    echo '    </div>';
                    echo '    <div class="owner-info">';
                    echo '        <h2>Owner Information</h2>';
                    echo '        <img src="' . $owner_image . '" alt="' . $owner_name . '" class="owner-image">';
                    echo '        <p>Name: ' . $owner_name . '</p>';
                    echo '        <p>Email: ' . $owner_email . '</p>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "Dog not found.";
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Invalid dog ID.";
            // Additional debug info
            echo "<br>Debug info: ";
            echo "GET parameter 'dog_id' is " . (isset($_GET['dog_id']) ? htmlspecialchars($_GET['dog_id']) : "not set");
        }

        // Close connection
        $conn->close();
        ?>
    </main>

    <script src="main.js"></script>
</body>

</html>
