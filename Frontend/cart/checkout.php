<?php
// Start session
session_start();

// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error.");
}

// Get the product ID from the query string (for direct Buy Now)
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details from the database if the product ID exists
if ($product_id) {
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no product is found, display a message and exit
    if (!$product) {
        die("Product not found.");
    }
} else {
    // If no product ID is passed, assume cart checkout
    if (!isset($_SESSION['checkout_cart']) || empty($_SESSION['checkout_cart'])) {
        die("No items in the cart for checkout.");
    }

    // Retrieve cart items from session (in case of cart-based checkout)
    $cartItems = $_SESSION['checkout_cart'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - Checkout</title>
    <link rel="stylesheet" href="../store/store.css">
    <link rel="stylesheet" href="./check.css">
</head>

<body>
    <?php include '../../Frontend/store/main-navbar.php'; ?>

    <div class="cnt">
        <div class="product-details-container">
            <!-- Product Image -->
            <div class="main-image">
                <?php if (strpos($product['main_image_url'], 'http') === 0): ?>
                    <img id="mainImage" src="<?= htmlspecialchars($product['main_image_url']) ?>" alt="Main Product Image">
                <?php else: ?>
                    <img id="mainImage" src="../uploads/<?= htmlspecialchars($product['main_image_url']) ?>" alt="Main Product Image">
                <?php endif; ?>
            </div>

            <!-- Product Information -->
            <div class="product-info">
                <h1><?= htmlspecialchars($product['name']) ?></h1>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <h2>Price: $<span id="price"><?= htmlspecialchars($product['price']) ?></span></h2>

                <!-- Increment and Quantity -->
                <form id="orderForm" action="place_order.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                    <input type="hidden" name="product_price" value="<?= htmlspecialchars($product['price']) ?>">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" max="10" required>

                    <!-- Phone Number Input -->
                    <br>
                    <label for="phone_number">Phone Number:</label><br>
                    <input type="text" id="phone_number" name="phone_number" required>

                    <!-- Show Total -->
                    <div class="total">
                        Shipping: $<span id="shipping">0</span><br>
                        Total: $<span id="total"></span>
                    </div>

                    <!-- Action Buttons -->
                    <button type="button" class="btn buy-now" onclick="showModal()">Place Order</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="checkoutModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Confirm Your Order</h2>
            <div class="modal-product-details">
                <div class="modal-product-image">
                    <?php if (strpos($product['main_image_url'], 'http') === 0): ?>
                        <img src="<?= htmlspecialchars($product['main_image_url']) ?>" alt="Product Image" style="max-width: 100px; height: auto;">
                    <?php else: ?>
                        <img src="../uploads/<?= htmlspecialchars($product['main_image_url']) ?>" alt="Product Image" style="max-width: 100px; height: auto;">
                    <?php endif; ?>
                </div>
                <div class="modal-product-info">
                    <p>Product: <?= htmlspecialchars($product['name']) ?></p>
                    <p>Quantity: <span id="modalQuantity">1</span></p>
                    <p>Total: $<span id="modalTotal"></span></p>
                    <p class="phone-number"><span class="phone-number-label">Phone Number:</span> <span id="modalPhoneNumber"></span></p>
                    <p>Delivery Method: Pay on Delivery</p>
                    <p>Estimated Delivery Date: <span id="deliveryDate"></span></p>
                </div>
            </div>
            <div class="modal-button-container">
                <button class="btn-confirm" onclick="confirmOrder()">Confirm</button>
                <button class="btn-cancel" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Function to update total and modal content
            function updateTotal() {
                const price = parseFloat(document.getElementById('price').textContent);
                const quantity = parseInt(document.getElementById('quantity').value);
                const total = price * quantity;
                document.getElementById('total').textContent = total.toFixed(2);
                document.getElementById('modalTotal').textContent = total.toFixed(2);
                document.getElementById('modalQuantity').textContent = quantity;
                document.getElementById('modalPhoneNumber').textContent = document.getElementById('phone_number').value;
            }

            function calculateDeliveryDate() {
                const today = new Date();
                const deliveryDate = new Date(today);
                deliveryDate.setDate(today.getDate() + 4);

                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const formattedDate = deliveryDate.toLocaleDateString(undefined, options);

                document.getElementById('deliveryDate').textContent = formattedDate;
            }

            window.showModal = () => {
                const phoneNumber = document.getElementById('phone_number').value;
                if (!phoneNumber) {
                    alert("Please enter your phone number.");
                    return;
                }
                updateTotal();
                calculateDeliveryDate();
                document.getElementById('checkoutModal').style.display = "block";
            };

            window.closeModal = () => {
                document.getElementById('checkoutModal').style.display = "none";
            };

            window.confirmOrder = () => {
                const form = document.getElementById('orderForm');
                const formData = new FormData(form);

                fetch('place_order.php', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.text())
                    .then(data => {
                        // Redirect to confirmation page with a success query parameter
                        window.location.href = 'confirmationforthedirectbuyorder.php?order=success';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Redirect to confirmation page with an error query parameter
                        window.location.href = 'confirmation.php?order=error';
                    });
            };

            window.onclick = (event) => {
                if (event.target == document.getElementById('checkoutModal')) {
                    closeModal();
                }
            };

            // Initial total update
            updateTotal();
        });
    </script>

    <?php include '../../Frontend/home/controls/footer.php'; ?>
</body>

</html>