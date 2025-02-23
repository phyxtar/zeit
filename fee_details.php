<?php
$page_no = "7";
$page_no_inside = "7_4";
include_once "include/authentication.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Fee Details </title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
                            <h1>Fee Details</h1>
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
                                <h3 class="card-title">Fee Details</h3>
                            </div>
                            <form method="POST" id="feeDetailsForm">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-4">
                                            <label>Academic Year</label>
                                            <select class="form-control" id="feeDetailsYear" name="data">
                                                <option value="select" selected>Select Academic Year</option>
                                                <?php
                        $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                       WHERE `status` = '$visible' ORDER BY `university_details_id` DESC;
                                       ";
                        $result_ac_year = $con->query($sql_ac_year);
                        while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                        ?>
                                                <option value="<?php echo $row_ac_year["university_details_id"]; ?>">
                                                    <?php echo explode('-', $row_ac_year["university_details_academic_start_date"])[0] . " - " . explode('-', $row_ac_year["university_details_academic_end_date"])[0]; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Course Name</label>
                                                <select onchange="change_semester(this.value)" class="form-control"
                                                    name="course_id">
                                                    <option selected disabled> - Select Course - </option>
                                                    <?php
                          $sql_course = "SELECT * FROM `tbl_course`
                                                                   WHERE `status` = '$visible' order by course_name asc;
                                                                   ";
                          $result_course = $con->query($sql_course);
                          while ($row_course = $result_course->fetch_assoc()) {
                          ?>
                                                    <option value="<?php echo $row_course["course_id"]; ?>">
                                                        <?php echo $row_course["course_name"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-1" style="margin-top: 29px;">
                                            <button type="submit" class="btn btn-primary">Go</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- /.card-header -->
                            <div class="card-body" id="data_table">

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
    function ajaxFeeDetails() {
        $.ajax({
            url: '<?= url('pages/fee/view?action=fetch_fees') ?>',
            type: 'POST',
            data: $('#feeDetailsForm').serializeArray(),
            success: function(result) {
                $('#response').remove();
                $('#data_table').append('<div id = "response">' + result + '</div>');
            }
        });
    }

    $(document).ready(function() {
        $('#feeDetailsYear').on('change', function(event) {
            ajaxFeeDetails();
            event.preventDefault();
        });
    });

    $(document).ready(function() {
        $('#feeDetailsForm').submit(function(event) {

            ajaxFeeDetails();
            event.preventDefault();
        });
    });
    </script>
</body>

</html>