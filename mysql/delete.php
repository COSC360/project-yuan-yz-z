
<?php
 
    // Checking, if post value is
    // set by user or not
    if(isset($_POST['btnValue']))
    {
        // Getting the value of button
        // in $btnValue variable
        $btnValue = $_POST['btnValue'];
       
         // Sending Response
        echo "Success";
    }

// if (!isset($_POST["id"])){
//   die("Some variables are not set");
// }
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//   die("This is php for Post");
// }
// $mysqli = require __DIR__ . "/connection.php";

// $sql = "UPDATE users set email=?, userName=?
//   where id=?" ;
        
// $stmt = $mysqli->stmt_init();

// if ( ! $stmt->prepare($sql)) {
//     die("SQL error: " . $mysqli->error);
// }
// $admin=0;
// $stmt->bind_param("ssi",
//                   $_POST['email'],
//                   $_POST['userName'],
//                   $_GET['userId']);
                  
// if ($stmt->execute()) {
//     header("Location: ../pages/profile.php?success=yes");
//     exit;
    
// } else {
    
//     if ($mysqli->errno === 1062) {
//         die("email already taken");
//     } else {
//         die($mysqli->error . " " . $mysqli->errno);
//     }
// }



