<?php
function getCompletedServices($conn, $username) {
    $sql = "SELECT c.id, c.title, c.description, c.category, c.videoURL, c.price 
            FROM services c 
            JOIN purchases p ON c.id = p.serviceId 
            WHERE p.userName='$username' AND p.status='completed'";
    $res = mysqli_query($conn, $sql);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}
?>
