<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="DogDetails.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <main class="DogDetailsContainer" style="padding-top: 130px; margin-top: 0px;">
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "caninecare_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['dog_id']) && !empty($_GET['dog_id'])) {
            $dog_id = $_GET['dog_id'];

            $stmt = $conn->prepare("SELECT dogs.*, users.FullName as owner_name, users.email as owner_email, users.profileImage as owner_image FROM dogs JOIN users ON dogs.user_id = users.id WHERE dogs.dog_id = ?");
            $stmt->bind_param("i", $dog_id);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = htmlspecialchars($row['name']);
                    $age = htmlspecialchars($row['age']);
                    $gender = htmlspecialchars($row['gender']);
                    $breed = htmlspecialchars($row['breed']);
                    $image = htmlspecialchars($row['image']);
                    $description = htmlspecialchars($row['description']);
                    $price = htmlspecialchars($row['price']);
                    $vaccination_status = htmlspecialchars($row['vaccination_status']);
                    $state = htmlspecialchars($row['state']);
                    $district = htmlspecialchars($row['district']);
                    $location = htmlspecialchars($row['location']);
                    $owner_name = htmlspecialchars($row['owner_name']);
                    $owner_email = htmlspecialchars($row['owner_email']);
                    $owner_image = htmlspecialchars($row['owner_image']);
        ?>

                    <!-- Display dog details and owner information -->
                    <div class="dog-card">
                        <div class="product">
                            <div class="product-main-image">
                                <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                            </div>
                            <div class="product-details">
                                <div class="product-title"><?php echo $name; ?></div>
                                <div class="product-price">Rs <?php echo $price; ?></div>
                                <button class="AdoptNow" onclick="openPaymentForm('<?php echo $dog_id; ?>', '<?php echo $name; ?>', '<?php echo $price; ?>')">Adopt Now</button>
                                <div class="product-description">
                                    <h2><br>Description</h2>
                                    <p class="age"><b>Age:</b> <?php echo $age; ?></p>
                                    <p class="breed"><b>Gender:</b> <?php echo $gender; ?></p>
                                    <p class="breed"><b>Breed:</b> <?php echo $breed; ?></p>
                                    <p class="vaccination-status"><b>Vaccination Status:</b> <?php echo $vaccination_status; ?></p>
                                    <p class="location"><b>Location:</b> <?php echo $location . ', ' . $district . ', ' . $state; ?></p>
                                    <h2><br>About</h2>
                                    <p><?php echo $description; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="owner-info">
                            <h2>Owner Information</h2>
                            <div class="owner-details">
                                <img src="<?php echo $owner_image; ?>" alt="<?php echo $owner_name; ?>" class="owner-image">
                                <div>
                                    <p>Name: <?php echo $owner_name; ?></p>
                                    <p>Email: <?php echo $owner_email; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

        <?php
                }
            } else {
                echo "Dog not found.";
            }
            $stmt->close();
        } else {
            echo "Invalid dog ID.";
        }
        $conn->close();
        ?>
        <div class="you-may-also-like">
            <hr><br>
            <h2>You May Also Like</h2>
            <div class="similar-dogs">
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if (isset($breed)) {
                    $stmt = $conn->prepare("SELECT * FROM dogs WHERE breed = ? AND dog_id != ? LIMIT 3");
                    $stmt->bind_param("si", $breed, $dog_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $dog_id = $row['dog_id'];
                            $name = $row['name'];
                            $age = $row['age'];
                            $breed = $row['breed'];
                            $img1 = isset($row['image']) ? $row['image'] : 'default_image_path.jpg';
                            $location = $row['location'];


                            echo ' <a href="dogdetails.php?dog_id=' . urlencode($dog_id) . '" class="details-button">';
                            echo '<div class="card">';
                            echo ' <div class="card-image">';
                            echo ' <img src="' . htmlspecialchars($img1) . '" alt="Dog image">';
                            echo ' </div>';
                            echo ' <div class="card-content">';
                            echo ' <h3>' . htmlspecialchars($name) . '</h3>';
                            echo ' <p>Breed: ' . htmlspecialchars($breed) . '</p>';
                            echo ' <p>Age: ' . htmlspecialchars($age) . '</p>';
                            echo ' <p>Location: ' . htmlspecialchars($location) . '</p>';
                            echo ' </div>';
                            echo ' <span><b>View Details</b></span>';
                            echo '</div>';
                            echo '</a>';
                ?>
                <?php
                        }
                    } else {
                        echo "<p>No similar dogs found.</p>";
                    }
                    $stmt->close();
                }

                $conn->close();
                ?>
            </div>
        </div>
    </main>

    <!-- Payment Popup Form -->
    <div id="paymentPopupForm" class="popup-form" style="display: none;">
        <div class="popup-content">
            <span class="popup-close" onclick="closePaymentPopup()">&times;</span>
            <div class="payment-container">
                <h2>Choose Payment Method</h2>
                <button id="khalti-payment-button">Pay with Khalti</button>
                <form id="esewaForm" action="https://uat.esewa.com.np/epay/main" method="POST">
                    <input id="esewa_tAmt" name="tAmt" type="hidden">
                    <input id="esewa_amt" name="amt" type="hidden">
                    <input value="0" name="txAmt" type="hidden">
                    <input value="0" name="psc" type="hidden">
                    <input value="0" name="pdc" type="hidden">
                    <input value="YOUR_ESEWA_MERCHANT_ID" name="scd" type="hidden">
                    <input id="esewa_pid" name="pid" type="hidden">
                    <input value="payment_success.php" type="hidden" name="su">
                    <input value="payment_failure.php" type="hidden" name="fu">
                    <button type="submit">Pay with eSewa</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://khalti.com/static/khalti-checkout.js"></script>
    <script>
        function openPaymentForm(dogId, dogName, price) {
            document.getElementById('esewa_tAmt').value = price;
            document.getElementById('esewa_amt').value = price;
            document.getElementById('esewa_pid').value = "DOG_" + dogId + "_" + new Date().getTime();
            document.getElementById('paymentPopupForm').style.display = 'block';
        }

        function closePaymentPopup() {
            document.getElementById('paymentPopupForm').style.display = 'none';
        }

        var config = {
            publicKey: "YOUR_KHALTI_PUBLIC_KEY",
            productIdentity: "1234567890",
            productName: "Service",
            productUrl: "http://example.com/product",
            eventHandler: {
                onSuccess(payload) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'payment_success.php';
                    form.innerHTML = '<input type="hidden" name="payment_token" value="' + payload.token + '">' +
                        '<input type="hidden" name="amount" value="' + payload.amount + '">' +
                        '<input type="hidden" name="payment_method" value="khalti">';
                    document.body.appendChild(form);
                    form.submit();
                },
                onError(error) {
                    console.log(error);
                },
                onClose() {
                    console.log('Widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);

        document.getElementById('khalti-payment-button').onclick = function() {
            var price = document.getElementById('esewa_amt').value;
            checkout.show({
                amount: price * 100
            });
        };
    </script>

    <script src="script.js"></script>
    <?php include  'Footer.php' ?>
</body>
</html>