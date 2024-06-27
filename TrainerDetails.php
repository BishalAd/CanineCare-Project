<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Trainer Details</title>
    <!-- Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- <?php include 'nav.php'; ?> -->
    <div class="trainer-details-container">
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

        // Check if id is set in URL
        if (isset($_GET['id'])) {
            $trainerId = intval($_GET['id']);
            $sql = "SELECT * FROM trainers WHERE trainer_id = $trainerId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $trainer = $result->fetch_assoc();
                echo "<div class='trainer-card'>
                        <img src='" . $trainer['image'] . "' alt='" . $trainer['name'] . "'>
                        <div class='trainer-info'>
                            <h2>" . $trainer['name'] . "</h2>
                            <p>" . $trainer['job'] . "</p>
                            <p>" . $trainer['state'] . ", " . $trainer['district'] . "</p>
                            <div class='social-links'>
                                <a href='" . $trainer['facebook'] . "' target='_blank'><i class='fab fa-facebook-f'></i></a>
                                <a href='" . $trainer['twitter'] . "' target='_blank'><i class='fab fa-twitter'></i></a>
                                <a href='" . $trainer['instagram'] . "' target='_blank'><i class='fab fa-instagram'></i></a>
                                <a href='" . $trainer['youtube'] . "' target='_blank'><i class='fab fa-youtube'></i></a>
                            </div>
                        </div>
                    </div>";

                $chargesSql = "SELECT * FROM charges WHERE trainer_id = $trainerId";
                $chargesResult = $conn->query($chargesSql);

                if ($chargesResult->num_rows > 0) {
                    echo "<div class='charges-list'>
                            <h3>Training Charges</h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Charge Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    while ($charge = $chargesResult->fetch_assoc()) {
                        echo "<tr>
                                <td>" . ucfirst($charge['charge_type']) . "</td>
                                <td>$" . number_format($charge['amount'], 2) . "</td>
                              </tr>";
                    }
                    echo "</tbody></table></div>";
                } else {
                    echo "<p>No charges available.</p>";
                }
            } else {
                echo "<p>Trainer not found.</p>";
            }
        } else {
            echo "<p>Trainer ID is missing in the URL.</p>";
        }

        $conn->close();
        ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
