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
        $id = $_POST['id'];
        $query = "DELETE FROM users WHERE id='$id'";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['hide'])) {
        $id = $_POST['id'];
        $query = "UPDATE users SET hidden=1 WHERE id='$id'";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['unhide'])) {
        $id = $_POST['id'];
        $query = "UPDATE users SET hidden=0 WHERE id='$id'";
        mysqli_query($conn, $query);
    }
}

// Determine which users to display based on the filter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
switch ($filter) {
    case 'active':
        $query = "SELECT * FROM users WHERE hidden=0";
        break;
    case 'hidden':
        $query = "SELECT * FROM users WHERE hidden=1";
        break;
    case 'all':
    default:
        $query = "SELECT * FROM users";
        break;
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Users</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'AdminNav.php'; ?>
    </div>
    <div class="content">
        <h1>View Users</h1>
        <form method="get" class="filter-form">
            <label for="filter">Filter Users:</label>
            <select name="filter" id="filter" onchange="this.form.submit()">
                <option value="all" <?php echo $filter == 'all' ? 'selected' : ''; ?>>All Users</option>
                <option value="active" <?php echo $filter == 'active' ? 'selected' : ''; ?>>Active Users</option>
                <option value="hidden" <?php echo $filter == 'hidden' ? 'selected' : ''; ?>>Hidden Users</option>
            </select>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['FullName']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
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