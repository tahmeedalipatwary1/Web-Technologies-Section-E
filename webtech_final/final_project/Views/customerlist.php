<?php
session_start();
require_once('../Models/dashboard_db.php');
$conn = getConnection();
$userDetails = getUserDetails($conn, $_SESSION['username']);
$username = $_SESSION['username'];


// Fetch customer data
$customers = getCustomerData($conn);

function getCustomerData($conn) {
    // Query to fetch customer data
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn, $sql);

    $customers = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customers[] = $row;
        }
    }
    return $customers;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/nightmode.css">
    <link rel="stylesheet" href="CSS/headerfooter_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="JS/night-mode.js"></script>
</head>
<body>
    
<header>
         <div class="header-container">
            <h2>Welcome <?php echo htmlspecialchars($userDetails['Name']); ?></h2>
            <button id="nightModeButton" class="night-mode-btn" onclick="NightMode()">Night Mode</button>
        </div>
        <div align="center">
        <div class="menu-item">
        <a href="dashboard.php" id="dashboardLink">Dashboard</a>
        <div id="dropdownMenu" class="dropdown-content">
        <a href="../Controllers/all_service_controller.php">All Services</a><br>
            <a href="../Controllers/enrolled_services_controller.php">Confirmed Services</a><br>
            <a href="../Controllers/completed_services_controller.php">Completed Services</a><br>
            <a href="../Controllers/makeNote_controller.php">Customer feedback</a>
        </div>
        </div>
            <a href="../Controllers/profile_controller.php">My Profile</a>
            <a href="../Controllers/recommendation_controller.php">service list</a>
            <a href="../Controllers/purchase_controller.php">Purchase History</a>
            <a href="customerlist.php">Customer List</a>
            <a href="../Controllers/settings_controller.php">Settings</a>
            
            <a href="../Controllers/logoutController.php">Logout</a>
        </div>
    </header>
    
    <h2 style="font-family: Arial, sans-serif; color: #333;">Customer List</h2>

<div class="category" style="margin-top: 20px;">
    <?php foreach ($customers as $customer): ?>
        <div class="customer" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px;">
            <div class="customer-info">
                <h4 style="margin-top: 0;"><?php echo htmlspecialchars($customer['Name']); ?></h4>
                <p style="margin: 5px 0;">Address: <?php echo htmlspecialchars($customer['Address']); ?></p>
                <p style="margin: 5px 0;">Contact: <?php echo htmlspecialchars($customer['Contact']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
    
    <footer>
    <p>&copy; 2024 Home Service Solution</p>
    <div class="social-icons">
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    </div>
</footer>
<script src="JS/dashboard_dropdown.js"></script> 
</body>
</html>
