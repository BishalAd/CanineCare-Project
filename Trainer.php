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
    <div class="TrainerContainer">
        <div class="Training-Heading">
            <h1>Trainer</h1>
        </div>
        <div class="AddTrainerCard">
            <button onclick="showForm()">Add Trainer</button>
        </div>
        <div class="filter-section">
            <select id="filterState" onchange="filterTrainers()">
                <option value="">Select State</option>
                <option value="State1">State1</option>
                <option value="State2">State2</option>
            </select>
            <select id="filterDistrict" onchange="filterTrainers()">
                <option value="">Select District</option>
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
                        echo "<div class='card' data-state='" . $row["state"] . "' data-district='" . $row["district"] . "'>
                            <div class='content' style='position: relative'>
                                <div class='img'>
                                    <img src='" . $row["image"] . "' alt='" . $row["name"] . "'>
                                </div>
                                <div class='details'>
                                    <div class='name'>" . $row["name"] . "</div>
                                    <div class='job'>" . $row["job"] . "</div>
                                </div>
                                <div class='media-icons'>
                                    <a href='" . $row["facebook"] . "' target='_blank'><i class='fab fa-facebook-f'></i></a>
                                    <a href='" . $row["twitter"] . "' target='_blank'><i class='fab fa-twitter'></i></a>
                                    <a href='" . $row["instagram"] . "' target='_blank'><i class='fab fa-instagram'></i></a>
                                    <a href='" . $row["youtube"] . "' target='_blank'><i class='fab fa-youtube'></i></a>
                                </div>
                            </div>
                          </div>";
                    }
                }
                $conn->close();
                ?>
            </div>

            <div class="form-popup" id="trainerFormPopup">
                <form id="trainerForm" class="form-container" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <button type="button" class="close-btn" onclick="hideForm()">X</button>
                    <h2>Add New Trainer</h2>
                    <input type="text" name="trainerName" placeholder="Trainer Name" required>
                    <input type="text" name="trainerJob" placeholder="Job Title" required>
                    <select name="state" id="state" required>
                        <option value="">Select State</option>
                        <option value="State1">State1</option>
                        <option value="State2">State2</option>
                    </select>
                    <select name="district" id="district" required>
                        <option value="">Select District</option>
                    </select>
                    <input type="file" name="profile" id="profile" required><br>
                    <input type="url" name="trainerFacebook" placeholder="Facebook URL">
                    <input type="url" name="trainerTwitter" placeholder="Twitter URL">
                    <input type="url" name="trainerInstagram" placeholder="Instagram URL">
                    <input type="url" name="trainerYouTube" placeholder="YouTube URL">
                    <button type="submit">Add Trainer</button>
                </form>
            </div>
        </div>

        <!-- Training Videos Section -->
        <div class="TrainingVideosSection">
            <h2>Training Videos</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/Zt31jNGAKz4?si=kmm7--uGorMJ-cuz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/psemvgmsI3Y?si=lxJjCraCw0GZAnNt" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/MW8X0IMVjzQ?si=s2vk6kNjY6B0j8As" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/1oDGa2yPb2g?si=JGvRkLkHFl54MlEV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/cn50qtdFzbI?si=6Ryqx3zeSsMqGOio" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/xT5zE5oiqoY?si=17K8uORhCfn2J8Z5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>

    <script>
        function showForm() {
            document.getElementById("trainerFormPopup").style.display = "block";
        }

        function hideForm() {
            document.getElementById("trainerFormPopup").style.display = "none";
        }

        document.getElementById("state").addEventListener("change", function () {
            const state = this.value;
            const districtSelect = document.getElementById("district");
            districtSelect.innerHTML = "<option value=''>Select District</option>"; // Clear existing options

            if (state === "State1") {
                districtSelect.innerHTML += "<option value='District1'>District1</option>";
                districtSelect.innerHTML += "<option value='District2'>District2</option>";
            } else if (state === "State2") {
                districtSelect.innerHTML += "<option value='District3'>District3</option>";
                districtSelect.innerHTML += "<option value='District4'>District4'></option>";
            }
        });

        document.getElementById("filterState").addEventListener("change", function () {
            const state = this.value;
            const districtSelect = document.getElementById("filterDistrict");
            districtSelect.innerHTML = "<option value=''>Select District</option>"; // Clear existing options

            if (state === "State1") {
                districtSelect.innerHTML += "<option value='District1'>District1</option>";
                districtSelect.innerHTML += "<option value='District2'>District2</option>";
            } else if (state === "State2") {
                districtSelect.innerHTML += "<option value='District3'>District3</option>";
                districtSelect.innerHTML += "<option value='District4'>District4</option>";
            }

            filterTrainers();
        });

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

        document.getElementById("trainerForm").addEventListener("submit", function (event) {
            if (event.submitter.className !== 'close-btn') {
                event.preventDefault();
                hideForm();
                this.submit();
            }
        });
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        $job = $_POST['trainerJob'];
        $state = $_POST['state'];
        $district = $_POST['district'];
        $facebook = $_POST['trainerFacebook'];
        $twitter = $_POST['trainerTwitter'];
        $instagram = $_POST['trainerInstagram'];
        $youtube = $_POST['trainerYouTube'];

        // File upload handling
        if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
            $file_name = $_FILES['profile']['name'];
            $file_tmp = $_FILES['profile']['tmp_name'];
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            move_uploaded_file($file_tmp, $upload_dir . $file_name);
            $image = $upload_dir . $file_name;
        } else {
            $image = "";
        }

        $sql = "INSERT INTO trainers (name, job, state, district, image, facebook, twitter, instagram, youtube) 
                VALUES ('$name', '$job', '$state', '$district', '$image', '$facebook', '$twitter', '$instagram', '$youtube')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New trainer added successfully'); window.location.href = window.location.href;</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
    <?php include  'Footer.php' ?>
</body>

</html>
