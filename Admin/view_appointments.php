<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('config.php');
$query = "SELECT * FROM consultations";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Doctor Appointments</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('AdminNav.php') ?>
    <div class="content">
        <h1>View Doctor Appointments</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Doctor Name</th>
                <th>Patient Name</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['doctor_name']; ?></td>
                    <td><?php echo $row['patient_name']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
