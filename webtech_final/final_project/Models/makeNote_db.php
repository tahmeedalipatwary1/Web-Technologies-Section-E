<?php
function getNotes($conn, $username) {
    $notes = [];
    $sql = "select * from notes where username = '$username'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $notes[] = $row;
        }
    } else {
        echo "Error fetching notes: " . mysqli_error($conn);
    }

    return $notes;
}

?>