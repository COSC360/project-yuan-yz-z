<?php

// if (empty($_POST["name"])) {
//     die("Name is required");
// }

// if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
//     die("Valid email is required");
// }

// if (strlen($_POST["password"]) < 8) {
//     die("Password must be at least 8 characters");
// }

// if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
//     die("Password must contain at least one letter");
// }

// if ( ! preg_match("/[0-9]/", $_POST["password"])) {
//     die("Password must contain at least one number");
// }

// if ($_POST["password"] !== $_POST["password_confirmation"]) {
//     die("Passwords must match");
// }

// $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connection.php";

$sql = "UPDATE users set email=?, userName=?
  where id=?" ;
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$admin=0;
$stmt->bind_param("ssi",
                  $_POST['email'],
                  $_POST['userName'],
                  $_GET['userId']);
                  
if ($stmt->execute()) {
    header("Location: ../pages/profile.php?success=yes");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}



