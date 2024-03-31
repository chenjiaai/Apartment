<?php
session_start();
include('connection.php');

$errors = array(); 

if (isset($_POST['adduser'])) {

  $number= mysqli_real_escape_string($conn, $_POST['number']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $tel= mysqli_real_escape_string($conn, $_POST['tel']);
  $dateIn= mysqli_real_escape_string($conn, $_POST['dateIn']);
  $emailT= mysqli_real_escape_string($conn, $_POST['emailT']);

 
  if (empty($number)) { 
    array_push($error); 
  }
  if (empty($username)) { 
    array_push($error); 
  }
  if (empty($tel)) { 
    array_push($error);
   }
  if (empty($dateIn)) { 
    array_push($error); 
  }
  if (empty($statusRoom)) { 
    array_push($error); 
  }
  if (empty($emailT)) { 
    array_push($error); 
  }


  $user_check_query = "SELECT * FROM tenantinfo WHERE number='$number' OR  username='$username'OR tel='$tel' OR emailT='$emailT' OR dateIn='$dateIn' OR statusRoom='$statusRoom'" ;
  $query = mysqli_query($conn, $user_check_query); 
  $result = mysqli_fetch_assoc($query);
 
  if (count($errors) == 0) {
  	

  	$sql = "INSERT INTO tenantinfo (number,username,tel,dateIn,statusRoom,emailT) 
  			  VALUES('$number','$username','$tel','$dateIn','$statusRoom','$emailT')";


    $sqlupdate = "UPDATE room SET statusRoom='BUSY' WHERE statusRoom is null and number='$number';";   
    $result = mysqli_query($conn,$sqlupdate) ;

  	mysqli_query($conn, $sql);
    $_SESSION['username'] = $username;
    header('location: tenant.php');
  }else {
    array_push($errors);
    header('location: tenant.php');
    }
}
?>