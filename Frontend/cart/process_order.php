<?php
session_start();
include '../../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $user_id = $_SESSION['user_id'];

    // Insert each product in the cart as an order
    foreach ($_SESSION['checkout_cart'] as $item) {
        $product_id = intval($item['product_id']);
        $quantity = intval($item['quantity']);
        $product_price = floatval($item['price']);
        $total_amount = $product_price * $quantity;

        // Insert order into the database
        $query = "INSERT INTO orders (user_id, product_id, quantity, total_amount, phone_number, status) VALUES (?, ?, ?, ?, ?, 'pending')";
        $stmt = $db->prepare($query);
        $stmt->execute([$user_id, $product_id, $quantity, $total_amount, $phone_number]);
    }

    // Clear cart
    unset($_SESSION['checkout_cart']);

    // Redirect to confirmation page
    header("Location: order_confirmation.php?order=success");
    exit();
} else {
    // Invalid request
    header("Location: checkout_page.php");
    exit();
}
