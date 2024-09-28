<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error."); // If there's a connection issue, stop further execution
}

try {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];

        // Update order status if provided
        if (isset($_POST['status'])) {
            $status = $_POST['status'];
            $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$status, $order_id]);
        }

        // Update admin comment if provided
        if (isset($_POST['admin_update']) && !empty(trim($_POST['admin_update']))) {
            $admin_update = $_POST['admin_update'];
            $sql = "UPDATE orders SET admin_update = ? WHERE order_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$admin_update, $order_id]);
        }

        header("Location: orders.php?status=updated");
        exit();
    } else {
        throw new Exception("Order ID not provided.");
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
