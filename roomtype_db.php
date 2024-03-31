<?php
session_start();
include('connection.php');

if (isset($_POST['add_roomtype'])) {
    $name =   $_POST['room_name'];
    $price =  $_POST['room_price'];
    $image =  $_FILES['room_image']['name'];

    $sql = "INSERT INTO roomtype (room_name, room_price, room_image) VALUES('$name', '$price', '$image')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        move_uploaded_file($_FILES["room_image"]["tmp_name"], 'upload/' . $_FILES["room_image"]["name"]);
        $_SESSION['status'] = "Successfully Save !";
        header('location: roomtype.php');
    } else {
        $_SESSION['status'] = "Not Saved !";
        header('location: roomtype.php');
    }
}

if (isset($_POST['edit_roomtype'])) {
    $id = $_POST['id'];
    $result_array = [];

    if (empty($id)) {
        array_push($errors);
    }

    $sql = "SELECT * FROM roomtype WHERE id='$id' ";
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

if(isset($_POST['update_roomtype'])) {
    $id = $POST['id'];
    $name = $_POST['room_name'];
    $price = $_POST['room_price'];

    $sql = "UPDATE roomtype SET room_name='$name', room_price='$price' WHERE id='$id'";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $_SESSION['status'] = "Successfully Saved !" ;
        header('location: roomtype.php');
    }else {
        $_SESSION['status'] = "Something Went Wrong !" ;
        header('location: roomtype.php');
    }
}


if (isset($_POST['delete_roomtype'])) {
    $id = $_POST['id'];
    $delete_image =  $_FILES['del_room_image'];

    $sql = "DELETE FROM roomtype WHERE id='$id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        unlink("upload/" .$delete_image);
        $_SESSION['status'] = "Successfully Deleted !";
        header('location: roomtype.php');
    } else {
        $_SESSION['status'] = "Something Went Wrong !";
        header('location: roomtype.php');
    }
}
