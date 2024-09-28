<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error."); // If there's a connection issue, stop further execution
}

try {
    $orders = $db->query("SELECT o.*, p.name AS product_name, p.image_url AS product_image, u.username AS user_name, u.email AS user_email, o.phone_number 
    FROM orders o
    JOIN products p ON o.product_id = p.id
    JOIN user u ON o.user_id = u.id
    ORDER BY o.order_id DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="./order.css">
</head>

<body>
    <div class="title">
        <p>Manage Orders - NextGen</p>
    </div>
    <div class="container">
        <div class="wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Admin Update</th>
                        <th>Actions</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="10" style="text-align: center;">No orders available</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= htmlspecialchars($order['order_id']) ?></td>
                                <td><?= htmlspecialchars($order['user_name']) ?></td>
                                <td><?= htmlspecialchars($order['user_email']) ?></td>
                                <td><?= htmlspecialchars($order['product_name']) ?></td>
                                <td><img src="<?= htmlspecialchars($order['product_image']) ?>" alt="Product Image" style="width: 50px;"></td>
                                <td><?= htmlspecialchars($order['quantity']) ?></td>
                                <td>$<?= number_format($order['total_amount'], 2) ?></td>
                                <td>
                                    <form action="update_order_status.php" method="POST">
                                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']) ?>">
                                        <select name="status">
                                            <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                        </select>
                                </td>
                                <td>
                                    <input type="text" name="admin_update" placeholder="Enter update">
                                </td>
                                <td>
                                    <?= htmlspecialchars($order['admin_update']) ?>
                                </td>
                                <td>
                                    <button type="submit">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (isset($_GET['status']) && $_GET['status'] === 'updated'): ?>
                <p style="color: green;">Order status updated successfully!</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>