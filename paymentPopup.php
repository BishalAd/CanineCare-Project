<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Popup</title>
    <style>
        .popup-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .payment-container {
            margin-top: 20px;
        }

        .payment-container button {
            margin: 10px 0;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="paymentPopupForm" class="popup-form">
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
                    <input value="test_merchant" name="scd" type="hidden">
                    <input id="esewa_pid" name="pid" type="hidden">
                    <input value="payment_success.php" type="hidden" name="su">
                    <input value="payment_failure.php" type="hidden" name="fu">
                    <button type="submit">Pay with eSewa</button>
                </form>
                <button onclick="cashOnDelivery()">Cash on Delivery</button>
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

        function cashOnDelivery() {
            alert('Cash on Delivery option selected. You will pay upon delivery.');
            closePaymentPopup();
        }

        var config = {
            publicKey: "4ffe4339eb954db1983356983716ee4f",
            productIdentity: "1234567890",
            productName: "Service",
            productUrl: "http://localhost/CanineCare-main/index.php",
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
</body>
</html>
