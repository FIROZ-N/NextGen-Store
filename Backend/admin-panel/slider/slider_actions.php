<?php
include '../../database/db.php'; // Database connection

// Add new slide
if (isset($_POST['add_slide'])) {
    $caption = $_POST['caption'];
    $slide_order = $_POST['slide_order'];

    // Check if image URL is provided
    if (!empty($_POST['image_url'])) {
        $image_url = $_POST['image_url'];
    } else {
        // Handle file upload
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image_url = $target;
    }

    // Insert into database
    $db->prepare("INSERT INTO slider (image_url, caption, slide_order) VALUES (?, ?, ?)")
       ->execute([$image_url, $caption, $slide_order]);

    header("Location: slider.php");
    exit();
}

// Update slide
if (isset($_POST['update_slide'])) {
    $id = $_POST['id'];
    $caption = $_POST['caption'];
    $slide_order = $_POST['slide_order'];

    // Update slide in database
    $db->prepare("UPDATE slider SET caption = ?, slide_order = ? WHERE id = ?")
       ->execute([$caption, $slide_order, $id]);

    header("Location: slider.php");
    exit();
}

// Delete slide
if (isset($_POST['delete_slide'])) {
    $id = $_POST['id'];

    // Delete slide from database
    $db->prepare("DELETE FROM slider WHERE id = ?")->execute([$id]);

    header("Location: slider.php");
    exit();
}
?>
