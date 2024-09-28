<!-- <?php
session_start();
include('../../Backend/database/db.php');

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error.");
}

// Fetch cart data
$query = "SELECT c.id, c.quantity, p.image_url, p.name AS product_name, p.price, u.username, u.email
          FROM cart c
          JOIN products p ON c.product_id = p.id
          JOIN user u ON c.user_id = u.id";
$cartItems = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart Products</title>
    <link rel="stylesheet" href="./panel.css">
</head>

<body>
    <div class="container">
        <h1>Cart Products</h1>

        <?php if (empty($cartItems)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" style="width: 100px;">
                    <p>Username: <?= htmlspecialchars($item['username']) ?></p>
                    <p>Email: <?= htmlspecialchars($item['email']) ?></p>
                    <p>Product: <?= htmlspecialchars($item['product_name']) ?></p>
                    <p>Price: $<?= htmlspecialchars(number_format($item['price'], 2)) ?></p>
                    <p>Quantity: <?= htmlspecialchars($item['quantity']) ?></p>
                    <p>Total: $<?= htmlspecialchars(number_format($item['price'] * $item['quantity'], 2)) ?></p>
                    <a href="place_order.php?id=<?= $item['id'] ?>">Place Order</a>
                    <a href="remove_from_cart.php?id=<?= $item['id'] ?>">Remove</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html> -->