<?php
$page_no = "11";
$page_no_inside = "11_15";
include_once "include/authentication.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Placement </title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="dist/js/jquery-3.2.1.min.js"></script>

    <style>
    .outer-scontainer {
        background: #F0F0F0;
        border: #e0dfdf 1px solid;
        padding: 20px;
        border-radius: 2px;
    }

    .input-row {
        margin-top: 0px;
        margin-bottom: 20px;
    }

    .btn-submit {
        background: #333;
        border: #1d1d1d 1px solid;
        color: #f0f0f0;
        font-size: 0.9em;
        width: 100px;
        border-radius: 2px;
        cursor: pointer;
    }

    .outer-scontainer table {
        border-collapse: collapse;
        width: 100%;
    }

    .outer-scontainer th {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    .outer-scontainer td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    #response {
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 2px;
        display: none;
    }

    .success {
        background: #c7efd9;
        border: #bbe2cd 1px solid;
    }

    .error {
        background: #fbcfcf;
        border: #f3c6c7 1px solid;
    }

    div#response.display-block {
        display: block;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#frmCSVImport").on("submit", function() {

            $("#response").attr("class", "");
            $("#response").html("");
            var fileType = ".csv";
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
            if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
                $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                return false;
            }
            return true;
        });
    });
    </script>
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
                            <h1>Placement Company List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Placement</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card"><br><br><br>
                            <div class="card-header">
                                <div class="float-sm-right" style="margin-top: -56px;">
                                    <button type="button" class="btn btn-success"><a href="placement_form"
                                            style="color: #fff;">Add Placement</a></button>
                                </div>
                            </div>
                            <form role="form" method="POST" id="fetchStudentDataForm">
                                <div class="card-body" style="margin-top: 0px;">
                                    <div class="row">
                                        <div class="col-12" id="error_section"></div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Course Name</label>
                                                <select class="form-control" name="course_id" id="course_id"
                                                    onchange="change_semester(this.value)">
                                                    <option value="all">Select</option>
                                                    <?php
                                                    $sql_course = "SELECT * FROM `tbl_course`
                                                                   WHERE `status` = '$visible';
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

                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Academic Year</label>
                                                <input type="hidden" name="subject_id">
                                                <select class="form-control" id="session_id"
                                                    onchange="showdesg(this.value)" name="academic_year">
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
                                                    <option
                                                        value="<?php echo $row_ac_year["university_details_id"]; ?>">
                                                        <?php echo $completeSessionOnlyYear; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-3">
                                            <div class="form-group">
                                                <label>Semester</label>
                                                <select class="form-control" name="semester_id" id="sem"
                                                    onchange="show(this.value)">
                                                    <option value="-1">Select</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-2" style="margin-top: 29px;">
                                            <button type="submit" id="fetchStudentDataButton"
                                                class="btn btn-primary">Go</button>
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
    <!-- Add student Modal Start-->
    <div id="add_student" class="w3-modal" style="z-index:2020;">
        <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
            <header class="w3-container" style="background:#343a40; color:white;">
                <span onclick="document.getElementById('add_student').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                <h2 align="center">Add Placement</h2>
            </header>
        </div>
    </div>
    <!-- Add student Modal End -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
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

        $('#add_student_button').click(function() {
            $('#loader_section').append(
                '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
            );
            $('#add_student_button').prop('disabled', true);
            $.ajax({
                url: 'include/controller.php',
                type: 'POST',
                data: $('#add_student_form').serializeArray(),
                success: function(result) {
                    $('#response').remove();
                    $('#add_student_form')[0].reset();
                    $('#error_section').append('<div id = "response">' + result + '</div>');
                    $('#loading').fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#add_student_button').prop('disabled', false);
                }

            });
            $.ajax({
                url: 'include/view.php?action=get_migration',
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
        $('#fetchStudentDataForm').submit(function(event) {
            $('#loader_section').append(
                '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
            );
            $('#fetchStudentDataButton').prop('disabled', true);
            $.ajax({
                url: 'include/view.php?action=get_placement',
                type: 'POST',
                data: $('#fetchStudentDataForm').serializeArray(),
                success: function(result) {
                    $('#response').remove();
                    if (result == 0) {
                        $('#error_section').append(
                            '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                        );
                    } else {
                        $("#data_table").html(result);
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
                var session = document.getElementById('session_id').value;

                showdesg(session)
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