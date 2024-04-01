<!DOCTYPE html>
<html>
<head>
    <title>Check if a Number is Odd or Even</title>
</head>
<body>
    <h1>Check if a Number is Odd or Even</h1>

    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $number = $_POST["number"];

        
        if ($number % 2 == 0) {
            echo "<p>The number {$number} is even.</p>";
        } else {
            echo "<p>The number {$number} is odd.</p>";
        }
    }
    ?>

    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="number">Number:</label>
        <input type="number" id="number" name="number" step="any" required><br><br>
        <input type="submit" value="Check">
    </form>
</body>
</html>