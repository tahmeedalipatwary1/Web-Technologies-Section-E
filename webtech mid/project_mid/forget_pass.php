<?php

include_once 'db_connection.php';

$errors = array(); 

if (isset($_POST['forgot_password'])) {
    $email = trim($_POST['email']);

    // Check email exists in database
    $sql = "SELECT * FROM manager_registrations WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Store the token in the database
        $update_sql = "UPDATE manager_registrations SET reset_token = '$token' WHERE email = '$email'";
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            
            header("Location: reset_password.php?token=$token");
            exit();
        } else {
            $errors[] = "Error updating reset token in the database.";
        }
    } else {
        $errors[] = "No user found with that email address.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2 align="center">Forgot Password</h2>
    <?php if (!empty($errors)) { ?>
        <ul style="color: red; list-style-type: none; text-align: center;">
            <?php foreach ($errors as $error) { ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <form method="post" align="center">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <button type="submit" name="forgot_password">Reset Password</button>
    </form>
</body>
</html>
