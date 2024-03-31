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
$username = $_SESSION['username'];
// Change password
if (isset($_POST['change_password'])) {
    $newPassword = $_POST['new_password'];
    $updatePasswordSql = "UPDATE manager_registrations SET password='$newPassword' WHERE username='$username'";
    if (mysqli_query($conn, $updatePasswordSql)) {
        echo "Password changed successfully.";
    } else {
        echo "Error changing password: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
</head>
<body>
    <h2 align="center">Change Password</h2>
    <form method="post">
        <table align="center">
            <tr>
                <td>New Password:</td>
                <td><input type="password" name="new_password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        <button name="change_password" style="background-color: #094F9F; text-align: center;">Change Password</button>
                    </center>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
