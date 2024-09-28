<?php
// Start session
session_start();

// Connect to the database
include '../../database/db.php'; // Adjust path as necessary

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];

try {
    if (!isset($db)) {
        throw new Exception("Database connection not established.");
    }

    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $db->prepare($sql);

    if (!$stmt) {
        throw new Exception("SQL error: " . $db->errorInfo()[2]);
    }

    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch user's orders
    $orderSql = "SELECT o.*, p.name AS product_name, p.main_image_url AS product_image, o.status AS order_status, o.phone_number 
FROM orders o 
JOIN products p ON o.product_id = p.id 
WHERE o.user_id = ? 
ORDER BY o.order_date DESC";

    $orderStmt = $db->prepare($orderSql);

    if (!$orderStmt) {
        throw new Exception("SQL error: " . $db->errorInfo()[2]);
    }

    $orderStmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $orderStmt->execute();
    $orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);

    // Handle order removal
    if (isset($_POST['remove_order_id'])) {
        $remove_order_id = $_POST['remove_order_id'];
        $deleteSql = "DELETE FROM orders WHERE order_id = ? AND user_id = ?";
        $deleteStmt = $db->prepare($deleteSql);
        $deleteStmt->execute([$remove_order_id, $user_id]);
        header("Location: profile.php?status=removed");
        exit();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./profile.css">
    <style>
        
    </style>
</head>

<body>
    <br>
    <center>
        <h2 style="color: #007BFF;">NextGen</h2>
    </center>
    <div class="pt">
        <div class="mt">
            <div class="container">
                <div class="profile-header">
                    <!-- Display profile picture and user details -->
                    <?php if (!empty($userData['profile_picture'])): ?>
                        <img src="<?= htmlspecialchars($userData['profile_picture']) ?>" alt="Profile Picture">
                    <?php else: ?>
                        <img src="" alt="Profile Picture">
                    <?php endif; ?>

                    <div>
                        <h1>Welcome, <?= htmlspecialchars($userData['full_name']) ?>!</h1>
                        <p><strong>Username:</strong> <?= htmlspecialchars($userData['username']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($userData['email']) ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($userData['phone']) ?></p>
                        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($userData['dob']) ?></p>
                        <p><strong>Gender:</strong> <?= htmlspecialchars($userData['gender']) ?></p>
                        <p><strong>Address:</strong> <?= htmlspecialchars($userData['address']) ?></p>
                        <p><strong>Preferred Contact Method:</strong> <?= htmlspecialchars($userData['contact_method']) ?></p>
                        <p><strong>Newsletter Subscription:</strong> <?= $userData['newsletter'] ? 'Subscribed' : 'Not Subscribed' ?></p>
                        <a href="edit_profile.php">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display user's orders -->
        <h2 style="text-align: center;">Your Orders</h2>
        <div class="orders-section">
            <?php if (count($orders) > 0): ?>
                <div class="orders-table-wrapper">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Admin Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><img src="<?= htmlspecialchars($order['product_image']) ?>" alt="Product Image"></td>
                                    <td><?= htmlspecialchars($order['product_name']) ?></td>
                                    <td><?= htmlspecialchars($order['quantity']) ?></td>
                                    <td>$<?= number_format($order['total_amount'], 2) ?></td>
                                    <td class="<?= htmlspecialchars($order['order_status'] === 'delivered' ? 'delivered' : 'pending') ?>">
                                        <?= htmlspecialchars($order['order_status']) ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($order['admin_update'])): ?>
                                            <div class="update-section">
                                                <?= htmlspecialchars($order['admin_update']) ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="update-section">No updates available.</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($order['order_status'] === 'delivered'): ?>
                                            <form action="profile.php" method="POST">
                                                <input type="hidden" name="remove_order_id" value="<?= htmlspecialchars($order['order_id']) ?>">
                                                <button type="submit" class="remove-button">Remove</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p style="text-align: center;">No orders found.</p>
            <?php endif; ?>
        </div>
    </div>
    <center>
        <a href="../../../Frontend/home/index.php" class="store-button">Store</a>
        <form action="../logout.php" method="POST">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </center>
    <br>
    <br>
</body>

</html>