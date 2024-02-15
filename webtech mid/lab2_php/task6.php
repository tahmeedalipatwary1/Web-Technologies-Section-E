<!DOCTYPE html>
<html>
<head>
    <title>Search an Element in an Array</title>
</head>
<body>
    <h1>Search an Element in an Array</h1>

    <?php
    $array = [1, 5, 9, 12, 15, 20];

        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searchElement = $_POST["searchElement"];
        $isFound = false;

            
        foreach ($array as $value) {
            if ($value == $searchElement) {
                $isFound = true;
                break;
            }
        }

        if ($isFound) {
            echo "<p>The element {$searchElement} is found in the array.</p>";
        } else {
            echo "<p>The element {$searchElement} is not found in the array.</p>";
        }
    }
    ?>

        
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="searchElement">Search Element:</label>
        <input type="number" id="searchElement" name="searchElement" step="any" required><br><br>
        <input type="submit" value="Search">
    </form>
</body>
</html>