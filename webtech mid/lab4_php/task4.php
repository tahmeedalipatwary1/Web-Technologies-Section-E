<!DOCTYPE html>
<html>
<head>
    <title>Find the Largest Number</title>
</head>
<body>
    <h1>Find the Largest Number</h1>

    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $num3 = $_POST["num3"];

        // Determine the largest number
        if (($num1 >= $num2) && ($num1 >= $num3)) {
            $largest = $num1;
        } elseif (($num2 >= $num1) && ($num2 >= $num3)) {
            $largest = $num2;
        } else {
            $largest = $num3;
        }

        echo "<p>The largest number is: {$largest}</p>";
    }
    ?>

    <!-- Create a form to take user input -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="num1">Number 1:</label>
        <input type="number" id="num1" name="num1" step="any" required><br><br>
        <label for="num2">Number 2:</label>
        <input type="number" id="num2" name="num2" step="any" required><br><br>
        <label for="num3">Number 3:</label>
        <input type="number" id="num3" name="num3" step="any" required><br><br>
        <input type="submit" value="Find Largest">
    </form>
</body>
</html>