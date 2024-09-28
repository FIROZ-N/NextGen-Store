<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error.");
}

// Handle product update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = floatval($_POST['price']);
    $main_image_url = $_POST['main_image_url'];

    // Update the product in the database
    $query = "UPDATE products SET name = ?, description = ?, price = ?, main_image_url = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $description, $price, $main_image_url, $product_id]);

    echo "Product updated successfully!";
}

// Fetch product details for the update form
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// If no product is found, display a message and exit
if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h1>Update Product</h1>
    <form method="post">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" step="0.01" required><br>
        <label for="main_image_url">Image URL:</label>
        <input type="text" id="main_image_url" name="main_image_url" value="<?= htmlspecialchars($product['main_image_url']) ?>" required><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
