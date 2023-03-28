<?php

  session_start();

  if (isset($_SESSION["user_id"])) {
      
      $mysqli = require __DIR__ . "/../mysql/connection.php";
      
      $sql = "SELECT * FROM users
              WHERE id = {$_SESSION["user_id"]}";
              
      $result = mysqli_query($mysqli,$sql);
      
      $user = $result->fetch_assoc();
  }
  if (!isset($user)){
    die("user not found, can't add new comment");
  }
  // echo $_POST["comment"];
  $threadId= $_GET["threadId"];
  $mysqli = require __DIR__ . "/connection.php";

  $sql = "INSERT INTO comment (userId, authorName, content, threadId)
          VALUES (?, ?, ?, ?)";
          
  $stmt = $mysqli->stmt_init();

  if ( ! $stmt->prepare($sql)) {
      die("SQL error: " );
  }
  $admin=0;
  $stmt->bind_param("isss",
                    $_SESSION["user_id"],
                    $user["name"],
                    $_POST['comment'],
                    $threadId);
                    
  if ($stmt->execute()) {

      header("Location: ../pages/thread.php?thread=".$threadId);
      exit;
      
  } else {
      
      if (mysqli_error($mysqli) === 1062) {
          die("email already taken");
      } else {
          die(mysqli_error($mysqli));
      }
  }

  ?>