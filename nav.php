<html>
<style>
    .sub-menu-wrap {
        position: absolute;
        top: 100%;
        left: 70%;
        width: 320px;
        max-height: 0px;
        overflow: hidden;
        transition: max-height 0.5s;
    }

    .sub-menu-wrap.open-menu {
        max-height: 400px;
    }

    .sub-menue {
        background: #fff;
        padding: 20px;
        margin: 10px;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-info h3 {
        font-weight: 500;
    }

    .user-info img {
        width: 60px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .sub-menue hr {
        border: 0;
        height: 1px;
        width: 100%;
        background: #ccc;
        margin: 15px 0 10px;
    }

    .sub-menu-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #525252;
        margin: 12px 0;
    }

    .sub-menu-link i {
        font-size: 24px;
        margin-right: 15px;
        color: #525252;
    }

    .sub-menu-link:hover i {
        color: #000;
    }

    .sub-menu-link p {
        width: 100%;
        font-size: 18px;
        font-weight: 100;
    }

    .sub-menu-link img {
        width: 40px;
        background: #e5e5e5;
        border-radius: 50%;
        padding: 8px;
        margin-right: 15px;
    }

    .sub-menu-link span {
        font-size: 22px;
        transform: transform 0.5s;
    }

    .sub-menu-link:hover span {
        transform: translateX(5px);
    }

    .sub-menu-link:hover p {
        font-weight: 600;
    }
</style>

<body>


    <nav>
        <div class="logo">
            <img src="Black logo - no background.svg" alt="CanineCare">
        </div>
        <div class="Main-Nav">
            <ul class="sidebar">
                <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                            <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg></a></li>
                <li><a href="index.html">Home</a></li>
                <li><a href="Adopt/AdoptSection.html">Adopt</a></li>
                <li><a href="Shop/Shop.php">Shop</a></li>
                <li><a href="Training.html">Training</a></li>
                <li><a href="Care.html">Care</a></li>
                <li><a href="AboutUs.html">About Us</a></li>
            </ul>
            <ul class="horizontal-nav">
                <li><a href="index.html">Home</a></li>
                <li><a href="Adopt/AdoptSection.html">Adopt</a></li>
                <li><a href="Shop/Shop.php">Shop</a></li>
                <li><a href="Training.html">Training</a></li>
                <li><a href="Care.html">Care</a></li>
                <li><a href="AboutUs.html">About Us</a></li>
            </ul>
        </div>
        <div class="login-Cart">
            <a href="#">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <?php
            session_start();

            // Check if user is logged in
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];

                // Connect to your database (modify connection details as needed)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "caninecare_db";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT profileImage, FullName FROM users WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $FullName = $row['FullName'];
                    $profileImage = $row['profileImage']; // Adjusted path
                    // $profileImageURL = "RegisterAndLogin/" . $profileImage;
                } else {
                    $profileImage = ""; // Default image or empty string 
                }

                $conn->close();

                if (!empty($profileImage)) {
                    echo "<img src='$profileImage' alt='Profile Picture' class='profile-pic' onclick='toggleMenu()'>";
                    echo '

                    <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menue">
                    <div class="user-info">';
                    echo '<img src="'. $profileImage. '">';
                    echo '<h3>' . $FullName . '</h3>';
                    echo '</div>
                    <hr>
                    <a href="#" class="sub-menu-link">
                        <i class="fa-solid fa-user-edit"></i>
                        <p>Edit Profile</p>
                        <span>></span>
                    </a>
                    <a href="#" class="sub-menu-link">
                        <i class="fa-solid fa-key"></i>
                        <p>Change Password</p>
                        <span>></span>
                    </a>
                    <a href="RegisterAndLogin/logout.php" class="sub-menu-link">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        <p>Logout</p>
                        <span>></span>
                    </a>

                </div>
            </div>

                    ';
                } else {
                    echo "<a href='RegisterAndLogin/login.html'>
                        <i class='fa-solid fa-right-to-bracket'></i>
                      </a>";
                }
            } else {
                echo "<a href='RegisterAndLogin/login.html'>
                    <i class='fa-solid fa-right-to-bracket'></i>
                  </a>";
            }
            ?>
        </div>
        <div class="Menu-btn">
            <a onclick="showSidebar()"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg></a>
        </div>
    </nav>
    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>

</body>

</html>