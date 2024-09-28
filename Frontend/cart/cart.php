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

try {
    $cartSql = "SELECT c.*, p.name AS product_name, p.price, p.main_image_url 
                FROM cart c 
                JOIN products p ON c.product_id = p.id 
                WHERE c.user_id = ?";
    $cartStmt = $db->prepare($cartSql);
    $cartStmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $cartStmt->execute();
    $cartItems = $cartStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Handle remove product, update quantity, and place order logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        // Remove item from cart
        $cart_id = $_POST['cart_id'];
        $removeSql = "DELETE FROM cart WHERE id = ?";
        $removeStmt = $db->prepare($removeSql);
        $removeStmt->execute([$cart_id]);
        header("Location: cart.php");
        exit();
    } elseif (isset($_POST['update_quantity'])) {
        // Update item quantities
        foreach ($_POST['quantity'] as $cart_id => $quantity) {
            $quantity = max(0, intval($quantity)); // Ensure quantity is non-negative
            $updateSql = "UPDATE cart SET quantity = ? WHERE id = ?";
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->execute([$quantity, $cart_id]);
        }
        header("Location: cart.php");
        exit();
    } elseif (isset($_POST['place_order'])) {
        // Ensure phone number is provided
        if (empty($_POST['phone_number'])) {
            echo "Phone number is required to place an order.";
            exit();
        }

        $phone_number = $_POST['phone_number'];
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

        // Redirect to confirmation page or display success message
        header("Location: ../../Backend/user/profile/profile.php?order_placed=success");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="./cart.css">
    <script>
        function confirmRemoval() {
            return confirm("Are you sure you want to remove this item from your cart?");
        }
    </script>
</head>

<body>
    <h2>NextGen - Your Cart</h2>
    <?php if (empty($cartItems)): ?>
        <p style="text-align: center;">Your cart is empty.</p>
    <?php else: ?>
        <!-- Form for updating quantities -->
        <form method="POST" action="cart.php">
            <div class="table-container">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Actions</th>
                        <th>Proceed</th> <!-- New column for proceed button -->
                    </tr>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><img src="<?= htmlspecialchars($item['main_image_url']) ?>" alt="Product Image" style="width: 50px;"></td>
                            <td>
                                <input type="number" name="quantity[<?= $item['id'] ?>]" value="<?= htmlspecialchars($item['quantity']) ?>" min="0">
                            </td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            <td>
                                <form method="POST" action="cart.php" onsubmit="return confirmRemoval();">
                                    <button type="submit" name="remove">Remove</button>
                                    <input type="hidden" name="cart_id" value="<?= htmlspecialchars($item['id']) ?>">
                                </form>
                            </td>
                            <td>
                                <!-- Proceed button -->
                                <a href="checkout_cart.php?id=<?= htmlspecialchars($item['product_id']) ?>" class="btn-proceed">Proceed</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <button type="submit" name="update_quantity">Update Quantities</button>
        </form>
        <br>
        <br>
        <hr>

    <?php endif; ?>
    <br>
    <center><a class="cs" href="../store/store.php">Continue Shopping !</a></center>
</body>

</html>