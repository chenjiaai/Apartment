<?php 
session_start();
include('connection.php'); 

$id = $_POST["id"];
$dateIn = $_POST["dateIn"];
$number = $_POST["number"];
$username = $_POST["username"];
$tel = $_POST["tel"];
$statusRoom = $_POST["statusRoom"];
$emailT = $_POST["emailT"];


$sql = "UPDATE tenantinfo SET id ='$id', dateIn='$dateIn' , number='$number' , username='$username', tel='$tel' , emailT='$emailT',statusRoom='$statusRoom' WHERE id=$id;"; 
$result=mysqli_query($conn,$sql);

if($result){
    header("location: tenant.php");
    exit(0);
}else{
    header("location: tenant.php");
    exit(0);
}
?>







