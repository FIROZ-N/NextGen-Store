<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error."); // If there's a connection issue, stop further execution
}

// Get the product ID from the query parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the product details
$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}

// Handle the update of a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];
    $main_image_url = $_POST['main_image_url'];
    $sub_image1_url = $_POST['sub_image1_url'];
    $sub_image2_url = $_POST['sub_image2_url'];
    $sub_image3_url = $_POST['sub_image3_url'];
    $sub_image4_url = $_POST['sub_image4_url'];
    $key_features = $_POST['key_features'];

    // Update query to include new fields
    $stmt = $db->prepare("UPDATE products 
        SET name = ?, description = ?, price = ?, category = ?, image_url = ?, 
            main_image_url = ?, sub_image1_url = ?, sub_image2_url = ?, 
            sub_image3_url = ?, sub_image4_url = ?, key_features = ? 
        WHERE id = ?");
    $stmt->execute([
        $name, $description, $price, $category, $image_url,
        $main_image_url, $sub_image1_url, $sub_image2_url, 
        $sub_image3_url, $sub_image4_url, $key_features, $id
    ]);

    header("Location: store.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="./e.css">
</head>
 
<body>
    <h2>Edit Product</h2>
    <form action="edit-product.php?id=<?= htmlspecialchars($product['id']) ?>" method="post">
        <input type="hidden" name="update_product" value="1">
        
        <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required></label>
        <label>Description: <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea></label>
        <label>Price: <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required></label>
        
        <label>Category:
            <select name="category" required>
                <option value="iphone" <?= $product['category'] === 'iphone' ? 'selected' : '' ?>>iPhone</option>
                <option value="samsung" <?= $product['category'] === 'samsung' ? 'selected' : '' ?>>Samsung</option>
                <option value="redmi" <?= $product['category'] === 'redmi' ? 'selected' : '' ?>>Redmi</option>
                <option value="wired_headphone" <?= $product['category'] === 'wired_headphone' ? 'selected' : '' ?>>Wired Headphone</option>
                <option value="wireless_headphone" <?= $product['category'] === 'wireless_headphone' ? 'selected' : '' ?>>Wireless Headphone</option>
                <option value="airpods" <?= $product['category'] === 'airpods' ? 'selected' : '' ?>>AirPods</option>
            </select>
        </label>
        
        <label>Image URL: <input type="text" name="image_url" value="<?= htmlspecialchars($product['image_url']) ?>" required></label>
        <label>Main Image URL: <input type="text" name="main_image_url" value="<?= htmlspecialchars($product['main_image_url']) ?>" required></label>
        <label>Sub Image 1 URL: <input type="text" name="sub_image1_url" value="<?= htmlspecialchars($product['sub_image1_url']) ?>"></label>
        <label>Sub Image 2 URL: <input type="text" name="sub_image2_url" value="<?= htmlspecialchars($product['sub_image2_url']) ?>"></label>
        <label>Sub Image 3 URL: <input type="text" name="sub_image3_url" value="<?= htmlspecialchars($product['sub_image3_url']) ?>"></label>
        <label>Sub Image 4 URL: <input type="text" name="sub_image4_url" value="<?= htmlspecialchars($product['sub_image4_url']) ?>"></label>
        <label>Key Features: <textarea name="key_features"><?= htmlspecialchars($product['key_features']) ?></textarea></label>
        
        <button type="submit">Update Product</button>
        <a href="store.php">Back to Store</a>
    </form>
</body>

</html>
