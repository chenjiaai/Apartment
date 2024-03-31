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
                    <h2 class="fs-2 m-0">Cost of Utilities</h2>
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

            <!--Log out Modal-->
            <div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="deleteRoomsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteRoomsModalLabel">Logout</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="homepage_db.php" method="post">
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

            <!--Add Modal -->
            <div class="modal fade" id="addCostmodal" tabindex="-1" aria-labelledby="addCostModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addCostModalLabel">Add Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="cost_db.php" method="post">
                                <div class="form-group">
                                    <label for="priceW" class="form-label">Water</label>
                                    <input type="text" class="form-control" name="priceW" Required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="priceE" class="form-label">Electric</label>
                                    <input type="text" class="form-control" name="priceE" Required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="commonfee" class="form-label">Common Fee</label>
                                    <input type="text" class="form-control" name="commonfee" Required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="add_cost">Save Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Edit Modal -->
            <div class="modal fade" id="editCostmodal" tabindex="-1" aria-labelledby="editCostModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editCostModalLabel">Edit Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="cost_db.php" method="post">
                                <input type="hidden" name="id" id="edit_id">
                                <div class="form-group">
                                    <label for="priceW" class="form-label">Water</label>
                                    <input type="text" class="form-control" id="edit_priceW" name="priceW" Required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="priceE" class="form-label">Electric</label>
                                    <input type="text" class="form-control" id="edit_priceE" name="priceE" Required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="commonfee" class="form-label">Common Fee</label>
                                    <input type="text" class="form-control" id="edit_commonfee" name="commonfee" Required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" name="update_cost">Updata Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Delete Modal -->
            <div class="modal fade" id="deleteCostmodal" tabindex="-1" aria-labelledby="deleteCostModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteCostModalLabel">Delete Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="cost_db.php" method="post">
                                <input type="hidden" name="id" id="delete_id">
                                <h5>Are you sure you want to delete data?</h5>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" name="delete_cost">Delete Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid px-4">
                <div class="row my-4">
                    <div class="col">
                        <?php
                        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['status']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['status']);
                        }
                        ?>
                        <div class="col-body">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addCostmodal">
                                ADD
                            </button>
                        </div>
                        <div class="col">
                            <div class="col-body">
                                <table class="table bg-white rounded shadow-sm  table-hover center my-3">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Water</th>
                                            <th scope="col">Electric</th>
                                            <th scope="col">Common Fee</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM cost";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            // while ($row = mysqli_fetch_array($result)) 
                                            foreach ($result as $row) {
                                        ?>
                                                <tr class="text-center bg-green-500">
                                                    <td style="display: none" class="cost_id "> <?php echo $row['id'] ?> </td>
                                                    <td> <?php echo $row['priceW']; ?> </td>
                                                    <td> <?php echo $row['priceE']; ?> </td>
                                                    <td> <?php echo $row['commonfee']; ?> </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success edit_cost"> EDIT </button>

                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger delete_cost"> DELETE </button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<h5>No Record Found</h5>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };

        $(document).ready(function() {

            $('.delete_cost').click(function(e) {
                e.preventDefault();
                var cost_id = $(this).closest('tr').find('.cost_id').text();
                // console.log(cost_id);
                $('#delete_id').val(cost_id);
                $('#deleteCostmodal').modal('show');
            })

            $('.edit_cost').click(function(e) {
                e.preventDefault();
                var cost_id = $(this).closest('tr').find('.cost_id').text();
                // console.log(cost_id);
                $.ajax({
                    type: "POST",
                    url: "cost_db.php",
                    data: {
                        'edit_cost': true,
                        'id': cost_id,
                    },
                    success: function(response) {
                        // console.log(response);
                        $.each(response, function(key, value) {
                            // console.log(value['priceW'])
                            $('#edit_id').val(value['id']);
                            $('#edit_priceW').val(value['priceW']);
                            $('#edit_priceE').val(value['priceE']);
                            $('#edit_commonfee').val(value['commonfee']);
                        });
                        $('#editCostmodal').modal('show');
                    }
                });
            })
        });
    </script>
</body>

</html>