<?php
session_start();
$servername="localhost";
$username= "root";
$password="";
$dbname="elearning";
$conn = new mysqli($servername, $username, $password, $dbname);

$userExists = false;
$passwordUpdated = false;

if(isset($_POST['Create_newPass']))
{
    $username=$_POST['username'];
    $email=$_POST['email'];
    $sql= "select * from registration where userName='$username' and eMail='$email'";
    $res= mysqli_query($conn,$sql);
    if($res->num_rows>0)
    {
        while($r=mysqli_fetch_assoc($res)) {
        $userExists = true;
        $_SESSION['username']=$username;
                                           }
    }
    else
    {
        echo "Invalid username or email";
    }
    
}

if (isset($_POST['Set_newPass']) && isset($_SESSION['username'])) {
    $new_password = $_POST['new_password'];
    $username = $_SESSION['username'];
    $sql = "update registration SET password='$new_password' where userName='$username'";
    $res= mysqli_query($conn,$sql);
    if ($conn->query($sql) === TRUE) {
        $passwordUpdated = true;
        session_destroy();
    }
    else
    {
        echo "Error updating password: ";
    }
} 

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <style>
            fieldset {
              background-color: #eeeeee;
              padding: 5px 10px;
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
                    background-color: #094F9F;
                    text-align: center;
                }

            input {
              margin: 5px;
            }
    </style>

    <title>Forget Password?</title>
</head>
<body>
    <form method="post">
        <fieldset width="500px">
        <legend>Don't Worry</legend>
        Username : <input type="text" name="username"> <br>
        <hr width="20%" align="center" color="black">
        Email : <input type="email" name="email"> <br>
        <hr width="20%" align="center" color="black">
        <center><button name="Create_newPass"><b>Create New Password</b></button></center>
        <br>
    <div>
        <?php if ($userExists): ?>
        <label>New Password</label><input type="password" name="new_password" required>
        <br>      
        <button name="Set_newPass"><b>Set New Password</b></button>
        <?php endif; ?>

               <?php if ($passwordUpdated): ?>
               <p>Congratulations! new password is set.</p>
               <?php endif; ?>           
    </div>
        Have valid Password?<a href="login_page.php">Sign In</a>
        </fieldset>
    </form>
</body>
</html>