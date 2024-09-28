<?php
session_start();
include('../database/db.php'); // Correct path to db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password === $confirmPassword) {
        // Check if username or email already exists
        $sql = "SELECT * FROM user WHERE email = ? OR username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Insert new user
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO user (email, username, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $email, $username, $hashedPassword);
            if ($stmt->execute()) {
                echo "<script>
                        alert('Account created successfully');
                        window.location.href = 'login.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error creating account.');
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Account already exists. Please log in.');
                    window.location.href = 'login.php';
                 </script>";
        }
    } else {
        echo "<script>
                alert('Passwords do not match.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Form</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container signup">
        <div class="wrapper">
            <div class="title"><span>SignUp Form</span></div>
            <form action="" method="post">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                </div>
                <div class="row button">
                    <input type="submit" value="SignUp">
                </div>
                <div class="signup-link">Already have an account? <a href="./login.php">Login now</a></div>
            </form>
        </div>
    </div>
</body>

</html>