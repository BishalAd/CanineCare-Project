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
            <span>Fastest Vet service in Nepal</span>
        </div>
    </div>

    <!-- Doctors Section -->
    <div class="doctor-container">
        <h1>Consult Experienced Veterinary Doctors Online</h1>
        <div class="doctor-section">
            <div class="doctor-card">
                <img src="Resources/Doctor1.jpg" alt="Dr. Pankaj Dhakad">
                <h2>Dr. Pankaj Dhakad</h2>
                <p>B.V.Sc. & AH, M.V.Sc.</p>
                <p>Experienced Veterinary Consultant & Surgeon with expertise in Veterinary Surgery, Radiology, Preventive Care, Nutrition, Wound care management, and Anesthesia monitoring. Expertise in treating canine, feline, avian, and small pets. Member of Nepal Veterinary Council. </p>
            </div>
            <div class="doctor-card">
                <img src="Resources/Doctor2.jpg" alt="Dr. Jagdish Chaudhary">
                <h2>Dr. Jagdish Chaudhary</h2>
                <p>B.V.Sc. & AH</p>
                <p>Experienced Veterinary consultant & Surgeon with expertise in treating Pet animals, Farm animals such as Cattle, Equine, Bovine, and Birds. Member of the Nepal Veterinary council. Speaks Neplai, English and Hindi.</p>
            </div>
            <div class="doctor-card">
                <img src="Resources/Doctor3.jpg" alt="Dr. Saheb Kumar">
                <h2>Dr. Saheb Kumar</h2>
                <p>B.V.Sc. & AH</p>
                <p>Experienced Veterinary Surgeon & Radiologist with expertise in Veterinary surgery, Vaccination, Preventive Care, Dermatology, Radiology, Nutrition, and Soft tissue surgery. Expertise in treating Canine, Feline, Avian, and Small Pets. Member of Nepal Veterinary Council.</p>
            </div>
        </div>
    </div>
    <div class="Symptoms-Container">
        <div class="progress-bar">
            <div class="step active">User Details</div>
            <div class="step">Pet Details</div>
            <div class="step">Main Symptom</div>
            <div class="step">Symptom Details</div>
            <div class="step">Report</div>
        </div>
        <form id="symptomCheckerForm">
            <div class="step-content active" id="step-1">
                <h1>Your Details</h1>
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" required><br><br>
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required><br><br>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br><br>
                <button type="button" class="btn" onclick="nextStep(2)">Next</button>
            </div>
            <div class="step-content" id="step-2">
                <h1>Pet Details</h1>
                <h2>What's their sex?</h2>
                <div>
                    <input type="radio" id="male" name="sex" value="male" required>
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="sex" value="female" required>
                    <label for="female">Female</label>
                </div>
                <h2>What's their Age?</h2>
                <input type="number" name="age" required><br>
                <button type="button" class="btn" onclick="prevStep(1)">Back</button>
                <button type="button" class="btn" onclick="nextStep(3)">Next</button>
            </div>
            <div class="step-content" id="step-3">
                <h2>Main Symptom</h2>
                <label for="mainSymptom">Select the main symptom</label>
                <select name="mainSymptom" id="mainSymptom" required>
                    <option value="coughing">Coughing</option>
                    <option value="vomiting">Vomiting</option>
                    <option value="diarrhea">Diarrhea</option>
                    <option value="lethargy">Lethargy</option>
                    <option value="itching">Itching</option>
                    <option value="loss of appetite">Loss of appetite</option>
                    <option value="excessive thirst">Excessive thirst</option>
                    <option value="difficulty breathing">Difficulty breathing</option>
                    <option value="limping">Limping</option>
                    <option value="ear discharge">Ear discharge</option>
                    <option value="sneezing">Sneezing</option>
                    <option value="hair loss">Hair loss</option>
                    <option value="eye discharge">Eye discharge</option>
                    <option value="weight loss">Weight loss</option>
                </select>
                <button type="button" class="btn" onclick="prevStep(2)">Back</button>
                <button type="button" class="btn" onclick="nextStep(4)">Next</button>
            </div>
            <div class="step-content" id="step-4">
                <h2>Symptom Details</h2>
                <label for="symptomDetails">Describe the symptom in more detail</label>
                <textarea name="symptomDetails" id="symptomDetails" rows="4" cols="50" required></textarea>
                <button type="button" class="btn" onclick="prevStep(3)">Back</button>
                <button type="button" class="btn" onclick="generateReport()">Generate Report</button>
            </div>
            <div class="step-content" id="step-5">
                <h2>Report</h2>
                <p id="reportContent"></p>
                <button type="button" class="btn" onclick="prevStep(4)">Back</button>
                <button type="button" class="btn" onclick="printReport()">Print Report</button>
            </div>
        </form>
    </div>

    <!-- Popup Form -->
    <div id="popupForm" class="popup-form">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <div class="consult-form-container">
                <h1>Consult a Vet Online</h1>
                <p class="consult-price">Rs 499.00</p>
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
                    $report = $_POST['report_data'];

                    // Check if the appointment time is already booked
                    $check_sql = "SELECT COUNT(*) AS count FROM consultations WHERE appointment_date = '$date' AND appointment_time = '$time'";
                    $check_result = $conn->query($check_sql);

                    if ($check_result && $check_result->num_rows > 0) {
                        $row = $check_result->fetch_assoc();
                        if ($row['count'] > 0) {
                            echo "<p class='consult-error'>Appointment time '$time' on '$date' is already booked. Please choose another time.</p>";
                            exit; // Stop further execution
                        }
                    } else {
                        echo "<p class='consult-error'>Error checking appointment availability.</p>";
                        exit; // Stop further execution
                    }

                    $sql = "INSERT INTO consultations (name, email, phone, appointment_date, appointment_time, doctor, report_data)
                            VALUES ('$name', '$email', '$phone', '$date', '$time', '$doctor', 'report')";

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

                    <label for="report">Upload Your Dog Report:</label>
                    <input type="file" id="report" name="report" required>

                    <label for="doctor">Select Doctor:</label>
                    <select id="doctor" name="doctor" required>
                        <option value="Dr. Smith">Dr. Pankaj Dhakad</option>
                        <option value="Dr. Johnson">Dr. Saheb Kumar</option>
                        <option value="Dr. Brown">Dr. Jagdish Chaudhary</option>
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
                <form id="esewa-form" action="https://uat.esewa.com.np/epay/main" method="POST">
                    <input value="499" name="tAmt" type="hidden">
                    <input value="499" name="amt" type="hidden">
                    <input value="0" name="txAmt" type="hidden">
                    <input value="0" name="psc" type="hidden">
                    <input value="0" name="pdc" type="hidden">
                    <input value="YOUR_ESEWA_MERCHANT_ID" name="scd" type="hidden">
                    <input value="YOUR_INVOICE_NUMBER" name="pid" type="hidden">
                    <input value="payment_success.php" type="hidden" name="su">
                    <input value="payment_failure.php" type="hidden" name="fu">
                    <button type="submit">Pay with eSewa</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
    <script src="CareSection.js"></script>
    <?php include  'Footer.php' ?>
    <script src="script.js"></script>
</body>

</html>