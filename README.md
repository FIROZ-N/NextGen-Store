# NextGen E-Commerce Platform
-------------------------------------------------------------------------------------------

## Overview

**NextGen** is a modern e-commerce platform that provides a seamless shopping experience for users and a robust management system for admins.

## Features

- **User Features:**
  - Secure registration and login.
  - Profile management and order tracking.
  - Browse products, add to cart, and place orders.

- **Admin Features:**
  - Admin login with a secure dashboard.
  - Manage users, products, and orders.

-------------------------------------------------------------------------------------------
## Project Structure
-------------------------------------------------------------------------------------------

### Backend
- **Admin:**
  - `admin_login.php`: Admin login page.
  - `adminpanel.php`: Admin dashboard.

- **User:**
  - `login.php`: User login page.
  - `signup.php`: User signup page.
  - `profile.php`: User profile management.

- **Database:**
  - `db.php`: Database connection file.

### Frontend
- **Home:**
  - `index.php`: Main homepage file.

### Database
- **`gstore.sql`**: SQL file for database setup.

-------------------------------------------------------------------------------------------
## Setup Guide
-------------------------------------------------------------------------------------------

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/nextgen-ecommerce.git
   cd nextgen-ecommerce
   ```

2. **Import Database**
   - Import `gstore.sql` into your MySQL database.

3. **Configure Database Connection**
   - Update database credentials in `Backend/database/db.php`.

4. **Run the Server**
   - Use a local server setup (XAMPP, WAMP, MAMP) to run the project.

-------------------------------------------------------------------------------------------
## How to Use
-------------------------------------------------------------------------------------------

### User Flow:
- **Sign up or log in to your account.**
- **Browse products, add to cart, and place orders.**

### Admin Flow:
- **Log in to the admin panel.**
- **Manage users, products, and orders.**

-------------------------------------------------------------------------------------------
## License
This project is licensed under the MIT License.
-------------------------------------------------------------------------------------------
