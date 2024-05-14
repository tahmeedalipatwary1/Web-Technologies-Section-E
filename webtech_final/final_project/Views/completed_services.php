<?php
session_start();
require_once('../Models/dashboard_db.php');
require_once('../Models/all_service_db.php');
require_once('../Models/completed_services_db.php');
$conn = getConnection();
$userDetails = getUserDetails($conn, $_SESSION['username']);

$username = $_SESSION['username'];
$completedServices = getCompletedServices($conn, $username);
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
                <a href="../Controllers/enrolled_services_controller.php">Confirmed services</a><br>
                <a href="../Controllers/completed_services_controller.php">Completed Services</a><br>
                <a href="../Controllers/makeNote_controller.php">Customer feedback</a>
            </div>
        </div>
        <a href="../Controllers/profile_controller.php">My Profile</a>
        <a href="../Controllers/recommendation_controller.php">Service List</a>
        <a href="../Controllers/purchase_controller.php">Purchase History</a>
        <a href="customerlist.php">Customer List</a>
        <a href="../Controllers/settings_controller.php">Settings</a>
        
        <a href="../Controllers/logoutController.php">Logout</a>
    </div>
</header>

<h2>Complete Services</h2>

<div class="catagory">
    <?php foreach ($completedServices as $service): ?>
        <div class="service">
            <div class="service-thumbnail">
                <?php $videoID = getYouTubeVideoID($service['videoURL']); ?>
                <?php if ($videoID): ?>
                    <img src="https://img.youtube.com/vi/<?php echo $videoID; ?>/hqdefault.jpg" alt="<?php echo htmlspecialchars($service['title']); ?>" style="width:100px;height:100px;">
                <?php else: ?>
                    <!-- Replace with your path to default thumbnail image -->
                    <img src="path_to_default_thumbnail_image" alt="Default Thumbnail" style="width:100px;height:100px;">
                <?php endif; ?>
            </div>
            <div class="service-info">
                <h4><?php echo htmlspecialchars($service['title']); ?></h4>
                <p><?php echo htmlspecialchars($service['description']); ?></p>
                <span><?php echo htmlspecialchars($service['category']); ?></span>
            </div>
            <div class="service-action">
                <a href="<?php echo htmlspecialchars($service['videoURL']); ?>" target="_blank">Review Service</a>
            </div>
        </div>
        <br><br>
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