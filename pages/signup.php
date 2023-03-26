
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/login.css">
  </head>
  <body>
    <div class="container">
      <!-- Sign Up -->
      <div class="container__form" style="width:100%">
        <form action="../mysql/process-signup.php" method="POST" class="form" id="form1" enctype="multipart/form-data">
          <h2 class="form__title">Sign Up</h2>
          <input type="text" placeholder="Name" name="name" name="name" class="input" />
          <input type="text" placeholder="userName"  name="userName" class="input" />
          <input type="email" placeholder="email" name="email" class="input" />
          <input type="password" placeholder="password" name="password" class="input" />
          <label for="img">Select profile image:</label>
          <input type="file" id="img" name="image" accept="image/*">
          <button for="submit" class="btn">Sign Up</button>
        </form>
      </div>
    
      <!-- Overlay -->
      <div class="container__overlay">
      </div>
    </div>
  </body>
</html>