<?php
session_start();
include '../../Backend/database/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You must be logged in to add items to the cart or make a purchase.');
            window.location.href = '../../Frontend/home/login.php';
          </script>";
    exit();
}

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error.");
}

// Get the product ID from the query string
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details from the database
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// If no product is found, display a message and exit
if (!$product) {
    die("Product not found.");
}

// Handle form submission for adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO cart (user_id, product_id) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    if ($stmt->execute([$user_id, $product_id])) {
        echo "<script>alert('Product added to cart.');</script>";
    } else {
        echo "<script>alert('Error adding product to cart.');</script>";
    }
}

// Handle form submission for buying now
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_now'])) {
    header('Location: ../cart/checkout.php?id=' . $product_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - Product Details</title>
    <link rel="stylesheet" href="../store/store.css">
    <link rel="stylesheet" href="./product.css">
</head>

<body>
    <?php include '../store/main-navbar.php'; ?>

    <div class="cnt">
        <div class="product-details-container">
            <!-- Main Product Image -->
            <div class="main-image">
                <?php if (strpos($product['main_image_url'], 'http') === 0): ?>
                    <img id="mainImage" src="<?= htmlspecialchars($product['main_image_url']) ?>" alt="Main Product Image">
                <?php else: ?>
                    <img id="mainImage" src="../uploads/<?= htmlspecialchars($product['main_image_url']) ?>" alt="Main Product Image">
                <?php endif; ?>
            </div>

            <!-- Sub Images -->
            <div class="sub-images">
                <?php if ($product['sub_image1_url']): ?>
                    <img src="<?= htmlspecialchars($product['sub_image1_url']) ?>" onclick="swapImages(this)" alt="Sub Image 1">
                <?php endif; ?>
                <?php if ($product['sub_image2_url']): ?>
                    <img src="<?= htmlspecialchars($product['sub_image2_url']) ?>" onclick="swapImages(this)" alt="Sub Image 2">
                <?php endif; ?>
                <?php if ($product['sub_image3_url']): ?>
                    <img src="<?= htmlspecialchars($product['sub_image3_url']) ?>" onclick="swapImages(this)" alt="Sub Image 3">
                <?php endif; ?>
                <?php if ($product['sub_image4_url']): ?>
                    <img src="<?= htmlspecialchars($product['sub_image4_url']) ?>" onclick="swapImages(this)" alt="Sub Image 4">
                <?php endif; ?>
            </div>

            <!-- Product Actions -->
            <div class="product-actions">
                <form method="POST" action="">
                    <button type="submit" name="buy_now" class="btn buy-now">Buy Now</button>
                </form>
                <form method="POST" action="">
                    <button type="submit" name="add_to_cart" class="btn add-to-cart">Add to Cart</button>
                </form>
            </div>

            <!-- Product Information -->
            <div class="product-info">
                <h1><?= htmlspecialchars($product['name']) ?></h1>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <h2>Price: $<?= htmlspecialchars($product['price']) ?></h2>

                <!-- Key Features (if available) -->
                <?php if ($product['key_features']): ?>
                    <h3>Key Features</h3>
                    <ul>
                        <?php foreach (explode("\n", $product['key_features']) as $feature): ?>
                            <li><?= htmlspecialchars($feature) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <br>
    <br>
    <center>
        <a class="bs" href="../store/store.php">Back to Store</a>
    </center>
    <br>
    <br>

    <script>
        const mainImage = document.getElementById('mainImage');

        function swapImages(e) {
            // Swapping the sub images with the main image
            mainImage.src = e.src;
        }
    </script>

    <?php include '../home/controls/footer.php'; ?>
</body>

</html>