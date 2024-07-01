<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Trainer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Dog Training Videos</title>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="Training-Heading">
        <h2 style="margin-top: 80px;">Our Trainers</h2>
    </div>
    <div class="TrainerContainer">

        <div class="AddTrainerCard">
            <?php if (isset($_SESSION['id'])) { ?>
                <button onclick="showForm()">Add Trainer</button>
            <?php } ?>
        </div>
        <div class="filter-section">
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
            <select name="district" class="filter-Input-box" id="filterDistrict" onchange="filterTrainers()">
                <option value="" disabled selected>Select District</option>
                <!-- District options will be populated based on state selection -->
            </select>
        </div>
        <div class="container">
            <div class="cards" id="trainerCards">
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

                $sql = "SELECT * FROM trainers";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
        <a href='TrainerDetails.php?trainer_id=" . $row["trainer_id"] . "'>
        <div class='card' data-state='" . $row["state"] . "' data-district='" . $row["district"] . "'>
            <div class='content'  style='position: static;'>
                <div class='img'>
                    <img src='trainers_img/" . $row["image"] . "' alt='" . $row["name"] . "'>
                </div>
                <div class='details'>
                    <div class='name'>" . $row["name"] . "</div>
                    <div class='training_center_name'>" . $row["training_center_name"] . "</div>
                </div>
                <div class='media-icons'>
                    <a href='" . $row["facebook"] . "' target='_blank'><i class='fab fa-facebook-f'></i></a>
                    <a href='" . $row["twitter"] . "' target='_blank'><i class='fab fa-twitter'></i></a>
                    <a href='" . $row["instagram"] . "' target='_blank'><i class='fab fa-instagram'></i></a>
                    <a href='" . $row["youtube"] . "' target='_blank'><i class='fab fa-youtube'></i></a>
                </div>
            </div>
          </div>
          </a>";
                    }
                }
                $conn->close();
                ?>
            </div>

            <div class="form-popup" id="trainerFormPopup" style="display:none;">
                <button type="button" class="close-btn" onclick="hideForm()">X</button>
                <form id="trainerForm" class="form-container" method="post" action="" enctype="multipart/form-data">
                    <h2>Add New Trainer</h2>
                    <input type="text" name="trainerName" placeholder="Trainer Name" required>
                    <input type="text" name="training_center_name" placeholder="Training Center Name" required>
                    <select name="state" id="state" onchange="populateDistricts('state', 'district')" required>
                        <option value="" disabled selected>Select State</option>
                        <option value="Province 1">Province 1</option>
                        <option value="Province 2">Province 2</option>
                        <option value="Bagmati">Bagmati</option>
                        <option value="Gandaki">Gandaki</option>
                        <option value="Lumbini">Lumbini</option>
                        <option value="Karnali">Karnali</option>
                        <option value="Sudurpashchim">Sudurpashchim</option>
                    </select>
                    <select name="district" id="district" required>
                        <option value="" disabled selected>Select District</option>
                        <!-- District options will be populated based on state selection -->
                    </select>
                    <input type="email" name="trainerEmail" placeholder="Email" required>
                    <input type="tel" name="trainerPhone" placeholder="Phone Number" required>
                    <input type="text" name="trainerAddress" placeholder="Address" required>
                    <input type="number" name="trainerExperience" placeholder="Years of Experience" required>
                    <input type="file" name="profile" id="profile" required><br>
                    <input type="url" name="trainerFacebook" placeholder="Facebook URL">
                    <input type="url" name="trainerTwitter" placeholder="Twitter URL">
                    <input type="url" name="trainerInstagram" placeholder="Instagram URL">
                    <input type="url" name="trainerYouTube" placeholder="YouTube URL">
                    <input type="file" name="experienceDocument" id="experienceDocument" required><br>
                    <textarea name="trainerDescription" placeholder="Trainer Description" required></textarea>
                    <button type="submit">Add Trainer</button>
                </form>
            </div>
        </div>

        <!-- Training Videos Section -->
        <div class="TrainingVideosSection">
            <h1>Training Videos</h1>
            <div class="video-grid">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/Zt31jNGAKz4?si=kmm7--uGorMJ-cuz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/psemvgmsI3Y?si=lxJjCraCw0GZAnNt" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/MW8X0IMVjzQ?si=s2vk6kNjY6B0j8As" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/1oDGa2yPb2g?si=JGvRkLkHFl54MlEV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/cn50qtdFzbI?si=6Ryqx3zeSsMqGOio" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/xT5zE5oiqoY?si=17K8uORhCfn2J8Z5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        $name = $_POST['trainerName'];
        $training_center_name = $_POST['training_center_name'];
        $state = $_POST['state'];
        $district = $_POST['district'];
        $email = $_POST['trainerEmail'];
        $phone = $_POST['trainerPhone'];
        $address = $_POST['trainerAddress'];
        $experience = $_POST['trainerExperience'];
        $facebook = $_POST['trainerFacebook'];
        $twitter = $_POST['trainerTwitter'];
        $instagram = $_POST['trainerInstagram'];
        $youtube = $_POST['trainerYouTube'];
        $description = $_POST['trainerDescription'];

        $profile_image = $_FILES['profile']['name'];
        $profile_image_temp = $_FILES['profile']['tmp_name'];
        move_uploaded_file($profile_image_temp, "trainers_img/$profile_image");

        $experience_document = $_FILES['experienceDocument']['name'];
        $experience_document_temp = $_FILES['experienceDocument']['tmp_name'];
        move_uploaded_file($experience_document_temp, "trainers_img/$experience_document");

        $sql = "INSERT INTO trainers (name, training_center_name, state, district, email, phone, address, experience, facebook, twitter, instagram, youtube, description, image, experience_document) 
                VALUES ('$name', '$training_center_name', '$state', '$district', '$email', '$phone', '$address', '$experience', '$facebook', '$twitter', '$instagram', '$youtube', '$description', '$profile_image', '$experience_document')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New trainer added successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        echo "<script>window.location.href='trainers.php';</script>";
    }
    ?>

    <script>
        const statesAndDistricts = {
            'Province 1': ['Bhojpur', 'Dhankuta', 'Ilam', 'Jhapa', 'Khotang', 'Morang', 'Okhaldhunga', 'Panchthar', 'Sankhuwasabha', 'Solukhumbu', 'Sunsari', 'Taplejung', 'Terhathum', 'Udayapur'],
            'Province 2': ['Bara', 'Dhanusha', 'Mahottari', 'Parsa', 'Rautahat', 'Saptari', 'Sarlahi', 'Siraha'],
            'Bagmati': ['Bhaktapur', 'Chitwan', 'Dhading', 'Dolakha', 'Kathmandu', 'Kavrepalanchok', 'Lalitpur', 'Makwanpur', 'Nuwakot', 'Ramechhap', 'Rasuwa', 'Sindhuli', 'Sindhupalchok'],
            'Gandaki': ['Baglung', 'Gorkha', 'Kaski', 'Lamjung', 'Manang', 'Mustang', 'Myagdi', 'Nawalpur', 'Parbat', 'Syangja', 'Tanahun'],
            'Lumbini': ['Arghakhanchi', 'Banke', 'Bardiya', 'Dang', 'Gulmi', 'Kapilvastu', 'Parasi', 'Palpa', 'Pyuthan', 'Rolpa', 'Rukum', 'Rupandehi'],
            'Karnali': ['Dailekh', 'Dolpa', 'Humla', 'Jajarkot', 'Jumla', 'Kalikot', 'Mugu', 'Rukum', 'Salyan', 'Surkhet'],
            'Sudurpashchim': ['Achham', 'Baitadi', 'Bajhang', 'Bajura', 'Dadeldhura', 'Darchula', 'Doti', 'Kailali', 'Kanchanpur']
        };

        function populateDistricts(stateSelectId, districtSelectId) {
            const stateSelect = document.getElementById(stateSelectId);
            const districtSelect = document.getElementById(districtSelectId);
            const selectedState = stateSelect.value;

            districtSelect.innerHTML = "<option value='' disabled selected>Select District</option>";
            if (statesAndDistricts[selectedState]) {
                statesAndDistricts[selectedState].forEach(district => {
                    const option = document.createElement("option");
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
            filterTrainers();
        }

        function filterTrainers() {
            const state = document.getElementById("filterState").value;
            const district = document.getElementById("filterDistrict").value;
            const cards = document.querySelectorAll(".card");

            cards.forEach(card => {
                const cardState = card.getAttribute("data-state");
                const cardDistrict = card.getAttribute("data-district");

                if ((state === "" || cardState === state) && (district === "" || cardDistrict === district)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        function showForm() {
            document.getElementById("trainerFormPopup").style.display = "block";
        }

        function hideForm() {
            document.getElementById("trainerFormPopup").style.display = "none";
        }

        document.getElementById("trainerForm").addEventListener("submit", function(event) {
            if (event.submitter.className !== 'close-btn') {
                event.preventDefault();
                hideForm();
                this.submit();
            }
        });
    </script>
</body>

</html>