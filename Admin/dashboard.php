<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('config.php');

// Fetch counts
$userCountQuery = "SELECT COUNT(*) as count FROM users";
$doctorCountQuery = "SELECT COUNT(*) as count FROM users WHERE role='doctor'";
$trainerCountQuery = "SELECT COUNT(*) as count FROM users WHERE role='trainer'";
$sellerCountQuery = "SELECT COUNT(*) as count FROM users WHERE role='seller'";
$otherCountQuery = "SELECT COUNT(*) as count FROM users WHERE role NOT IN ('doctor', 'trainer', 'seller')";

$dogCountQuery = "SELECT COUNT(*) as count FROM dogs";
$productCountQuery = "SELECT COUNT(*) as count FROM product";
$trainerListCountQuery = "SELECT COUNT(*) as count FROM trainers";

// Fetch detailed counts
$dogBreedCountQuery = "SELECT breed, COUNT(*) as count FROM dogs GROUP BY breed";
$productTypeCountQuery = "SELECT category, COUNT(*) as count FROM product GROUP BY category";

$userCount = mysqli_fetch_assoc(mysqli_query($conn, $userCountQuery))['count'];
$doctorCount = mysqli_fetch_assoc(mysqli_query($conn, $doctorCountQuery))['count'];
$trainerCount = mysqli_fetch_assoc(mysqli_query($conn, $trainerCountQuery))['count'];
$sellerCount = mysqli_fetch_assoc(mysqli_query($conn, $sellerCountQuery))['count'];
$otherCount = mysqli_fetch_assoc(mysqli_query($conn, $otherCountQuery))['count'];

$dogCount = mysqli_fetch_assoc(mysqli_query($conn, $dogCountQuery))['count'];
$productCount = mysqli_fetch_assoc(mysqli_query($conn, $productCountQuery))['count'];
$trainerListCount = mysqli_fetch_assoc(mysqli_query($conn, $trainerListCountQuery))['count'];

$dogBreedCounts = mysqli_query($conn, $dogBreedCountQuery);
$productTypeCounts = mysqli_query($conn, $productTypeCountQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'AdminNav.php'; ?>

    </div>
    <div class="content">
        <h1>Admin Dashboard</h1>
        <div class="dashboard-stats">
            <div class="stat">
                <h3>Total Users</h3>
                <p><?php echo $userCount; ?></p>
            </div>
            <div class="stat">
                <h3>Doctor Users</h3>
                <p><?php echo $doctorCount; ?></p>
            </div>
            <div class="stat">
                <h3>Trainer Users</h3>
                <p><?php echo $trainerCount; ?></p>
            </div>
            <div class="stat">
                <h3>Seller Users</h3>
                <p><?php echo $sellerCount; ?></p>
            </div>
            <div class="stat">
                <h3>Other Users</h3>
                <p><?php echo $otherCount; ?></p>
            </div>
            <div class="stat">
                <h3>Dogs Listed</h3>
                <p><?php echo $dogCount; ?></p>
            </div>
            <div class="stat">
                <h3>Products Listed</h3>
                <p><?php echo $productCount; ?></p>
            </div>
            <div class="stat">
                <h3>Trainers Listed</h3>
                <p><?php echo $trainerListCount; ?></p>
            </div>
        </div>
        <div class="detailed-stats">
            <h2>Detailed Statistics</h2>
            <div class="detail">
                <h3>Dogs by Breed</h3>
                <ul>
                    <?php while ($row = mysqli_fetch_assoc($dogBreedCounts)) { ?>
                        <li><?php echo $row['breed']; ?>: <?php echo $row['count']; ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="detail">
                <h3>Products by Type</h3>
                <ul>
                    <?php while ($row = mysqli_fetch_assoc($productTypeCounts)) { ?>
                        <li><?php echo $row['category']; ?>: <?php echo $row['count']; ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
