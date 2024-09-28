<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error.");
}

// Get the product ID from the query string
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id']; // Assume user ID is stored in session

// Fetch product details from the database
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// If no product is found, display a message and exit
if (!$product) {
    die("Product not found.");
}

// Add the product to the cart
$query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1";
$stmt = $db->prepare($query);
$stmt->execute([$user_id, $product_id]);

// Redirect to checkout
header('Location: checkout.php?id=' . $product_id);
exit();
