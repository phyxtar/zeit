<?php
$page_no = "2";
$page_no_inside = "2_4";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZEIT | Subscription</title>
    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="img/fav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Subscription</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Subscription</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-credit-card mr-2"></i>
                                Manage Subscriptions
                            </h3>
                            <div class="card-tools">
                                <button class="btn btn-sm" style="background-color: #f90004; color: white;" data-toggle="modal" data-target="#addSubscriptionModal">
                                    <i class="fas fa-plus mr-1"></i> Add Subscription
                                </button>
                                <button class="btn btn-sm ml-2" style="background-color: #f90004; color: white;" data-toggle="modal" data-target="#createPlanModal">
                                    <i class="fas fa-list mr-1"></i> Create Plan
                                </button>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm" style="background-color: #f90004; color: white;" data-toggle="dropdown">
                                        <i class="fas fa-download mr-1"></i> Export
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="fas fa-file-excel mr-2"></i>Excel</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-file-pdf mr-2"></i>PDF</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-file-csv mr-2"></i>CSV</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Create Plan Modal -->
                        <div class="modal fade" id="createPlanModal" tabindex="-1" role="dialog" aria-labelledby="createPlanModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header text-white" style="background-color: #f90004;">
                                        <h5 class="modal-title" id="createPlanModalLabel">
                                            <i class="fas fa-list mr-2"></i>Create New Subscription Plan
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="insert_subscription.php" method="POST" class="px-4 py-2">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label><i class="fas fa-user mr-1"></i>Plan Name</label>
                                                <input type="text" class="form-control" name="subscriber" required>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-tag mr-1"></i>Plan Type</label>
                                                <select class="form-control" name="plan" required>
                                                    <option value="">Select Plan</option>
                                                    <option value="Basic">Basic</option>
                                                    <option value="Premium">Premium</option>
                                                    <option value="Enterprise">Enterprise</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><i class="fas fa-calendar-plus mr-1"></i>Start Date</label>
                                                        <input type="date" class="form-control" name="start_date" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><i class="fas fa-calendar-minus mr-1"></i>End Date</label>
                                                        <input type="date" class="form-control" name="end_date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-dollar-sign mr-1"></i>Amount</label>
                                                <input type="number" class="form-control" name="amount" step="0.01" required>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fas fa-info-circle mr-1"></i>Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="Active">Active</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Expired">Expired</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times mr-1"></i>Close
                                            </button>
                                            <button type="submit" class="btn text-white" style="background-color: #f90004;">
                                                <i class="fas fa-save mr-1"></i>Create Plan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Rest of the existing code remains the same -->
                            <!-- Summary Stats -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>856</h3>
                                            <p>Total Subscribers</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>$12,450</h3>
                                            <p>Monthly Revenue</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>28</h3>
                                            <p>Renewals Due</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-sync"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3>15</h3>
                                            <p>Expired</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filters -->
                            <div class="card card-outline card-primary mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><i class="fas fa-tag mr-1"></i>Plan Type</label>
                                                <select class="form-control">
                                                    <option>All Plans</option>
                                                    <option>Basic</option>
                                                    <option>Premium</option>
                                                    <option>Enterprise</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><i class="fas fa-info-circle mr-1"></i>Status</label>
                                                <select class="form-control">
                                                    <option>All Status</option>
                                                    <option>Active</option>
                                                    <option>Pending</option>
                                                    <option>Expired</option>
                                                    <option>Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><i class="fas fa-calendar mr-1"></i>Date Range</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="start">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">to</span>
                                                    </div>
                                                    <input type="date" class="form-control" name="end">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button class="btn btn-block" style="background-color: #f90004; color: white;">
                                                    <i class="fas fa-search mr-1"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Subscriber</th>
                                            <th>Plan</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Auto Renew</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Smith</td>
                                            <td><span class="badge badge-info">Premium</span></td>
                                            <td>2023-01-15</td>
                                            <td>2024-01-14</td>
                                            <td>$99/month</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td><i class="fas fa-check text-success"></i></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Cancel">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sarah Johnson</td>
                                            <td><span class="badge badge-secondary">Basic</span></td>
                                            <td>2023-03-20</td>
                                            <td>2024-03-19</td>
                                            <td>$29/month</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td><i class="fas fa-check text-success"></i></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Cancel">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Michael Brown</td>
                                            <td><span class="badge badge-dark">Enterprise</span></td>
                                            <td>2023-05-01</td>
                                            <td>2023-06-15</td>
                                            <td>$299/month</td>
                                            <td><span class="badge badge-danger">Expired</span></td>
                                            <td><i class="fas fa-times text-danger"></i></td>
                                            <td>
                                                <button class="btn btn-sm btn-success" title="Renew">
                                                    <i class="fas fa-sync"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-end mt-3">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#"><i class="fas fa-angle-left"></i></a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>

        <?php include_once 'include/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- Add admin Modal Start-->
    



        </div>
    </div>
    <!-- Add Admin Modal End -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    
</body>

</html>