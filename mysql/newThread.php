<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/../mysql/connection.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
if (!isset($user)){
  die("user not found, can't add new thread");
}

$mysqli = require __DIR__ . "/connection.php";

$sql = "INSERT INTO thread (userId, authorName, content, title)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$admin=0;
$stmt->bind_param("isss",
                  $_SESSION["user_id"],
                  $user["name"],
                  $_POST['content'],
                  $_POST["title"],);
                  
if ($stmt->execute()) {

    header("Location: ../pages/index.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}



