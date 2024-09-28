<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the database
include '../../Backend/database/db.php'; // Adjust the path if necessary

// Check if 'id' is provided in the query string
if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'error' => 'Missing user ID']);
    exit;
}

// Get the user ID from the query string
$userId = (int)$_GET['id'];

// Prepare and execute the SQL query to delete the user
$sql = "DELETE FROM user WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $userId, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(['success' => true]); // Return success message
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to delete user']); // Return error message
}
