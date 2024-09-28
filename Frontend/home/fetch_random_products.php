<?php
include('../../Backend/database/db.php');

$sql = "SELECT * FROM product_catalog ORDER BY RAND() LIMIT 3";
$result = $conn->query($sql);

if ($result) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode([]);
}
