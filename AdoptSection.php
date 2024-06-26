<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CanineCare: Adopt a Dog</title>
    <link rel="shortcut icon" type="image/x-icon" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="AdoptSection.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $user_id = $_SESSION['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        // Collect form data
        $dogName = $_POST['dogName'];
        $dogAge = $_POST['dogAge'];
        $dogBreed = $_POST['dogBreed'];
        $dogDescription = $_POST['dogDescription'];
        $dogPrice = $_POST['dogPrice'];
        $dogVaccinationStatus = $_POST['dogVaccinationStatus'];
        $dogState = $_POST['dogState'];
        $dogDistrict = $_POST['dogDistrict'];
        $location = $_POST['dogLocation'];
        $gender = $_POST['dogGender'];
        $AgeType = $_POST['AgeType'];

        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["dogImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["dogImage"]["tmp_name"], $target_file)) {
            // File is uploaded successfully
            $imagePath = $target_file;

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO dogs (name, age, breed, image, description, price, vaccination_status, state, district, location, user_id, gender, AgeType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                // Error handling for prepare statement
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $stmt->bind_param("sisssisssssss", $dogName, $dogAge, $dogBreed, $imagePath, $dogDescription, $dogPrice, $dogVaccinationStatus, $dogState, $dogDistrict, $location, $user_id, $gender, $AgeType);

            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        $conn->close();
    }
    ?>

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
            <?php if (isset($_SESSION['id'])) { ?>
                <button onclick="showForm()">Add Dogs</button>
           <?php } ?>
        </div>
        <h1 class="AdoptTitle">Adopt a Dog</h1>
        <div class="filter-section">
            <h2>Filter Dogs</h2>
            <form method="GET" action="" class="horizontal-form">
                <select name="state" class="filter-Input-box" id="filterState" onchange="populateDistricts('filterState', 'filterDistrict')">
                    <option value="" disabled selected>Select State</option>
                    <option value="Province 1">Province 1</option>
                    <option value="Province 2">Province 2</option>
                    <option value="Bagmati">Bagmati</option>
                    <option value="Gandaki">Gandaki</option>
                    <option value="Lumbini">Lumbini</option>
                    <option value="Karnali">Karnali</option>
                    <option value="Sudurpashchim">Sudurpashchim</option>
                </select>
                <select name="district" class="filter-Input-box" id="filterDistrict">
                    <option value="" disabled selected>Select District</option>
                    <!-- District options will be populated based on state selection -->
                </select>
                <label for="age">Age:</label>
                <select name="age" id="age" class="filter-Input-box">
                    <option value="">Select Age</option>
                    <option value="puppy">Puppy</option>
                    <option value="young">Young</option>
                    <option value="adult">Adult</option>
                    <option value="senior">Senior</option>
                </select>

                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="filter-Input-box">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>

                <h3>Breed:</h3>
                <div class="checkbox-group">
                    <input type="checkbox" id="labrador" name="breed[]" value="labrador">
                    <label for="labrador">Labrador Retriever</label><br>

                    <input type="checkbox" id="poodle" name="breed[]" value="poodle">
                    <label for="poodle">Poodle</label><br>

                    <input type="checkbox" id="bulldog" name="breed[]" value="bulldog">
                    <label for="bulldog">Bulldog</label><br>

                    <input type="checkbox" id="terrier" name="breed[]" value="terrier">
                    <label for="terrier">Terrier</label><br>

                    <input type="checkbox" id="golden" name="breed[]" value="golden">
                    <label for="golden">Golden Retriever</label><br>

                    <input type="checkbox" id="boxer" name="breed[]" value="boxer">
                    <label for="boxer">Boxer</label><br>

                    <input type="checkbox" id="beagle" name="breed[]" value="beagle">
                    <label for="beagle">Beagle</label><br>

                    <input type="checkbox" id="dachshund" name="breed[]" value="dachshund">
                    <label for="dachshund">Dachshund</label><br>

                    <input type="checkbox" id="husky" name="breed[]" value="husky">
                    <label for="husky">Siberian Husky</label><br>

                    <input type="checkbox" id="rottweiler" name="breed[]" value="rottweiler">
                    <label for="rottweiler">Rottweiler</label><br>

                    <input type="checkbox" id="chihuahua" name="breed[]" value="chihuahua">
                    <label for="chihuahua">Chihuahua</label><br>

                    <input type="checkbox" id="pug" name="breed[]" value="pug">
                    <label for="pug">Pug</label><br>

                    <input type="checkbox" id="germanshepherd" name="breed[]" value="germanshepherd">
                    <label for="germanshepherd">German Shepherd</label><br>

                    <input type="checkbox" id="rottweiler" name="breed[]" value="rottweiler">
                    <label for="rottweiler">Rottweiler</label><br>

                    <input type="checkbox" id="doberman" name="breed[]" value="doberman">
                    <label for="doberman">Doberman</label><br>

                    <input type="checkbox" id="mastiff" name="breed[]" value="mastiff">
                    <label for="mastiff">Mastiff</label><br>

                    <input type="checkbox" id="greatdane" name="breed[]" value="greatdane">
                    <label for="greatdane">Great Dane</label><br>

                    <input type="checkbox" id="boxer" name="breed[]" value="boxer">
                    <label for="boxer">Boxer</label><br>

                    <input type="checkbox" id="others" name="breed[]" value="boxer">
                    <label for="others">Others</label><br>

                    <!-- Add more breeds as needed -->

                </div>

                <button type="submit">Apply Filters</button>
            </form>
        </div>
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

            $sql = "SELECT * FROM dogs WHERE 1=1";

            // Add filters to query
            if (!empty($_GET['state'])) {
                $state = $conn->real_escape_string($_GET['state']);
                $sql .= " AND state = '$state'";
            }

            if (!empty($_GET['district'])) {
                $district = $conn->real_escape_string($_GET['district']);
                $sql .= " AND district = '$district'";
            }

            if (!empty($_GET['age'])) {
                $age = $conn->real_escape_string($_GET['age']);
                $sql .= " AND AgeType = '$age'";
            }

            if (!empty($_GET['gender'])) {
                $gender = $conn->real_escape_string($_GET['gender']);
                $sql .= " AND gender = '$gender'";
            }

            if (!empty($_GET['breed'])) {
                $breeds = $_GET['breed'];
                $breedQuery = implode("','", array_map('mysqli_real_escape_string', array_fill(0, count($breeds), $conn), $breeds));
                $sql .= " AND breed IN ('$breedQuery')";
            }

            // Execute query
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dog_id = $row['dog_id'];
                    $name = $row['name'];
                    $age = $row['age'];
                    $breed = $row['breed'];
                    $img1 = isset($row['image']) ? $row['image'] : 'default_image_path.jpg';
                    $location = $row['location'];

                    echo '<div class="card">';
                    echo '    <div class="card-image">';
                    echo '        <img src="' . htmlspecialchars($img1) . '" alt="Dog image">';
                    echo '    </div>';
                    echo '    <div class="card-content">';
                    echo '        <h3>' . htmlspecialchars($name) . '</h3>';
                    echo '        <p>Breed: ' . htmlspecialchars($breed) . '</p>';
                    echo '        <p>Age: ' . htmlspecialchars($age) . '</p>';
                    echo '        <p>Location: ' . htmlspecialchars($location) . '</p>';
                    echo '        <a href="dogdetails.php?dog_id=' . urlencode($dog_id) . '" class="details-button">View Details</a>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="no-dogs-message">No dogs found.</p>';
            }

            // $stmt->close();
            $conn->close();
            ?>
        </div>

        <div id="form-container" class="form-popup" style="display:none;">
            <form class="form-container" action="adoptsection.php" method="POST" enctype="multipart/form-data">
                <button type="button" class="close-btn" onclick="showForm()">X</button>
                <h2>Add New Dog for Sale</h2>
                <input type="text" name="dogName" placeholder="Dog Name" required>
                <label for="dogGender">Gender:</label>
                <div id="dogGender">
                    <input type="radio" id="male" name="dogGender" value="Male" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="dogGender" value="Female">
                    <label for="female">Female</label>
                </div>
                <select name="AgeType" id="AgeType" require>
                    <option value="" disabled selected>Age Type</option>
                    <option value="Puppy">Puppy</option>
                    <option value="Young">Young</option>
                    <option value="Adult">Adult</option>
                    <option value="Senior">Senior</option>
                </select>
                <input type="number" name="dogAge" placeholder="Age (in years)" required>
                <!-- <input type="text" name="dogBreed" placeholder="Breed" required> -->
                <select name="dogBreed" id="dogBreed" require>
                    <option value="" disabled selected>Dog Breed</option>
                    <option value="Labrador Retriever">Labrador Retriever</option>
                    <option value="Poodle">Poodle</option>
                    <option value="Bulldog">Bulldog</option>
                    <option value="Terrier">Terrier</option>
                    <option value="Golden Retriever">Golden Retriever</option>
                    <option value="Boxer">Boxer</option>
                    <option value="Beagle">Beagle</option>
                    <option value="Dachshund">Dachshund</option>
                    <option value="Siberian Husky">Siberian Husky</option>
                    <option value="Rottweiler">Rottweiler</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Pug">Pug</option>
                    <option value="German Shepherd">German Shepherd</option>
                    <option value="Doberman">Doberman</option>
                    <option value="Mastiff">Mastiff</option>
                    <option value="Great Dane">Great Dane</option>
                    <option value="Boxer">Boxer</option>
                    <option value="others">Others</option>
                </select>
                <input type="file" name="dogImage" id="dogImage" required><br>
                <textarea name="dogDescription" placeholder="Description" rows="4" required></textarea>
                <input type="number" name="dogPrice" placeholder="Price (in USD)" required>
                <input type="text" name="dogVaccinationStatus" placeholder="Vaccination Status (e.g., Fully vaccinated)" required>

                <label for="dogState">State:</label>
                <select id="dogState" name="dogState" onchange="populateDistricts('dogState', 'dogDistrict')" required>
                    <option value="" disabled selected>Select State</option>
                    <option value="Province 1">Province 1</option>
                    <option value="Province 2">Province 2</option>
                    <option value="Bagmati">Bagmati</option>
                    <option value="Gandaki">Gandaki</option>
                    <option value="Lumbini">Lumbini</option>
                    <option value="Karnali">Karnali</option>
                    <option value="Sudurpashchim">Sudurpashchim</option>
                </select>

                <label for="dogDistrict">District:</label>
                <select id="dogDistrict" name="dogDistrict" required>
                    <option value="" disabled selected>Select District</option>
                    <!-- District options will be populated based on state selection -->
                </select>

                <input type="text" name="dogLocation" placeholder="Location (Local Address, City)" required>
                <button type="submit">Add Dog</button>
            </form>
        </div>
        <?php include  'Footer.php' ?>
        <script>
            function showForm() {
                var formContainer = document.getElementById('form-container');
                if (formContainer.style.display === 'none') {
                    formContainer.style.display = 'block';
                } else {
                    formContainer.style.display = 'none';
                }
            }

            function populateDistricts(stateId, districtId) {
                var stateElement = document.getElementById(stateId);
                var districtElement = document.getElementById(districtId);

                var districts = {
                    'Province 1': ['Bhojpur', 'Dhankuta', 'Ilam', 'Jhapa', 'Khotang', 'Morang', 'Okhaldhunga', 'Panchthar', 'Sankhuwasabha', 'Solukhumbu', 'Sunsari', 'Taplejung', 'Terhathum', 'Udayapur'],
                    'Province 2': ['Bara', 'Dhanusha', 'Mahottari', 'Parsa', 'Rautahat', 'Saptari', 'Sarlahi', 'Siraha'],
                    'Bagmati': ['Bhaktapur', 'Chitwan', 'Dhading', 'Dolakha', 'Kathmandu', 'Kavrepalanchok', 'Lalitpur', 'Makwanpur', 'Nuwakot', 'Ramechhap', 'Rasuwa', 'Sindhuli', 'Sindhupalchok'],
                    'Gandaki': ['Baglung', 'Gorkha', 'Kaski', 'Lamjung', 'Manang', 'Mustang', 'Myagdi', 'Nawalpur', 'Parbat', 'Syangja', 'Tanahun'],
                    'Lumbini': ['Arghakhanchi', 'Banke', 'Bardiya', 'Dang', 'Gulmi', 'Kapilvastu', 'Parasi', 'Palpa', 'Pyuthan', 'Rolpa', 'Rukum', 'Rupandehi'],
                    'Karnali': ['Dailekh', 'Dolpa', 'Humla', 'Jajarkot', 'Jumla', 'Kalikot', 'Mugu', 'Rukum', 'Salyan', 'Surkhet'],
                    'Sudurpashchim': ['Achham', 'Baitadi', 'Bajhang', 'Bajura', 'Dadeldhura', 'Darchula', 'Doti', 'Kailali', 'Kanchanpur']
                };

                var selectedState = stateElement.value;
                var options = districts[selectedState] || [];

                // Clear previous options
                districtElement.innerHTML = '<option value="" disabled selected>Select District</option>';

                // Add new options
                options.forEach(function(district) {
                    var option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    districtElement.appendChild(option);
                });
            }

            document.getElementById("AddDogForm").addEventListener("submit", function(event) {
                if (event.submitter.className !== 'close-btn') {
                    event.preventDefault();
                    hideForm();
                    this.submit();
                }
            });
        </script>
    </main>
</body>

</html>