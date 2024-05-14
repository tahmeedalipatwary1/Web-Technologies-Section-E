<?php
session_start();
require_once('../Models/dashboard_db.php');
$conn=getConnection();
$userDetails = getUserDetails($conn, $_SESSION['username']);

$userName = mysqli_real_escape_string($conn, $_SESSION['username']);



// Deposit money
if (isset($_POST['deposit'])) {
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $sql = "update registration set balance = balance + {$amount} where userName = '{$userName}'";
    if (mysqli_query($conn, $sql)) {
        echo "Money deposited successfully!";
    } else {
        echo "Error depositing money: " . mysqli_error($conn);
    }
}
// withdraw money
if (isset($_POST['withdraw'])) {
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $sql = "update registration set balance = balance - {$amount} where userName = '{$userName}'";
    if (mysqli_query($conn, $sql)) {
        echo "Money withdrawn successfully!";
    } else {
        echo "Error withdrawing money: " . mysqli_error($conn);
    }
}


// Purchase a service
if (isset($_POST['purchase'])) {
    $serviceId = mysqli_real_escape_string($conn, $_POST['serviceId']);
    $checkPurchase = "select * from purchases where userName='{$userName}' and serviceId={$serviceId}";
    $purchaseResult = mysqli_query($conn, $checkPurchase);
    mysqli_begin_transaction($conn);
    try {
        // Check user balance
        $sql = "select balance from registration where userName = '{$userName}'";
        $res = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($res);

        // Get service price
        $sql = "select price from services where ID = {$serviceId}";
        $res = mysqli_query($conn, $sql);
        $service = mysqli_fetch_assoc($res);

        // if ($user['balance'] >= $service['price']) {
            // Deduct service price from user's balance
            $sql = "update registration set balance = balance + {$service['price']} where userName = '{$userName}'";
            mysqli_query($conn, $sql);

            // Add to purchases
            $sql = "insert into purchases (userName, serviceId) values ('{$userName}', {$serviceId})";
            mysqli_query($conn, $sql);

            mysqli_commit($conn);
            $sql = "select eMail from registration where userName = '{$userName}'";
            $result = mysqli_query($conn, $sql);
        // } 
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "An error occurred. Purchase failed.";
    }
}

// Retrieve all services
$sql = "select ID, title, price from services";
$res = mysqli_query($conn, $sql);
$services = mysqli_fetch_all($res, MYSQLI_ASSOC);

mysqli_close($conn);
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
            <a href="../Controllers/completedService_controller.php">Completed Services</a><br>
            <a href="../Controllers/makeNote_controller.php">Create Note</a>
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

    <h2 style="font-family: Arial, sans-serif; color: #333; text-align: center;">Current Balance: <?php echo htmlspecialchars($userDetails['balance']); ?></h2>

<h3 style="font-family: Arial, sans-serif; color: #333;">Deposit money</h3>
<form method="post" action="">
    <label for="amount">Deposit Amount:</label>
    <input type="number" id="amount" name="amount" required>
    <button type="submit" name="deposit" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Deposit Money</button>
</form>

<h3 style="font-family: Arial, sans-serif; color: #333;">Withdraw money</h3>
<form method="post" action="">
    <label for="amount">Withdraw Amount:</label>
    <input type="number" id="amount" name="amount" required>
    <button type="submit" name="withdraw" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Withdraw Money</button>
</form>

<h2 style="font-family: Arial, sans-serif; color: #333; text-align: center;">Available Services</h2>
<?php foreach ($services as $service): ?>
    <div class="service" style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px;">
        <h3 style="margin-top: 0;"><?php echo htmlspecialchars($service['title']); ?></h3>
        <p>Price: $<?php echo htmlspecialchars($service['price']); ?></p>
        <form method="post" action="">
            <input type="hidden" name="serviceId" value="<?php echo $service['ID']; ?>">
            <button type="submit" name="purchase" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Purchase</button>
        </form>
    </div>
<?php endforeach; ?>
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
