<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $email = "";
    $e = "";
    
    if (isset($_POST["submit"])) {
        if (empty($_POST["email"])) {
            $e = "Email is required";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $e = "Must be a valid email address";
        } else {
            $email = $_POST["email"];
            echo "My email is $email";
        }
    }
    ?>

    <form method="post" action="" novalidate>
        <fieldset>
            <legend align="center"><h2>Email</h2></legend>
            Email:
            <input type="email" name="email" value="<?php echo $email; ?>" /><br>
            <?php echo $e; ?><hr>
            <input type="submit" name="submit" value="Submit"/>
        </fieldset>
    </form>
</body>
</html>
