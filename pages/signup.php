
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
  </head>
  <body>
    <div class="container right-panel-active">
      <!-- Sign Up -->
      <div class="container__form container--signup">
        <form action="../mysql/process-signup.php" method="POST" class="form" id="form1">
          <h2 class="form__title">Sign Up</h2>
          <input type="text" name="name" name="name" class="input" />
          <input type="text" placeholder="userName"  name="userName" class="input" />
          <input type="email" placeholder="email" name="email" class="input" />
          <input type="password" placeholder="password" name="password" class="input" />
          <button for="submit" class="btn">Sign Up</button>
        </form>
      </div>
    
      <!-- Overlay -->
      <div class="container__overlay">
      </div>
    </div>
  </body>
</html>