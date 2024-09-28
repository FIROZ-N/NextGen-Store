<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../store/store.css">
    <style>
        .confirmation-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            background-color: #f9fafc;
            padding: 20px;
        }

        .confirmation-message {
            font-size: 1.2rem;
            color: #2c3e50;
            text-align: center;
        }

        .btn-back {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <?php include '../store/main-navbar.php'; ?>

    <div class="confirmation-container">
        <?php
        // Check if the order was successful
        if (isset($_GET['order']) && $_GET['order'] === 'success') {
            echo "<div class='confirmation-message'>
                    <p>Your order has been placed successfully!</p>
                    <p>Thank you for shopping with us.</p>
                  </div>";
        } else {
            echo "<div class='confirmation-message'>
                    <p>There was an issue with your order. Please try again.</p>
                  </div>";
        }
        ?>
        <a href="../store/store.php" class="btn-back">Back to Home</a>
        <a href="../../Backend/user/profile/profile.php" class="btn-back">Your Orders !</a>
    </div>

    <?php include '../home/controls/footer.php'; ?>
</body>

</html>