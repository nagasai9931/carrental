# Car Rental Website

## Description
A web-based car rental system that allows users to browse available cars, make bookings, and process payments. This project includes authentication, booking management, and payment handling.

## Features
- User authentication (Signup, Login, Logout)
- Browse available cars
- Make and manage bookings
- Payment processing
- Admin panel to manage cars and bookings

## Technologies Used
- Frontend: HTML, CSS, JavaScript, Bootstrap
- Backend: PHP
- Database: MySQL
- Hosting: cPanel (optional)

## Setup Instructions

### 1. Clone the Repository
```sh
    git clone https://github.com/nagasai9931/car-rental.git
    cd car-rental
```

### 2. Setup the Database
1. Create a new database in MySQL (e.g., `car_rental`).
2. Import the provided `car_rental.sql` file into your database.
3. Update the `config.php` file with your database credentials:
```php
    <?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "car_rental";

    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>
```

### 3. Configure cPanel (Optional)
If deploying on cPanel:
1. Upload all files to the `public_html` directory.
2. Update the database credentials in `config.php`.
3. Set up a MySQL database and import the SQL file.

### 4. Run the Application
1. Start a local server (XAMPP, WAMP, or MAMP):
   - Move the project to `htdocs` (XAMPP) or equivalent.
   - Start Apache and MySQL from the control panel.
2. Open a browser and go to:
   ```
   http://localhost/car-rental/
   ```

### 5. Default Admin Credentials
- **Email**: admin@carrental.com
- **Password**: admin123

## How to Contribute
1. Fork the repository.
2. Create a new branch: `git checkout -b feature-name`
3. Commit changes: `git commit -m "Added new feature"`
4. Push to GitHub: `git push origin feature-name`
5. Submit a pull request.



