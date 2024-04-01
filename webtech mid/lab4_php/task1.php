<!DOCTYPE html>
<html>
<head>
    <title>Rectangle Area and Perimeter</title>
</head>
<body>
    <h1>Calculate Rectangle Area and Perimeter</h1>

    <?php
    
    function area($length, $width) {
        return $length * $width;
    }

    
    function perimeter($length, $width) {
        return 2 * ($length + $width);
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $length = $_POST["length"];
        $width = $_POST["width"];

        
        $rectangleArea = area($length, $width);
        $rectanglePerimeter = perimeter($length, $width);

        echo "<p>Length: {$length}</p>";
        echo "<p>Width: {$width}</p>";
        echo "<p>Area: {$rectangleArea}</p>";
        echo "<p>Perimeter: {$rectanglePerimeter}</p>";
    }
    ?>

    <!-- Create a form to take user input -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="length">Length:</label>
        <input type="number" id="length" name="length" step="any" required><br><br>
        <label for="width">Width:</label>
        <input type="number" id="width" name="width" step="any" required><br><br>
        <input type="submit" value="Calculate">
    </form>
</body>
</html>