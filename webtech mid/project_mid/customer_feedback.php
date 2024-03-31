<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
</head>
<body>
    <!-- Header -->
    <header style="background-color: #f2f2f2; padding: 10px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <img src="logo.png" alt="Company Logo" width="50" height="50">
            </div>
            <div>
                <h1 style="margin: 0; color: #333; font-size: 24px;">Home Service Solution</h1>
            </div>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav style="background-color: #808080; padding: 10px;">
        <ul style="list-style-type: none; margin: 0; padding: 0; text-align: center;">
            <li style="display: inline-block; margin-right: 20px;"><a href="home.html" style="color: #fff; text-decoration: none;">Home</a></li>
            <li style="display: inline-block; margin-right: 20px;"><a href="dashboard.php" style="color: #fff; text-decoration: none;">Dashboard</a></li>
            <li style="display: inline-block; margin-right: 20px;"><a href="customer_feedback.php" style="color: #fff; text-decoration: none;">customer feedback</a></li>
            <li style="display: inline-block; margin-right: 20px;"><a href="service_history.php" style="color: #fff; text-decoration: none;">service history</a></li>
            <li style="display: inline-block; margin-right: 20px;"><a href="contact_management.php" style="color: #fff; text-decoration: none;">contact management</a></li>
        </ul>
    </nav>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_comment'])) {
    $comment = htmlspecialchars($_POST["comment"]);
    $file = "comment_history.txt";
    file_put_contents($file, $comment . PHP_EOL, FILE_APPEND);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $index = $_POST['index'];
    $comments = file("comment_history.txt");
    unset($comments[$index]);
    file_put_contents("comment_history.txt", implode("", $comments));
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <textarea name="comment" rows="4" cols="50" placeholder="Enter your comment"></textarea><br>
    <input type="submit" name="add_comment" value="Add Comment">
</form>

<h2>Comment History</h2>
<ul>
    <?php
    $comments = file("comment_history.txt");
    foreach ($comments as $index => $comment) {
        echo "<li>$comment <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'><input type='hidden' name='index' value='$index'><input type='submit' name='delete' value='Delete'></form></li>";
    }
    ?>
</ul>




  
    <style>
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #f0f0f0;
        padding: 10px;
        text-align: center;
    }
    </style>

    <footer>
        <p>&copy; "Home Service Solution". All rights reserved.</p>
    </footer>

</body>
</html>
