<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CanineCare: The Dog Care Center</title>
    <link rel="shortcut icon" type="x-con" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include  'nav.php' ?>
    <main>
        <div class="heroSection">
            <video autoplay muted loop id="video-background">
                <source src="Resources/Video1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="black-overlay"></div>
            <div class="content">
                <p>Welcome to </p>
                <h1>CanineCare!</h1>
                <p>We Can <span class="typing"></span></p>
                <!-- <p>Your pet's health and wellbeing is our top priority.</p> -->
            </div>
        </div>
        <div class="other-section">
            <div class="adopt-section">
                <a href="AdoptSection.php">
                    <h1>Adopt Dog</h1>
                    <div class="Dog-img">
                        <img src="Resources/2sad dog.png" alt="Sad Dog Image" class="original-image">
                        <img src="Resources/happy dog 2.png" alt="Happy Dog Image" class="hover-image">
                    </div>
                    <div class="Content">
                        <p><q>In our dog adoption section, easily find your perfect furry friend and welcome a new
                                member into your family today.</q></p>
                    </div>
                </a>
            </div>
        </div>
        <?php        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "caninecare_db";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM product ORDER BY product_id DESC LIMIT 8";
        $result = $conn->query($sql);

        ?>
        <div id="trending-product">
            <h1>Trending Products</h1>
            <div id="products">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="box">
                            <div class="imgbox">
                                <img src="Product_Img_uploads/<?php echo $row['img1']; ?>" alt="<?php echo $row['name']; ?>" class="product-img">
                            </div>
                            <h2 class="product-title"><?php echo $row['name']; ?></h2><br>
                            <span class="price">RS <?php echo $row['price']; ?></span>
                            <button class="add-cart">Add to cart</button>
                            <a href="AddProductDetails.php?id=<?php echo $row['product_id']; ?>" class="view-details">
                                <button class="view-details">View Details</button>
                            </a>
                            <!-- <a href="AddProductDetails.<php?id=' . $product_id . '">
                                <button class="view-details">View Details</button>
                            </a> -->
                        </div>
                <?php
                    }
                } else {
                    echo "No products found.";
                }
                ?>
            </div>
            <div class="SeeMore">
                <a href="Shop.php">See More</a>
            </div>
        </div>

        <?php
        $conn->close();
        ?>

        <div class="training-box">
            <div class="training-section">
                <a href="Trainer.php">
                    <h1>Training Programs</h1>
                    <div class="Training-section-Content">
                        <p><q>Explore our training programs designed to enhance your pet's skills and strengthen your
                                bond together.</q></p>
                    </div>
                    <div class="Training-Video">
                        <video src="Resources/Video3.mp4" autoplay loop muted class="original-video"></video>
                    </div>
                </a>
            </div>
        </div>
        <div class="other-section">
            <div class="adopt-section">
                <a href="CareSection.php">
                    <h1>Dog Care</h1>
                    <div class="Dog-img" style="margin-left: -50px;">
                        <img src="Resources/DogCheckup.png" alt="Dog Check Up Image">
                    </div>
                    <div class="Content">
                        <p><q>Discover essential dog care tips to keep your furry friend healthy and happy.

                            </q></p>
                    </div>
                </a>
            </div>
    </main>
    <?php include  'Footer.php' ?>
    <script src="script.js"></script>
</body>

</html>