<?php
    session_start();
    include('connection.php');
    if(!isset($_SESSION['username'])){
        $_SESSION['msg']="You must login first";
        header('location: login.php');
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
  
  
    $sql="SELECT * from  room order by number" ;
    $result= mysqli_query($conn,$sql);
    $count= mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
   
    $sql2="SELECT number from  room where number in (select number from tenantinfo where statusRoom is not null);";
    $result= mysqli_query($conn,$sql);
    $result2= mysqli_query($conn,$sql2);
    $count2= mysqli_num_rows($result2);
    $row2 = mysqli_fetch_array($result2);

    $sql3="SELECT number from  room where number not in (select number from tenantinfo where statusRoom is not null);";
    $result= mysqli_query($conn,$sql);
    $result3= mysqli_query($conn,$sql3);
    $count3= mysqli_num_rows($result3);
    $row3 = mysqli_fetch_array($result3);
?>
<!doctype html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="homepage.css">
  

  

    <title>status Room</title>
  </head>
  <body>
    <div class ="container"> 
    <h1 class="text-center">Status Room</h1><br>
    <div class ="grid">
        <?php while($row = mysqli_fetch_array($result)){ ?>
       
       <?php 
              if( $row["statusR"] == NULL  ) {
                    
                echo "<font class='green'>{$row['number'] }</font>";
              
            }
            
            else if($row["statusRoom"] == "Busy")  {
                echo "<font  class='red'>{$row['number'] }</font>";
                
            }
             
         ?>
        <?php } ?> 

        
    </div>
    <br>
   
    <div class ="count"> 
    Busy: <?php echo $count2;?>
    </div> <br><br><br>

    <div class ="count2"> 
    Avaible: <?php echo $count3;?>  <br>
    </div>
    </div>


    <script src="ham.js"></script>
  </body>
</html>
