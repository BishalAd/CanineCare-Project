<?php
include 'payment.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payment_token'])) {
    $token = $_POST['payment_token'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    if (processPayment($payment_method, $amount, $token)) {
        echo "<p class='success'>Payment verified successfully!</p>";
    } else {
        echo "<p class='error'>Payment verification failed!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    <p class='success'>Payment verified successfully!</p>
</body>
</html>
