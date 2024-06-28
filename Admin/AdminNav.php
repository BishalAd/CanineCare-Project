<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
?>

<div class="sidebar">
    <h2>Admin Dashboard</h2>
    <ul>
        <li><a href="Dashboard.php">Home</a></li>
        <li><a href="view_users.php">View All Users</a></li>
        <li><a href="view_dogs.php">View All Dogs</a></li>
        <li><a href="view_products.php">View All Products</a></li>
        <li><a href="view_trainers.php">View All Trainers</a></li>
        <li><a href="view_appointments.php">View All Doctor Appointments</a></li>
    </ul>
</div>