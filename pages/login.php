
<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $mysqli = require __DIR__ . "/../mysql/connection.php";
    
    $sql = "SELECT * FROM users
                    WHERE email = '".$_POST["email"]."'";
    
    $result = mysqli_query($mysqli,$sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        if (password_verify($_POST["password"], $user["pass"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            // echo($user)
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
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <div class="container">
      <div class="container__form container--signin" style="width:100%">
        <form method="post" class="form" id="form2">
          <h2 class="form__title">Sign In</h2>
          <input type="email" name="email" placeholder="Email" class="input" required/>
          <input type="password" name="password" placeholder="Password" class="input" required/>
          <a href="signup.php" class="link">No Account? Sign up here</a>
          <button for="submit" class="btn">Sign in</button>
        </form>
      </div>
  
    </div>
  </body>
</html>