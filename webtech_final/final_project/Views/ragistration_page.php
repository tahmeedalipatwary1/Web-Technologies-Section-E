<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <style>
        .registration-table {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
    <script src="JS/jsvalidationwithlivecheck.js"></script>
</head>
<body>
    <form name="registrationForm" method="post" onsubmit="return validatestudent()"
    action="../Controllers/logCheckController.php">
        <h2 align="center">Register</h2>
        <div class="registration-table">
            <table align="center">
                <tr>
                    <td>Username:</td>
                    <td>
                    <input type="text" id="username" name="username" onkeyup="checkAvailability('username')">
                    <span id="usernameAvailability"></span>
                    </td>
                    <td><?php 
                    session_start();
                    if(isset($_SESSION['error_messageR1'])){
                    echo "<p style='color:red;'>".$_SESSION['error_messageR1']."<p>";
                    unset($_SESSION['error_messageR1']);
                    }?></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" id="name" name="name"></td>
                    <td><?php 
                    if(isset($_SESSION['error_messageR2'])){
                    echo "<p style='color:red;'>".$_SESSION['error_messageR2']."<p>";
                    unset($_SESSION['error_messageR2']);
                    }?></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" id="phoneNum" name="phoneNum"></td>
                    <td><?php 
                    if(isset($_SESSION['error_messageR3'])){
                    echo "<p style='color:red;'>".$_SESSION['error_messageR3']."<p>";
                    unset($_SESSION['error_messageR3']);
                    }?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                    <input type="email" id="email" name="email" onkeyup="checkAvailability('email')">
                    <span id="emailAvailability"></span>
                    </td>
                    <td><?php 
                    if(isset($_SESSION['error_messageR4'])){
                    echo "<p style='color:red;'>".$_SESSION['error_messageR4']."<p>";
                    unset($_SESSION['error_messageR4']);
                    }?></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" id="password" name="password"></td>
                    <td><?php 
                    if(isset($_SESSION['error_messageR7'])){
                    echo "<p style='color:red;'>".$_SESSION['error_messageR7']."<p>";
                    unset($_SESSION['error_messageR7']);
                    }?></td>
                    <td><?php 
                    if(isset($_SESSION['error_messageR5'])){
                    echo "<p style='color:red;'>".$_SESSION['error_messageR5']."<p>";
                    unset($_SESSION['error_messageR5']);
                    }?></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" id="confirmPassword" name="confirmPassword"></td>
                    <td><?php 
                    if(isset($_SESSION['error_messageR6'])){
                    echo "<p style='color:red;'>".$_SESSION['error_messageR6']."<p>";
                    unset($_SESSION['error_messageR6']);
                    }?></td>
                </tr>
                <br>
                <tr>
                    <td colspan="2"><center><button name="signup" style="background-color: skyblue; text-align: center;">
                        <b> Sign Up </b> </button></center></td>
                    <td><?php 
                    if(isset($_SESSION['signup_message'])){
                    echo "<p style='color:red;'>".$_SESSION['signup_message']."<p>";
                    unset($_SESSION['signup_message']);
                    }?></td>
                </tr>
            </table>
            <p align="center">Already have an account?<a href="login_page.php">Sign In</a></p>
        </div>
    </form>
</body>
</html>