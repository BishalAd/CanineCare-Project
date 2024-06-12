<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CanineCare: Adopt a Dog</title>
    <link rel="shortcut icon" type="x-con" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="AdoptSection.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <main class="AdoptSection">
        <div class="heroSection">
            <video autoplay muted loop id="video-background">
                <source src="Resources/Video4.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="black-overlay"></div>
            <div class="content">
                <p>Welcome to </p>
                <h1>CanineCare!</h1>
                <p>Your pet's health and wellbeing is our top priority.</p>
            </div>
        </div>
        <div class="Add-Dogs">
            <button onclick="showForm()">Add Dogs</button>
        </div>
        <h1 class="AdoptTitle">Adopt a Dog</h1>
        <div class="cards-container">
            <?php
            // Enable error reporting
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

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

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $dogName = $_POST['dogName'];
                $dogAge = $_POST['dogAge'];
                $dogBreed = $_POST['dogBreed'];
                $dogDescription = $_POST['dogDescription'];
                $dogPrice = $_POST['dogPrice'];
                $dogVaccinationStatus = $_POST['dogVaccinationStatus'];
                $dogLocation = $_POST['dogLocation'];

                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["dogImage"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is an actual image or fake image
                $check = getimagesize($_FILES["dogImage"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["dogImage"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["dogImage"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["dogImage"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }

                if ($uploadOk == 1) {
                    $stmt = $conn->prepare("INSERT INTO dogs (name, age, breed, image, description, price, vaccination_status, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    if ($stmt === false) {
                        die("Prepare failed: " . htmlspecialchars($conn->error));
                    }
                    $stmt->bind_param("sisssdss", $dogName, $dogAge, $dogBreed, $target_file, $dogDescription, $dogPrice, $dogVaccinationStatus, $dogLocation);

                    if ($stmt->execute()) {
                        echo "New dog record created successfully";
                        header("Location: AdoptSection.php"); 
                        exit();
                    } else {
                        echo "Error: " . htmlspecialchars($stmt->error);
                    }

                    $stmt->close();
                }
            }

            $sql = "SELECT * FROM dogs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dog_id = $row['dog_id'];
                    $name = $row['name'];
                    $age = $row['age'];
                    $breed = $row['breed'];
                    $img1 = isset($row['image']) ? $row['image'] : 'default_image_path.jpg';
                    $description = $row['description'];

                    echo '<div class="card">';
                    echo '    <div class="card-image">';
                    echo '        <img src="' . htmlspecialchars($img1) . '" alt="' . htmlspecialchars($name) . '">';
                    echo '    </div>';
                    echo '    <div class="card-content">';
                    echo '        <h2>' . htmlspecialchars($name) . '</h2>';
                    echo '        <p>Age: ' . htmlspecialchars($age) . '</p>';
                    echo '        <p>Breed: ' . htmlspecialchars($breed) . '</p>';
                    echo '        <p>' . htmlspecialchars($description) . '</p>';
                    echo '        <button class="adopt-btn">Adopt Me</button>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "No dogs available for adoption.";
            }
            $conn->close();
            ?>
        </div>
        <div class="form-popup" id="trainerFormPopup">
            <form id="dogSellingForm" class="form-container" method="post" action="" enctype="multipart/form-data">
                <button type="button" class="close-btn" onclick="hideForm()">X</button>
                <h2>Add New Dog for Sale</h2>
                <input type="text" name="dogName" placeholder="Dog Name" required>
                <input type="number" name="dogAge" placeholder="Age (in years)" required>
                <input type="text" name="dogBreed" placeholder="Breed" required>
                <input type="file" name="dogImage" id="dogImage" required><br>
                <textarea name="dogDescription" placeholder="Description" rows="4" required></textarea>
                <input type="number" name="dogPrice" placeholder="Price (in USD)" required>
                <input type="text" name="dogVaccinationStatus" placeholder="Vaccination Status (e.g., Fully vaccinated)" required>
                <input type="text" name="dogLocation" placeholder="Location (City, State)" required>
                <button type="submit">Add Dog</button>
            </form>
        </div>
    </main>
    <script src="script.js"></script>
    <script>
        function showForm() {
            document.getElementById("trainerFormPopup").style.display = "block";
        }

        function hideForm() {
            document.getElementById("trainerFormPopup").style.display = "none";
        }

        document.getElementById("dogSellingForm").addEventListener("submit", function(event) {
            if (event.submitter.className !== 'close-btn') {
                event.preventDefault();
                hideForm();
                this.submit();
            }
        });
    </script>
</body>

</html>
