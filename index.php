<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CanineCare: The Dog Care Center</title>
    <link rel="shortcut icon" type="x-con" href="Resources/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include  'nav.php'?>
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
                <a href="Adopt.html">
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
        <div id="trending-product">
            <h1>Trending Products</h1>
            <div id="products">
                <div class="box">
                    <div class="imgbox">
                        <img src="Resources/product1.png" alt="Product 1" class="product-img">
                    </div>
                    <h2 class="product-title">Endi Chews Milk Flavor Soft Knotted Treats Bone - 100gm</h2><br>
                    <span class="price">RS 450</span>
                    <button class="add-cart">Add to cart</button>
                </div>
                <div class="box">
                    <div class="imgbox">
                        <img src="Resources/product2.png" alt="Product 2" class="product-img">
                    </div>
                    <h2 class="product-title">Super bite Snacks / duck roll stick / Pet Food Supplies</h2><br>
                    <span class="price">RS 300</span>
                    <button class="add-cart">Add to cart</button>
                </div>
                <div class="box">
                    <div class="imgbox">
                        <img src="Resources/product3.png" alt="Product 3" class="product-img">
                    </div>
                    <h2 class="product-title">Pedigree Adult Dry Dog Food- Vegetarian, 1.kg</h2><br>
                    <span class="price">RS 35453</span>
                    <button class="add-cart">Add to cart</button>
                </div>
                <div class="box">
                    <div class="imgbox">
                        <img src="Resources/product4.png" alt="Product 4" class="product-img">
                    </div>
                    <h2 class="product-title">1 KG Loose Pack Adult Dog Food By Crown Aquatics</h2><br>
                    <span class="price">RS 310</span>
                    <button class="add-cart">Add to cart</button>
                </div>
                <div class="box">
                    <div class="imgbox">
                        <img src="Resources/product5.png" alt="Product 5" class="product-img">
                    </div>
                    <h2 class="product-title">Super bite Snacks / duck roll stick / Pet Food Supplies</h2><br>
                    <span class="price">RS 300</span>
                    <button class="add-cart">Add to cart</button>
                </div>
                <div class="box">
                    <div class="imgbox">
                        <img src="Resources/product6.png" alt="Product 6" class="product-img">
                    </div>
                    <h2 class="product-title">Foam Shampoo / Pet Shampoo / Pet cleaning shampoo</h2><br>
                    <span class="price">RS 450</span>
                    <button class="add-cart">Add to cart</button>
                </div>
                <div class="box">
                    <div class="imgbox">
                        <img src="Resources/product7.png" alt="Product 7" class="product-img">
                    </div>
                    <h2 class="product-title">Puppy Neck belt / Pet NeckBelt / Pet Accessories</h2><br>
                    <span class="price">RS 160</span>
                    <button class="add-cart">Add to cart</button>
                </div>
                <div class="box">
                    <div class="imgbox">
                        <img src="Resources/product8.png" alt="Product 8" class="product-img">
                    </div>
                    <h2 class="product-title">Bone Design Collar Bell For Dogs | Crafted from a premium quality </h2>
                    <br>
                    <span class="price">RS 110</span>
                    <button class="add-cart">Add to cart</button>
                </div>
            </div>
            <a href="Shop.html">See More</a>
        </div>
        <div class="training-box">
            <div class="training-section">
                <a href="Training.html">
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
                <a href="Adopt.html">
                    <h1>Dog Care</h1>
                    <div class="Dog-img" style="margin-left: -35px;">
                        <img src="Resources/DogCheckup.png" alt="Dog Check Up Image">
                    </div>
                    <div class="Content">
                        <p><q>Discover essential dog care tips to keep your furry friend healthy and happy.

                            </q></p>
                    </div>
                </a>
            </div>
    </main>
    <footer>
        <div class="row">
            <div class="col">
                <img src="Resources/White logo.svg" alt="logo" class="logo">
                <p>Welcome to Canine Care, your ultimate destination for all things dog-related. From adoption services
                    to premium dog food and accessories, we're here to cater to every aspect of your canine companion's
                    needs. Our platform also offers valuable information on dog health care and access to professional
                    trainers, ensuring your furry friend receives the best care possible.</p>
            </div>
            <div class="col">
                <h3>Quick Links</h3>
                <ul class="Footer-list">
                    <li><a href="">Home</a></li>
                    <li><a href="">Adopt</a></li>
                    <li><a href="Shop/Shop.php">Shop</a></li>
                    <li><a href="">Traning</a></li>
                    <li><a href="">Care</a></li>
                    <li><a href="">About Us</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Contact us</h3>
                <p>Lekhnath</p>
                <p>Pokhara-26, Kaski</p>
                <p class="email">canineecare@gmail.com</p>
                <h4>+977 - 9825150365</h4>
            </div>
            <div class="col"></div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>