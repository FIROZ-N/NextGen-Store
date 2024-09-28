<?php
session_start();
include('../database/db.php'); // Correct path to db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailOrUsername = $_POST['emailOrUsername'];
    $password = $_POST['password'];

    // Check if email or username exists
    $sql = "SELECT * FROM user WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; // Store username for welcome message

            // Redirect to index.php with a welcome message
            header("Location: ../../Frontend/home/index.php?message=" . urlencode("Welcome, " . $user['username']));
            exit();
        } else {
            echo "<script>
                alert('Check your Password and Username!');
              </script>";
        }
    } else {
        echo "<script>
                alert('Account does not exist. Please sign up.');
                window.location.href = 'signup.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Login Form</span></div>
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
                <div class="signup-link">Don't Have an Accont ? <a href="signup.php">Signup now</a></div>
                <div class="signup-link">Admin ? <a href="../admin/adminlogin.php">Login now</a></div>
            </form>
        </div>
    </div>
</body>

</html>