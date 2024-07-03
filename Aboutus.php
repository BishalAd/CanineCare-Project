<!DOCTYPE html>
<html>

<head>
    <title>About Us Section</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-con" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="Aboutus.css">
    <link rel="stylesheet" href="mail.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="about-section">
        <div class="about-container">
            <div class="about-content-section">
                <div class="about-title">
                    <h1> About Us</h1>
                </div>
                <div class="about-content">
                    <h3>Who we are</h3>
                    <p>CanineCare is more than just an organization; it's a passion,
                        a commitment to the well-being of our furry friends.
                        Founded with a deep love for dogs and a desire to make a difference,
                        CanineCare is a non-profit dedicated to rescuing, rehabilitating, and rehoming dogs in need. Our
                        journey began on March 18, 2024,
                        and since then, we've been on a mission to provide love, care, and a second chance to dogs who
                        have been neglected, abused,
                        or abandoned.
                        At CanineCare, we believe that every dog deserves a loving home.
                        That's why we go above and beyond to ensure that each dog in our care receives the attention,
                        medical care,
                        and training they need to thrive. What sets us apart is our commitment to finding the perfect
                        match for each dog and adopter,
                        ensuring a happy and harmonious forever home. Our team is made up of passionate individuals who
                        share a common goal,
                        to make a difference in the lives of dogs.
                        From our dedicated staff to our tireless volunteers, everyone at CanineCare plays a vital role
                        in our mission.
                        Together, we've rescued and rehomed countless dogs, giving them a second chance at a happy life.
                        But our work doesn't stop there. We're constantly striving to do more, to rescue more dogs,
                        to find more forever homes, and to educate the community about responsible pet ownership.
                        With your support, we can continue to make a difference in the lives of dogs in need.
                        Join us in our mission and help us give every dog the love and care they deserve.</p>
                    <div class="about-button">
                        <a href="#"> Read more</a>
                    </div>
                    <div class="about-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="about-image-section">
                <img src="Resources/123.jpeg" alt="Dog Image">
            </div>
        </div>
    </div>

    <div class="contact-form">
        <h2>Contact Us</h2>

        <form action="submit" method="POST">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $userEmail = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $to = "canineecare@gmail.com"; // Replace with your email address
    $subject = "New Message from Contact Form";
    $body = "Name: $name\nEmail: $userEmail\n\nMessage:\n$message";
    $headers = "From: $userEmail";

    if (mail($to, $subject, $body, $headers)) {
        echo "<p style='color: green;'>Message sent successfully.</p>";
    } else {
        echo "<p style='color: red;'>Failed to send message.</p>";
    }
}
?>