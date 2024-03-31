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
                    <h2 class="fs-2 m-0">Invoice</h2>
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

                <!--Log out Modal-->
                <div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="deleteRoomsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteRoomsModalLabel">Logout</h1>
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
            </nav>
        </div>
        <!-- /#page-content-wrapper -->
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>