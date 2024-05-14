<?php 
require_once('db.php');

function loginAuth($username,$pass)
{
     $conn=getConnection();
     $sql="Select * from registration where userName='$username' and passWord='$pass'";
     $res= mysqli_query($conn,$sql);
     $count=mysqli_num_rows($res);
     if($count==1)
     {
     	return true;
     }
     else
     {
     	return false;
     }
}

function SignUp($username,$name,$phoneNum,$email,$password)
{
     $conn=getConnection();
     $sql1 = "insert into registration (userName, Name, phoneNum, eMail, passWord) values ('$username', '$name', '$phoneNum', '$email', '$password')";
     $res = mysqli_query($conn, $sql1);
}
?>