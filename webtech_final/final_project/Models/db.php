<?php
function getConnection()
{
	$servername="localhost";
    $username="root";
    $pass="";
    $dbname="home_service_solution";
    $conn= new mysqli($servername,$username,$pass,$dbname);
    return $conn;
}
?>