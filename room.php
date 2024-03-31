<?php
session_start();
include('connection.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must login first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}

$query = "SELECT * from  room where statusRoom is not null 
union
SELECT * from  room where statusRoom is  null order by number";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);



$perpage = 10;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $perpage;
$sql = "SELECT * from  room where statusRoom is not null 
union
SELECT * from  room where statusRoom is  null order by number limit {$start} , {$perpage} ";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="homepage.css" />
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-building me-2"></i></i>Apartment</div>
            <div class="list-group list-group-flush my-3">
                <a href="homepage.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-home me-2"></i>Home Page</a>
                <a href="tenant.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-user-friends me-2"></i>Tenant</a>
                <a href="rooms.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-door-closed"></i>Rooms</a>
                <a href="room.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="	fas fa-door-open"></i>Room</a>
                <a href="cost.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-paperclip me-2"></i>Cost of Utilities</a>
                <a href="invoice.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-receipt me-2"></i>Invoice</a>
                <a href="moveout.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-receipt me-2"></i>Move out</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#logoutmodal"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0"> Rooms </h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i> <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="setting.php">Setting</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutmodal">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

     
  

            <div class="container-fluid">

<div class="card shadow mb-4">
           <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-striped">
                       <thead>
                           <tr>
                               <th>Room no.</th>
                               <th>Price</th>
                               <th>Status</th>
                               <th>Edit</th>
                           </tr>
                       </thead>

                       <tbody>
                           <?php while ($result = mysqli_fetch_assoc($query)) { ?>
                               <tr>
                                   <td><?php echo $result["number"]; ?></td>
                                   <td><?php echo $result["price"]; ?></td>
                                   <td><?php
                                       if ($result['statusRoom'] == NULL) {
                                           echo "<font color='#0ab97f;'>Available</font>";
                                       } else {
                                           echo "<font color='red'>{$result['statusRoom']}</font>";
                                       }

                                       ?></td>




                                   <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modaledit<?php echo $result["id"]; ?>"> Edit</button></td>


                               </tr>


                               <!--edit-modal -->
                               <div class="modal fade" id="modaledit<?php echo $result["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                   <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h3 class="modal-title" id="exampleModalLongTitle">Edit</h3>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               <form action="room_db.php" method="post">
                                                   <input type="hidden" value="<?php echo $result["id"]; ?>" name="id">
                                                   <?php include('errors.php'); ?>
                                                   <?php if (isset($_SESSION['error'])) :  ?>
                                                       <div class="error">
                                                           <h3>
                                                               <?php
                                                               echo $_SESSION['error'];
                                                               unset($_SESSION['error']);
                                                               ?>
                                                           </h3>
                                                       </div>
                                                   <?php endif ?>
                                                   <div class="modal-card">


                                                       <label for="number">Room no.</label>
                                                       <input type="text" name="number" class="form-control form-control-user" value="<?php echo $result["number"]; ?>">


                                                       <label for="price">Price</label>
                                                       <input type="text" name="price" class="form-control form-control-user" value="<?php echo $result["price"]; ?>">

                                                       <br>
                                                       <div class="text-right">
                                                           <input type="submit" value="Edit" class="btn btn-success">
                                                       </div>
                                                   </div>
                                           </div>
                                           </form>
                                           <!--end-edit-modal --> <?php } ?>
                       </tbody>
                   </table>
                   

       </form>
   </div>
</div>
</div>

</div>



<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->

<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!--Log out Modal-->
<div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="logoutModalLabel">Logout</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <h5>Are you sure you want to log out?</h5>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a class="btn btn-danger" href="login.php">Logout</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<!--insert modal-->

<!--end insert modal-->
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>



