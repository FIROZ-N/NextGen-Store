<?php
// Start session and include necessary files
session_start();
include '../../Backend/database/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch user cart data
$user_id = $_SESSION['user_id'];

// Initialize variables
$cartItems = [];
$totalAmount = 0;

try {
    // Get cart items from the cart
    $cartSql = "SELECT c.*, p.name AS product_name, p.price, p.main_image_url 
                FROM cart c 
                JOIN products p ON c.product_id = p.id 
                WHERE c.user_id = ?";
    $cartStmt = $db->prepare($cartSql);
    $cartStmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $cartStmt->execute();
    $cartItems = $cartStmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate total amount
    foreach ($cartItems as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Handle checkout logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Ensure phone number is provided
    if (empty($_POST['phone_number'])) {
        echo "Phone number is required to place an order.";
        exit();
    }

    $phone_number = $_POST['phone_number'];
    try {
        // Insert each item into the orders table and remove from cart
        foreach ($cartItems as $item) {
            $total_amount = $item['price'] * $item['quantity'];
            $insertOrderSql = "INSERT INTO orders (user_id, product_id, quantity, total_amount, phone_number) 
                               VALUES (?, ?, ?, ?, ?)";
            $orderStmt = $db->prepare($insertOrderSql);
            $orderStmt->execute([$user_id, $item['product_id'], $item['quantity'], $total_amount, $phone_number]);

            // Remove item from cart after placing order
            $removeCartSql = "DELETE FROM cart WHERE id = ?";
            $removeCartStmt = $db->prepare($removeCartSql);
            $removeCartStmt->execute([$item['id']]);
        }

        // Set session variable for successful order placement
        $_SESSION['order_placed'] = true;

        // Redirect to place_order.php
        header("Location: placeorder.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="./checkoutcart.css">
</head>

<body>
    <div class="container">
        <h2>Checkout</h2>
        <?php if (empty($cartItems)): ?>
            <div class="card">
                <p class="empty-cart">Your cart is empty.</p>
            </div>
        <?php else: ?>
            <div class="card">
                <form method="POST" action="checkout_cart.php">
                    <div class="card-body">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td><img src="<?= htmlspecialchars($item['main_image_url']) ?>" alt="Product Image" class="product-image"></td>
                                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                                        <td>$<?= number_format($item['price'], 2) ?></td>
                                        <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <h3>Total Amount: $<?= number_format($totalAmount, 2) ?></h3>
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" name="phone_number" id="phone_number" required>
                        <button type="submit" name="place_order" class="btn-place-order">Place Order</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>