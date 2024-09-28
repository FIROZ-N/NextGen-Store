<?php
session_start();
include('../../database/db.php');

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $contact_method = isset($_POST['contact_method']) ? $_POST['contact_method'] : '';
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;

    // Handle profile picture upload and URL
    $profile_picture = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../../uploads/' . basename($_FILES['profile_picture']['name']));
    } elseif (!empty($_POST['profile_picture_url'])) {
        $profile_picture = $_POST['profile_picture_url'];
    }

    // Update user data
    $sql = "UPDATE user SET username = ?, email = ?, full_name = ?, address = ?, phone = ?, dob = ?, gender = ?, contact_method = ?, newsletter = ?, profile_picture = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Failed to prepare SQL statement: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssi", $username, $email, $full_name, $address, $phone, $dob, $gender, $contact_method, $newsletter, $profile_picture, $user_id);
    $stmt->execute();

    $_SESSION['username'] = $username; // Update session username
    $_SESSION['message'] = "Profile updated successfully."; // Set session message for feedback
    header("Location: profile.php"); // Redirect to profile.php
    exit();
} else {
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Failed to prepare SQL statement: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $userData = $stmt->get_result()->fetch_assoc();

    if (!$userData) {
        echo 'User data not found.';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="./edit_profile.css">
</head>

<body>
    <div class="pt">
        <div class="container">
            <h1>Edit Profile</h1>
            <?php
            // Display feedback message if set
            if (isset($_SESSION['message'])) {
                echo '<div class="message">' . htmlspecialchars($_SESSION['message']) . '</div>';
                unset($_SESSION['message']);
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($userData['username'] ?? '') ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($userData['email'] ?? '') ?>" required>

                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($userData['full_name'] ?? '') ?>" required>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?= htmlspecialchars($userData['address'] ?? '') ?>" required>

                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($userData['phone'] ?? '') ?>" required>

                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($userData['dob'] ?? '') ?>">

                <label for="gender">Gender</label>
                <select id="gender" name="gender">
                    <option value="">Select</option>
                    <option value="Male" <?= ($userData['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($userData['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= ($userData['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                </select>

                <label for="contact_method">Preferred Contact Method</label>
                <select id="contact_method" name="contact_method">
                    <option value="">Select</option>
                    <option value="Email" <?= ($userData['contact_method'] == 'Email') ? 'selected' : '' ?>>Email</option>
                    <option value="Phone" <?= ($userData['contact_method'] == 'Phone') ? 'selected' : '' ?>>Phone</option>
                </select>

                <label for="newsletter">Subscribe to Newsletter</label>
                <input style="text-align: left; width: min-content;" type="checkbox" id="newsletter" name="newsletter" <?= ($userData['newsletter']) ? 'checked' : '' ?>>

                <label for="profile_picture">Upload Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture">

                <label for="profile_picture_url">Or Enter Profile Picture URL</label>
                <input type="text" id="profile_picture_url" name="profile_picture_url" value="<?= htmlspecialchars($userData['profile_picture'] ?? '') ?>">

                <input type="submit" value="Update Profile">
            </form>
            <a href="profile.php" class="back-link">Back to Profile</a>
        </div>
    </div>
</body>

</html>