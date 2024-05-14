<?php
function getYouTubeVideoID($url) {
    preg_match("/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/\s]{11})/i", $url, $matches);
    return $matches[1] ?? null;
}

function getAllServices($conn) {
    $sql = "SELECT id, title, description, category, videoURL, price FROM services";
    $res = mysqli_query($conn, $sql);
    $services = array();

    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $services[] = $row;
        }
    }

    return $services;
}
