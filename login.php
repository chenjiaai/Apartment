<?php
session_start();
include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  <!-- Bootstap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!-- CSS File-->
  <link rel="stylesheet" href="login.css">

</head>

<body>
  <div class="login">
    <h1 class="text-center">Login</h1>
    <form action="login_db.php" method="post">
      <?php include('errors.php'); ?>
      <?php if (isset($_SESSION['error'])) :  ?>
        <div class="alert alert-warning" role="alert">
        <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
      <?php endif ?>
      <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" Required>
      </div>
      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" Required>
      </div>
      <input class="btn btn-success w-100" type="submit" value="Login" name="login_admin">
      <div class="signup_link mt-2">
        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
      </div>
    </form>
  </div>
</body>

</html>