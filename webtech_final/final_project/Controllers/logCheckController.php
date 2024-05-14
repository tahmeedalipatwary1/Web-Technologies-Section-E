<?php
session_start();
require_once('../Models/login_db.php');

if(isset($_REQUEST['login']))
{
	$username=$_REQUEST['username'];
	$pass=$_REQUEST['password'];
	if(empty($username))
	{
		$_SESSION['error_message1']="Username field can't be empty";
	}
    if(empty($pass))
    {
        $_SESSION['error_message2']="Password field can't be empty";
    }
	else
	{
       $status=loginAuth($username,$pass);
       if($status)
       {
           setcookie('last_activity', time(), time() + 3600, "/");
           $_SESSION['username'] = $username;
           header('location: dashboardController.php');
           exit();
       }
       else
       {
          $_SESSION['error_message3']="Invalid User";
       }
	}
    header('location:../Views/login_page.php');
    exit();
}

if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $phoneNum = trim($_POST['phoneNum']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($username)) {
        $_SESSION['error_messageR1']="Username is required";
    }

    if (empty($name)) {
        $_SESSION['error_messageR2']="Name is required";
    }

    if (!preg_match('/^[0-9]{11}+$/', $phoneNum)) {
        $_SESSION['error_messageR3']="Invalid phone number format";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_messageR4']="Invalid email format";
    }

    if (empty($password)) {
        $_SESSION['error_messageR7']="Password is required";
    }

    if (strlen($password) > 10) {
        $_SESSION['error_messageR5']="Password must be less than 10 characters";
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error_messageR6']="Passwords do not match";
    }
    if (
    !isset($_SESSION['error_messageR1']) &&
    !isset($_SESSION['error_messageR2']) &&
    !isset($_SESSION['error_messageR3']) &&
    !isset($_SESSION['error_messageR4']) &&
    !isset($_SESSION['error_messageR5']) &&
    !isset($_SESSION['error_messageR6']) &&
    !isset($_SESSION['error_messageR7']))
    {
       $registration=SignUp($username,$name,$phoneNum,$email,$password);
       $_SESSION['signup_message']="Registration successfull";
    }
    header('location:../Views/ragistration_page.php');
    exit();
}
?>