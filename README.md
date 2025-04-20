# Blood Donation Management System

This is a simple PHP-based web application to manage blood donor registrations and view donors. It allows users to register as donors, search donors by blood group, and perform basic CRUD operations (Create, Read, Update, Delete).

## Features

- Register new donors
- View all registered donors
- Search donors by blood group
- Edit donor information
- Delete donor records
- Clean and responsive UI

## Technologies Used

- PHP
- MySQL
- HTML/CSS

## Project Sturcture 
blood-donation-system/
│
├── Form.html           # Home page with links
├── register.php        # Donor registration page
├── view_donors.php     # Donor listing, edit, delete, and search
├── db_connect.php      # Database connection
├── style.css           # CSS styling
└── image.jpg           # Background image (optional)


## How to Run
Place all files in your local web server's root directory (e.g., htdocs in XAMPP).

Start Apache and MySQL from XAMPP (or any local server).

Access the application at:

http://localhost:PORT/Form.html
Replace PORT with the actual port used (default is 80 for XAMPP, 3307 for DB as per code).

1. Create a MySQL database named `blood_donation`.
2. Use the following SQL to create the `donors` table:

## Database Setup

```sql
CREATE TABLE donors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  blood_group VARCHAR(10) NOT NULL,
  location VARCHAR(100) NOT NULL,
  contact VARCHAR(15) NOT NULL
);
