<?php
// Start session
session_start();

// Connect to the database
include '../../Backend/database/db.php';

// Check if cart items are available in the session
if (!isset($_SESSION['checkout_cart']) || empty($_SESSION['checkout_cart'])) {
    die("No items in the cart for checkout.");
}

// Retrieve cart items from session
$cartItems = $_SESSION['checkout_cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../store/">
    <link rel="stylesheet" href="./check.css">
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <form id="checkoutForm" action="process_order.php" method="post">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
            <!-- Product details -->
            <?php foreach ($cartItems as $item): ?>
                <div class="product">
                    <img src="../uploads/<?= htmlspecialchars($item['main_image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    <p><?= htmlspecialchars($item['name']) ?></p>
                    <p>Price: $<?= number_format($item['price'], 2) ?></p>
                    <p>Quantity: <?= htmlspecialchars($item['quantity']) ?></p>
                </div>
            <?php endforeach; ?>
            <button type="button" onclick="showModal()">Place Order</button>
        </form>
        <!-- Modal -->
        <div id="checkoutModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Confirm Your Order</h2>
                <!-- Modal details here -->
                <button onclick="confirmOrder()">Confirm</button>
                <button onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        function showModal() {
            // Show modal logic
            document.getElementById('checkoutModal').style.display = 'block';
        }

        function closeModal() {
            // Close modal logic
            document.getElementById('checkoutModal').style.display = 'none';
        }

        function confirmOrder() {
            const form = document.getElementById('checkoutForm');
            const formData = new FormData(form);

            fetch('process_order.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                // Redirect to confirmation page with a success query parameter
                window.location.href = 'order_confirmation.php?order=success';
            }).catch(error => {
                console.error('Error:', error);
                window.location.href = 'order_confirmation.php?order=error';
            });
        }
    </script>
</body>
</html>
