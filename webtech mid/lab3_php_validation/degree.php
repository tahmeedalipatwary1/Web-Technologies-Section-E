<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
if (isset($_REQUEST['Submit'])) {
    if (empty($_REQUEST['degree'])) {
        echo "Select at least two degrees";
    } elseif (count($_REQUEST['degree']) < 2) {
        echo "Select at least two degrees";
    } else {
        $degrees = $_REQUEST['degree'];
        foreach ($degrees as $degree) {
            echo $degree . "<br>";
        }
    }
}
?>
   
   <form method="post"action=""enctype="">
       <fieldset>

           <legend><h2>Degree</h2></legend>
           <input type="checkbox" name="degree[]" <?php if (isset($degree) && $degree=="SSC") echo "checked";?>  value="SSC">SSC<br>
           <input type="checkbox" name="degree[]" <?php if (isset($degree) && $degree=="HSC") echo "checked";?>value="HSC"> HSC <br>
           <input type="checkbox" name="degree[]"<?php if (isset($degree) && $degree=="BSC") echo "checked";?> value="BSC"> BSC <br>
           <input type="checkbox" name="degree[]" <?php if (isset($degree) && $degree=="MSC") echo "checked";?> value="MSC"> MSC<br>
           <hr>
           <input type="submit"   name="Submit" value="Submit" />
       </fieldset>
   </from>
    
</body>
</html>

    