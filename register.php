<?php
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <!-- Bootstap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- CSS File-->
    <link rel="stylesheet" href="register.css">

</head>

<body>
    <div class="register">
        <h1 class="text-center">Register</h1>
        <form action="register_db.php" method="post">
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
                <label for="surname" class="form-label">Surname</label>
                <input type="text" class="form-control" name="surname" Required>
            </div>
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" Required>
            </div>
            <div class="form-group">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" name="gender" size="mb-4" Required>
                    <option selected>Please select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group ">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" Required>
            </div>
            <div class="form-group">
                <label for="password_1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password_1" Required>
            </div>
            <div class="form-group">
                <label for="password_2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_2" Required>
            </div>
            <input class="btn btn-success w-100" type="submit" value="Register" name="reg_admin">
            <div class="register_link mt-2">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>