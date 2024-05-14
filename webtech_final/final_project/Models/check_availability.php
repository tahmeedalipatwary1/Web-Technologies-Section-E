<?php 
require_once('db.php');
$conn=getConnection();

$field = $_GET['field'];
$value = $_GET['value'];

if ($field == "username") {
    $value = mysqli_real_escape_string($conn, $value);
    $sql = "select userName from registration where userName = '$value'";
    $emailorUserName = "Username";
} 
elseif ($field == "email") {
    $value = mysqli_real_escape_string($conn, $value);
    $sql = "select eMail from registration where eMail = '$value'";
    $emailorUserName = "Email";
}

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    echo "<span style='color: red;'>This ".$emailorUserName . " is not available. </span>";
}
else
{
    echo "<span style='color: green;'>This ".$emailorUserName . " is available. </span>";
}
mysqli_close($conn);
?>