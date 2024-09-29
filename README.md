--------------------------------------------------------------------------------------------------------------------------------------------------------
# NextGen E-Commerce Platform
--------------------------------------------------------------------------------------------------------------------------------------------------------

## Overview

**NextGen** is a dynamic and modern e-commerce platform providing a seamless shopping experience for users and a robust management system for admins.

## Features

- **User Features:**
  - Secure registration and login.
  - Profile management and order tracking.
  - Browse products, add to cart, and place orders.
  - Real-time order status updates.

- **Admin Features:**
  - Admin login with a secure dashboard.
  - Manage users, products, and orders.
  - Control homepage content, sliders, and product catalog.
 
-----------------------------------------------------------------------------------------------------------------------------------------------------
## Project Structure
-----------------------------------------------------------------------------------------------------------------------------------------------------

### Backend
- **Admin:**
  - `admin_login.php`: Admin login page.
  - `adminpanel.php`: Admin dashboard for managing users and orders.
  
- **User:**
  - `login.php`: User login page.
  - `signup.php`: User signup page.
  - `profile.php`: User profile management.

- **Admin Panel:**
  - `getusers.php`: Fetch and display user details.
  
- **Database:**
  - `db.php`: Database connection file.

### Frontend
- **Home:**
  - `index.php`: Main homepage file.
  
- **Assets:**
  - `css/`: Stylesheets.
  - `js/`: JavaScript files.

### Database
- **`gstore.sql`**: SQL file for setting up the database.

## Setup Guide

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/nextgen-ecommerce.git
   cd nextgen-ecommerce
   Import Database

2. **Import gstore.sql into your MySQL database.
     Configure Database Connection

3. **Update database credentials in Backend/database/db.php.
     Run the Server

4. **Use a local server setup (XAMPP, WAMP, MAMP) and ensure the project is accessible.

6. **How to Use

     -----------------------------------------------------
     User Flow:
     -----------------------------------------------------
     ** Sign up or log in to your account.
     ** Browse products and add them to your cart.
     ** Place orders and track status updates.
   
     -----------------------------------------------------
     Admin Flow:
     -----------------------------------------------------
     ** Log in to the admin panel.
     ** Manage users, products, and orders.
     ** Update order statuses and control homepage content.
     ** Contributing
   
Feel free to contribute by forking the repository and submitting a pull request.
---------------------------------------------------------------------------------------------
License
This project is licensed under the MIT License.
---------------------------------------------------------------------------------------------
