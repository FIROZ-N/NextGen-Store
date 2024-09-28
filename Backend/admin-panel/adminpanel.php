<?php
// Connect to the database
include '../../Backend/database/db.php';

// Check if the $db variable is defined after including db.php
if (!$db) {
    die("Database connection error."); // If there's a connection issue, stop further execution
}

// Fetch slider data from the database
$slides = $db->query("SELECT * FROM slider ORDER BY slide_order ASC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch subscriber data from the database
$subscribers = $db->query("SELECT * FROM subscribers")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./panel.css"> <!-- Linking external CSS for styling -->
</head>

<body>
    <div class="title">
        <p>Admin Panel - NextGen</p>
    </div>
    <div class="container">
        <div class="wrapper">
            <nav>
                <ul>
                    <li><a href="#" onclick="loadUsers(); return false;">Show Users</a></li>
                    <li><a href="#" onclick="toggleSubscribers(); return false;">Show/Hide Subscribers</a></li>
                    <li><a href="../admin-panel/slider/slider.php" target="_blank">Manage Slider</a></li>
                    <li><a href="../store-management/store.php" target="_blank">Manage Store</a></li>
                    <li><a href="../../Frontend/cart/orders.php" target="_blank">Manage Orders</a></li>
                    <li><a href="../../Backend/user/login.php" target="_blank">Store</a></li>
                </ul>
            </nav>
            <div class="slideshow-container">
                <!-- Display each slide fetched from the database -->
                <?php foreach ($slides as $index => $slide): ?>
                    <div class="mySlides fade">
                        <?php if (strpos($slide['image_url'], 'http') === 0): ?>
                            <img class="img" src="<?= $slide['image_url'] ?>" alt="Slide Image">
                        <?php else: ?>
                            <img class="img" src="../uploads/<?= htmlspecialchars($slide['image_url']) ?>" alt="Slide Image">
                        <?php endif; ?>
                        <div class="text" style="z-index:99 !important;"><?= htmlspecialchars($slide['caption']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="subscriber-container" style="display: none;">
                <h2>Subscribed Users</h2>
                <div id="subscriberCardContainer" class="subscriber-card-container">
                    <?php foreach ($subscribers as $subscriber): ?>
                        <div class="subscriber-card">
                            <div class="card-content">
                                <p><strong>Email:</strong> <?= htmlspecialchars($subscriber['email']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="cont">
            <div class="cntt">
                <!-- User Cards will be loaded here -->
                <div id="userCardContainer" class="user-card-container"></div>
            </div>
        </div>
    </div>


    <script>
        async function loadUsers() {
            try {
                const response = await fetch('../user/getusers.php'); // Adjusted path
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const users = await response.json();

                const userCardContainer = document.getElementById('userCardContainer');
                userCardContainer.innerHTML = ''; // Clear existing cards

                if (users.length === 0) {
                    alert('No users found.');
                    return;
                }

                users.forEach((user) => {
                    const card = document.createElement('div');
                    card.className = 'user-card';
                    card.innerHTML = `
                        <h3>${user.username}</h3>
                        <p><strong>Username: </strong> ${user.username}</p>
                        <p><strong>Email: </strong> ${user.email}</p>
                        <button style='text-align:center;' onclick="deleteUser(${user.id})">Delete User</button>
                    `;
                    userCardContainer.appendChild(card);
                });
            } catch (error) {
                console.error('Error fetching users:', error);
                alert('Failed to load users. Please try again later.');
            }
        }

        async function deleteUser(userId) {
            if (!userId) {
                console.error('No user ID provided.');
                return;
            }

            const confirmation = confirm('Are you sure you want to delete this user?');

            if (confirmation) {
                try {
                    const response = await fetch(`../admin-panel/delete_user.php?id=${userId}`, {
                        method: 'POST',
                    });

                    if (!response.ok) {
                        throw new Error('Error deleting user');
                    }

                    const result = await response.json();
                    if (result.success) {
                        alert('User deleted successfully!');
                        loadUsers(); // Reload the users after deletion
                    } else {
                        alert(`Failed to delete user: ${result.error}`);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the user.');
                }
            }
        }
        async function updateOrderStatus(orderId, status) {
            if (!orderId || !status) {
                console.error('Invalid order ID or status.');
                return;
            }

            try {
                const formData = new URLSearchParams();
                formData.append('id', orderId);
                formData.append('status', status);

                const response = await fetch('../../Frontend/cart/update_order_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: formData.toString()
                });

                if (!response.ok) {
                    throw new Error('Error updating order status');
                }

                const result = await response.json();
                if (result.success) {
                    alert('Order status updated successfully!');
                    window.location.reload(); // Reload the page to reflect the updated status
                } else {
                    alert(`Failed to update order status: ${result.error}`);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while updating the order status.');
            }
        }
        async function loadSubscribers() {
            try {
                const response = await fetch('../user/getsubscribers.php'); // Path to your subscribers fetching script
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const subscribers = await response.json();

                const subscriberCardContainer = document.getElementById('subscriberCardContainer');
                subscriberCardContainer.innerHTML = ''; // Clear existing cards

                if (subscribers.length === 0) {
                    alert('No subscribers found.');
                    return;
                }

                subscribers.forEach((subscriber) => {
                    const card = document.createElement('div');
                    card.className = 'subscriber-card';
                    card.innerHTML = `
                <p><strong>Email:</strong> ${subscriber.email}</p>
            `;
                    subscriberCardContainer.appendChild(card);
                });
            } catch (error) {
                console.error('Error fetching subscribers:', error);
                alert('Failed to load subscribers. Please try again later.');
            }
        }

        function toggleSubscribers() {
            const subscriberContainer = document.querySelector('.subscriber-container');
            if (subscriberContainer.style.display === "none" || subscriberContainer.style.display === "") {
                subscriberContainer.style.display = "block"; // Show the subscribers
            } else {
                subscriberContainer.style.display = "none"; // Hide the subscribers
            }
        }
    </script>
</body>

</html>