<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $name = "";
    $error = "";

    if (isset($_POST["submit"])) {
        if (empty($_POST["name"])) {
            $error = "Name is required";
        } elseif (!preg_match('/^[a-zA-Z][a-zA-Z\s]+$/i', $_POST["name"])) {
            $error = "Name must start with a letter and contain at least two words";
        } else {
            $name = $_POST["name"];
            echo "My name is $name";
        }
    }
    ?>

    <form method="post" action="">
        <fieldset>
            <legend align="center"><h2>Name</h2></legend>
            Name:
            <input type="text" name="name" value="<?php echo $name; ?>" /><br>
            <?php echo $error; ?><hr>
            <input type="submit" name="submit" value="Submit"/>
        </fieldset>
    </form>
</body>
</html>
