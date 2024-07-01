<?php
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

if (isset($_GET['trainer_id'])) {
    $trainer_id = intval($_GET['trainer_id']);
} else {
    echo "No trainer selected.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_name = $_POST['owner_name'];
    $owner_email = $_POST['owner_email'];
    $dog_name = $_POST['dog_name'];
    $dog_age = $_POST['dog_age'];
    $preferred_date = $_POST['preferred_date'];
    $additional_info = $_POST['additional_info'];
    $trainer_id = $_POST['trainer_id'];

    // Fetch trainer's center name and location
    $stmt = $conn->prepare("SELECT training_center_name FROM trainers WHERE trainer_id = ?");
    $stmt->bind_param("i", $trainer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $trainer = $result->fetch_assoc();
    $training_center_name = $trainer['training_center_name'];
    // $training_center_location = $trainer['training_center_location'];
    $stmt->close();

    // Insert booking into trainingBooking table
    $stmt = $conn->prepare("INSERT INTO trainingBooking (owner_name, owner_email, dog_name, dog_age, preferred_date, additional_info, trainer_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissi", $owner_name, $owner_email, $dog_name, $dog_age, $preferred_date, $additional_info, $trainer_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Booked Successfully! Visit our Training center ($training_center_name) on $preferred_date');
                window.location.href = 'Trainer.php';
              </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $stmt = $conn->prepare("SELECT * FROM trainers WHERE trainer_id = ?");
    $stmt->bind_param("i", $trainer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No trainer found.";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="TrainerDetails.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="profile-container">
        <div class="profile-header">
            <img src="trainers_img/<?php echo htmlspecialchars($row['image']); ?>" alt="Profile Picture">
            <div>
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p><?php echo htmlspecialchars($row['training_center_name']); ?></p>
            </div>
        </div>
        <div class="profile-body">
            <p><strong>About:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
            <p><strong>Experience:</strong> <?php echo htmlspecialchars($row['experience']); ?> years</p>
            <p><strong>Contact:</strong> <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($row['email']); ?> | <i class="fas fa-phone"></i> <?php echo htmlspecialchars($row['phone']); ?></p>
            <p><strong>Location:</strong> <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['district']) . ', ' . htmlspecialchars($row['state']); ?></p>
            <p><strong>Training Charge:</strong> <?php echo htmlspecialchars($row['price']); ?></p>
            <div class="social-links">
                <a href="<?php echo htmlspecialchars($row['facebook']); ?>"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="<?php echo htmlspecialchars($row['twitter']); ?>"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="<?php echo htmlspecialchars($row['instagram']); ?>"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="<?php echo htmlspecialchars($row['youtube']); ?>"><i class="fab fa-youtube"></i> YouTube</a>
            </div>
        </div>
        <div class="booking-form">
            <h2>Book Trainer</h2>
            <form action="" method="post">
                <label for="owner_name">Your Name:</label><br>
                <input type="text" id="owner_name" name="owner_name" required><br><br>
                <label for="owner_email">Your Email:</label><br>
                <input type="email" id="owner_email" name="owner_email" required><br><br>
                <label for="dog_name">Dog's Name:</label><br>
                <input type="text" id="dog_name" name="dog_name" required><br><br>
                <label for="dog_age">Dog's Age:</label><br>
                <input type="number" id="dog_age" name="dog_age" required><br><br>
                <label for="preferred_date">Preferred Date:</label><br>
                <input type="date" id="preferred_date" name="preferred_date" required><br><br>
                <label for="additional_info">Additional Information:</label><br>
                <textarea id="additional_info" name="additional_info" rows="4" cols="50"></textarea><br><br>
                <input type="hidden" name="trainer_id" value="<?php echo htmlspecialchars($trainer_id); ?>">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
