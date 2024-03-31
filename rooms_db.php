<?php
session_start();
include('connection.php');

if (isset($_POST['add_rooms'])) {
    $type = mysqli_real_escape_string($conn, $_POST['room_type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    
    $sql = "INSERT INTO rooms (room_type, price) VALUES('$type', '$price')";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $_SESSION['status'] = "Successfully Save !" ;
        header('location: rooms.php');
    }else {
        $_SESSION['status'] = "Not Saved !" ;
        header('location: rooms.php');
    }
}

if (isset($_POST['edit_rooms'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $result_array = [];

    if (empty($id)) {
        array_push($errors);
    }

    $sql = "SELECT * FROM rooms WHERE id='$id' ";
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

if(isset($_POST['update_rooms'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $type = mysqli_real_escape_string($conn, $_POST['room_type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "UPDATE rooms SET room_type='$type', price='$price' WHERE id='$id' ";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $_SESSION['status'] = "Successfully Saved !" ;
        header('location: rooms.php');
    }else {
        $_SESSION['status'] = "Something Went Wrong !" ;
        header('location: rooms.php');
    }
}

if (isset($_POST['delete_rooms'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    if (empty($id)) {
        array_push($errors);
    }

    $sql = "DELETE FROM rooms WHERE id='$id' ";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $_SESSION['status'] = "Successfully Deleted !" ;
        header('location: rooms.php');
    }else {
        $_SESSION['status'] = "Something Went Wrong !" ;
        header('location: rooms.php');
    }
}

?>