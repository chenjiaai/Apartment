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

$query = "SELECT number from  room where number not in (select number from tenantinfo where username is not null) order by  number;";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);



$perpage = 10;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $perpage;
$sql = "select * from tenantinfo order by  number limit {$start} , {$perpage} ";
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
                    <h2 class="fs-2 m-0">Tenant info</h2>
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




           


            <div class="container-fluid px-4">
                 <!-- Page Heading -->
                 <div class="col-body">
                 <button type="button" class="btn btn-light"  data-toggle="modal" data-target="#modaladd">
                                ADD
                            </button>
                  </div><br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="text-right mr-5">
                            <!-- add-modal -->
                            <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLongTitle">Add Tenant</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="adduser_db.php" method="post">
                                                <?php include('error.php'); ?>
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
                                                <div class="text-left">
                                                    <label for="dateIn">Date</label>
                                                    <input type="date" class="form-control form-control-user" name="dateIn" Required>
                                                </div><br>
                                                <div class="text-left">
                                                    <label for="number">Room no.</label><br>
                                                    <select name="number" class="form-control form-control-user" required>
                                                        <option value="">--</option>
                                                        <?php foreach ($result as $results) { ?>
                                                            <option value="<?php echo $results["number"]; ?>">
                                                                <?php echo $results["number"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div><br>
                                                <div class="text-left">
                                                    <label for="username">Name</label><br>
                                                    <input type="text" class="form-control form-control-user" name="username" Required>
                                                </div><br>
                                                <div class="text-left">
                                                    <label for="tel">Tel.</label><br>
                                                    <input type="text" class="form-control form-control-user" name="tel" Required>
                                                </div><br>
                                                
                                                <div class="text-left">
                                                    <label for="emaiT">Email</label><br>
                                                    <input type="text" class="form-control form-control-user" name="emailT" Required>
                                                </div>

                                                </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="adduser" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!--end-add-modal -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Room no.</th>
                                            <th>Name</th>
                                            <th>Detail</th>
                                            <th>Edit</th>
                                            <th>Move out</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php while ($result = mysqli_fetch_assoc($query)) { ?>
                                            <tr>
                                                <td><?php echo $result["number"]; ?></td>
                                                <td><?php echo $result["username"]; ?></td>


                                                <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalview<?php echo $result["id"]; ?>"> view </button></td>
                                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaledit<?php echo $result["id"]; ?>"> Edit</button></td>
                                                <td> <a href="editmoveout.php?id=<?php echo $result["id"]; ?>" class="btn btn-danger">move out</a></td>

                                            </tr>
                                            <!--view-modal -->
                                            <div class="modal fade" id="modalview<?php echo $result["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLongTitle">Tenant info</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Room no. : <?php echo $result["number"] ?> <br>
                                                            Name : <?php echo $result["username"] ?> <br>
                                                           Tel. : <?php echo $result["tel"]; ?><br>
                                                            
                                                            Email :<?php echo $result["emailT"] ?><br>
                                                            Date In : <?php echo $result["dateIn"]; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end-view-modal -->

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
                                                            <form action="updatedata.php" method="post">
                                                                <input type="hidden" value="<?php echo $result["id"]; ?>" name="id">
                                                                <?php include('error.php'); ?>
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
                                                                <label for="dateIn">Date In :</label>
                                                                <input type="date" class="form-control form-control-user" name="dateIn" value="<?php echo $result["dateIn"]; ?>">
                                                                <br>

                                                                <label for="number">Room no. :</label>
                                                                <input type="text" class="form-control form-control-user" name="number" value="<?php echo $result["number"]; ?>" readonly>
                                                                <br>

                                                                <label for="username">Name:</label>
                                                                <input type="text" class="form-control form-control-user" name="username" value="<?php echo $result["username"]; ?>">
                                                                <br>

                                                                <label for="tel">Tel. :</label>
                                                                <input type="text" class="form-control form-control-user" name="tel" value="<?php echo $result["tel"]; ?>">
                                                                <br>

                                                               

                                                                <label for="emailT">Email :</label>
                                                                <input type="text" class="form-control form-control-user" name="emailT" value="<?php echo $result["emailT"]; ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary width" data-dismiss="modal">Close</button>
                                                            <input type="submit" value="Save" class="btn btn-success">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                            <!--end-edit-modal -->

                                            <!--moveout-modal -->
                                            <div class="modal fade" id="modalmoveout<?php echo $result["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLongTitle">Move out</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="deletemoveout.php" method="post">
                                                                <input type="hidden" value="<?php echo $result["id"]; ?>" name="id">
                                                                <?php include('error.php'); ?>
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
                                                                <input type="hidden" name="date" value="<?php echo $result["date"]; ?>">
                                                                <br>

                                                                <label for="number">Room no.</label>
                                                                <input type="text" name="number" class="form-control form-control-user" value="<?php echo $result["number"]; ?>" readonly>
                                                                <br>

                                                                <label for="username">Name</label>
                                                                <input type="text" name="username" class="form-control form-control-user" value="<?php echo $result["username"]; ?>" readonly>
                                                                <br>

                                                                <label for="tel">Tel.</label>
                                                                <input type="text" name="tel" class="form-control form-control-user" value="<?php echo $result["tel"]; ?>" readonly>
                                                                <br>

                                                                <label for="dateIn">Date In</label>
                                                                <input type="date" name="dateIn" class="form-control form-control-user" value="<?php echo $result["dateIn"]; ?>" readonly>
                                                                <br>

                                                                <label for="dateOut">Date Out</label>
                                                                <input type="date" name="dateOut" class="form-control form-control-user" value="<?php echo $result["dateOut"]; ?>" Required>
                                                                <br>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <input type="submit" value="Save" class="btn btn-success">

                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <!--end-moveout-modal -->
                                            <?php } ?>
                                    </tbody>
                                </table>
                                <!-- Button trigger modal -->

                                <!-- Modal -->

                                <?php
                                $sql2 = "select * from tenantinfo ";
                                $query2 = mysqli_query($conn, $sql2);
                                $total_record = mysqli_num_rows($query2);
                                $total_page = ceil($total_record / $perpage);
                                ?>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="tenant.php?page=1" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                            <li class="page-item"><a class="page-link" href="tenant.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php } ?>
                                        <li class="page-item">
                                            <a class="page-link" href="tenant.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div> <!-- /container -->
                    <script src="bootstrap/js/bootstrap.min.js"></script>


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
