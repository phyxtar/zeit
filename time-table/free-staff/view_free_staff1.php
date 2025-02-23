<?php
$page_no = "15";
$page_no_inside = "15_5";
?>
<style>
        .card-header p {
                margin-bottom: 0px;
        }
</style>
<?php
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<div class="main-panel">
        <div class="content-wrapper">
                <section class="content-header">
                        <div class="container-fluid">
                                <div class="row mb-2">
                                        <div class="col-sm-6">
                                                <h1>Free Staff</h1>
                                        </div>

                                        <div class="col-sm-6">
                                                <ol class="breadcrumb float-sm-right">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active">Free Staff</li>
                                                </ol>
                                        </div>
                                </div>
                        </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card card-default">
                                <div class="card-header">
                                        <span class="error"></span>
                                </div>
                                <form id="form_id" role="form" method="POST" >
                                        <div class="card-body">
                                                <div class="row ">
                                                        <!-- <div class="col-3">
                                                                <div class="form-group">
                                                                        <label>Course Name</label>
                                                                        <select class="form-control rounded-pill" name="course_id" id="course_id" onchange="change_semester(this.value)">
                                                                                <option value="all">Select</option>
                                                                                <?php
                                                                                $sql_course = "SELECT * FROM `tbl_course`
                                                                                          WHERE `status` = '$visible' ";
                                                                                $result_course = $con->query($sql_course);
                                                                                while ($row_course = $result_course->fetch_assoc()) {
                                                                                ?>
                                                                                        <option value="<?php echo $row_course["course_id"]; ?>"><?php echo $row_course["course_name"]; ?></option>
                                                                                <?php } ?>
                                                                        </select>
                                                                </div>
                                                        </div>

                                                        <div class="col-2">
                                                                <div class="form-group">
                                                                        <label>Academic Year</label>
                                                                        <input type="hidden" name="subject_id">
                                                                        <select class="form-control rounded-pill" id="session_id" onchange="showdesg(this.value)" name="academic_year">

                                                                        </select>
                                                                </div>
                                                        </div>
                                                        <div class="col-3">
                                                                <div class="form-group">
                                                                        <label>Semester</label>
                                                                        <select class="form-control rounded-pill" name="semester_id" id="sem" onchange="show(this.value)">

                                                                        </select>
                                                                </div>
                                                        </div> -->
                                                        
                                                        <div class="col-md-3 ">
                                                                <div class="form-group">
                                                                        <label>Select Date</label>
                                                                        <input onchange="" type="text" id="date" class="form-control rounded-pill" name="date_of_start_time_table" value="">
                                                                </div>
                                                        </div>

                                                        <div class="col-1" style="margin-top: 29px;">
                                                                <button type="button" onclick="ajaxCall('form_id', 'view', 'error_section')" id="fetchStudentDataButton" class="btn btn-primary">Go</button>
                                                        </div>
                                                </div>
                                        </div>
                                </form>
                                <!-- /.card-body -->
                        </div>
                        <div class="col-md-12" id="error_section"></div>

                </section>
                <!-- /.content -->
                

        </div>
</div>



<?php include "../include/foot.php" ?>
<?php include "../../framwork/ajax/method.php" ?>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
        $(document).ready(function() {
                //alert('hello');
                $("#date").datepicker({
                        beforeShowDay: unavailable
                });
        });


        var unavailableDates = [
                new Date(2012, 1, 20).valueOf(),
                new Date(2012, 1, 27).valueOf()
        ];

        function unavailable(date) {
                if (date.getDay() === 1 && $.inArray(date.valueOf(), unavailableDates) < 0) {
                        return [true, ""];
                } else {
                        return [false, "", "Unavailable"];
                }
        }

        function printpage() {
                var printButton = document.getElementById("printpagebutton");
                printButton.style.visibility = 'hidden';
                window.print()
                printButton.style.visibility = 'visible';
        }

        function change_semester(semester) {
                $.ajax({
                        url: '<?= url('include/ajax/add_semester.php') ?>',
                        type: 'POST',
                        data: {
                                'data': semester
                        },
                        success: function(result) {
                                document.getElementById('session_id').innerHTML = result;
                                showdesg(document.getElementById('session_id').value);
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
                                get_teacher();
                                get_subject();
                        },
                });

        }
</script>