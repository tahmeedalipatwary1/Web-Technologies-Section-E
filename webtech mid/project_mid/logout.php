<?php
session_start();
session_destroy();
header("Location: manager_login.php");
?>