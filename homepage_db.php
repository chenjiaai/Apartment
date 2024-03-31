<?php
session_start();
include('connection.php');

if (isset($_POST['edit_hp'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $result_array = [];

    if (empty($id)) {
        array_push($errors);
    }

    $sql = "SELECT * FROM cost WHERE id='$id' ";
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
    if(isset($_POST['update_hp'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $priceW = mysqli_real_escape_string($conn, $_POST['priceW']);
    $priceE = mysqli_real_escape_string($conn, $_POST['priceE']);
    $commonfee = mysqli_real_escape_string($conn, $_POST['commonfee']);

    $sql = "UPDATE cost SET priceW='$priceW', priceE='$priceE', commonfee='$commonfee' WHERE id='$id' ";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $_SESSION['status'] = "Successfully Saved !" ;
        header('location: cost.php');
    }else {
        $_SESSION['status'] = "Something Went Wrong !" ;
        header('location: cost.php');
    }
}

?>