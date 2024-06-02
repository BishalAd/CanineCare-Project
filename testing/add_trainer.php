<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Trainer.css">
    <title>Dog Training Videos</title>
</head>
<body>
    <header>
        <h1>Dog Training Videos</h1>
    </header>
    <div class="AddTrainerCard">
        <button onclick="showForm()">Add Trainer</button>
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
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card'>
                            <div class='content'>
                                <div class='img'>
                                    <img src='".$row["image"]."' alt='".$row["name"]."'>
                                </div>
                                <div class='details'>
                                    <div class='name'>".$row["name"]."</div>
                                    <div class='job'>".$row["job"]."</div>
                                </div>
                                <div class='media-icons'>
                                    <a href='".$row["facebook"]."' target='_blank'><i class='fab fa-facebook-f'></i></a>
                                    <a href='".$row["twitter"]."' target='_blank'><i class='fab fa-twitter'></i></a>
                                    <a href='".$row["instagram"]."' target='_blank'><i class='fab fa-instagram'></i></a>
                                    <a href='".$row["youtube"]."' target='_blank'><i class='fab fa-youtube'></i></a>
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
                <h2>Add New Trainer</h2>
                <input type="text" name="trainerName" placeholder="Trainer Name" required>
                <input type="text" name="trainerJob" placeholder="Job Title" required>
                <input type="file" name="profile" id="profile" accept="image/*" required><br>
                <input type="url" name="trainerFacebook" placeholder="Facebook URL">
                <input type="url" name="trainerTwitter" placeholder="Twitter URL">
                <input type="url" name="trainerInstagram" placeholder="Instagram URL">
                <input type="url" name="trainerYouTube" placeholder="YouTube URL">
                <button type="submit">Add Trainer</button>
                <button type="button" class="close-btn" onclick="hideForm()">Close</button>
            </form>
        </div>
    </div>
    <script>
        function showForm() {
            document.getElementById("trainerFormPopup").style.display = "block";
        }

        function hideForm() {
            document.getElementById("trainerFormPopup").style.display = "none";
        }

        document.getElementById("trainerForm").addEventListener("submit", function(event){
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
        $facebook = $_POST['trainerFacebook'];
        $twitter = $_POST['trainerTwitter'];
        $instagram = $_POST['trainerInstagram'];
        $youtube = $_POST['trainerYouTube'];

        // File upload handling
        if(isset($_FILES['profile'])){
            $file_name = $_FILES['profile']['name'];
            $file_tmp = $_FILES['profile']['tmp_name'];
            $upload_dir = "uploads/";
            move_uploaded_file($file_tmp, $upload_dir.$file_name);
            $image = $upload_dir.$file_name;
        } else {
            $image = "";
        }

        $sql = "INSERT INTO trainers (name, job, image, facebook, twitter, instagram, youtube) 
                VALUES ('$name', '$job', '$image', '$facebook', '$twitter', '$instagram', '$youtube')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New trainer added successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>