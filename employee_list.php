<?php
$page_no = "3";
$page_no_inside = "3_1";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZEIT | Employee</title>
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
                            <h1>Employee List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Employee List</li>
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
                            <h3 class="card-title">Manage Employees</h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm dropdown-toggle" style="background-color: #ff0004; color:white" data-toggle="dropdown">
                                            Export <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#"><i class="fas fa-file-excel"></i> Excel</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-file-pdf"></i> PDF</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-file-csv"></i> CSV</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Summary Stats -->
                            <?php
                            // Get employee counts
                            $total_sql = "SELECT COUNT(*) as total FROM tbl_employee";
                            $fulltime_sql = "SELECT COUNT(*) as count FROM tbl_employee WHERE employment_type='Full-Time'";
                            $parttime_sql = "SELECT COUNT(*) as count FROM tbl_employee WHERE employment_type='Part-Time'";
                            $onleave_sql = "SELECT COUNT(*) as count FROM tbl_employee WHERE status='On Leave'";

                            $total_result = $conn->query($total_sql);
                            $fulltime_result = $conn->query($fulltime_sql);
                            $parttime_result = $conn->query($parttime_sql);
                            $onleave_result = $conn->query($onleave_sql);

                            $total = $total_result->fetch_assoc()['total'];
                            $fulltime = $fulltime_result->fetch_assoc()['count'];
                            $parttime = $parttime_result->fetch_assoc()['count'];
                            $onleave = $onleave_result->fetch_assoc()['count'];
                            ?>
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3><?php echo $total; ?></h3>
                                            <p>Total Employees</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3><?php echo $fulltime; ?></h3>
                                            <p>Full-Time</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3><?php echo $parttime; ?></h3>
                                            <p>Part-Time</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-user-clock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="small-box" style="background-color: #ff0004; color:white">
                                        <div class="inner">
                                            <h3><?php echo $onleave; ?></h3>
                                            <p>On Leave</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-user-minus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filters -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" id="department-filter">
                                            <option value="">All Departments</option>
                                            <?php
                                            $dept_sql = "SELECT DISTINCT department FROM tbl_employee ORDER BY department";
                                            $dept_result = $conn->query($dept_sql);
                                            while($dept = $dept_result->fetch_assoc()) {
                                                echo "<option value='".$dept['department']."'>".$dept['department']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" id="type-filter">
                                            <option value="">All Types</option>
                                            <option value="Full-Time">Full-Time</option>
                                            <option value="Part-Time">Part-Time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Internship">Internship</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="search" placeholder="Search employees...">
                                        <div class="input-group-append">
                                            <button class="btn" style="background-color: #ff0004; color:white" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Employee Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Join Date</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tbl_employee ORDER BY employee_id";
                                        $result = $conn->query($sql);

                                        while($row = $result->fetch_assoc()) {
                                            $type_class = ($row['employment_type'] == 'Full-Time') ? 'primary' : 'warning';
                                            $status_class = ($row['status'] == 'Active') ? 'success' : 
                                                          (($row['status'] == 'On Leave') ? 'danger' : 'secondary');
                                            
                                            echo "<tr>
                                                <td><input type='checkbox'></td>
                                                <td>".$row['employee_id']."</td>
                                                <td>".$row['name']."</td>
                                                <td>".$row['department']."</td>
                                                <td>".$row['position']."</td>
                                                <td>".date('Y-m-d', strtotime($row['join_date']))."</td>
                                                <td><span class='badge badge-".$type_class."'>".$row['employment_type']."</span></td>
                                                <td><span class='badge badge-".$status_class."'>".$row['status']."</span></td>
                                                <td>
                                                    <div class='btn-group'>
                                                        <button class='btn btn-info btn-sm' title='View'><i class='fas fa-eye'></i></button>
                                                        <button class='btn btn-warning btn-sm' title='Edit'><i class='fas fa-edit'></i></button>
                                                        <button class='btn btn-danger btn-sm' title='Delete'><i class='fas fa-trash'></i></button>
                                                    </div>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Add Employee Modal -->
                            <div class="modal fade" id="addEmployeeModal">
                                <!-- Modal content remains the same -->
                            </div>

                            <!-- Import Modal -->
                            <div class="modal fade" id="importEmployeesModal">
                                <!-- Modal content remains the same -->
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