<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('config.php'); // Include your database connection file

$query = "SELECT * FROM trainingBooking";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Trainer Bookings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('AdminNav.php'); // Include your admin navigation ?>
    <div class="content">
        <h1>View Trainer Bookings</h1>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Owner Name</th>
                <th>Owner Email</th>
                <th>Dog's Name</th>
                <th>Dog's Age</th>
                <th>Preferred Date</th>
                <th>Additional Info</th>
                <th>Trainer ID</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['owner_name']; ?></td>
                    <td><?php echo $row['owner_email']; ?></td>
                    <td><?php echo $row['dog_name']; ?></td>
                    <td><?php echo $row['dog_age']; ?></td>
                    <td><?php echo $row['preferred_date']; ?></td>
                    <td><?php echo $row['additional_info']; ?></td>
                    <td><?php echo $row['trainer_id']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
