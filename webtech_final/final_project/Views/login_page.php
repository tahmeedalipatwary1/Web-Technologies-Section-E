<?php
if(isset($_COOKIE['last_activity']))
{
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
            fieldset {
              width: 300px; 
              margin: 0 auto;
              padding: 20px;
              border: 1px solid #ccc;
              text-align: center;
            }

            legend {
              background-color: black;
              color: white;
              padding: 5px 10px;
              text-align: center;
              font-size: 20;
            }

            button{
                    background-color: skyblue;
                    text-align: center;
                }

            input {
              margin: 5px;
            }
    </style>
    <title>Login Page</title>
</head>
<body>
    <form method="post" action="../Controllers/logCheckController.php">
        <fieldset width="500px">
        <legend>Welcome</legend>
        Username : <input type="text" name="username"> <br>

        <?php 
        session_start();
        if(isset($_SESSION['error_message1'])){
        echo "<p style='color:red;'>".$_SESSION['error_message1']."<p>";
        unset($_SESSION['error_message1']);
        }?>
        <hr width="85%" align="center" color="black">

        Password : <input type="password" name="password"> <br>

        <?php 
        if(isset($_SESSION['error_message2'])){
        echo "<p style='color:red;'>".$_SESSION['error_message2']."<p>";
        unset($_SESSION['error_message2']);
        }?>
        <hr width="85%" align="center" color="black">

        <center><button name="login"><b>Login</b></button></center>
        <br>

        <?php
        if(isset($_SESSION['error_message3'])){
        echo "<p style='color:red;'>".$_SESSION['error_message3']."<p>";
        unset($_SESSION['error_message3']);
        }?>

        <a href="forget_password.php">Forget Password?</a><br>
        Don't have an account?<a href="ragistration_page.php">Register</a>
        </fieldset>
    </form>
</body>
</html>

