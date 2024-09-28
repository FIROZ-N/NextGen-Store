# NextGen eCommerce Project

## Overview

NextGen is a modern, feature-rich eCommerce platform built with PHP, MySQL, and HTML/CSS. It includes a comprehensive admin panel for managing products, users, orders, and website content, along with a seamless shopping experience for customers. The platform is designed for scalability and future enhancements, making it an ideal solution for small to medium-sized businesses looking to establish an online presence.

## Features

### For Users:
- **User Authentication**: Secure login and signup with validation.
- **Profile Management**: Edit and update personal information; hidden profile image if not updated.
- **Product Browsing**: View detailed product listings with images and descriptions.
- **Shopping Cart**: Add, remove, and manage items in the cart.
- **Checkout**: Place orders with a "Pay on Delivery" option; dynamic quantity adjustments with real-time total price calculation.
- **Order Management**: Track order status updates and view order details on the profile page.
- **Email Subscription**: Subscribe to newsletters directly from the home page.

### For Admins:
- **Admin Authentication**: Secure admin login with a restriction on multiple signups.
- **Admin Dashboard**: Control panel to manage users, products, orders, and the website’s homepage sections.
- **CRUD Operations**: Create, read, update, and delete operations for products, users, and website content.
- **Slider Control**: Manage homepage sliders directly from the admin panel.
- **Order Management**: View and update order statuses; send notifications to users.
- **Content Management**: Customize home page sections, including background images, quotes, and subscription options.

## Project Structure
.
├── Backend
│   ├── admin
│   │   ├── admin_login.php
│   │   ├── adminpanel.php
│   │   └── ...
│   ├── user
│   │   ├── login.php
│   │   ├── signup.php
│   │   └── ...
│   ├── admin-panel
│   │   ├── getusers.php
│   │   ├── ...
│   ├── database
│   │   ├── db.php
│   │   └── ...
│   └── ...
├── Frontend
│   ├── home
│   │   ├── index.php
│   │   └── ...
│   ├── css
│   └── js
├── Database
│   ├── gstore.sql
└── ...
-------------------------------------------------------------------------------------------------------------
Installation
-------------------------------------------------------------------------------------------------------------
Clone the repository:

bash
Copy code
git clone https://github.com/yourusername/nextgen-ecommerce.git
cd nextgen-ecommerce
Set up the database:

Import the gstore.sql file into your MySQL database.
Configure the database connection:

Update the database connection details in db.php located in the Backend/database folder.
Start the server:

Use a local server setup like XAMPP, WAMP, or MAMP, and ensure the project folder is accessible via the server.
Usage
User Flow
Sign Up / Log In: Users can register and log in to access their personalized profiles and start shopping.
Browse Products: Navigate through the product catalog and add desired items to the cart.
Place Order: Review cart items, adjust quantities, and proceed to checkout.
Order Management: View the order status, and if delivered, you can remove the order from your profile.
Admin Flow
Log In: Admins log in to access the admin panel.
Manage Users: View user information and manage admin access.
Manage Products and Orders: Add new products, update existing ones, and handle user orders by updating their status.
Configuration
Database: Ensure your MySQL database is running and that the connection credentials in db.php are correct.
File Permissions: Ensure that necessary folders have the right permissions for file uploads and profile picture updates.
Key Files
db.php: Handles the database connection.
profile.php: Displays user profile information and orders.
adminpanel.php: Admin dashboard for managing the application.
index.php: Main entry point for the homepage.

----------------------------------------------------------------------------------------------------------------------------------------

Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your changes.

License
This project is licensed under the MIT License. See the LICENSE file for details.

