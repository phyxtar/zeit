<?php
$page_no = "11";
$page_no_inside = "11_4";
include_once "include/authentication.php";
include_once "framwork/main.php";
include_once "include/config.php";
$visible = md5("visible");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("Y-m-d h:i:s");
?>
<?php
if (isset($_POST["importExcelButton"])) {
    $file = $_FILES['importExcelFile']['tmp_name'];
    $handle = fopen($file, "r");
    if ($file == null) {
        echo "<script>
                        alert('Please first select an Excel file!!!');
                        location.replace('add_subject.php');
                    </script>";
    } else {
        $c = 0;
        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
            $course_name = $filesop[0];
            $semester_name = $filesop[1];
            $academic_year = $filesop[2];
            $subject_name = $filesop[3];
            $subject_code = $filesop[4];
            $date_of_examination = $filesop[5];
            $full_marks = $filesop[6];
            $pass_marks = $filesop[7];
            $credit = $filesop[8];
            $course_id = "";
            $semester_id = "";
            $fee_academic_year = "";

            $course_name = $filesop[0];

            if (strpos($course_name, '.') !== false) {
                // Course name contains a period
                $pattern = str_replace(' ', '%', $course_name);
                $where_clause = "`course_name` LIKE '%" . $pattern . "%'";
                $sql_grade = "SELECT * FROM `tbl_course` WHERE ($where_clause) AND `status` = '$visible'";
            } else {
                // Course name does not contain a period
                $sql_grade = "SELECT * FROM `tbl_course` WHERE `course_name`='$course_name' AND `status`='$visible'";
            }
            $result_grade = mysqli_query($con, $sql_grade);
            $row_grade = mysqli_fetch_assoc($result_grade);
            $course_id = $row_grade["course_id"];

            $sql_year = "SELECT * FROM `tbl_university_details` WHERE `academic_session`='$academic_year' && `status`='$visible' ";
            $result_year = mysqli_query($con, $sql_year);
            $row_year = mysqli_fetch_assoc($result_year);
            $fee_academic_year = $row_year["university_details_id"];

            $sql_semester = "SELECT * FROM `tbl_semester` WHERE `semester` LIKE '%$semester_name%' && `course_id`='$course_id' && `fee_academic_year`='$fee_academic_year' && `status`='$visible' ";
            $result_semester = mysqli_query($con, $sql_semester);
            $row_semester = mysqli_fetch_assoc($result_semester);
            $semester_id = $row_semester["semester_id"];

            $sql = "INSERT INTO `tbl_subjects`(`subject_id`,`course_id`, `semester_id`, `fee_academic_year`,`subject_name`, `subject_code`,`date_of_examination`,`full_marks`,`pass_marks`,`credit`,`add_time` ,`status`)
                    VALUES (NULL,'$course_id','$semester_id','$fee_academic_year','$subject_name','$subject_code','$date_of_examination','$full_marks','$pass_marks','$credit','$date_variable_today_month_year_with_timing','$visible')";
            $result = mysqli_query($con, $sql);
            $c = $c + 1;
        }
        if ($result) {
            echo "<script>
                            alert('Excel Imported Successfully!!!');
                            location.replace('add_subject.php');
                        </script>";
        } else {
            echo "<script>
                            alert('" . $con->error . "');
                            location.replace('add_subject.php');
                        </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY1 | Add Subjects</title>
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
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script>

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
                            <h1>Add Subjects</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Subjects</li>
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
                            <h3 class="card-title">Add Subjects</h3>


                        </div>
                        <br>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="input-row">
                                <label class="col-md-4 control-label" for="">
                                    <a href="<?= url('format/subjects.csv') ?>">&nbsp;&nbsp;&nbsp;Choose CSV
                                        File</a> </label> <input type="file" name="importExcelFile" />
                                <input type="submit" name="importExcelButton" class="btn btn-success btn-sm"
                                    value="Import" />
                            </div>
                        </form>
                        <form role="form" method="POST" id="add_subjects_form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="error_section"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select class="form-control" name="course_id" id="course_id"
                                                onchange="change_semester(this.value); change_spec(this.value);" required>
                                                <option value="">Select</option>
                                                <?php $sel_dept = mysqli_query($con, "SELECT * FROM `tbl_course` ");
                                                while ($res_dept = mysqli_fetch_assoc($sel_dept)) { ?>
                                                    <option value="<?php echo $res_dept['course_id']; ?>">
                                                        <?php echo $res_dept['course_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Academic Year</label>
                                            <select class="form-control" onchange="showdesg(this.value)" id="session_id"
                                                name="academic_year">
                                                <option value="0">Select</option>
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select class="form-control" name="semester_id" id="sem">
                                                <option value="-1">Select</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- /.card-header -->

                            <div class="card-body">
                                <table class="table table-bordered" id="dynamic_field" style="overflow-y:auto;">
                                    <thead>
                                        <tr>
                                            <th data-field="S.NO" data-sortable="true" rowspan="2">S.no</th>
                                            <th data-field="SubjectName" data-sortable="true" rowspan="2">Subject Name
                                            </th>
                                            <th data-field="SubjectCode" data-sortable="true" rowspan="2">Subject Code
                                            </th>
                                            <th data-field="SubjectCode" data-sortable="true" rowspan="2">Specialization</th>
                                            <th data-field="ExamDate" data-sortable="true" rowspan="2">Exam Date</th>
                                            <th data-field="FullMarks" data-sortable="true" rowspan="2">Full Marks</th>
                                            <th data-field="PassMarks" data-sortable="true" rowspan="2">Pass Marks</th>
                                            <th data-field="PassMarks" data-sortable="true" rowspan="2">Credit</th>
                                            <th rowspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="5%"><input type="text" id="slno1" value="1" readonly
                                                    class="form-control" style="border:none;" /></td>

                                            <td width="30%"><input type="text" name="subject_name[]"
                                                    placeholder="Subject Name" class="form-control" /></td>
                                            <td width="15%"><input type="text" name="subject_code[]"
                                                    placeholder="Subject Code" class="form-control" /></td>
                                            <td width="20%"><select class="form-control" name="specialization[]" id="spec">

                                            </select></td>
                                            <td width="10%"><input type="date" name="exam_date[]"
                                                    placeholder="Exam Date" class="form-control" /></td>
                                            <td width="15%"><input type="number" name="full_marks[]"
                                                    placeholder="Full Marks" class="form-control" /></td>
                                            <td width="15%"><input type="number" name="pass_marks[]"
                                                    placeholder="Pass Marks" class="form-control" /></td>
                                            <td width="15%"><input type="number" name="credit[]"
                                                    placeholder="Credit" class="form-control" /></td>
                                            <td><button type="button" name="add" id="add" class="btn btn-success"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></button></td>

                                        </tr>
                                    </tbody>
                                </table>

                                <br>
                                <input type='hidden' name='action' value='add_sub' />
                                <div class="col-md-12" id="loader_section"></div>
                                <button type="button" id="add_subjects_button" class="btn btn-primary">Add</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                            <!-- /.card-body -->


                    </div>

                    </form>
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


    <script>
        $(function () {

            $('#add_subjects_button').click(function () {
                $('#loader_section').append(
                    '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                );
                $('#add_subjects_button').prop('disabled', true);
                $.ajax({
                    url: 'include/controller.php',
                    type: 'POST',
                    data: $('#add_subjects_form').serializeArray(),
                    success: function (result) {
                        $('#response').remove();
                        if (result == "courseempty")
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please First Add Courses!!!</div></div>'
                            );
                        if (result == "empty")
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out all required fields!!!</div></div>'
                            );
                        if (result == "error")
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                            );
                        if (result == "success") {
                            $('#add_subjects_form')[0].reset();
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Subject added successfully!!!</div></div>'
                            );
                        }
                        if (result == "update") {
                            $('#add_subjects_form')[0].reset();
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Subject updated successfully!!!</div></div>'
                            );
                        }
                        console.log(result);
                        $('#loading').fadeOut(500, function () {
                            $(this).remove();
                        });
                        $('#add_subjects_button').prop('disabled', false);
                    }

                });
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            var i = 1;

            $('#add').click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added" ><td><input type="text" id="slno' + i + '" value="' + i +
                    '" readonly class="form-control" style="border:none;" /></td>' +
                    '<td><input type="text" name="subject_name[]" placeholder="Subject Name" class="form-control" /></td>' +
                    '<td><input type="text" name="subject_code[]" placeholder="Subject Code" class="form-control" />' +
                    '<td><select class="form-control" name="specialization[]" id="spec"></select>' +
                    '</td><td><input type="date" name="exam_date[]" placeholder="Exam date Code" class="form-control" />' +
                    '</td><td><input type="number" name="full_marks[]" placeholder="Full Marks" class="form-control" />' +
                    '</td><td><input type="number" name="pass_marks[]" placeholder="Pass Marks" class="form-control" />' +
                    '</td><td><button type="button" name="remove" id="' + i +
                    '" class="btn btn-danger btn_remove">X</button></td>' +
                    '</tr>');
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });

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
            var dept = document.getElementById('course_id').value;
            $.ajax({
                url: 'ajaxdata.php',
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

        function change_spec(spec) {
      $.ajax({
        url: 'include/ajax/spec.php',
        type: 'POST',
        data: {
          'data': spec
        },
        success: function (result) {
          document.getElementById('spec').innerHTML = result;
        }

      });
    }
    </script>

</body>

</html>