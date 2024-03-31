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
$id = $_GET["id"];
$sql = "SELECT * FROM tenantinfo WHERE id=$id ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

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
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#logoutmodal"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Tenant</h2>
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

                                <li><a class="dropdown-item" href="setting.php">Settings</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutmodal">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- DataTales Example -->



                    <!-- DataTales Example -->

                    <body class="bg-gradient-primary">

                        <div class="container">

                            <!-- Outer Row -->
                            <div class="row justify-content-center">

                                <div class="col-xl-10 col-lg-12 col-md-9">

                                    <div class="card o-hidden border-0 shadow-lg my-5">
                                        <div class="card-body p-0">
                                            <!-- Nested Row within Card Body -->
                                            <div class="row">
                                                <div class="col-lg-6 d-none d-lg-block text-center">
                                                    <img class="img-profile" style="margin-top:120px;margin-left:20px;" src="picture/admin.png" width="100%" height="auto">
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="p-5">
                                                        <div class="text-center">
                                                            <form action="deletemoveout.php" method="post">
                                                                <input type="hidden" value="<?php echo $row["id"]; ?>" name="id">
                                                                <?php include('error.php'); ?>
                                                                <?php if (isset($_SESSION['error'])) :  ?>
                                                                    <div class="error-moveout ">
                                                                        <h3>
                                                                            <?php
                                                                            echo $_SESSION['error'];
                                                                            unset($_SESSION['error']);
                                                                            ?>
                                                                        </h3>
                                                                    </div>
                                                                <?php endif ?>
                                                                <input type="hidden" name="date" class="form-control form-control-user" value="<?php echo $row["date"]; ?>">
                                                                <br>
                                                                <div class="text-left">
                                                                    <label for="number">Room no.</label>
                                                                    <input type="text" name="number" class="form-control form-control-user" value="<?php echo $row["number"]; ?>" readonly>
                                                                    <br>

                                                                    <label for="username">Name</label>
                                                                    <input type="text" name="username" class="form-control form-control-user" value="<?php echo $row["username"]; ?>" readonly>
                                                                    <br>

                                                                    <label for="tel">Tel</label>
                                                                    <input type="text" name="tel" class="form-control form-control-user" value="<?php echo $row["tel"]; ?>" readonly>
                                                                    <br>

                                                                    <label for="dateIn">Date In</label>
                                                                    <input type="date" name="dateIn" class="form-control form-control-user" value="<?php echo $row["dateIn"]; ?>" readonly>
                                                                    <br>

                                                                    <label for="dateOut">Dateout</label>
                                                                    <input type="date" name="dateOut" class="form-control form-control-user" value="<?php echo $row["dateOut"]; ?>" Required>
                                                                    <br>
                                                                    <div class="text-right">
                                                                        <input type="submit" class="btn btn-success" value="Edit" class="btns">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
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

                        <!-- Logout Modal-->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a href="homepage.php?logout='1'" class="btn btn-danger">Logout</a>
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
