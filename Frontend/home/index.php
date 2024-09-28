<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Backend/user/login.php");
    exit();
}

// Display welcome message
if (isset($_GET['message'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['message']) . "');</script>";
}

// Fetch user data
include('../../Backend/database/db.php');
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userData = $stmt->get_result()->fetch_assoc();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGen</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div id="menu" class="sidemenu">
        <div class="top">
            <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
            <a href="../store/store.php" target="_blank" onclick="closeMenu()">Store</a>
            <a href="#iphone" onclick="closeMenu()">iPhone</a>
            <a href="#samsung" onclick="closeMenu()">Samsung</a>
            <a href="#redmi" onclick="closeMenu()">Redmi</a>
            <a href="#wihp" onclick="closeMenu()">Wired HeadPhone</a>
            <a href="#wrhp" onclick="closeMenu()">Wireless HeadPhone</a>
            <a href="#air" onclick="closeMenu()">Airpods</a>
            <a href="#News-letter" onclick="closeMenu()">Subscribition</a>
            <a href="#footer" onclick="closeMenu()">More</a>
        </div>
    </div>

    <div class="navbar">
        <div class="navbar-logo">
            <a href="#">NextGen</a>
        </div>
        <div id="navbar-links" class="navbar-links">
            <a href="../cart/cart.php" onclick="window.location.href='/Frontend/cart/view_cart.php';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
                </svg>
            </a>
            <a href="../../Backend/user/profile/profile.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
            </a>
            <a href="#####" onclick="openMenu()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg></a>
        </div>
    </div>
    <div id="store" class="page" style="background: url('https://static.vecteezy.com/system/resources/previews/032/542/079/original/3d-illustration-gadgets-with-leaves-ai-generated-png.png');">
        <div class="cnt">
            <div class="quote">
                <p>"Welcome to <span class="str">NextGen</span> ! Your Destination for the Latest Tech and Accessories!" <span class="span">"Discover the latest tech gadgets and accessories at unbeatable prices. Shop with confidence for quality and innovation."</span></p>
                <a href="../store/store.php" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
    <div id="iphone" class="page sub" style="background: url('https://www.freeiconspng.com/uploads/iphone-x-hd-pic-10.png');">
        <div class="cnt">
            <div class="quote">
                <p>"Explore our collection of the latest iPhones. Sleek design, powerful performance, and cutting-edge features await you."</p>
                <a href="../pages/iphone.php" class="btn">Shop Now</a>
            </div>
        </div>
    </div>


    <div id="samsung" class="page sub" style="background-position: center !important; background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEWD2wYX7n7seiG65wM2hkTPdbPTZGFTHPow&s');">
        <div class="cnt">
            <div class="quote">
                <p>"Experience innovation with Samsung. Discover cutting-edge smartphones and accessories designed for your connected lifestyle."</p>
                <a href="../pages/samsung.php" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
    <div id="redmi" class="page sub" style="background-position: center !important; background: url('https://www.sony-africa.com/image/f3f1e4cde7ef052790bfd64ce85f39bb?fmt=png-alpha&wid=1200');">
        <div class="cnt">
            <div class="quote">
                <p>"Immerse yourself in sound with our wireless headphones. Seamless connectivity, superior audio, and all-day comfort."</p>
                <a href="../pages/wireless.php" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
    <div id="wihp" class="page sub" style="background: url('https://cdn.mos.cms.futurecdn.net/fBLWy65De7iw6gHfy33ANK.jpg');">
        <div class="cnt">
            <div class="quote">
                <p>"Unlock innovation with Xiaomi. Explore feature-packed smartphones and smart devices at unbeatable prices."</p>
                <a href="../pages/redmi.php" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
    <div id="wrhp" class="page sub" style="background: url('https://www.fingers.co.in/secure/api/uploads/products/1558509846_f_10.png');">
        <div class="cnt">
            <div class="quote">
                <p>"Enjoy crystal-clear sound with our wired headphones. Reliable performance, superior audio quality, and comfort you can trust."</p>
                <a href="../pages/wired.php" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
    <div id="air" class="page sub" style="background: url('https://images.squarespace-cdn.com/content/v1/5388de33e4b01b17bc0d1ed7/354b96f9-63ed-4f8c-a547-6922ae4664d5/Design40APoster-AirPods.png');">
        <div class="cnt">
            <div class="quote">
                <p>"Experience true wireless freedom with our AirPods. Superior sound quality, seamless connectivity, and an effortless listening experience."</p>
                <a href="../pages/airpod.php" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
    <!-- <div class="page sub" style="background: url('');">
        <div class="cnt">
            <div class="quote">
                <p></p>
                <a href="#" class="btn">Shop Now</a>
            </div>
        </div>
    </div> -->
    <section class="news-letter" id="News-letter">
        <div class="news">
            <div class="container">
                <h1 class="news-heading">Subscribe To Get The Latest <br> News About Us</h1>
                <p class="des how-de">Get the latest news about digital Marketing in your pocket. Drop your <br> email below to get daily updates about us.</p>

                <form action="../home/subscribe.php" method="POST">
                    <input style="outline: none;" type="email" name="email" maxlength="50" required placeholder="Enter your email address">
                    <button class="bt" type="submit">Subscribe</button>
                </form>
                <?php
                // Check for the message in the URL and display it
                if (isset($_GET['message'])) {
                    echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <?php include './controls/footer.php' ?>
    <script src="./script.js"></script>
</body>

</html>