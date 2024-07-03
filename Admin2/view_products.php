<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('config.php');

// Handle hiding and deleting actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] == 'hide') {
        $query = "UPDATE product SET hidden=1 WHERE product_id=$id";
        mysqli_query($conn, $query);
    } elseif ($_GET['action'] == 'unhide') {
        $query = "UPDATE product SET hidden=0 WHERE product_id=$id";
        mysqli_query($conn, $query);
    } elseif ($_GET['action'] == 'delete') {
        $query = "DELETE FROM product WHERE product_id=$id";
        mysqli_query($conn, $query);
    }
}

// Handle filtering
$where = "WHERE 1";
if (isset($_GET['filter_visibility'])) {
    $filter_visibility = $_GET['filter_visibility'];
    if ($filter_visibility == 'hidden') {
        $where .= " AND hidden=1";
    } elseif ($filter_visibility == 'unhidden') {
        $where .= " AND hidden=0";
    }
}

$query = "SELECT * FROM product $where";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <h1>View Products</h1>
        <form method="GET" action="view_products.php">
            <select id="filter_visibility" name="filter_visibility">
                <option value="all" <?php echo (isset($_GET['filter_visibility']) && $_GET['filter_visibility'] == 'all') ? 'selected' : ''; ?>>All</option>
                <option value="unhidden" <?php echo (isset($_GET['filter_visibility']) && $_GET['filter_visibility'] == 'unhidden') ? 'selected' : ''; ?>>Unhidden</option>
                <option value="hidden" <?php echo (isset($_GET['filter_visibility']) && $_GET['filter_visibility'] == 'hidden') ? 'selected' : ''; ?>>Hidden</option>
            </select>
            <button type="submit">Filter</button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo substr($row['description'], 0, 100) . '...'; ?></td>
                    <td>
                        <?php if ($row['hidden'] == 0) { ?>
                            <a href="view_products.php?action=hide&id=<?php echo $row['product_id']; ?>" title="Hide"><i class="fas fa-eye-slash"></i></a>
                        <?php } else { ?>
                            <a href="view_products.php?action=unhide&id=<?php echo $row['product_id']; ?>" title="Unhide"><i class="fas fa-eye"></i></a>
                        <?php } ?>
                        <a href="view_products.php?action=delete&id=<?php echo $row['product_id']; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
