<?php

include_once 'db_connection.php';

// check token 
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check token in database
    $sql = "SELECT * FROM manager_registrations WHERE reset_token = '$token'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Token exists, allow the user to reset their password
        if (isset($_POST['reset_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Validate
            if ($new_password != $confirm_password) {
                $error_message = "Passwords do not match.";
            } else {
                // Update password in the database
                $update_sql = "UPDATE manager_registrations SET password = '$new_password', reset_token = NULL WHERE reset_token = '$token'";
                $update_result = mysqli_query($conn, $update_sql);

                if ($update_result) {
                    echo "Password reset successful. You can now <a href='manager_login.php'>login</a> with your new password.";
                    exit();
                } else {
                    $error_message = "Error updating password.";
                }
            }
        }
    } else {
        // Token is invalid or expired
        echo "Invalid token. Please try again or request a new password reset link.";
        exit();
    }
} else {
    // Token is not provided in the URL
    echo "Token not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2 align="center">Reset Password</h2>
    <?php if (isset($error_message)) { ?>
        <p style="color: red; text-align: center;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" align="center">
        <label>New Password:</label><br>
        <input type="password" name="new_password"><br><br>
        <label>Confirm Password:</label><br>
        <input type="password" name="confirm_password"><br><br>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>
</body>
</html>
