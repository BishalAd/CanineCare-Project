<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('config.php');

// Handle filtering
$where = "WHERE 1";
$filter_visibility = 'all'; // Default filter option
if (isset($_GET['filter_visibility'])) {
    $filter_visibility = $_GET['filter_visibility'];
    if ($filter_visibility == 'hidden') {
        $where .= " AND hidden=1";
    } elseif ($filter_visibility == 'unhidden') {
        $where .= " AND hidden=0";
    }
}

$query = "SELECT * FROM trainers $where";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Trainers</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function filterTrainers() {
            var visibility = document.getElementById('filter_visibility').value;
            window.location.href = 'view_trainers.php?filter_visibility=' + visibility;
        }
    </script>
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
        <h1>View Trainers</h1>
        <form id="filterForm">
            <select id="filter_visibility" name="filter_visibility" onchange="filterTrainers()">
                <option value="all" <?php echo ($filter_visibility == 'all') ? 'selected' : ''; ?>>All</option>
                <option value="unhidden" <?php echo ($filter_visibility == 'unhidden') ? 'selected' : ''; ?>>Unhidden</option>
                <option value="hidden" <?php echo ($filter_visibility == 'hidden') ? 'selected' : ''; ?>>Hidden</option>
            </select>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>District</th>
                <th>Facebook</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['trainer_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['district']; ?></td>
                    <td><?php echo $row['facebook']; ?></td>
                    <td>
                        <!-- Add your action icons here -->
                        <!-- Example: -->
                        <!-- <a href="view_trainers.php?action=hide&id=<?php echo $row['trainer_id']; ?>" title="Hide"><i class="fas fa-eye-slash"></i></a> -->
                        <!-- <a href="view_trainers.php?action=unhide&id=<?php echo $row['trainer_id']; ?>" title="Unhide"><i class="fas fa-eye"></i></a> -->
                        <!-- <a href="view_trainers.php?action=delete&id=<?php echo $row['trainer_id']; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this trainer?');"><i class="fas fa-trash"></i></a> -->
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
