<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error."); // If there's a connection issue, stop further execution
}

// Get the selected category from the query parameter
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Prepare the query based on the selected category
if ($category === 'all') {
    $query = "SELECT * FROM products";
} else {
    $query = "SELECT * FROM products WHERE category = ?";
}

// Prepare and execute the query
$stmt = $db->prepare($query);
if ($category !== 'all') {
    $stmt->execute([$category]);
} else {
    $stmt->execute();
}

// Fetch all products
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch slider data from the database
$slidesQuery = "SELECT * FROM slider ORDER BY slide_order ASC";
$slides = $db->query($slidesQuery)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Page</title>
    <link rel="stylesheet" href="./store.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.cs">
</head>

<body>
    <?php include './main-navbar.php'; ?>

    <div class="slideshow-container" style="overflow:hidden;height:550px;width:100% !important;">
        <!-- Display each slide fetched from the database -->
        <?php foreach ($slides as $index => $slide): ?>
            <div class="mySlides fade">
                <?php if (strpos($slide['image_url'], 'http') === 0): ?>
                    <img class="img" src="<?= htmlspecialchars($slide['image_url']) ?>">
                <?php else: ?>
                    <img class="img" src="../uploads/<?= htmlspecialchars($slide['image_url']) ?>">
                <?php endif; ?>
                <div class="text" style="z-index:99 !important;"><?= htmlspecialchars($slide['caption']) ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="product-link" style="z-index: 999 !important;">
        <div class="product-links">
            <a href="?category=all" class="filter-link">All Products</a>
            <a href="?category=iphone" class="filter-link">iPhone</a>
            <a href="?category=samsung" class="filter-link">Samsung</a>
            <a href="?category=redmi" class="filter-link">Redmi</a>
            <a href="?category=wired_headphone" class="filter-link">Wired&nbsp;HeadPhone</a>
            <a href="?category=wireless_headphone" class="filter-link">Wireless&nbsp;HeadPhone</a>
            <a href="?category=airpods" class="filter-link">AirPods</a>
        </div>
    </div>

    <div class="cntt">
        <div class="cnt">
            <div class="products">
                <?php if (empty($products)): ?>
                    <p style="position:absolute;left:50%;transform: translateX(-50%);text-align: center !important;width: 100%;color:aquamarine;">No products available in this category !</p>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-item">
                            <?php if (strpos($product['main_image_url'], 'http') === 0): ?>
                                <img src="<?= htmlspecialchars($product['main_image_url']) ?>" alt="Product Image">
                            <?php else: ?>
                                <img src="../uploads/<?= htmlspecialchars($product['main_image_url']) ?>" alt="Product Image">
                            <?php endif; ?>
                            <h2><?= htmlspecialchars($product['name']) ?></h2>
                            <p style="display: none;"><?= htmlspecialchars($product['description']) ?></p>
                            <p>Price: $<?= htmlspecialchars($product['price']) ?></p>
                            <!-- Updated link to product-details.php -->
                            <a href="../../Frontend/store/product-details.php?id=<?= htmlspecialchars($product['id']) ?>" class="view-button">View</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include '../home/controls/footer.php'; ?>
    <script src="./store.js"></script>
</body>

</html>