<?php
    session_start();
    include('connection.php');

    $errors = array(); 

    if (isset($_POST['login_admin'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)) { 
            array_push($errors, "Username is required"); 
        }
        if (empty($password)) {
            array_push($errors, "Password is required"); 
        }
        if (count($errors) == 0) {
  	        $password = md5($password);
            $query =  "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
            $result = mysqli_query($conn, $query); 
  	        if(mysqli_num_rows($result)==1){
  	            $_SESSION['username'] = $username;
  	            header('location: homepage.php');
            }else{
                array_push($errors,"Wrong Username/Password combination");
                $_SESSION['error'] = 'Wrong Username/Password combination';
                header('location: login.php');
            }
        }
    }
?>
