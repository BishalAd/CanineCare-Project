<html>
<body>
    <nav>
        <div class="logo">
            <a href="index.php">
            <img src="Resources/Black logo - no background.svg" alt="CanineCare">
            </a>
        </div>
        <div class="Main-Nav">
            <ul class="sidebar">
                <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30">
                            <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg></a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="Adopt/AdoptSection.php">Adopt</a></li>
                <li><a href="Shop.php">Shop</a></li>
                <li><a href="testing/add_trainer.php">Training</a></li>
                <li><a href="Care.html">Care</a></li>
                <li><a href="Aboutus.php">About Us</a></li>
            </ul>
            <ul class="horizontal-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="Adopt/AdoptSection.php">Adopt</a></li>
                <li><a href="Shop.php">Shop</a></li>
                <li><a href="testing/add_trainer.php">Training</a></li>
                <li><a href="Care.html">Care</a></li>
                <li><a href="Aboutus.php">About Us</a></li>
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
                    echo '<img src="' . $profileImage . '">';
                    echo '<h3>' . $FullName . '</h3>';
                    echo '</div>
                    <hr>
                    <a href="#" class="sub-menu-link">
                        <i class="fa-solid fa-user-edit"></i>
                        <p>Edit Profile</p>
                        <span>></span>
                    </a>
                    <a href="ChangePassword.php" class="sub-menu-link">
                        <i class="fa-solid fa-key"></i>
                        <p>Change Password</p>
                        <span>></span>
                    </a>
                    <a href="logout.php" class="sub-menu-link">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        <p>Logout</p>
                        <span>></span>
                    </a>

                </div>
            </div>

                    ';
                } else {
                    echo "<a href='login.php'>
                        <i class='fa-solid fa-right-to-bracket'></i>
                      </a>";
                }
            } else {
                echo "<a href='login.php'>
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