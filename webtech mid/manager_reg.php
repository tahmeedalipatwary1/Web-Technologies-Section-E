<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new mysqli($servername, $username, $password, $dbname); 

$errors = array(); // Initialize an empty array to store errors

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);
    $phone_number = trim($_POST['phone_number']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    // Validate inputs
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required";
    }
    if (empty($username)) {
        $errors['username'] = "Username is required";
    } elseif (!preg_match('/.*[0-9].*/', $username)) {
        $errors['username'] = "Username must contain at least one number";
    }
    if (empty($phone_number)) {
        $errors['phone_number'] = "Phone number is required";
    } elseif (!preg_match('/^01[3-9][0-9]{8}$/', $phone_number)) {
        $errors['phone_number'] = "Invalid phone number format";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    if (empty($dob)) {
        $errors['dob'] = "Date of Birth is required";
    }
    if (!isset($_POST['gender']) || empty($_POST['gender'])) {
        $errors['gender'] = "Gender is required";
    }
    
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif ($password != $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }

    // If no validation errors, proceed with registration
    if (empty($errors)) {
        $sql = "INSERT INTO manager_registrations (name, username, email, phone_number, address, password, dob, gender) VALUES ('$name', '$username', '$email', '$phone_number', '$address', '$password', '$dob', '$gender')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("Location: manager_login.php");
            exit();
        } else {
            $errors[] = "Registration failed";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Registration</title>
</head>
<body>
    <h2 align="center">Register</h2>
    <form method="post">
        <table align="center">
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name"></td>
                <td style="color: red;"><?php if (!empty($errors['name'])) echo $errors['name']; ?></td>
            </tr>
            <!-- Add Date of Birth Field -->
            <tr>
                <td>Date of Birth:</td>
                <td><input type="date" name="dob"></td>
                <td style="color: red;"><?php if (!empty($errors['dob'])) echo $errors['dob']; ?></td>
            </tr>
            <!-- Add Gender Field with Radio Buttons -->
            <tr>
                <td>Gender:</td>
                <td>
                    <input type="radio" name="gender" value="male"> Male
                    <input type="radio" name="gender" value="female"> Female
                    <input type="radio" name="gender" value="other"> Other
                </td>
                <td style="color: red;"><?php if (!empty($errors['gender'])) echo $errors['gender']; ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="address"></td>
                <td style="color: red;"><?php if (!empty($errors['address'])) echo $errors['address']; ?></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username"></td>
                <td style="color: red;"><?php if (!empty($errors['username'])) echo $errors['username']; ?></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><input type="tel" name="phone_number"></td>
                <td style="color: red;"><?php if (!empty($errors['phone_number'])) echo $errors['phone_number']; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email"></td>
                <td style="color: red;"><?php if (!empty($errors['email'])) echo $errors['email']; ?></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password"></td>
                <td style="color: red;"><?php if (!empty($errors['password'])) echo $errors['password']; ?></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="confirm_password"></td>
                <td style="color: red;"><?php if (!empty($errors['confirm_password'])) echo $errors['confirm_password']; ?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <center>
                        <button name="signup" style="background-color: #094F9F; text-align: center;">
                            <b>Sign Up</b>
                        </button>
                    </center>
                </td>
            </tr>
        </table>
    </form>
    <div style="text-align: center;">
        Already have an account?<a href="manager_login.php">Login</a>
    </div>
</body>
</html>
