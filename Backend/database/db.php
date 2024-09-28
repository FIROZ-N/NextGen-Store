<?php
// Example MySQL database connection using PDO
$host = 'localhost'; // Database host
$dbname = 'gstore';  // Database name
$username = 'root';  // Database username (check this in your case)
$password = '';      // Database password (check this in your case)
// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
// Example MySQL database connection using PDO
$host = 'localhost'; // Database host
$dbname = 'gstore';  // Database name
$username = 'root';  // Database username (check this in your case)
$password = '';      // Database password (check this in your case)

// Create PDO connection
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
