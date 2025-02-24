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
    <title>ZEIT | Admin</title>
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
            <div class="ibox-content">
                            <!-- Summary Stats -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="widget style1 rounded shadow-sm" style="background-color: #1ab394;">
                                        <div class="row align-items-center p-3">
                                            <div class="col-4">
                                                <i class="fa fa-users fa-3x text-white"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span class="text-white-50">Total Users</span>
                                                <h2 class="font-bold text-white mb-0">
                                                    <?php
                                                    $sql = "SELECT COUNT(*) as total FROM tbl_admin";
                                                    $result = $con->query($sql);
                                                    $row = $result->fetch_assoc();
                                                    echo $row['total'];
                                                    ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1 rounded shadow-sm" style="background-color: #23c6c8;">
                                        <div class="row align-items-center p-3">
                                            <div class="col-4">
                                                <i class="fa fa-user-circle fa-3x text-white"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span class="text-white-50">Active Users</span>
                                                <h2 class="font-bold text-white mb-0">
                                                    <?php
                                                    $sql = "SELECT COUNT(*) as active FROM tbl_admin WHERE status = '46cf0e59759c9b7f1112ca4b174343ef'";
                                                    $result = $con->query($sql);
                                                    $row = $result->fetch_assoc();
                                                    echo $row['active'];
                                                    ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1 rounded shadow-sm" style="background-color: #f8ac59;">
                                        <div class="row align-items-center p-3">
                                            <div class="col-4">
                                                <i class="fa fa-user-times fa-3x text-white"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span class="text-white-50">Inactive Users</span>
                                                <h2 class="font-bold text-white mb-0">
                                                    <?php
                                                    $sql = "SELECT COUNT(*) as inactive FROM tbl_admin WHERE status != '46cf0e59759c9b7f1112ca4b174343ef'";
                                                    $result = $con->query($sql);
                                                    $row = $result->fetch_assoc();
                                                    echo $row['inactive'];
                                                    ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1 rounded shadow-sm" style="background-color: #FF0004;">
                                        <div class="row align-items-center p-3">
                                            <div class="col-4">
                                                <i class="fa fa-user-secret fa-3x text-white"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span class="text-white-50">Admin Users</span>
                                                <h2 class="font-bold text-white mb-0">
                                                    <?php
                                                    $sql = "SELECT COUNT(*) as admin FROM tbl_admin WHERE admin_type = 'superadmin'";
                                                    $result = $con->query($sql);
                                                    $row = $result->fetch_assoc();
                                                    echo $row['admin'];
                                                    ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-sm-right">
                                    <button style="background-color: #FF0004 !important; color:white;" type="button" class="btn btn-sm"
                                        onclick="document.getElementById('add_admin').style.display='block'"><i class="fas fa-plus"></i> Add
                                        New User</button>
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
                <h2 align="center">Add User</h2>
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
                    onchange="generateUserId()">
                    <option selected disabled> - Select User Type - </option>
                    <option value="superadmin">Super Admin</option>
                    <option value="employee">Employee</option>
                    <option value="customer">Customer</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>User ID</label>
                <input type="text" id="user_id" name="user_id" class="form-control" required readonly>
            </div>
            <div class="col-md-6">
                <label>Department</label>
                <input type="text" name="department" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Joining Date</label>
                <input type="date" name="join_date" class="form-control" required>
            </div>
        </div>
        <br />
        <input type='hidden' name='action' value='add_admin' />
        <div class="col-md-12" id="loader_section"></div>
        <button type="button" id="add_admin_button" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>

<script>
function generateUserId() {
    var adminType = document.getElementById('admin_type').value;
    var userIdField = document.getElementById('user_id');

    var prefix = "";
    if (adminType === "superadmin") {
        prefix = "ADM";
    } else if (adminType === "employee") {
        prefix = "EMP";
    } else if (adminType === "customer") {
        prefix = "CUST";
    }

    if (prefix) {
        var randomNumber = Math.floor(100 + Math.random() * 900); // Generates a 3-digit random number
        userIdField.value = prefix + randomNumber;
    } else {
        userIdField.value = "";
    }
}
</script>

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