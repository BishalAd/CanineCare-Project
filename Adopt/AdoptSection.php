<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CanineCare: Adopt a Dog</title>
    <link rel="shortcut icon" type="x-con" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="AdoptSection.css">
    
</head>

<body>
<?php include '../nav.php' ?>
    <main class="adopt-section">
        <h1>Adopt a Dog</h1>
        <div class="cards-container">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "caninecare_db";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM dogs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dog_id = $row['dog_id'];
                    $name = $row['name'];
                    $age = $row['age'];
                    $breed = $row['breed'];
                    $img1 = $row['img1'];
                    $description = $row['description'];

                    echo '<div class="card">';
                    echo '    <div class="card-image">';
                    echo '        <img src="Dog_Img_uploads/' . htmlspecialchars($img1) . '" alt="' . htmlspecialchars($name) . '">';
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
    </main>
    <script src="script.js"></script>
</body>

</html>
