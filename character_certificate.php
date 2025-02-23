<?php 
    $page_no = "11";
    $page_no_inside = "11_12";
    include_once "include/authentication.php"; 
	$visible = md5("visible");
	date_default_timezone_set("Asia/Calcutta");
    $date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Character Certificate Application </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Character Certificate Application</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Character Certificate Application</li>
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
                            <form role="form" method="POST" id="fetchStudentDataForm">
                                <div class="card-body" style="margin-top: 0px;">
                                    <table id="provisionalFormTable"
                                        class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Student Name</th>
                                                <th>Course</th>
                                                <th>Regn No</th>
                                                <th>Roll No</th>
                                                <th>Session</th>
                                                <th>Status</th>
                                                <th>Print</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $s_no = 1;
                                        $sql = "SELECT * FROM `tbl_character`";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $course_id = $row["course_id"];
                                                $sql_course = "SELECT * FROM `tbl_course` WHERE `status` = '$visible' AND `course_id` = '$course_id'";
                                                $result_course = $conn->query($sql_course);
                                                $row_course = $result_course->fetch_assoc();
                                        ?>
                                            <tr class="text-center">
                                                <td><?php echo $s_no; ?></td>
                                                <?php
                                                 $student_id = $row["student_id"];
                                                    $sql_admission = "SELECT admission_first_name, admission_middle_name, admission_last_name FROM `tbl_admission` WHERE `admission_id` = '$student_id'";
                                                    $result_admission = $conn->query($sql_admission);
                                                    $row_admission = $result_admission->fetch_assoc();
                                                ?>
                                                <td><?php echo $row_admission["admission_first_name"] . " " . $row_admission["admission_middle_name"] . " " . $row_admission["admission_last_name"]; ?>
                                                </td>
                                                <td><?php echo $row_course["course_name"]; ?></td>
                                                <?php
                                                    $sql_allot_semester = "SELECT * FROM `tbl_allot_semester` WHERE `admission_id` = '$student_id'";
                                                    $result_allot_semester = $conn->query($sql_allot_semester);
                                                    $row_allot_semester = $result_allot_semester->fetch_assoc();
                                                ?>
                                                <td><?php echo $row_allot_semester["reg_no"]; ?></td>
                                                <td><?php echo $row_allot_semester["roll_no"]; ?></td>
                                                <td><?php echo $row["session"]; ?></td>
                                                <td>
                                                    <button type="button"
                                                        class="status-btn btn btn-sm <?php echo ($row['status'] === 'Approved') ? 'btn-success' : 'btn-warning'; ?>"
                                                        data-id="<?php echo $row['student_id']; ?>">
                                                        <?php echo $row["status"]; ?>
                                                    </button></button>
                                                </td>
                                                <td>

                                                    <a class='btn btn-sm btn-success' href="print_character.php?student_id=<?php echo $student_id; ?>
                                                        target=" _blank">
                                                        <i class="fas fa-print "></i>
                                                    </a>

                                                </td>

                                            </tr>
                                            <?php
                                                $s_no++;
                                            }
                                        } else {
                                            echo '<tr><td colspan="8" class="text-center">No data available now!!!</td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <script>
                                    $(document).ready(function() {
                                        // Initialize the DataTable
                                        var table = $('#provisionalFormTable').DataTable({
                                            "paging": true,
                                            "lengthChange": false,
                                            "searching": true,
                                            "ordering": true,
                                            "info": true,
                                            "autoWidth": false,
                                        });

                                        $('#provisionalFormTable').on('click', '.status-btn', function() {
                                            var button = $(this);
                                            var student_id = button.data('id');
                                            $.ajax({
                                                url: 'update_status1.php', // The URL of the PHP script that will update the status
                                                type: 'POST',
                                                data: {
                                                    student_id: student_id
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    if (response.new_status) {
                                                        // Update the button text based on the new status
                                                        button.text(response.new_status);

                                                        // Update the cell content in the DataTable
                                                        var row = table.row(button.parents(
                                                            'tr'));
                                                        var cellIndex = table.cell(button
                                                                .parents('td')).index()
                                                            .column; // Get cell index
                                                        table.cell(row, cellIndex).data(
                                                            response.new_status).draw(
                                                            false);
                                                    } else {
                                                        alert(response.error);
                                                    }
                                                }
                                            });
                                        });


                                    });
                                    </script>
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

        <?php include_once 'include/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page script -->
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



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
</body>

</html>