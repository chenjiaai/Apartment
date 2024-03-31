<?php 
session_start();
include('connection.php');

$errors = array(); 

$id = $_POST["id"];
$dateIn = $_POST["dateIn"];
$dateOut=$_POST["dateOut"];


$sql = "UPDATE tenantinfo SET id ='$id', dateIn='$dateIn' , dateOut='$dateOut'WHERE id=$id;"; 
$result=mysqli_query($conn,$sql);


if($result && $dateIn < $dateOut){
    $sqlinsert="INSERT INTO moveout (number,username,tel,dateIn,dateOut,emailT) SELECT number,username,tel,dateIn,dateOut,emailT FROM tenantinfo WHERE id=$id";
    $result = mysqli_query($conn,$sqlinsert) ;

    $statusRoom = mysqli_real_escape_string($conn, $_POST['statusRoom']);
    $number= mysqli_real_escape_string($conn, $_POST['number']);
   
    $sqlupdate = "UPDATE room SET number ='$number',statusRoom=NULL WHERE statusRoom ='Busy' and number='$number';";   
    $result = mysqli_query($conn,$sqlupdate) ;

    $sqldelete="DELETE FROM tenantinfo WHERE id=$id ";
    $result = mysqli_query($conn,$sqldelete) ;
    header("location:moveout.php");
    exit(0);
} else{
    array_push($errors,"Date Out Error!");
    $_SESSION['error'] = "Date out Error!"; 
    header("location:editmoveout.php?id=$id");
    exit(0);
}
?>
