<?php
$page_no = "15";
$page_no_inside = "15_4";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
$msg = '';
?>
<!DOCTYPE html>
<html>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Time Table Allot Teachers LIst</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Time Table Allot Teachers LIst</li>
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
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="card-title">Time Table Allot Teachers LIst</h3>
                                </div>
                                <div class="col-3"><a href="add_teacher_allotment" type="button" class="btn btn-primary">Add Allot Teachers </a></div>
                            </div>


                        </div>

                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-12" id="error_section"></div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select class="form-control" name="course_id" id="course_id" onchange="change_semester(this.value)">
                                                <option value="all">Select</option>
                                                <?php
                                                $sql_course = "SELECT * FROM `tbl_course`
                                                                   WHERE `status` = '$visible';
                                                                   ";
                                                $result_course = $con->query($sql_course);
                                                while ($row_course = $result_course->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $row_course["course_id"]; ?>"><?php echo $row_course["course_name"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Academic Year</label>
                                            <input type="hidden" name="subject_id">
                                            <select class="form-control" id="session_id" onchange="showdesg(this.value)" name="academic_year">
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
                                                    <option value="<?php echo $row_ac_year["university_details_id"]; ?>"><?php echo $completeSessionOnlyYear; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select class="form-control" name="semester_id" id="sem" onchange="show(this.value)">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" id="fetchStudentDataButton" class="btn btn-primary">Go</button>
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
            </section>
            <!-- /.content -->
        </div>

        <?php include_once '../include/foot.php'; ?>


        <script>
            $(document).ready(function() {
                $('#fetchStudentDataForm').submit(function(event) {
                    $('#loader_section').append('<center id = "loading"><img width="50px" src = "<?= url('images/ajax-loader.gif') ?>" alt="Currently loading" /></center>');
                    $('#fetchStudentDataButton').prop('disabled', true);
                    $.ajax({
                        url: 'teacher_allotment/view.php?action=fetch_student_list',
                        type: 'POST',
                        data: $('#fetchStudentDataForm').serializeArray(),
                        success: function(result) {
                            $('#response').remove();
                            if (result == 0) {
                                $('#error_section').html('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>');
                            } else {
                                $('#data_table').html('<div id = "response">' + result + '</div>');
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
                    url: '<?= url('include/ajax/add_semester.php') ?>',
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
                    url: '<?= url('ajaxdata.php') ?>',
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
                    url: '<?= url('include/ajax/add_semester.php') ?>',
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
                    url: '<?= url('ajaxdata.php') ?>',
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