<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: manager_login.php");
    exit();
}

// Retrieve user information from the database
$username = $_SESSION['username'];
$sql = "SELECT * FROM manager_registrations WHERE username='$username'";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) != 1) {
    echo "Error fetching user information";
    exit();
}
$userData = mysqli_fetch_assoc($result);

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $target_dir = "uploads/"; // Directory where the image will be stored
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Update user's profile picture in the database
            $image_path = $target_file;
            $update_sql = "UPDATE manager_registrations SET profile_picture='$image_path' WHERE username='$username'";
            if (mysqli_query($conn, $update_sql)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Error updating profile picture.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Information</title>
</head>
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
            <li style="display: inline-block; margin-right: 20px;"><a href="dashboard.php" style="color: #fff; text-decoration: none;">Dashboard</a></li>
            
        </ul>
    </nav>
<body>
    <h2 align="center">Profile Information</h2>
    <table align="center">
        <tr>
            <td>Name:</td>
            <td><?php echo $userData['name']; ?></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?php echo $userData['address']; ?></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><?php echo $userData['username']; ?></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><?php echo $userData['phone_number']; ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $userData['email']; ?></td>
        </tr>
        <tr>
            <td>Profile Picture:</td>
            <td>
                <?php 
                if(isset($userData['profile_picture'])) {
                    echo '<img src="' . $userData['profile_picture'] . '" width="150" height="150">';
                } else {
                    echo 'No profile picture uploaded.';
                }
                ?>
            </td>
        </tr>
    </table>
    <div align="center">
        <form action="" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="image" id="image">
            <input type="submit" value="Upload Image" name="submit">
        </form>
        <br>
        <a href="logout.php">Logout</a>
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
