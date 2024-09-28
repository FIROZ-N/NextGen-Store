<?php
session_start(); // Start the session

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // If not logged in, redirect to login page
    header("Location: ../../admin/adminlogin.php");
}

// Include database connection
include '../../database/db.php'; // Database connection

// Fetch slides from the database
$slides = $db->query("SELECT * FROM slider ORDER BY slide_order ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Slider</title>
    <link rel="stylesheet" href="./slider.css">
</head>

<body>
    <h1>Manage Slider</h1>

    <!-- Add New Slide -->
    <h2>Add New Slide</h2>
    <form action="slider_actions.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="image_url" placeholder="Image URL (optional)">
        <input type="file" name="image" accept="image/*">
        <input type="text" name="caption" placeholder="Caption (optional)">
        <input type="number" name="slide_order" placeholder="Slide Order" required>
        <button type="submit" name="add_slide">Add Slide</button>
    </form>


    <!-- Current Slides -->
    <h2>Current Slides</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Image</th>
                <th>Caption</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($slides as $slide): ?>
                <tr>
                    <td><img src="<?= $slide['image_url'] ?>" width="100"></td>
                    <td><?= htmlspecialchars($slide['caption']) ?></td>
                    <td><?= htmlspecialchars($slide['slide_order']) ?></td>
                    <td>
                        <form action="slider_actions.php" method="POST">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($slide['id']) ?>">
                            <input type="text" name="caption" value="<?= htmlspecialchars($slide['caption']) ?>">
                            <input type="number" name="slide_order" value="<?= htmlspecialchars($slide['slide_order']) ?>">
                            <button type="submit" name="update_slide">Update</button>
                            <button type="submit" name="delete_slide">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>