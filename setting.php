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

$check_submit = "";

$sql = "SELECT * FROM admin WHERE username = '" . $_SESSION['username'] . "'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);

if (isset($_GET['update'])) {
    if ($_GET['update'] == "pass") {
        $check_submit = '<div class="alert alert-success" role="alert">';
        $check_submit .= '<span><i class="bi bi-check2-circle"></i> Saved</span>';
        $check_submit .= '</div>';
    }
}

if (isset($_POST["save"])) {
    $sql_2 = "UPDATE admin  SET name = '" . $_POST["name"] . "' , surname = '" . $_POST["surname"] . "' , gender = '" . $_POST["gender"] . "' , email = '" . $_POST["email"] . "' WHERE username = '" . $_SESSION['username'] . "'";
    $query_2 = mysqli_query($conn, $sql_2);

    header("location:setting.php?update=pass");
    exit();
}

$sql2 = "SELECT id, password FROM admin WHERE username = '" . $_SESSION['username'] . "'";
$query2 = mysqli_query($conn, $sql2);
$result2 = mysqli_fetch_array($query2);

if (isset($_POST['savepassword'])) {
    if (md5($_POST['password_old']) != $result2[1]) {
        $check_submit = '<div class="alert alert-danger" role="alert">';
        $check_submit .= '<span><i class="bi bi-info-circle"></i> Old Password not correct</span>';
        $check_submit .= '</div>';
    } elseif ($_POST['password_new'] != $_POST['confirm_password']) {
        $check_submit = '<div class="alert alert-danger" role="alert">';
        $check_submit .= '<span><i class="bi bi-info-circle"></i> New Password or Confirm Password not correct</span>';
        $check_submit .= '</div>';
    } else {
        $sql3 = "UPDATE admin SET password = '" . md5($_POST["password_new"]) . "' WHERE username = '" . $_SESSION['username'] . "'";
        $query3 = mysqli_query($conn, $sql3);

        header("location:setting.php?update=pass");
        exit();
    }
}
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
                    <h2 class="fs-2 m-0">Setting</h2>
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


            <div class="container-fluid">
                <div class="col-md-12 mt-4">
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto"><?php echo $check_submit; ?></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-1 col-md-9 mb-5">
                            <div class="card o-hidden border-0 shadow-lg my-5 mb-5">
                                <div class="card-body p-0">
                                    <div class="row-center">
                                        <div class="col-12 d-none d-lg-block text-center">
                                       
                                            <img class="img-profile" style="margin-top:20px;" src="picture/admin.png" width="20%" height="auto">
                                            <div class="row-center">
                                                <br><i class="fas fa-home me-2">

                                                </i>Name : <?php echo $result[1]; ?>
                                                <br>Surname : <?php echo $result[3] ?>
                                                <br>Name : <?php echo $result[4]; ?>
                                                <br>Gender : <?php echo $result[5]; ?>
                                                <br>E-mail : <?php echo $result[6]; ?>
                                            </div>
                                            <div class="col mt-4 mb-5">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaledit<?php echo $result["id"]; ?>"> EDIT </button>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalchangepass<?php echo $result["id"]; ?>">Change Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                            <form method="post">
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
                                <label for="date">username</label>
                                <input type="text" class="form-control form-control-user" name="username" value="<?php echo $result[1]; ?>" disabled>
                                <br>

                                <label for="number">Name</label>
                                <input type="text" class="form-control form-control-user" name="name" value="<?php echo $result[3]; ?>">
                                <br>

                                <label for="username">Surname</label>
                                <input type="text" class="form-control form-control-user" name="surname" value="<?php echo $result[4]; ?>">
                                <br>

                                <label for="username">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="male" <?php if ($result[5] == 'Male') {
                                                                echo " selected";
                                                            } ?>>Male</option>
                                    <option value="female" <?php if ($result[5] == 'Female') {
                                                                echo " selected";
                                                            } ?>>Female</option>
                                </select>
                                <br>
                                <label for="email">Email</label>
                                <input type="text" class="form-control form-control-user" name="email" value="<?php echo $result[6]; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary width" data-dismiss="modal">Close</button>
                            <input type="submit" value="save" name="save" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <!--end-edit-modal -->
    <!--change-password -->
    <div class="modal fade" id="modalchangepass<?php echo $result2["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Change Password</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <label for="date">Old Password</label>
                        <input type="password" class="form-control form-control-user" name="password_old" required />
                        <br>

                        <label for="number">New Password</label>
                        <input type="password" class="form-control form-control-user" name="password_new" required />
                        <br>

                        <label for="username">Confirm New password</label>
                        <input type="password" class="form-control form-control-user" name="confirm_password" required />
                        <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary width" data-dismiss="modal">Close</button>
                    <input type="submit" value="Save" name="savepassword" class="btn btn-success">

                </div>
            </div>
        </div>
        </form>
    </div>
    <!--change-password -->
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


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
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>


    <?php mysqli_close($conn); ?>
</body>
</body>

</html>
