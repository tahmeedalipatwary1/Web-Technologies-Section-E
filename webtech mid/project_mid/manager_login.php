<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="project";
$conn= new mysqli($servername,$username,$password,$dbname);

// Check session username
if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// login form 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM manager_registrations WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); 
        exit();
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Login</title>
</head>
<body>
    <form method="post">
        <h2 align="center">Login</h2>
        <table align="center">
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        <button name="login" style="background-color: #094F9F; text-align: center;">
                            <b>Login</b>
                        </button>
                    </center>
                </td>
            </tr>
        </table>
    </form>
    <div style="text-align: center;">
        <?php if(isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
        <a href="forget_pass.php">Forget Password?</a><br>
        Don't have an account?<a href="manager_reg.php">Register</a>
    </div>
</body>
</html>
