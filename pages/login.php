
<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/connection.php";
    
    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        if (password_verify($_POST["password"], $user["password"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            echo($user)
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
  </head>
  <body>
    <div class="container right-panel-active">

      <div class="container__form container--signin">
        <form action="index.php" class="form" id="form2">
          <h2 class="form__title">Sign In</h2>
          <input type="email" placeholder="Email" class="input" required/>
          <input type="password" placeholder="Password" class="input" required/>
          <a href="index.php" class="link">Forgot your password?</a>
          <button for="submit" class="btn">Sign in</button>
        </form>
      </div>
    
      <!-- Overlay -->
      <div class="container__overlay">
      </div>
    </div>
  </body>
</html>