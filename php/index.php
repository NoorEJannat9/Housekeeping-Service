<?php
session_start();
include('db_config.php');

// Check if the user is logged in and retrieve their role
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housekeeping Service</title>
    <link rel="stylesheet" href="css/styles.css"> 
    <style>
        .navbar .logo img {
            width: 50px; 
            height: auto;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="logo">
                <img src="image/logo.jpg" alt="Logo">
            </a>
            <ul class="navbar-menu">
                <li><a href="#">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">SERVICES</a></li>
                <li><a href="#">SHOP</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="#">CONTACT</a></li>
                <?php if (!$role): ?>
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="signup.php">SIGN UP</a></li>
                <?php else: ?>
                    <li><a href="logout.php">LOGOUT</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- About Us Section -->
    <div class="about-section">
        <img src="image/image4.jpg" alt="Housekeeping Service" class="about-img">
        <h2>About Us</h2>
        <p>We are a professional housekeeping service provider, offering reliable and experienced house helpers all around Dhaka, Bangladesh. Our mission is to make your home cleaner, more organized, and more comfortable by providing a wide range of services tailored to your needs.</p>
        <ul>
            <br>
            <li>Regular House Cleaning</li>
            <br>
            <li>Deep Cleaning</li>
            <br>
            <li>Cooking & Meal Preparation</li>
            <br>
            <li>Laundry & Ironing</li>
            <br>
            <li>Home Organization</li>
            <br>
            <li>Part-Time & Full-Time House Helpers</li>
            <br>
        </ul>
        <p>Contact us today to learn more about our services and to book your personal house helper. We look forward to assisting you with all your household needs!</p>
    </div>

    <!-- Role-Based Content -->
    <?php if ($role === 'User'): ?>
        <div class="container">
            <h1>Welcome, User!</h1>
            <p>Explore our services and manage your household needs.</p>
            <div class="nav-links">
                <ul>
                    <li><a href="add_service.php" class="btn">Book Service</a></li>
                    <li><a href="view_services.php" class="btn">View Booked Services</a></li>
                    <li><a href="view_subscriptions.php" class="btn">Manage Subscriptions</a></li>
                </ul>
            </div>
        </div>
    <?php elseif ($role === 'Housekeeper'): ?>
        <div class="container">
            <h1>Welcome, Housekeeper!</h1>
            <p>Manage your tasks and schedules here.</p>
            <div class="nav-links">
                <ul>
                    <li><a href="view_tasks.php" class="btn">View Tasks</a></li>
                    <li><a href="update_schedule.php" class="btn">Update Schedule</a></li>
                </ul>
            </div>
        </div>
    <?php elseif ($role === 'Admin'): ?>
        <div class="container">
            <h1>Welcome, Admin!</h1>
            <p>Manage users, employees, and services.</p>
            <div class="nav-links">
                <ul>
                    <li><a href="add_user.php" class="btn">Add User</a></li>
                    <li><a href="view_users.php" class="btn">View Users</a></li>
                    <li><a href="add_employee.php" class="btn">Add Employee</a></li>
                    <li><a href="view_employees.php" class="btn">View Employees</a></li>
                    <li><a href="add_service.php" class="btn">Add Service</a></li>
                    <li><a href="view_services.php" class="btn">View Services</a></li>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <h1>Welcome to Housekeeping Service</h1>
            <p>Please log in to access personalized features.</p>
        </div>
    <?php endif; ?>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="contact-info">
                <h3>Information</h3>
                <p><strong>Corporate Office:</strong></p>
                <p>House # 5/4, Block # 1, Monipuri Para, Tejgaon, Dhaka-1215, Bangladesh.</p>
                <p><strong>Phone:</strong> 01630971218</p>
                <p><strong>Email:</strong> <a href="mailto:active.mahadi2015@gmail.com">active.mahadi2015@gmail.com</a></p>
            </div>
            <div class="menu-links">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com" target="_blank"><img src="images/facebook-icon.png" alt="Facebook"></a>
                <a href="https://www.instagram.com" target="_blank"><img src="images/instagram-icon.png" alt="Instagram"></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Housekeeping Services | All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
