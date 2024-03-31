<?php
session_start();
include('connection.php');

if (isset($_POST['add_tenantinfo'])) {
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $emailT = mysqli_real_escape_string($conn, $_POST['emailT']);
    $dateIn = mysqli_real_escape_string($conn, $_POST['dateIn']);

    
    $sql = "INSERT INTO tenantinfo (number, username, tel, emailT,dateIn) VALUES('$number', '$username', '$tel','$emailT','$dateIn')";
    $sqlupdate = "UPDATE room SET statusRoom='ไม่ว่าง' WHERE statusRoom is null and number='$number';";
    $result = mysqli_query($conn,$sqlupdate);

    if ($result) {
        $_SESSION['status'] = "Successfully Save !" ;
        header('location: tenant.php');
    }else {
        $_SESSION['status'] = "Not Saved !" ;
        header('location: tenant.php');
    }
}












if (isset($_POST['edit_tenantinfo'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $result_array = [];

    if (empty($id)) {
        array_push($errors);
    }

    $sql = "SELECT * FROM tenantinfo WHERE id='$id' ";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result)>0) {
        foreach ($result as $row){
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    }else {
        echo $return = "<h5>Not Record Found</h5>" ;
    }
}

if(isset($_POST['update_tenantinfo'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $emailT = mysqli_real_escape_string($conn, $_POST['emailT']);
    $dateIn = mysqli_real_escape_string($conn, $_POST['dateIn']);


    $sql = "UPDATE tenantinfo SET number='$number', username='$username', tel='$tel' , emailT='$emailT' , dateIn='$dateIn' WHERE id='$id' ";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $_SESSION['status'] = "Successfully Saved !" ;
        header('location: tenant.php');
    }else {
        $_SESSION['status'] = "Something Went Wrong !" ;
        header('location: tenant.php');
    }
}

if (isset($_POST['delete_tenantinfo'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    if (empty($id)) {
        array_push($errors);
    }

    $sql = "DELETE FROM tenantinfo WHERE id='$id' ";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $_SESSION['status'] = "Successfully Deleted !" ;
        header('location: tenant.php');
    }else {
        $_SESSION['status'] = "Something Went Wrong !" ;
        header('location: tenant.php');
    }
}

if (isset($_POST['checking_viewbtn'])) {
    $id = $_POST['tenantinfo_id'];
    //echo $return =$id;
    $query="SELECT * FROM tenantinfo WHERE id='$id'";
    $result=mysqli_query($conn,$query);
     if (mysqli_num_rows($result) > 0) 
     {
       while($row=mysqli_fetch_array($result))
        {
            echo $return = 
            '
            <h5> ID : '.$row['id'].'</h5>
            <h5> Name : '.$row['username'].'</h5>
            <h5> Tel : '.$row['tel'].'</h5>
            <h5> Email: '.$row['emailT'].'</h5>
            <h5> Move In: '.$row['dateIn'].'</h5>
            ';
        }
        }
       else {
       echo $return="<h5>No Record Found</h5>";
           }
    }



 ?>

