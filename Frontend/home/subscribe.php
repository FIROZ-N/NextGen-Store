<?php
// Start the session if not already started
session_start();

// Include the database connection
include('../../Backend/database/db.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form and sanitize it
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Check if the email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare the SQL query to insert the email into a 'subscribers' table
        $sql = "INSERT INTO subscribers (email) VALUES (:email)";
        $stmt = $db->prepare($sql); // Use the correct PDO variable for the connection
        $stmt->bindParam(':email', $email); // Bind the parameter

        // Execute the query and check if the email was added successfully
        if ($stmt->execute()) {
            // Redirect to the previous page with a success message
            header("Location: ../../Frontend/home/index.php?message=Thank you for subscribing!");
            exit();
        } else {
            // Display an error message if there was an issue with the insertion
            echo "<script>alert('An error occurred. Please try again later.');</script>";
        }

        // Close the statement
        $stmt = null; // PDO does not require explicitly closing the statement
    } else {
        // Display an error message if the email is invalid
        echo "<script>alert('Invalid email address. Please enter a valid email.');</script>";
    }
}

// Close the database connection
$db = null; // Properly close the PDO connection
?>
