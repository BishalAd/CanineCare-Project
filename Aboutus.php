<!DOCTYPE html>
<html>

<head>
    <title>About Us Section</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-con" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="Aboutus.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="about-section">
        <div class="about-container">
            <div class="about-content-section">
                <div class="about-title">
                    <h1>About Us</h1>
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
                        <a href="#">Read more</a>
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

    <div id="mail" style="margin-left: 30%; margin-top: 50px;">
        <div class="contact-form">
            <h2>Contact Us</h2>
            <form action="send_email.php" method="POST">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $message = htmlspecialchars($_POST['message']);
            $to = "thapahimal567@gmail.com"; // Replace with your email address
            $subject = "New Message from Contact Form";
            $body = "Name: $name\n\nMessage:\n$message";
            $headers = "From: webmaster@example.com"; // Replace with your website's domain

            if (mail($to, $subject, $body, $headers)) {
                echo "Message sent successfully.";
            } else {
                echo "Failed to send message.";
            }
        }
        ?>
    </div>

    <div id="team">
        <section class="teams" id="teams">
            <div class="max-width">
                <h2 class="title">My teams</h2>
                <div class="carousel owl-carousel">
                    <div class="card">
                        <div class="box">
                            <img src="image1.jpg" alt="">
                            <div class="text">Bishal Adhikari</div>
                            <p>is a Front-End Developer</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="box">
                            <img src="himal.jpg" alt="My Profile Image">
                            <div class="text">Himal Thapa</div>
                            <p>is a Back-End Developer</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="box">
                            <img src="Aayushka.jpg" alt="">
                            <div class="text">Aayushka GC</div>
                            <p>is a Project Manager</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="box">
                            <img src="ashis.jpg" alt="">
                            <div class="text">Ashish Gurung</div>
                            <p>is a Quality Assurance (QA) Tester</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-KyZXEAg3QhqLMpG8r+8fhAXLRw0smIOmwV8AY5poTwja57f0SQY7gGQtsEkF+3eU0P6mTpoXf7znkXwQYoAhhQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-tS3n7VFL9WqF3GBFb9Y2O5iVrcOVsZXB2IDTxN1Lz8x0CRR5XBlU6u9e3M0MysD2XnqStmduDAET2P2P5TICsg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="scripts.js"></script>
</body>

</html>
