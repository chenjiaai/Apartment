<?php 
session_start();
include('connection.php'); 

$id = $_POST["id"];
$number = $_POST["number"];
$price = $_POST["price"];
$statusR = $_POST["statusRoom"];


$sql = "UPDATE room SET id ='$id', number='$number' , price='$price'  WHERE id=$id;"; 
$result=mysqli_query($conn,$sql);

if($result){
    header("location: room.php");
    exit(0);
}else{
    header("location: room.php");
    exit(0);
}

?>
