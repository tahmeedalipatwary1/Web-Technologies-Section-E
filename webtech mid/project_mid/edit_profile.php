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

// Update profile information
if (isset($_POST['update'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : $userData['name'];
    $address = isset($_POST['address']) ? $_POST['address'] : $userData['address'];
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : $userData['phone_number'];
    $email = isset($_POST['email']) ? $_POST['email'] : $userData['email'];

    // Validation
    $errors = array();
    if (!empty($_POST['name']) && empty($name)) {
        $errors['name'] = "Name is required";
    }
    if (!empty($_POST['address']) && empty($address)) {
        $errors['address'] = "Address is required";
    }
    if (!empty($_POST['phone_number']) && empty($phone_number)) {
        $errors['phone_number'] = "Phone number is required";
    } elseif (!empty($phone_number) && !preg_match('/^01[3-9][0-9]{8}$/', $phone_number)) {
        $errors['phone_number'] = "Invalid phone number format";
    }
    if (!empty($_POST['email']) && empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // If no validation errors, proceed with update
    if (empty($errors)) {
        $updateSql = "UPDATE manager_registrations SET name='$name', address='$address', phone_number='$phone_number', email='$email' WHERE username='$username'";
        if (mysqli_query($conn, $updateSql)) {
            echo "Profile information updated successfully.";
            // Refresh user data after update
            $result = mysqli_query($conn, $sql);
            $userData = mysqli_fetch_assoc($result);
        } else {
            echo "Error updating profile information: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2 align="center">Edit Profile</h2>
    <form method="post" >
        <table align="center">
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?php echo $userData['name']; ?>"></td>
                <td style="color: red;"><?php if (!empty($errors['name'])) echo $errors['name']; ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="address" value="<?php echo $userData['address']; ?>"></td>
                <td style="color: red;"><?php if (!empty($errors['address'])) echo $errors['address']; ?></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><input type="tel" name="phone_number" value="<?php echo $userData['phone_number']; ?>"></td>
                <td style="color: red;"><?php if (!empty($errors['phone_number'])) echo $errors['phone_number']; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value="<?php echo $userData['email']; ?>"></td>
                <td style="color: red;"><?php if (!empty($errors['email'])) echo $errors['email']; ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        <button name="update" style="background-color: #094F9F; text-align: center;">Update Profile</button>
                    </center>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
