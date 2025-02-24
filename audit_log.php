<?php
$page_no = "2";
$page_no_inside = "2_2";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZEIT | Audit Logs</title>
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
                            <h1>Audit Logs</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Audit Logs</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
          
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                        
                            <div class="ibox-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Export <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-file-text-o"></i> CSV</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <!-- Summary Stats -->
                            <div class="row mb-4">
                                <?php
                                // Get total logs count
                                $total_logs = $con->query("SELECT COUNT(*) as count FROM tbl_admin")->fetch_assoc()['count'];
                                
                                // Get unique users count
                                $unique_users = $con->query("SELECT COUNT(DISTINCT admin_username) as count FROM tbl_admin")->fetch_assoc()['count'];
                                
                                // Get failed actions count (assuming status field indicates success/failure)
                                $failed_actions = $con->query("SELECT COUNT(*) as count FROM tbl_admin WHERE status != '46cf0e59759c9b7f1112ca4b174343ef'")->fetch_assoc()['count'];
                                
                                // Get security events (assuming admin_type changes and password changes)
                                $security_events = $con->query("SELECT COUNT(*) as count FROM tbl_admin WHERE admin_type = 'superadmin'")->fetch_assoc()['count'];
                                ?>
                                <div class="col-md-3">
                                    <div class="widget style1" style="background-color: #1ab394; color: white; border-radius: 10px;">
                                        <div class="row p-3">
                                            <div class="col-4 d-flex align-items-center">
                                                <i class="fas fa-database fa-3x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span class="h5">Total Logs</span>
                                                <h2 class="font-weight-bold mb-0"><?php echo number_format($total_logs); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1" style="background-color: #23c6c8; color: white; border-radius: 10px;">
                                        <div class="row p-3">
                                            <div class="col-4 d-flex align-items-center">
                                                <i class="fas fa-users fa-3x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span class="h5">Unique Users</span>
                                                <h2 class="font-weight-bold mb-0"><?php echo number_format($unique_users); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1" style="background-color: #f8ac59; color: white; border-radius: 10px;">
                                        <div class="row p-3">
                                            <div class="col-4 d-flex align-items-center">
                                                <i class="fas fa-exclamation-triangle fa-3x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span class="h5">Failed Actions</span>
                                                <h2 class="font-weight-bold mb-0"><?php echo number_format($failed_actions); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1" style="background-color: #FF0004; border-radius: 10px; color: white;">
                                        <div class="row p-3">
                                            <div class="col-4 d-flex align-items-center">
                                                <i class="fas fa-shield-alt fa-3x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span class="h5">Security Events</span>
                                                <h2 class="font-weight-bold mb-0"><?php echo number_format($security_events); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-b-sm">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Event Type</label>
                                        <select class="form-control">
                                            <option>All Events</option>
                                            <option>Login</option>
                                            <option>Logout</option>
                                            <option>Create</option>
                                            <option>Update</option>
                                            <option>Delete</option>
                                            <option>Password Change</option>
                                            <option>Permission Change</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>User</label>
                                        <select class="form-control">
                                            <option>All Users</option>
                                            <?php
                                            $sql = "SELECT DISTINCT admin_type FROM tbl_admin";
                                            $result = $con->query($sql);
                                            while($row = $result->fetch_assoc()) {
                                                echo "<option>" . ucfirst($row['admin_type']) . " Users</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date Range</label>
                                        <div class="input-daterange input-group">
                                            <input type="date" class="form-control" name="start">
                                            <span class="input-group-addon">to</span>
                                            <input type="date" class="form-control" name="end">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button class="btn btn-block" style="background-color: #FF0004; color: white;">Search Logs</button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Timestamp</th>
                                            <th>Event Type</th>
                                            <th>User</th>
                                            <th>IP Address</th>
                                            <th>Module</th>
                                            <th>Action</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tbl_admin ORDER BY join_date DESC";
                                        $result = $con->query($sql);
                                        
                                        while($row = $result->fetch_assoc()) {
                                            $status_class = ($row['status'] == '46cf0e59759c9b7f1112ca4b174343ef') ? 'primary' : 'danger';
                                            $status_text = ($row['status'] == '46cf0e59759c9b7f1112ca4b174343ef') ? 'Success' : 'Failed';
                                            
                                            // Define event type colors
                                            $event_type_color = '';
                                            switch(strtolower($row['admin_type'])) {
                                                case 'login':
                                                    $event_type_color = '#23c6c8'; // Teal
                                                    break;
                                                case 'logout': 
                                                    $event_type_color = '#1ab394'; // Green
                                                    break;
                                                case 'create':
                                                    $event_type_color = '#1c84c6'; // Blue
                                                    break;
                                                case 'update':
                                                    $event_type_color = '#f8ac59'; // Orange
                                                    break;
                                                case 'delete':
                                                    $event_type_color = '#ed5565'; // Red
                                                    break;
                                                case 'superadmin':
                                                    $event_type_color = '#FF0004'; // Red
                                                    break;
                                                default:
                                                    $event_type_color = '#888888'; // Gray
                                            }
                                            
                                            echo "<tr>";
                                            echo "<td>" . $row['join_date'] . "</td>";
                                            echo "<td><span class='badge' style='background-color: " . $event_type_color . "; color: white;'>" . ucfirst($row['admin_type']) . "</span></td>";
                                            echo "<td>" . $row['admin_email'] . "</td>";
                                            echo "<td>" . $_SERVER['REMOTE_ADDR'] . "</td>";
                                            echo "<td>User Management</td>";
                                            echo "<td>User Activity</td>";
                                            echo "<td>" . $row['admin_name'] . " - " . $row['department'] . "</td>";
                                            echo "<td><span class='badge badge-" . $status_class . "'>" . $status_text . "</span></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#" style="color:gray">Previous</a></li>
                                            <li class="page-item active"><a class="page-link" href="#" style="background-color: #FF0004; border-color: #FF0004; color:white;">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#" style="color:gray">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#" style="color:gray">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" style="color:gray">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
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