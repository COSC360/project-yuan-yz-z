<?php
if (isset($_GET["success"])){
  
  echo '<script>alert("Profile successfully updated")</script>';
}
session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/../mysql/connection.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/thread.css">
  </head>
  <body>
    <div class="top-bar">
        <h1 class="nav">
            Profile page
        </h1>
    <?php if (isset($user)): ?>
        <p class="nav">Hello <?= htmlspecialchars($user["name"]) ?></p>
        <a href="index.php" class="nav, button-login"> Go to Homepage</a>
        <a href="../mysql/logout.php" class="nav, button-login"> logout</a>
    </div>
    <?php else: ?>
        <a href="login.php" class="nav, button-login"> login</a>
    </div>
    <?php endif; ?>
    <form action="../mysql/updateThread.php?userId=<?php echo $user["id"]?>" method="post">
      <div class="container">
        <label for="uname"><b>Change User Name</b></label>
        <input type="text" name="userName" placeholder="Enter new user name" >
    
        <label for="psw"><b>Change email</b></label>
        <input type="text" name="email" placeholder="Enter new Email" >
    
        <button id="submit" type="submitButton">Submit</button>
      </div>
    </form>
	<script src="index.js"></script>
  </body>
</html>