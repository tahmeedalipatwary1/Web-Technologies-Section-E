<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:../Controllers/logoutController.php");
    exit();
}

if (!isset($_COOKIE['last_activity']) || (time() - $_COOKIE['last_activity']) > 3600) {
    header("Location:../Controllers/logoutController.php");
    exit();
}

header('Location: ../Views/dashboard.php');
?>
