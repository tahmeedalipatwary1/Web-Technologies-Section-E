<?php
require_once('db.php');

function getUserDetails($conn, $username) {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "select * from registration where userName='$username'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    } else {
        echo "User not found";
        exit();
    }
}
?>
