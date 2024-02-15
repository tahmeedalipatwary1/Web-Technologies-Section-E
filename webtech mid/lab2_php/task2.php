<!DOCTYPE html>
<html>
<head>
    <title>VAT Calculator</title>
</head>
<body>
    <h1>Calculate VAT</h1>

    <?php
    
    function vat($amount) {
        return $amount * 0.15;
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amount = $_POST["amount"];

        
        $vat = vat($amount);

        echo "<p>Amount: {$amount}</p>";
        echo "<p>VAT: {$vat}</p>";
    }
    ?>

    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="any" required><br><br>
        <input type="submit" value="Calculate">
    </form>
</body>
</html>