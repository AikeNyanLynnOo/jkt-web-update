<?php
session_start();
include_once 'auth/authenticate.php';
include("confs/config.php");
$result = mysqli_query($conn, "SELECT
p.policy_id,
cty.category_id AS category_id,
cty.title AS category_title,
p.description,
p.created_at,
p.updated_at
FROM
policies p,
categories cty
WHERE
p.category_id = cty.category_id");
$get_notifications = "SELECT * FROM notifications WHERE seen=0 AND created_at >= DATE_SUB(NOW(),INTERVAL 6 HOUR)";
$noti_result = mysqli_query($conn, $get_notifications);
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="img/logo.jpg" />
    <title>JKT Admin - Types</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">JKT Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block my-1">

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item">
                <a class="nav-link" href="./students.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Students</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Enrollments</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="newEnroll.php">
                            <i class="fas fa-fw fa-user-plus"></i>
                            <span>New Enrollment</span>
                        </a>
                        <a class="collapse-item" href="enrollments.php">
                            <i class="fas fa-fw fa-paperclip"></i>
                            <span>All Enrollments</span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Courses</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="newCourse.php">
                            <i class="fas fa-fw fa-folder-plus"></i>
                            <span>New Course</span>
                        </a>
                        <a class="collapse-item" href="courses.php">

                            <i class="fas fa-fw fa-folder-open"></i>
                            <span>All Courses</span>
                        </a>
                        <a class="collapse-item" href="categories.php">
                            <i class="fas fa-fw fa-clipboard-list"></i>
                            <span>Categories</span>

                        </a>
                        <a class="collapse-item" href="types.php">

                            <i class="fas fa-fw fa-thumbtack"></i>
                            <span>Course types</span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-dollar-sign"></i>
                    <span>Payments</span>
                </a>
                <div id="collapsePayment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./payment.php">
                            <i class="fas fa-fw fa-check"></i>
                            <span>Approved Payments</span></a>
                        <a class="collapse-item" href="./pendingPayments.php">
                            <i class="fas fa-fw fa-dollar-sign"></i>
                            <span>Pending Payments</span></a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block my-1">

            <li class="nav-item">
                <a class="nav-link" href="./consultants.php">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Consultants</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRecruitment" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Recruitment</span>
                </a>
                <div id="collapseRecruitment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./jobs.php">
                            <i class="fas fa-fw fa-suitcase"></i>
                            <span>All jobs</span></a>
                        <a class="collapse-item" href="./applicants.php">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Applicants</span></a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block my-1">

            <li class="nav-item active">
                <a class="nav-link" href="./policies.php">
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>Policy</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search nav-title">
                        <h3>Policies</h3>
                    </div>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <?php if (mysqli_num_rows($noti_result) > 0) { ?>
                                    <span class="badge badge-danger badge-counter"><?php echo mysqli_num_rows($noti_result) ?>+</span>
                                <?php } else { ?>
                                    <span class="badge badge-info badge-counter"><?php echo mysqli_num_rows($noti_result) ?></span>
                                <?php } ?>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notifications Center
                                </h6>
                                <?php while ($row = mysqli_fetch_assoc($noti_result)) : ?>
                                    <a class="dropdown-item d-flex align-items-center" href="notiView.php?id=<?php echo $row["noti_id"] ?>">
                                        <div class="mr-3">
                                            <?php if ($row["type"] == "PENDING_REQUEST") : ?>
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-user-plus text-white"></i>
                                                </div>
                                            <?php elseif ($row["type"] == "PENDING_PAYMENT") : ?>
                                                <div class="icon-circle bg-success">
                                                    <i class="fas fa-donate text-white"></i>
                                                </div>
                                            <?php elseif ($row["type"] == "NEW_APPOINTMENT") : ?>
                                                <div class="icon-circle bg-secondary">
                                                    <i class="fas fa-user-tie text-white"></i>
                                                </div>
                                            <?php else :  ?>
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?php echo $row["created_at"] ?></div>
                                            <span class="font-weight-bold"><?php echo $row["title"] ?></span>
                                        </div>
                                    </a>
                                <?php endwhile; ?>

                                <a class="dropdown-item text-center small text-gray-500" href="notiView.php">Show All Alerts</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $name; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a> -->
                                <a class="dropdown-item" href="./setting.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">
                    <div class="row">
                        <div class="card shadow mb-4 table-lg">
                            <div class="card-header py-3">
                                <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
                                <a href="newPolicy.php" class="new">
                                    <i class="fas fa-fw fa-folder-plus"></i>
                                    Insert New Policy
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                                <tr>
                                                    <td><?= $row['policy_id'] ?></td>
                                                    <td><?= $row['description'] ?></td>
                                                    <td><?= $row['category_title'] ?></td>
                                                    <td><?= $row['created_at'] ?></td>
                                                    <td><?= $row['updated_at'] ?></td>
                                                    <td><button class="tb-btn tb-btn-edit" onclick="setCurrentPolicyEdit(this,<?php echo $row['category_id'] ?>)" data-toggle="modal" data-target="#editingModal"><i class="fa fa-pencil"></i></button></td>
                                                    <td><button class="tb-btn tb-btn-delete" onclick="setCurrentPolicyDel(<?php echo $row['policy_id'] ?>)" data-toggle="modal" data-target="#deletingModal"><i class="fa fa-trash"></button></i></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- editing Modal -->
            <div class="modal fade" id="editingModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editing</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="col-12" id="editingModal" action="backend/editPolicy.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="policyIdEdit" id="policyIdEdit">
                                <label for="policyDescription">Type Title<span class="my-required-field">Required*</span></label>
                                <input type="text" name="policyDescription" id="policyDescription" class="form-control" />
                                <div class="form-group mt-3 mb-3">
                                    <label for="policyCatId">Choose Category<span class="my-required-field">Required*</span></label>
                                    <select name="policyCatId" id="policyCatId" class="form-control" required>
                                        <option value="" selected disabled>Category</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT * FROM categories");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value='<?= $row["category_id"] ?>'><?= $row["title"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <input class="btn btn-primary" type="submit" value="Update">
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <!-- delete modal -->
            <div class="modal fade" id="deletingModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Deleting</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to delete?</p>
                            <form class="col-12" action="backend/deletePolicy.php" method="POST">
                                <input type="hidden" name="policyIdDel" id="policyIdDel">
                                <hr />
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <input class="btn btn-primary" type="submit" value="Delete">
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; JKT Myanmar International 2021</span>
                    </div>
                </div>
            </footer>
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
                    <a class="btn btn-primary" href="auth/logoutBackend.php">Logout</a>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/style.js"></script>
    <script>
        $(document).ready(function() {
            $("#dataTable").DataTable({
                "order": [
                    [4, 'desc']
                ],
                // dom: 'fBlrtpi',
                dom: "<'row' <'col-sm-12 col-md-2'l> <'col-md-8 col-sm-12 text-center'B> <'col-sm-12 col-md-2'f> >" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                // dom : '<"mybg"fB><"bottom"lrtpi>',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        titleAttr: 'Copy',
                        exportOptions: {
                            modifier: {
                                // DataTables core
                                order: 'index', // 'current', 'applied',
                                //'index', 'original'
                                page: 'all', // 'all', 'current'
                                search: 'none' // 'none', 'applied', 'removed'
                            },
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        exportOptions: {
                            modifier: {
                                // DataTables core
                                order: 'index', // 'current', 'applied',
                                //'index', 'original'
                                page: 'all', // 'all', 'current'
                                search: 'none' // 'none', 'applied', 'removed'
                            },
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    // {
                    //     extend: 'csvHtml5',
                    //     text: '<i class="fa fa-file-text-o"></i>',
                    //     titleAttr: 'CSV',
                    //     exportOptions: {
                    //         modifier: {
                    //             // DataTables core
                    //             order: 'index', // 'current', 'applied',
                    //             //'index', 'original'
                    //             page: 'all', // 'all', 'current'
                    //             search: 'none' // 'none', 'applied', 'removed'
                    //         },
                    //         columns: [0, 1, 2, 3]
                    //     }
                    // },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',
                        exportOptions: {
                            modifier: {
                                // DataTables core
                                order: 'index', // 'current', 'applied',
                                //'index', 'original'
                                page: 'all', // 'all', 'current'
                                search: 'none' // 'none', 'applied', 'removed'
                            },
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        exportOptions: {
                            modifier: {
                                // DataTables core
                                order: 'index', // 'current', 'applied',
                                //'index', 'original'
                                page: 'all', // 'all', 'current'
                                search: 'none' // 'none', 'applied', 'removed'
                            },
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                ]
            });
        });
    </script>

    <!-- for excel print -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
</body>

</html>