<!DOCTYPE html>
<html>
<head>
    <title>Print Odd Numbers</title>
</head>
<body>
    <h1>Print Odd Numbers between 10 and 100</h1>

    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start = 10;
        $end = 100;

        
        if ($_POST["start"] <= $end) {
            $start = $_POST["start"];
            $end = $_POST["end"];
        }

        echo "<p>Odd numbers between {$start} and {$end}:</p>";
        echo "<ul>";
        for ($i = $start; $i <= $end; $i++) {
            if ($i % 2 != 0) {
                echo "<li>{$i}</li>";
            }
        }
        echo "</ul>";
    }
    ?>

        
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="start">Start:</label>
        <input type="number" id="start" name="start" step="any" required><br><br>
        <label for="end">End:</label>
        <input type="number" id="end" name="end" step="any" required><br><br>
        <input type="submit" value="Print Odd Numbers">
    </form>
</body>
</html>