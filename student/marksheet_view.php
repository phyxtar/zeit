<?php
$page_no = "30";
include "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Marksheet </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page script -->
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <style>
        table,
        th,
        td {
            border-collapse: collapse;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Marksheet</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Marksheet</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Marksheet</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-12" id="error_section"></div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Academic Year</label>
                                            <!-- <?php echo $_SESSION['user']["admission_course_name"]; ?> -->
                                            <select class="form-control" onchange="showdesg(this.value)" id="session_id"
                                                name="academic_year">
                                                <option value="0">Select Academic Year</option>
                                                <?php
                                                $course_duration_get = "SELECT * FROM `tbl_course` WHERE `course_id`='" . $_SESSION['user']["admission_course_name"] . "' ";
                                                $course_duration_get = $con->query($course_duration_get);
                                                $course_duration = mysqli_fetch_array($course_duration_get)['duration'];

                                                $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                                                       WHERE `status` = '$visible' ORDER BY `university_details_academic_end_date` DESC
                                                                                       ";
                                                $sql_ac_year1 = "SELECT * FROM `tbl_university_details`
                                                                                       WHERE `status` = '$visible' ORDER BY `university_details_academic_end_date` DESC
                                                                                       ";
                                                $result_ac_year = $con->query($sql_ac_year);
                                                $result_ac_year1 = $con->query($sql_ac_year1);
                                                $year = date('Y');
                                                if (mysqli_num_rows($course_duration_get) > 0) {
                                                    while ($row_ac_year = $result_ac_year->fetch_assoc()) {

                                                        $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                                        $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);

                                                        $total_year = $year - (int) $completeSessionStart[0];
                                                        $get_course_duration = $completeSessionEnd[0] - $completeSessionStart[0];
                                                        if ($get_course_duration == $course_duration) {
                                                            $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                                            ?>
                                                            <option value="<?php echo $row_ac_year["university_details_id"]; ?>">
                                                                <?php echo $completeSessionOnlyYear; ?>
                                                            </option>
                                                        <?php }
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select class="form-control" name="semester_id" id="sem"
                                                onchange="show(this.value)">
                                                <option value="-1">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="course_id" id="course_id"
                                        value="<?php echo $_SESSION['user']['admission_course_name']; ?>">
                                        <input type="hidden" name="admission_id" id="admission_id"
                                        value="<?php echo $_SESSION['user']['admission_id']; ?>">
                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" id="fetchStudentDataButton"
                                            class="btn btn-primary">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-12" id="loader_section"></div>
                        <!-- /.card-header -->
                        <div class="card-body" id="data_table">

                        </div>
                    </div>

                </div>

        </div>
        </section>
        <!-- /.content -->
    </div>

    <?php include 'include/footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>



    <script>
        $(document).ready(function () {
            $('#fetchStudentDataForm').submit(function (event) {
                $('#loader_section').append(
                    '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                );
                $('#fetchStudentDataButton').prop('disabled', true);
                $.ajax({
                    url: '../include/view.php?action=fetch_student_for_studentsite',
                    type: 'POST',
                    data: $('#fetchStudentDataForm').serializeArray(),
                    success: function (result) {
                        $('#response').remove();
                        if (result.trim() == 0) {
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                            );
                        } else {
                            $('#data_table').append('<div id = "response">' + result +
                                '</div>');
                        }
                        $('#loading').fadeOut(500, function () {
                            $(this).remove();
                        });
                        $('#fetchStudentDataButton').prop('disabled', false);
                    }
                });
                event.preventDefault();
            });
        });
    </script>
    <script>
        $(function () {
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
        function change_semester(semester) {
            $.ajax({
                url: 'include/ajax/add_semester.php',
                type: 'POST',
                data: {
                    'data': semester
                },
                success: function (result) {
                    document.getElementById('session_id').innerHTML = result;
                }

            });
        }

        function showdesg(session) {
            var dept = <?php echo $_SESSION['user']['admission_course_name'] ?>;
            $.ajax({
                url: '../ajaxdata.php',
                type: 'POST',
                data: {
                    'depart': dept,
                    'session': session
                },
                success: function (data) {
                    $("#sem").html(data);
                },
            });

        }
    </script>
</body>

</html>