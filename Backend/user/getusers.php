<?php
// Start session if necessary
session_start();

// Connect to the database
include '../../Backend/database/db.php'; // Adjust the path if necessary

// Fetch users from the database
$sql = "SELECT id, username, email FROM user"; // Include 'id' in the query
$stmt = $db->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($users);
