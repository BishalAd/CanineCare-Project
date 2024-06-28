<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('config.php');

// Handle hide and delete actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $dog_id = $_POST['dog_id'];
        $query = "DELETE FROM dogs WHERE dog_id='$dog_id'";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['hide'])) {
        $dog_id = $_POST['dog_id'];
        $query = "UPDATE dogs SET hidden=1 WHERE dog_id='$dog_id'";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['unhide'])) {
        $dog_id = $_POST['dog_id'];
        $query = "UPDATE dogs SET hidden=0 WHERE dog_id='$dog_id'";
        mysqli_query($conn, $query);
    }
}

// Determine which dogs to display based on the filter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
switch ($filter) {
    case 'active':
        $query = "SELECT * FROM dogs WHERE hidden=0";
        break;
    case 'hidden':
        $query = "SELECT * FROM dogs WHERE hidden=1";
        break;
    case 'all':
    default:
        $query = "SELECT * FROM dogs";
        break;
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Dogs</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="view_users.php?filter=all">View All Users</a></li>
            <li><a href="view_dogs.php?filter=all">View All Dogs</a></li>
            <li><a href="view_products.php">View All Products</a></li>
            <li><a href="view_trainers.php">View All Trainers</a></li>
            <li><a href="view_appointments.php">View All Doctor Appointments</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>View Dogs</h1>
        <form method="get" class="filter-form">
            <label for="filter">Filter Dogs:</label>
            <select name="filter" id="filter" onchange="this.form.submit()">
                <option value="all" <?php echo $filter == 'all' ? 'selected' : ''; ?>>All Dogs</option>
                <option value="active" <?php echo $filter == 'active' ? 'selected' : ''; ?>>Active Dogs</option>
                <option value="hidden" <?php echo $filter == 'hidden' ? 'selected' : ''; ?>>Hidden Dogs</option>
            </select>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['dog_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['breed']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="dog_id" value="<?php echo $row['dog_id']; ?>">
                            <?php if ($row['hidden'] == 0) { ?>
                                <button type="submit" name="delete"><i class="fas fa-trash-alt"></i></button>
                                <button type="submit" name="hide"><i class="fas fa-eye-slash"></i></button>
                            <?php } else { ?>
                                <button type="submit" name="unhide"><i class="fas fa-eye"></i></button>
                            <?php } ?>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
