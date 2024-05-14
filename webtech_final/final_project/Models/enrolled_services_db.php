<?php
function getEnrolledServices($conn, $username) {
    $sql = "select c.id, c.title, c.description, c.category, c.videoURL, c.price 
            from services c 
            JOIN purchases p ON c.id = p.serviceId 
            where p.userName='$username' AND p.status='enrolled'";
    $res = mysqli_query($conn, $sql);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}
?>
