<?php
session_start();
require_once('../Models/dashboard_db.php');
require_once('../Models/all_service_db.php');
require_once('../Models/enrolled_services_db.php');
$conn=getConnection();
$userDetails = getUserDetails($conn, $_SESSION['username']);


$username = $_SESSION['username'];

// remove from a service
if (isset($_POST['Remove'])) {
    $serviceId = $_POST['serviceId'];
    // Update the status to 'completed' instead of deleting the record
    $sql = "update purchases SET status='completed' where userName='$username' AND serviceId='$serviceId'";
    if (mysqli_query($conn, $sql)) {
        echo "Service marked as completed successfully!";
    } else {
        echo "Error marking service as completed: " . mysqli_error($conn);
    }
}

$enrolledServices = getEnrolledServices($conn, $username);
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
        <a href="../Controllers/recommendation_controller.php">Service List</a>
        <a href="../Controllers/purchase_controller.php">Purchase History</a>
        <a href="customerlist.php">Customer List</a>
        <a href="../Controllers/settings_controller.php">Settings</a>
        <a href="../Controllers/logoutController.php">Logout</a>
    </div>
</header>


<h2 style="font-family: Arial, sans-serif; color: #333; text-align: center;">Confirmed Services</h2>

<div class="catagory" style="margin-top: 20px;">
    <?php foreach ($enrolledServices as $service): ?>
    <?php $videoID = getYouTubeVideoID($service['videoURL']); ?>
    <div class="service" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px;">
        <div class="service-thumbnail">
            <?php if ($videoID): ?>
                <img src="https://img.youtube.com/vi/<?php echo $videoID; ?>/hqdefault.jpg" alt="<?php echo htmlspecialchars($service['title']); ?>" style="width:100px;height:100px;">
            <?php else: ?>
                <img src="path_to_default_thumbnail_image" alt="Default Thumbnail" style="width:100px;height:100px;">
            <?php endif; ?>
        </div>
        <div class="service-info" style="margin-left: 120px;">
            <h4 style="margin-top: 0;"><?php echo htmlspecialchars($service['title']); ?></h4>
            <p><?php echo htmlspecialchars($service['description']); ?></p>
            <span><?php echo htmlspecialchars($service['category']); ?></span>
        </div>
        <div class="service-action" style="margin-left: 120px;">
            <a href="<?php echo htmlspecialchars($service['videoURL']); ?>" target="_blank">....</a>
            <form method="post" action="" style="display: inline;">
                <input type="hidden" name="serviceId" value="<?php echo $service['id']; ?>">
                
                <button type="submit" name="Remove" style="padding: 5px 10px; background-color: #f44336; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer;">Remove</button>
            </form>
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