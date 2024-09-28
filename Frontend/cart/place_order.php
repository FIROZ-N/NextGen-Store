<?php
// Start session
session_start();

// Connect to the database
include '../../Backend/database/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You need to log in to place an order.");
}

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error.");
}

// Get POST data
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
$product_price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0;
$user_id = $_SESSION['user_id'];

// Validate inputs
if ($product_id <= 0 || $quantity <= 0 || $product_price <= 0) {
    die("Invalid input data.");
}

// Calculate random shipping fee between 20 and 70
$shipping_fee = rand(20, 70);

// Calculate total amount (product price * quantity + shipping)
$total_amount = ($product_price * $quantity) + $shipping_fee;

try {
    // Insert order into database
    $query = "INSERT INTO orders (user_id, product_id, quantity, total_amount, shipping_fee, status) VALUES (?, ?, ?, ?, ?, 'Pending')";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id, $product_id, $quantity, $total_amount, $shipping_fee]);

    // Remove product from cart
    $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id, $product_id]);

    // Redirect to the order confirmation page in the cart folder with a success message
    header("Location: ../../Frontend/cart/order_confirmation.php?order=success");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../store/store.css">
    <style>
        .confirmation-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            background-color: #f9fafc;
            padding: 20px;
        }

        .confirmation-message {
            font-size: 1.2rem;
            color: #2c3e50;
            text-align: center;
        }

        .btn-back {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-back:hover {  
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <?php include '../store/main-navbar.php'; ?>

    <div class="confirmation-container">
        <?php
        // Check if the order was successful
        if (isset($_GET['order']) && $_GET['order'] === 'success') {
            echo "<div class='confirmation-message'>
                    <p>Your order has been placed successfully!</p>
                    <p>Thank you for shopping with us.</p>
                  </div>";
        } else {
            echo "<div class='confirmation-message'>
                    <p>There was an issue with your order. Please try again.</p>
                  </div>";
        }
        ?>
        <a href="../store/store.php" class="btn-back">Back to Home</a><br>
        <a href="../../Backend/user/profile/profile.php" class="btn-back">Your Orders !</a>
    </div>

    <?php include '../home/controls/footer.php'; ?>
</body>

</html>