<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('config.php');
$query = "SELECT * FROM appointments";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Doctor Appointments</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="view_users.php">View All Users</a></li>
            <li><a href="view_dogs.php">View All Dogs</a></li>
            <li><a href="view_products.php">View All Products</a></li>
            <li><a href="view_trainers.php">View All Trainers</a></li>
            <li><a href="view_appointments.php">View All Doctor Appointments</a></li>
        </ul>
    </div>
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
