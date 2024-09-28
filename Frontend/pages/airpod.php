<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error."); // If there's a connection issue, stop further execution
}

// Get the selected category from the query parameter
$category = 'airpods'; // Adjusted to AirPods

// Prepare the query based on the selected category
$query = "SELECT * FROM products WHERE category = ?";

// Prepare and execute the query
$stmt = $db->prepare($query);
$stmt->execute([$category]);

// Fetch all products
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirPods - NextGen Store</title>
    <link rel="stylesheet" href="./page.css">
</head>

<body>
    <?php include '../store/main-navbar.php'; ?>
    <br><br>

    <!-- Display Product Slider -->
    <?php if (!empty($products)): ?>
        <div class="slider-container">
            <div class="slider">
                <?php foreach ($products as $product): ?>
                    <div class="slide">
                        <img src="<?= htmlspecialchars($product['main_image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Slider navigation controls -->
            <a class="prev" onclick="plusSlides(-1)">&#60;</a>
            <a class="next" onclick="plusSlides(1)">&#62;</a>
        </div>
    <?php else: ?>
        <p style="text-align: center;">No AirPods available.</p>
    <?php endif; ?>
    <br>
    <br>

    <!-- Display Products in Cards -->
    <?php if (empty($products)): ?>
        <p style="text-align: center;">No AirPods available.</p>
    <?php else: ?>
        <div class="products">
            <?php foreach ($products as $product): ?>
                <a href="../../Frontend/store/product-details.php?id=<?= htmlspecialchars($product['id']) ?>"
                    class="product-card">
                    <img src="<?= htmlspecialchars($product['main_image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><?= htmlspecialchars($product['description']) ?></p>
                    <p class="price">$<?= htmlspecialchars($product['price']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <br>
    <center>
        <a class="linkkk" href="../pages/airpod.php">Go to Store!</a>
    </center>
    <br>
    <?php include '../home/controls/footer.php'; ?>
    
    <script>
        // Add JavaScript for slider functionality
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slide");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slides[slideIndex-1].style.display = "block";  
        }
    </script>
</body>

</html>
