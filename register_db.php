<?php
session_start();
include('connection.php');

$errors = array();

if (isset($_POST['reg_admin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($surname)) {
        array_push($errors, "Surname is required");
    }
    if (empty($name)) {
        array_push($errors, "Name is required");
    }
    if (empty($gender)) {
        array_push($errors, "Gender is required");
    }
    if (empty($email)) {
        array_push($errors, "E-mail is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $admin_check_query = "SELECT * FROM admin WHERE username='$username' OR surname='$surname' OR name='$name' OR gender='$gender' OR email='$email' ";
    $query = mysqli_query($conn, $admin_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) { 
        if ($result['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($result['email'] === $email) {
            array_push($errors, "E-mail already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1); 
        $sql = "INSERT INTO admin (username, surname, name, gender, email,password) VALUES('$username', '$surname', '$name', '$gender', '$email', '$password')";
        mysqli_query($conn, $sql);
        $_SESSION['username'] = $username;
        header('location: homepage.php');
    }else{
        array_push($errors,"Wrong Username/Email combination");
        $_SESSION['error'] = 'Wrong Username/Email combination';
        header('location: register.php');
    }
}
?>
