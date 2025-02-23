<?php
$page_no = "11";
$page_no_inside = "11_5";
include 'include/config.php';
include_once "include/authentication.php";
include_once "framwork/main.php";
include_once "include/PHPExcel/PHPExcel.php";

$visible = md5("visible");

$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");


$logger_username = $_SESSION["logger_username"];
$sql_admin = "SELECT admin_type, hod_permission FROM tbl_admin WHERE admin_username = '$logger_username' AND `status` = '$visible'";
$result_admin = $con->query($sql_admin);
$admin_data = $result_admin->fetch_assoc();
$admin_type = $admin_data['admin_type'];
$hod_permission = $admin_data['hod_permission'];

// Adjust SQL query based on admin type
$sql_course = "SELECT * FROM `tbl_course` WHERE `status` = '$visible' ";
if ($admin_type == 'hod') {
    $hod_permission_array = json_decode($hod_permission, true);
    $hod_permission_list = implode(",", $hod_permission_array);
    $sql_course .= "AND `course_id` IN ($hod_permission_list) ";
}
$sql_course .= "ORDER BY `course_name`";
$result_course = $con->query($sql_course);
?>

<?php
// import code:
if (isset($_POST["import_marks"])) {

    $inputFileName = $_FILES['importExcelFile']['tmp_name'];

    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    for ($i = 5; $i <= $highestRow; $i++) {
        $data = $sheet->rangeToArray(
            'B' . $i . ':' . 'AC' . $i,
            NULL,
            TRUE,
            FALSE
        );
    }

    $flatData = [];
    foreach ($data as $dataArray) {
        foreach ($dataArray as $celldata) {
            $flatData[] = $celldata;
        }
    }

    //course name to course id
    $sql_course = "SELECT * FROM `tbl_course` WHERE `course_name`='$flatData[3]'";
    $result_course = $con->query($sql_course);
    $row_course = $result_course->fetch_assoc();
    $course_idi = $row_course["course_id"];

    //academic session to session id
    if ($flatData[4] == "2019-2021") {
        $session_idi = 1;
    } else if ($flatData[4] == "2019-2022") {
        $session_idi = 2;
    } else if ($flatData[4] == "2019-2023") {
        $session_idi = 3;
    } else if ($flatData[4] == "2019-2024") {
        $session_idi = 4;
    } else if ($flatData[4] == "2020-2022") {
        $session_idi = 5;
    } else if ($flatData[4] == "2020-2023") {
        $session_idi = 6;
    } else if ($flatData[4] == "2020-2024") {
        $session_idi = 7;
    } else if ($flatData[4] == "2020-2025") {
        $session_idi = 8;
    } else if ($flatData[4] == "2018-2020") {
        $session_idi = 9;
    } else if ($flatData[4] == "2018-2021") {
        $session_idi = 10;
    } else if ($flatData[4] == "2021-2023") {
        $session_idi = 11;
    } else if ($flatData[4] == "2021-2024") {
        $session_idi = 12;
    } else if ($flatData[4] == "2021-2025") {
        $session_idi = 13;
    } else if ($flatData[4] == "2021-2026") {
        $session_idi = 14;
    } else if ($flatData[4] == "2022-2024") {
        $session_idi = 15;
    } else if ($flatData[4] == "2022-2025") {
        $session_idi = 16;
    } else if ($flatData[4] == "2022-2026") {
        $session_idi = 17;
    } else if ($flatData[4] == "2022-2027") {
        $session_idi = 18;
    } else if ($flatData[4] == "2022-2028") {
        $session_idi = 19;
    } else if ($flatData[4] == "2023-2025") {
        $session_idi = 20;
    } else if ($flatData[4] == "2023-2026") {
        $session_idi = 21;
    } else if ($flatData[4] == "2023-2027") {
        $session_idi = 24;
    } else if ($flatData[4] == "2023-2028") {
        $session_idi = 25;
    } else if ($flatData[4] == "2024-2029") {
        $session_idi = 31;
    } else if ($flatData[4] == "2024-2028") {
        $session_idi = 32;
    } else if ($flatData[4] == "2024-2026") {
        $session_idi = 33;
    } else if ($flatData[4] == "2024-2027") {
        $session_idi = 34;
    }

    //  Loop through each row of the worksheet in turn
    for ($row = 5; $row <= $highestRow; $row++) {
        //  Read a row of data into an array
        $rowData = $sheet->rangeToArray(
            'AD' . $row . ':' . $highestColumn . $row,
            NULL,
            TRUE,
            FALSE
        );
        // Flatten the $rowData array to avoid nested arrays
        $flatRowData = [];
        foreach ($rowData as $rowArray) {
            foreach ($rowArray as $cell) {
                $flatRowData[] = $cell;
            }
        }

        // Chunk the flattened array into parts of 15 elements each
        $chunks = array_chunk($flatRowData, 15);

        for ($i = 0; $i < count($chunks); $i++) {
            $chunk = $chunks[$i];

            // Build the SQL query for the current chunk
            $sql = "INSERT INTO `tbl_marks` (`marks_id`,`course_id`,`semester_id`,`fee_academic_year`,`subject_id`, `reg_no`,`full_internal_marks`, `full_external_marks`, `full_practical_marks`, `internal_marks`, `external_marks`, `practical_marks`, `total_marks_obtained`, `grade`,`grade_points`,`credit_points`,`add_time`,`status`) 
                    VALUES (NULL,'$course_idi','$flatData[6]','$session_idi','$chunk[2]','$chunk[3]','$chunk[4]','$chunk[5]','$chunk[6]','$chunk[7]','$chunk[8]','$chunk[9]','$chunk[10]','$chunk[11]','$chunk[12]','$chunk[14]','$date_variable_today_month_year_with_timing','$visible')";

            // Execute the query
            $result = $con->multi_query($sql);
            if ($result) {
                echo "<script>
                            alert('Excel Imported Successfully!!!');
                            location.replace('add_marks');
                        </script>";
            } else {
                echo "<script>
                            alert('Something went wrong please try again!!!');
                            location.replace('add_marks');
                        </script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Add Marks</title>
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
                            <h1>Add Marks</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Marks</li>
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
                            <h3 class="card-title">Add Marks</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-success"><a href="marks_view" style="color: #fff;">
                                        Marks List</a></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-remove"></i></button>
                            </div>
                        </div></br>

                        <form class="form-horizontal" id="" action="" method="post" enctype="multipart/form-data">
                            <div class="input-row">
                                <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="images/marksheet/MARKS_FORMAT.csv"><b
                                        style="font-size:16px;">Format</b></a> -->
                                <label class="col-md-4 control-label">&nbsp;Choose CSV
                                    File</label> <input type="file" name="importExcelFile" />
                                <input type="submit" name="import_marks" class="btn btn-success btn-sm"
                                    value="Import" />
                            </div>
                        </form>

                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-12" id="error_section"></div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select class="form-control" name="course_id" id="course_id"
                                                onchange="change_semester(this.value); change_spec(this.value);">
                                                <option value="0">Select Course</option>
                                                <?php while ($row_course = $result_course->fetch_assoc()) { ?>
                                                <option value="<?php echo $row_course["course_id"]; ?>">
                                                    <?php echo $row_course["course_name"]; ?></option>
                                                <?php } ?>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Academic Year</label>
                                            <input type="hidden" name="subject_id">
                                            <select class="form-control" id="session_id" onchange="showdesg(this.value)"
                                                name="academic_year">
                                                <option value="0">Select Academic Year</option>
                                                <?php
                                                $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                                   WHERE `status` = '$visible';
                                                                   ";
                                                $result_ac_year = $con->query($sql_ac_year);
                                                while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                                                    ?>
                                                <?php
                                                    $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                                    $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                                                    $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                                    ?>
                                                <option value="<?php echo $row_ac_year["university_details_id"]; ?>">
                                                    <?php echo $completeSessionOnlyYear; ?>
                                                </option>
                                                <?php } ?>
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
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Specialization</label>
                                            <select class="form-control" name="spec" id="spec">

                                            </select>
                                        </div>
                                    </div>
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

                        <!-- edit form start -->

                        <!-- edit form end -->

                    </div>
                </div>
        </div>
        </section>
        <!-- /.content -->
    </div>

    <?php include_once 'include/footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
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
    $(document).ready(function() {
        $('#fetchStudentDataForm').submit(function(event) {
            $('#loader_section').append(
                '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
            );
            $('#fetchStudentDataButton').prop('disabled', true);
            $.ajax({
                url: 'include/view.php?action=fetch_student_list',
                type: 'POST',
                data: $('#fetchStudentDataForm').serializeArray(),
                success: function(result) {
                    $('#response').remove();
                    if (result == 0) {
                        $('#error_section').append(
                            '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                        );
                    } else {
                        $('#data_table').append('<div id = "response">' + result +
                            '</div>');
                    }
                    $('#loading').fadeOut(500, function() {
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
    function change_semester(semester) {
        $.ajax({
            url: 'include/ajax/add_semester.php',
            type: 'POST',
            data: {
                'data': semester
            },
            success: function(result) {
                document.getElementById('session_id').innerHTML = result;


            }

        });
    }

    function showdesg(session) {
        var dept = document.getElementById('course_id').value;
        $.ajax({
            url: 'ajaxdata.php',
            type: 'POST',
            data: {
                'depart': dept,
                'session': session
            },
            success: function(data) {
                $("#sem").html(data);
            },
        });

    }

    function change_semester1(semester) {
        $.ajax({
            url: 'include/ajax/add_semester.php',
            type: 'POST',
            data: {
                'data': semester
            },
            success: function(result) {
                document.getElementById('session_id1').innerHTML = result;
                showdesg1(document.getElementById('session_id1').value)
            }

        });
    }

    function showdesg1(session) {
        var dept = document.getElementById('course_id1').value;
        $.ajax({
            url: 'ajaxdata.php',
            type: 'POST',
            data: {
                'depart': dept,
                'session': session
            },
            success: function(data) {
                $("#sem1").html(data);
            },
        });

    }

    function change_spec(spec) {
        $.ajax({
            url: 'include/ajax/spec.php',
            type: 'POST',
            data: {
                'data': spec
            },
            success: function(result) {
                document.getElementById('spec').innerHTML = result;
            }

        });
    }
    </script>
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