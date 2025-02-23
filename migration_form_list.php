<?php
$page_no = "11";
$page_no_inside = "11_31";
include_once "include/authentication.php";

// Fetch admin details
$logger_username = $_SESSION["logger_username"];
$sql_admin = "SELECT admin_type, hod_permission FROM tbl_admin WHERE admin_username = '$logger_username'";
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
$sql_course .= "ORDER BY `course_name` ASC";
$result_course = $con->query($sql_course);

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Meta and Stylesheets -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Migration Application List</title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Migration Application List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Migration Application List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Migration Application List</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <form role="form" method="POST" id="fetchFeeDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-12" id="error_section"></div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select class="form-control rounded-pill" id="course_id" name="course_id"
                                                onchange="change_semester(this.value)">
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
                                            <select class="form-control rounded-pill" onchange="showdesg(this.value)"
                                                id="session_id" name="academic_year">
                                                <option value="0">Select Academic Year</option>
                                                <?php
                                                $sql_ac_year = "SELECT * FROM `tbl_university_details` WHERE `status` = '$visible';";
                                                $result_ac_year = $con->query($sql_ac_year);
                                                while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                                                    $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                                    $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                                                    $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                                ?>
                                                <option value="<?php echo $row_ac_year["university_details_id"]; ?>">
                                                    <?php echo $completeSessionOnlyYear; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" id="fetchFeeDataButton"
                                            class="btn btn-primary rounded-pill">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-12" id="loader_section"></div>
                        <div class="card-body" id="data_table"></div>
                    </div>
                </div>
            </section>
        </div>
        <!-- <div id="view_exam_lists" class="w3-modal" style="z-index:2020;">
            <div class="w3-modal-content w3-animate-top w3-card-4" style="width:60%">
                <header class="w3-container" style="background:#343a40; color:white;">
                    <span id="close-view_exam_lists" class="w3-button w3-display-topright">&times;</span>
                    <h2 align="center">Examination Form Details</h2>
                </header>
                <div id="see-section"></div>
            </div>
        </div> -->
        <?php include_once 'include/footer.php'; ?>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <script>
    $("#close-view_exam_lists").click(function() {
        $("#view_exam_lists").css("display", "none");
    });
    </script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script>
    $(document).ready(function() {
        $('#fetchFeeDataForm').submit(function(event) {
            $('#loader_section').append(
                '<center id="loading"><img width="50px" src="images/ajax-loader.gif" alt="Currently loading" /></center>'
            );
            $('#fetchFeeDataButton').prop('disabled', true);
            $.ajax({
                url: 'include/view.php?action=get_migration_list',
                type: 'POST',
                data: $('#fetchFeeDataForm').serializeArray(),
                success: function(result) {
                    $('#response').remove();
                    if (result == 0) {
                        $('#error_section').html(
                            '<div id="response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                        );
                    } else {
                        $('#data_table').html('<div id="response">' + result + '</div>');
                    }
                    $('#loading').fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#fetchFeeDataButton').prop('disabled', false);
                }
            });
            event.preventDefault();
        });
    });
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
    </script>
</body>

</html>