<?php
session_start();
require_once('../Models/dashboard_db.php');
$conn=getConnection();
$userDetails = getUserDetails($conn, $_SESSION['username']);

$user_id = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $updateField = '';
    $newValue = '';

    if (isset($_POST['update_name'])) {
        $updateField = 'Name';
        $newValue = trim($_POST['name']);
        if (empty($newValue)) {
            $errors[] = "Name cannot be empty.";
        }
    } elseif (isset($_POST['update_phoneNum'])) {
        $updateField = 'phoneNum';
        $newValue = trim($_POST['phoneNum']);
        if (!preg_match('/^[0-9]{11}+$/', $newValue)) {
            $errors[] = "Invalid phone number format.";
        }
    } elseif (isset($_POST['update_email'])) {
        $updateField = 'eMail';
        $newValue = trim($_POST['email']);
        if (!filter_var($newValue, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
    } elseif (isset($_POST['update_password'])) {
        $updateField = 'passWord';
        $newValue = $_POST['password'];
        if (strlen($newValue) > 10) {
            $errors[] = "Password must be less than 10 characters.";
        }
    }

    if (count($errors) === 0 && $updateField !== '') {
        $newValue = $conn->real_escape_string($newValue);
        $sql = "UPDATE registration SET $updateField = '$newValue' where userName = '$user_id'";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            echo "<div class='success'>Information updated successfully</div>";
        } else {
            echo "<div class='error'>Error updating information: " . $conn->error . "</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='error'>Error: $error</div>";
        }
    }
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
    
<h3>Update Information</h3>
    <form method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" id="name" value=""></td>
                <td><button name="update_name">Update Name</button></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><input type="tel" name="phoneNum" id="phoneNum" value=""></td>
                <td><button name="update_phoneNum">Update Phone</button></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" id="email" value=""></td>
                <td><button name="update_email">Update Email</button></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="password" value=""></td>
                <td><button name="update_password">Update Password</button></td>
            </tr>
        </table>
    </form>
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