<?php
session_start();
include ('../database/db.php'); // Correct path to db.php

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailOrUsername = $_POST['emailOrUsername'];
    $password = $_POST['password'];

    // Check if email or username exists
    $sql = "SELECT * FROM admin WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: ../admin-panel/adminpanel.php"); // Redirect to admin panel
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Sign up first!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Form</title>
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Admin Login</span></div>
            <form action="" method="post">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="emailOrUsername" placeholder="Email or Username" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="row button">
                    <input type="submit" value="Login">
                </div>
                <?php if ($error): ?>
                    <div class="error"><p style="color: red; text-align: center;"><?php echo htmlspecialchars($error); ?></p></div>
                <?php endif; ?>
                <div class="signup-link">Not signed up yet? <a href="adminsignup.php">Signup now</a></div>
            </form>
        </div>
    </div>
</body>

</html>