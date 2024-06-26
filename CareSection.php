<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consult a Vet Online - Canine Care</title>
    <link rel="stylesheet" href="CareSection.css">
</head>

<body>
    <?php include 'nav.php' ?>
    <div class="main-container">
        <div class="header-section">
            <h1>Need Advice on your Pet's health? Now Ask a Vet Online 24/7</h1>
            <p>Get Best Veterinary Advice online from the comfort of your home.</p>
            <button class="consult-button" onclick="openPopup()">Consult A Vet Online ➤</button>
        </div>
        <div class="vet-image-section">
            <img src="Resources/CareSection.png" alt="Vet with pet">
        </div>
    </div>
    <div class="features-section">
        <div class="feature-item">
            <img src="Resources/DogCare1.png" alt="Stethoscope Icon">
            <p>Nepal's No. 1 Online Vet Consultation Service</p>
            <span>Ask Top Vet's Advice</span>
        </div>
        <div class="feature-item">
            <img src="Resources/DogCare2.png" alt="Paw Icon">
            <p>Trusted & Affordable Vetcare</p>
            <span>Consult Vet @ 499</span>
        </div>
        <div class="feature-item">
            <img src="Resources/DogCare3.png" alt="Appointment Icon">
            <p>Easy Appointment Booking</p>
            <span>Book at a few clicks</span>
        </div>
        <div class="feature-item">
            <img src="Resources/DogCare4.png" alt="Clock Icon">
            <p>Consult Vet in 15 minutes</p>
            <span>Fastest Vet service in India</span>
        </div>
    </div>

    <!-- Doctors Section -->
    <div class="doctor-container">
        <h1>Consult Experienced Veterinary Doctors Online</h1>
        <div class="doctor-section">
            <div class="doctor-card">
                <img src="Resources/Doctor1.jpg" alt="Dr. Pritish Rath">
                <h2>Dr. Pritish Rath</h2>
                <p>B.V.Sc. & AH, M.V.Sc. (Gold Medalist)</p>
                <p>Experienced Veterinary Consultant & Surgeon with expertise in Veterinary Surgery, Radiology, Preventive Care, Nutrition, Wound care management, and Anesthesia monitoring. Expertise in treating canine, feline, avian, and small pets. Member of Indian Veterinary Council. Lifetime Member of the Indian Society of Veterinary Surgery (ISVS).</p>
            </div>
            <div class="doctor-card">
                <img src="Resources/Doctor2.jpg" alt="Dr. Prafulla Kumar Mishra">
                <h2>Dr. Prafulla Kumar Mishra</h2>
                <p>B.V.Sc. & AH (Gold Medalist)</p>
                <p>Experienced Veterinary consultant & Surgeon with expertise in treating Pet animals, Farm animals such as Cattle, Equine, Bovine, and Birds. Member of the Indian Veterinary council. Speaks English, Hindi, & Odia.</p>
            </div>
            <div class="doctor-card">
                <img src="Resources/Doctor3.jpg" alt="Dr. Jupaka Shashank">
                <h2>Dr. Jupaka Shashank</h2>
                <p>B.V.Sc. & AH</p>
                <p>Experienced Veterinary Surgeon & Radiologist with expertise in Veterinary surgery, Vaccination, Preventive Care, Dermatology, Radiology, Nutrition, and Soft tissue surgery. Expertise in treating Canine, Feline, Avian, and Small Pets. Member of Indian Veterinary Council.</p>
            </div>
        </div>
    </div>

    <!-- Popup Form -->
    <div id="popupForm" class="popup-form">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <div class="consult-form-container">
                <h1>Consult a Vet Online</h1>
                <p class="consult-price">₹199.00</p>
                <p class="consult-description">Book your schedule for an online vet consultation now! You will be notified about the vet assignment shortly.</p>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "canine_care";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $doctor = $_POST['doctor'];

                    $sql = "INSERT INTO consultations (name, email, phone, appointment_date, appointment_time, doctor)
                            VALUES ('$name', '$email', '$phone', '$date', '$time', '$doctor')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<p class='consult-success'>Appointment booked successfully!</p>";
                    } else {
                        echo "<p class='consult-error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
                    }

                    $conn->close();
                }
                ?>

                <form id="consultationForm" action="index.php" method="POST">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Your Phone:</label>
                    <input type="tel" id="phone" name="phone" required>

                    <label for="date">Appointment Date:</label>
                    <input type="date" id="date" name="date" required>

                    <label for="time">Appointment Time:</label>
                    <input type="time" id="time" name="time" required>

                    <label for="doctor">Select Doctor:</label>
                    <select id="doctor" name="doctor" required>
                        <option value="Dr. Smith">Dr. Smith</option>
                        <option value="Dr. Johnson">Dr. Johnson</option>
                        <option value="Dr. Brown">Dr. Brown</option>
                    </select>

                    <button type="button" onclick="showPaymentPopup()">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Popup Form -->
    <div id="paymentPopupForm" class="popup-form">
        <div class="popup-content">
            <span class="popup-close" onclick="closePaymentPopup()">&times;</span>
            <div class="payment-container">
                <h2>Choose Payment Method</h2>
                <button id="khalti-payment-button">Pay with Khalti</button>
                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                    <input value="199" name="tAmt" type="hidden">
                    <input value="199" name="amt" type="hidden">
                    <input value="0" name="txAmt" type="hidden">
                    <input value="0" name="psc" type="hidden">
                    <input value="0" name="pdc" type="hidden">
                    <input value="YOUR_ESEWA_MERCHANT_ID" name="scd" type="hidden">
                    <input value="YOUR_INVOICE_NUMBER" name="pid" type="hidden">
                    <input value="http://yourwebsite.com/payment_success.php" type="hidden" name="su">
                    <input value="http://yourwebsite.com/payment_failure.php" type="hidden" name="fu">
                    <button type="submit">Pay with eSewa</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://khalti.com/static/khalti-checkout.js"></script>
    <script>
        var config = {
            publicKey: "YOUR_KHALTI_PUBLIC_KEY",
            productIdentity: "1234567890",
            productName: "Canine Care Service",
            productUrl: "http://bishaladhikari7.com.np",
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
        var btn = document.getElementById("khalti-payment-button");
        btn.onclick = function() {
            checkout.show({
                amount: 19900
            });
        }
    </script>

    <script>
        function openPopup() {
            document.getElementById("popupForm").style.display = "block";
        }

        function closePopup() {
            document.getElementById("popupForm").style.display = "none";
        }

        function showPaymentPopup() {
            document.getElementById("paymentPopupForm").style.display = "block";
        }

        function closePaymentPopup() {
            document.getElementById("paymentPopupForm").style.display = "none";
        }
    </script>

    <script src="script.js"></script>
</body>

</html>
