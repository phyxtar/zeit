<?php
$page_no = "2";
$page_no_inside = "2_1";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Admin</title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
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
                            <h1>Admin List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Admin</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-sm-right">
                                    <button type="button" class="btn btn-success"
                                        onclick="document.getElementById('add_admin').style.display='block'">Add
                                        Admin</button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive" id="data_table">

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
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
    <div id="add_admin" class="w3-modal" style="z-index:2020;">
        <div class="w3-modal-content w3-animate-top w3-card-4" style="width:60%">
            <header class="w3-container" style="background:#343a40; color:white;">
                <span onclick="document.getElementById('add_admin').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                <h2 align="center">Add Admin</h2>
            </header>
            <form id="add_admin_form" role="form" method="POST" enctype="multipart/form-data">


                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="error_section"></div>
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="admin_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Username</label>
                            <input type="text" name="admin_username" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="admin_password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email Id</label>
                            <input type="text" name="admin_email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Mobile</label>
                            <input type="hidden" name="admin_type" value="subadmin" class="form-control" required>
                            <input type="text" name="admin_mobile" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Admin Type</label>
                            <select name="admin_type" id="admin_type" class="form-control text-capitalize"
                                onchange="toggleCourseField()">
                                <option selected disabled> - Select Admin Type - </option>
                                <option value="superadmin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="subadmin">Sub Admin</option>
                                <option value="hod">HOD</option>
                                <option value="library">Library</option>
                                <option value="it_lab">IT Lab</option>
                                <option value="dept_lab">Dept. Lab</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="course_field" style="display:none;">
                            <label>Course</label>
                            <select class="form-control" name="hod_permission[]" multiple>
                                <option selected disabled>Select Course</option>
                                <?php
                                $sql = "SELECT * FROM `tbl_course`";
                                $result = $con->query($sql);
                                while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?php echo $row["course_id"]; ?>"><?php echo $row["course_name"]; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <script>
                        function toggleCourseField() {
                            var adminType = document.getElementById('admin_type').value;
                            var courseField = document.getElementById('course_field');
                            if (adminType === 'hod') {
                                courseField.style.display = 'block';
                            } else {
                                courseField.style.display = 'none';
                            }
                        }
                        </script>
                        </script>
                    </div>
                    <br />
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Select Permissions</h3>
                        </div>
                        <div class="card-body">
                            <!-- Minimal style -->
                            <div class="row">

                                <!-- Administation -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Administation</h3>
                                            </div>
                                            <div class="card-body">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_1"
                                                                    name="permission_2[]" value="2_1">
                                                                <label for="checkboxPrimary13_1">View Admin List
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_4"
                                                                    name="permission_2[]" value="2_4">
                                                                <label for="checkboxPrimary13_4">Edit Admin List
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_5"
                                                                    name="permission_2[]" value="2_5">
                                                                <label for="checkboxPrimary13_5">Delete Admin List
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_2"
                                                                    name="permission_2[]" value="2_2">
                                                                <label for="checkboxPrimary13_2">View Leave
                                                                    Applications</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_3"
                                                                    name="permission_2[]" value="2_6">
                                                                <label for="checkboxPrimary13_3">Leave Approval</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_4"
                                                                    name="permission_2[]" value="2_7">
                                                                <label for="checkboxPrimary13_4">Delete Leave
                                                                    Applications</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_5"
                                                                    name="permission_2[]" value="2_8">
                                                                <label for="checkboxPrimary13_5">Leave Rejection</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_3"
                                                                    name="permission_2[]" value="2_3">
                                                                <label for="checkboxPrimary13_3">View Loan
                                                                    Applications</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_3"
                                                                    name="permission_2[]" value="2_9">
                                                                <label for="checkboxPrimary13_3">Loan Approval</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_3"
                                                                    name="permission_2[]" value="2_10">
                                                                <label for="checkboxPrimary13_3">Delete Loan
                                                                    Applications</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary13_3"
                                                                    name="permission_2[]" value="2_11">
                                                                <label for="checkboxPrimary13_3">Loan Rejection</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SetUp -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">SetUp</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary1_1"
                                                                    name="permission_3[]" value="3_1">
                                                                <label for="checkboxPrimary1_1">University Details
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary1_2"
                                                                    name="permission_3[]" value="3_2">
                                                                <label for="checkboxPrimary1_2">View Courses </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary1_3"
                                                                    name="permission_3[]" value="3_6">
                                                                <label for="checkboxPrimary1_3">Edit Courses</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary1_4"
                                                                    name="permission_3[]" value="3_4">
                                                                <label for="checkboxPrimary1_4">Delete Courses</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary1_5"
                                                                    name="permission_3[]" value="3_5">
                                                                <label for="checkboxPrimary1_5">Active Courses</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary1_6"
                                                                    name="permission_3[]" value="3_3">
                                                                <label for="checkboxPrimary1_6">Mandatory
                                                                    Documents</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary1_7"
                                                                    name="permission_3[]" value="3_7">
                                                                <label for="checkboxPrimary1_7">Edit Mandatory
                                                                    Documents</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary1_8"
                                                                    name="permission_3[]" value="3_8">
                                                                <label for="checkboxPrimary1_8">Delete Mandatory
                                                                    Documents</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Front Office -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Front Office</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary2_1"
                                                                    name="permission_4[]" value="4_1">
                                                                <label for="checkboxPrimary2_1">View Prospectus </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary2_2"
                                                                    name="permission_4[]" value="4_2">
                                                                <label for="checkboxPrimary2_2">Add Prospectus </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary2_3"
                                                                    name="permission_4[]" value="4_3">
                                                                <label for="checkboxPrimary2_3">Edit Prospectus </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary2_4"
                                                                    name="permission_4[]" value="4_4">
                                                                <label for="checkboxPrimary2_4">Delete Prospectus
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Admission -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Admission</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary3_1"
                                                                    name="permission_5[]" value="5_1">
                                                                <label for="checkboxPrimary3_1">Admission Form
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Student -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Student</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary4_1"
                                                                    name="permission_6[]" value="6_4">
                                                                <label for="checkboxPrimary4_1">Student List
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary4_1"
                                                                    name="permission_6[]" value="6_8">
                                                                <label for="checkboxPrimary4_1">Innactive All
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary4_1"
                                                                    name="permission_6[]" value="6_9">
                                                                <label for="checkboxPrimary4_1">Completed Button
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary4_3"
                                                                    name="permission_6[]" value="6_7">
                                                                <label for="checkboxPrimary4_3">Student List Yearwise
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" style="display:none;">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary4_2"
                                                                    name="permission_6[]" value="6_5">
                                                                <label for="checkboxPrimary4_2">Student Edit
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6" style="display:none;">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary4_2"
                                                                    name="permission_6[]" value="6_22">
                                                                <label for="checkboxPrimary4_2">Registered Students
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fee Payment -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Fee Payment</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_1"
                                                                    name="permission_7[]" value="7_1">
                                                                <label for="checkboxPrimary5_1">Add Fees</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_2"
                                                                    name="permission_7[]" value="7_4">
                                                                <label for="checkboxPrimary5_2">Fee Details </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_7"
                                                                    name="permission_7[]" value="7_2">
                                                                <label for="checkboxPrimary5_7">Edit Fees </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_8"
                                                                    name="permission_7[]" value="7_3">
                                                                <label for="checkboxPrimary5_8">Delete Fees</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_3"
                                                                    name="permission_7[]" value="7_7">
                                                                <label for="checkboxPrimary5_3">Pay Fee</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_14"
                                                                    name="permission_7[]" value="7_14">
                                                                <label for="checkboxPrimary5_14">Paid Info
                                                                    Refund</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_15"
                                                                    name="permission_7[]" value="7_15">
                                                                <label for="checkboxPrimary5_15">Paid Info
                                                                    Delete</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_4"
                                                                    name="permission_7[]" value="7_8">
                                                                <label for="checkboxPrimary5_4">Print
                                                                    Receipt</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_13"
                                                                    name="permission_7[]" value="7_12">
                                                                <label for="checkboxPrimary5_13">Delete
                                                                    Receipt</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_11"
                                                                    name="permission_7[]" value="7_13">
                                                                <label for="checkboxPrimary5_11">Print</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_5"
                                                                    name="permission_7[]" value="7_9">
                                                                <label for="checkboxPrimary5_5">Dues / No Dues
                                                                    list</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_12"
                                                                    name="permission_7[]" value="7_11">
                                                                <label for="checkboxPrimary5_12">Course & Year Wise
                                                                    Fee
                                                                    Report </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_6"
                                                                    name="permission_7[]" value="7_10">
                                                                <label for="checkboxPrimary5_6">Datewise Fee Report
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_9"
                                                                    name="permission_7[]" value="7_5">
                                                                <label for="checkboxPrimary5_9">Hostel Fee List
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary5_10"
                                                                    name="permission_7[]" value="7_6">
                                                                <label for="checkboxPrimary5_10">Student Fee Card
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Income/Expense -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Income / Expenses</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary6_1"
                                                                    name="permission_8[]" value="8_1">
                                                                <label for="checkboxPrimary6_1">Extra Income
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary6_5"
                                                                    name="permission_8[]" value="8_5">
                                                                <label for="checkboxPrimary6_5">Extra Income
                                                                    Edit</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary6_6"
                                                                    name="permission_8[]" value="8_6">
                                                                <label for="checkboxPrimary6_6">Extra Income
                                                                    Delete</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary6_2"
                                                                    name="permission_8[]" value="8_2">
                                                                <label for="checkboxPrimary6_2">Income </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary6_3"
                                                                    name="permission_8[]" value="8_3">
                                                                <label for="checkboxPrimary6_3">Expenses </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary6_7"
                                                                    name="permission_8[]" value="8_7">
                                                                <label for="checkboxPrimary6_7">Expenses
                                                                    Edit</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary6_8"
                                                                    name="permission_8[]" value="8_8">
                                                                <label for="checkboxPrimary6_8">Expenses
                                                                    Delete</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary6_4"
                                                                    name="permission_8[]" value="8_4">
                                                                <label for="checkboxPrimary6_4">Balance Sheet
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nsuniv Informations -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Nsuniv Informations</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <!--  <div class="col-sm-6">-->
                                                    <!-- checkbox -->
                                                    <!--  <div class="form-group clearfix">-->
                                                    <!--    <div class="icheck-danger d-inline">-->
                                                    <!--      <input type="checkbox" id="checkboxPrimary7_all" name="permission_9[]" value="">-->
                                                    <!--      <label for="checkboxPrimary7_all">All </label>-->
                                                    <!--    </div>-->
                                                    <!--  </div>-->
                                                    <!--</div>-->
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary7_1"
                                                                    name="permission_9[]" value="9_4">
                                                                <label for="checkboxPrimary7_1">Get Started Enquiry
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary7_6"
                                                                    name="permission_9[]" value="9_1">
                                                                <label for="checkboxPrimary7_6">Get Started Enquiry
                                                                    Delete </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary7_2"
                                                                    name="permission_9[]" value="9_2">
                                                                <label for="checkboxPrimary7_2">Prospectus Enquiry
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary7_7"
                                                                    name="permission_9[]" value="9_7">
                                                                <label for="checkboxPrimary7_7">Prospectus Enquiry
                                                                    Delete </label>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary7_3"
                                                                    name="permission_9[]" value="9_3">
                                                                <label for="checkboxPrimary7_3">Admission Enquiry
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary7_4"
                                                                    name="permission_9[]" value="9_5">
                                                                <label for="checkboxPrimary7_4">Notifications
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary7_5"
                                                                    name="permission_9[]" value="9_6">
                                                                <label for="checkboxPrimary7_5">Files </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Students And Examination -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Students And Examination</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_1"
                                                                    name="permission_11[]" value="11_12">
                                                                <label for="checkboxPrimary8_1">Character Certificate
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_1"
                                                                    name="permission_11[]" value="11_15">
                                                                <label for="checkboxPrimary8_1">Placement Form
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_1"
                                                                    name="permission_11[]" value="11_14">
                                                                <label for="checkboxPrimary8_1">Placement Applied Std
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_1"
                                                                    name="permission_11[]" value="11_1">
                                                                <label for="checkboxPrimary8_1">Add Semester
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_9"
                                                                    name="permission_11[]" value="11_13">
                                                                <label for="checkboxPrimary8_9">Add Specialization
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_2"
                                                                    name="permission_11[]" value="11_2">
                                                                <label for="checkboxPrimary8_2">Export Student
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_8"
                                                                    name="permission_11[]" value="11_8">
                                                                <label for="checkboxPrimary8_8">Import Student
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_3"
                                                                    name="permission_11[]" value="11_3">
                                                                <label for="checkboxPrimary8_3">Allocate Semester Before
                                                                    2024
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_3"
                                                                    name="permission_11[]" value="11_10">
                                                                <label for="checkboxPrimary8_3">Allocate Semester After
                                                                    2024
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_4"
                                                                    name="permission_11[]" value="11_4">
                                                                <label for="checkboxPrimary8_4">Add Subject </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_5"
                                                                    name="permission_11[]" value="11_5">
                                                                <label for="checkboxPrimary8_5">Add Marks </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_5"
                                                                    name="permission_11[]" value="11_13">
                                                                <label for="checkboxPrimary8_5">Add Marks Button</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_6"
                                                                    name="permission_11[]" value="11_6">
                                                                <label for="checkboxPrimary8_6">Create Report
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_7"
                                                                    name="permission_11[]" value="11_7">
                                                                <label for="checkboxPrimary8_7">Create Full Report
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-sm-6">

                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_7"
                                                                    name="permission_11[]" value="11_8">
                                                                <label for="checkboxPrimary8_7">Provisional Certificate
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">

                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_7"
                                                                    name="permission_11[]" value="11_9">
                                                                <label for="checkboxPrimary8_7">Migration Certificate
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_7"
                                                                    name="permission_11[]" value="11_10">
                                                                <label for="checkboxPrimary8_7">Upload Sign
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_7"
                                                                    name="permission_11[]" value="11_11">
                                                                <label for="checkboxPrimary8_8">Backlogs Management
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_7"
                                                                    name="permission_11[]" value="11_23">
                                                                <label for="checkboxPrimary8_7">Add Registration
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_7"
                                                                    name="permission_11[]" value="11_22">
                                                                <label for="checkboxPrimary8_7">Registered Student
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_30"
                                                                    name="permission_11[]" value="11_30">
                                                                <label for="checkboxPrimary8_7">Migration Form
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_31"
                                                                    name="permission_11[]" value="11_31">
                                                                <label for="checkboxPrimary8_7">Migration Form
                                                                    Applications
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary8_12"
                                                                    name="permission_11[]" value="11_12">
                                                                <label for="checkboxPrimary8_7">Provisional Form
                                                                    Applications
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Examination -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Examination</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary9_1"
                                                                    name="permission_12[]" value="12_1">
                                                                <label for="checkboxPrimary9_1">Exam Form </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary9_2"
                                                                    name="permission_12[]" value="12_2">
                                                                <label for="checkboxPrimary9_2">Student List(No
                                                                    Dues)
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary9_2"
                                                                    name="permission_12[]" value="12_6">
                                                                <label for="checkboxPrimary9_2">Attendance
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Complaints From Student -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Complaints From Student</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary10_1"
                                                                    name="permission_13[]" value="13_1">
                                                                <label for="checkboxPrimary10_1">View
                                                                    Complaints</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Admit Card -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Admit Card</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary11_11"
                                                                    name="permission_14[]" value="14_1">
                                                                <label for="checkboxPrimary11_11">Admit Card
                                                                    Approval</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Time Table -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Time Table</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary11_1"
                                                                    name="permission_15[]" value="15_1">
                                                                <label for="checkboxPrimary11_1">View Time
                                                                    Table</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hostel Management -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Hostel Management</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary14_0"
                                                                    name="permission_17[]" value="17_0">
                                                                <label for="checkboxPrimary14_0">Hotel Join Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary14_1"
                                                                    name="permission_17[]" value="17_0">
                                                                <label for="checkboxPrimary14_1">Hostel Join Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary14_2"
                                                                    name="permission_17[]" value="17_1">
                                                                <label for="checkboxPrimary14_2">Building Management
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary14_3"
                                                                    name="permission_17[]" value="17_2">
                                                                <label for="checkboxPrimary14_3">Room </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary14_4"
                                                                    name="permission_17[]" value="17_3">
                                                                <label for="checkboxPrimary14_4">Bed </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary14_5"
                                                                    name="permission_17[]" value="17_4">
                                                                <label for="checkboxPrimary14_5">Room Allotment
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary17_5"
                                                                    name="permission_17[]" value="17_5">
                                                                <label for="checkboxPrimary17_5">Gender-wise
                                                                    Hostellers
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary17_22"
                                                                    name="permission_17[]" value="17_22">
                                                                <label for="checkboxPrimary17_22">Hostel Dashboard
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary17_33"
                                                                    name="permission_17[]" value="17_33">
                                                                <label for="checkboxPrimary17_33">Hostel Dues/No
                                                                    Dues
                                                                    List
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary17_34"
                                                                    name="permission_17[]" value="17_34">
                                                                <label for="checkboxPrimary17_33">Hostel Full Report
                                                                    List
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary17_35"
                                                                    name="permission_17[]" value="17_35">
                                                                <label for="checkboxPrimary17_35">Hostel Alloted/Not
                                                                    Alloted List
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary17_36"
                                                                    name="permission_17[]" value="17_36">
                                                                <label for="checkboxPrimary17_36">Room Availablity
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payroll System -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">Payroll</h3>
                                            </div>
                                            <div class="card-body pl-3 pr-3">
                                                <!-- Minimal style -->
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_1"
                                                                    name="permission_16[]" value="16_1">
                                                                <label for="checkboxPrimary12_1">Employee Type
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_2"
                                                                    name="permission_16[]" value="16_2">
                                                                <label for="checkboxPrimary12_2">Employee Management
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_3"
                                                                    name="permission_16[]" value="16_3">
                                                                <label for="checkboxPrimary12_3">Holiday List</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_4"
                                                                    name="permission_16[]" value="16_4">
                                                                <label for="checkboxPrimary12_4">Apply For Leave</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_5"
                                                                    name="permission_16[]" value="16_5">
                                                                <label for="checkboxPrimary12_5">Employee Attendence
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_6"
                                                                    name="permission_16[]" value="16_6">
                                                                <label for="checkboxPrimary12_6">Attendence Report
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_7"
                                                                    name="permission_16[]" value="16_7">
                                                                <label for="checkboxPrimary12_7">Apply For Loan
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_8"
                                                                    name="permission_16[]" value="16_8">
                                                                <label for="checkboxPrimary12_8">Pay Slip
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_9"
                                                                    name="permission_16[]" value="16_9">
                                                                <label for="checkboxPrimary12_9">Leave Report
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary12_10"
                                                                    name="permission_16[]" value="16_10">
                                                                <label for="checkboxPrimary12_10">Salary Reports
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- AMS -->
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title">AMS</h3>
                                            </div>
                                            <div class="card-body pl-5 pr-5">
                                                <!-- Minimal style -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary18_1"
                                                                    name="permission_18[]" value="18_2">
                                                                <label for="checkboxPrimary18_1">AMS Students
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary18_2"
                                                                    name="permission_18[]" value="18_5">
                                                                <label for="checkboxPrimary18_2">AMS Teachers</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary18_3"
                                                                    name="permission_18[]" value="18_3">
                                                                <label for="checkboxPrimary18_3">AMS Grade</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-warning d-inline">
                                                                <input type="checkbox" id="checkboxPrimary18_4"
                                                                    name="permission_18[]" value="18_4">
                                                                <label for="checkboxPrimary18_4">Manage
                                                                    Attendance</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <br />
                    <input type='hidden' name='action' value='add_admin' />
                    <div class="col-md-12" id="loader_section"></div>
                    <button type="button" id="add_admin_button" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
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
    <script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
    </script>
    <script>
    $(function() {

        $('#add_admin_button').click(function() {
            $('#loader_section').append(
                '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
            );
            $('#add_admin_button').prop('disabled', true);
            $.ajax({
                url: 'include/controller.php',
                type: 'POST',
                data: $('#add_admin_form').serializeArray(),
                success: function(result) {
                    $('#response').remove();
                    $('#add_admin_form')[0].reset();
                    $('#error_section').append('<div id = "response">' + result + '</div>');
                    $('#loading').fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#add_admin_button').prop('disabled', false);
                }

            });
            $.ajax({
                url: 'include/view.php?action=get_admin',
                type: 'GET',
                success: function(result) {
                    $("#data_table").html(result);
                }
            });

        });

    });
    </script>
    <script>
    $(document).ready(function() {
        $.ajax({
            url: '<?= url('pages/admin/view?action=get_admin') ?>',
            type: 'GET',
            success: function(result) {
                $("#data_table").html(result);
            }
        });

    });
    </script>
</body>

</html>