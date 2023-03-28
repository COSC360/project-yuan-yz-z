
<?php
 
    // Checking, if post value is
    if(isset($_POST['btnValue']))
    {
        $mysqli = require __DIR__ . "/../mysql/connection.php";

        $sql = "DELETE from thread where id='".$_POST["btnValue"]."'";
    
        if(!mysqli_query($mysqli,$sql)){
            echo("Error description: " . mysqli_error($mysqli));
            die();
        }
        mysqli_close($mysqli);
        echo "success";

    }
    else{
        die("Button not set");
    }





