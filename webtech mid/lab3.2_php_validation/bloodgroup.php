<!DOCTYPE html>
<html>
<head>
    <title>Blood Group</title>
</head>
<body>
        
    <form method="post" action="" enctype="">
        <fieldset>
            <legend><h2>Blood Group</h2></legend>
            <select name="BG">
                <option value="A+">A+</option>            
                <option value="B+">B+</option>
                <option value="A-">A-</option>
                <option value="B-">B-</option>         
                <option value="AB+">AB+</option> 
                <option value="O+">O+</option> 
                <option value="O-">O-</option>           
            </select> <br> <br>
            <input type="submit" name="Submit" value="Submit"/>
        </fieldset>
    </form>

    <?php
    if (isset($_REQUEST['BG'])) {
        $Blood_Group = $_REQUEST['BG'];
        echo $Blood_Group;
    }
    ?>
</body>
</html>
