<?php
session_start();

// Check if the session username is not set, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: manager_login.php");
    exit();
}

// Retrieve user information from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM manager_registrations WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $userData = $result->fetch_assoc();
} else {
    echo "Error fetching user information";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
</head>
<body>
    <!-- Header -->
    <header style="background-color: #f2f2f2; padding: 10px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <img src="logo.png" alt="Company Logo" width="50" height="50">
            </div>
            <div>
                <h1 style="margin: 0; color: #333; font-size: 24px;">Home Service Solution</h1>
            </div>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav style="background-color: #808080; padding: 10px;">
        <ul style="list-style-type: none; margin: 0; padding: 0; text-align: center;">
            <li style="display: inline-block; margin-right: 20px;"><a href="home.html" style="color: #fff; text-decoration: none;">Home</a></li>
            <li style="display: inline-block; margin-right: 20px;"><a href="customer_feedback.php" style="color: #fff; text-decoration: none;">customer feedback</a></li>
            <li style="display: inline-block; margin-right: 20px;"><a href="service_history.php" style="color: #fff; text-decoration: none;">service history</a></li>
            <li style="display: inline-block; margin-right: 20px;"><a href="contact_management.php" style="color: #fff; text-decoration: none;">contact management</a></li>
            
        </ul>
    </nav>

    <div style="text-align: center; padding: 20px;">
        <div style="padding: 20px;">
            <h3>Welcome, <?php echo $_SESSION['username']; ?></h3>
            <p>Here you can manage your tasks and view reports.</p>
            <ul>
                <li><a href="edit_profile.php">Update Profile</a></li>
                <li><a href="change_pass.php">Change Password</a></li>
                <li><a href="view_profile.php">View Profile</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
        <div>
            <?php 
            if(isset($userData['profile_picture'])) {
                echo '<img src="' . $userData['profile_picture'] . '" width="150" height="150">';
            } else {
                echo 'No profile picture uploaded.';
            }
            ?>
        </div>
    </div>
</body>
</html>


    <style>
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #f0f0f0;
        padding: 10px;
        text-align: center;
    }
    </style>

<footer>
    <p>&copy; "Home Service Solution". All rights reserved.</p>
</footer>

</body>
</html>
