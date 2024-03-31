<?php
session_start();
include('connection.php');

if (isset($_POST['add_roomtype'])) {
    $image = mysqli_real_escape_string($conn, $_FILES['add_image']["type"]);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    

    if (file_exists("upload/" . $_FILES["image"]["type"])) {
        $store = $_FILES["image"]["type"];
        $_SESSION['status'] = "" ;
        header('location: roomtype.php');
    }else {
        $sql = "INSERT INTO roomtype (image, type, price) VALUES('$image', '$type', '$price')";
        $result = mysqli_query($conn,$sql);
    
        if($result) {
            move_uploaded_file(["imgage"]["tmp_type"], "upload/" .$_FILES["image"]["type"]);
            $_SESSION['status'] = "Successfully Save !" ;
            header('location: roomtype.php');
        }else {
            $_SESSION['status'] = "Not Saved !" ;
            header('location: roomtype.php');
        }
    }
    // if ($result) {
    //     $_SESSION['status'] = "Successfully Save !" ;
    //     header('location: cost.php');
    // }else {
    //     $_SESSION['status'] = "Not Saved !" ;
    //     header('location: cost.php');
    // }
}

if (isset($_POST['edit_roomtype'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
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
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "UPDATE roomtype SET image='$image', type='$type', price='$price' WHERE id='$id' ";
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
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    if (empty($id)) {
        array_push($errors);
    }

    $sql = "DELETE FROM roomtype WHERE id='$id' ";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $_SESSION['status'] = "Successfully Deleted !" ;
        header('location: roomtype.php');
    }else {
        $_SESSION['status'] = "Something Went Wrong !" ;
        header('location: roomtype.php');
    }
}

?>