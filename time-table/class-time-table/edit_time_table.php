<?php
$page_no = "15";
$page_no_inside = "15_1";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";

$msg = '';
$data = array();
$class_id = $_GET['class_id'];

if (isset($_GET['master_id'])) {
        $masterid = $_GET['master_id'];
} else {
        $masterid = '';
}

//get timetable Master data for edit part
$master_sql = "SELECT * FROM `time_table_master`
WHERE `id` = '$masterid'";
$master_result = $con->query($master_sql);
$get_masterdata = $master_result->fetch_assoc();
$course_id = $get_masterdata['class_id'];  //course id for getting all staff and subject for particular course
$academic_year = $get_masterdata['academic_year']; // session id for geting all staff and subject  for particular session 
$semester_id = $get_masterdata['semester'];   // semester id for getting all staff and subject for particular semester

$staff_id_loop = 0;
if (isset($_POST['add_time_table']) && $_POST['add_time_table'] != '') {


        $master_data = array();
        $master_data['section'] = $_POST['section'];
        $master_data['semester'] = $_POST['semester'];
        $master_data['room_no'] = $_POST['room_no'];
        $master_data['start_time'] = $_POST['start_time'];
        $master_data['class_id'] = $_POST['class_id'];
        $master_data['academic_year'] = $_POST['academic_year'];

        $master_data['no_of_period'] = $_POST['no_of_period'];
        $master_data['each_period_duration'] = $_POST['each_period_duration'];
        $master_data['each_period_break_duration'] = $_POST['each_period_break_duration'];
        $master_data['break_after_period_1'] = $_POST['break_after_period_1'];
        $master_data['break_after_period_2'] = $_POST['break_after_period_2'];
        $master_data['break1_time'] = $_POST['break1_time'];
        $master_data['break2_time'] = $_POST['break2_time'];
        $master_data['date_of_start_time_table'] = $_POST['date_of_start_time_table'];
        $data = $master_data;

        if ($masterid != '') {
                //$del = delete('time_table_child', 'master_id=' . $masterid . '');
                $delquery = "DELETE FROM time_table_child WHERE master_id = $masterid";
                $del = mysqli_query($conn, $delquery);
                if ($del == "success") {

                        $msg = updateAll('time_table_master', $master_data, 'id=' . $id . '');

                        for ($i = 0; $i < count($_POST['date']); $i++) {
                                for ($k = 0; $k < count($_POST['class_start_time']); $k++) {
                                        $child_data['master_id'] = $masterid;
                                        $child_data['staff_id'] = $_POST['staff_id'][$staff_id_loop];
                                        $child_data['subject_id'] = $_POST['subject_id'][$staff_id_loop];

                                        $child_data['course_id'] = $_POST['class_id'];
                                        $child_data['start_time'] = $_POST['class_start_time'][$k];
                                        $child_data['date'] = $_POST['date'][$i];
                                        $child_data['allocated_by'] = 'Admin';
                                        $result = insertAll('time_table_child', $child_data);
                                        $staff_id_loop++;
                                }
                        }
                }
        }


        if ($result == "success") {
                $msg =  success_alert('Data Updated Successfully');
                reload(1);
        } else {
                echo $msg = danger_alert($conn->error);
        }
}




if (isset($_POST['submit'])) {
        $post = array();

        $time_table_master['section'] = $_POST['section'];
        $time_table_master['semester'] = $_POST['semester'];
        $time_table_master['room_no'] = $_POST['room_no'];
        $time_table_master['academic_year'] = $_POST['academic_year'];
        $time_table_master['no_of_period'] = $_POST['no_of_period'];
        $time_table_master['start_time'] = $_POST['start_time'];
        $time_table_master['each_period_duration'] = $_POST['each_period_duration'];
        $time_table_master['each_period_break_duration'] = $_POST['each_period_break_duration'];
        $time_table_master['break_after_period_1'] = $_POST['break_after_period_1'];
        $time_table_master['break_after_period_2'] = $_POST['break_after_period_2'];
        $time_table_master['break1_time'] = $_POST['break1_time'];
        $time_table_master['break2_time'] = $_POST['break2_time'];
        $time_table_master['date_of_start_time_table'] = $_POST['date_of_start_time_table'];
        $suc =   updateAll('time_table_master', $time_table_master, ' id=' . $masterid . '');
        if ($suc == "success") {
                $msg =  success_alert('Data Updated Successfully');
                reload(1);
        } else {
                echo $msg = danger_alert($con->error);
        }

        //updateGetId('time_table_update', $time_table_update, $id = 'id')
}

$class_id = $_GET['class_id'];

//Get class Name

$row =  fetchRow('tbl_course', '`course_id`=' . $class_id . '');
$data = fetchRow('time_table_update');
if ($get_masterdata != '') {
        $data = $get_masterdata;
}



?>
<div class="main-panel">
        <div class="content-wrapper">
                <section class="content-header">
                        <div class="container-fluid">
                                <div class="row mb-2">
                                        <div class="col-sm-6">
                                                <h1>Course Time Table </h1>
                                        </div>

                                        <div class="col-sm-6">
                                                <ol class="breadcrumb float-sm-right">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active">Course Time Table</li>
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
                                                <h3 class="card-title text-uppercase">Edit Time Table For <?= $row['course_name'] ?></h3>
                                                <?= $msg ?>
                                        </div>
                                        <form action="" role="form" method="POST">
                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-md-12" id="error_section"></div>
                                                                <input type="hidden" name="id" value="<?= $_GET['master_id']; ?>">

                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Academic Year</label>
                                                                                <?php
                                                                                $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                                         WHERE `status` = '$visible';
                                                                         ";
                                                                                $result_ac_year = $con->query($sql_ac_year); ?>

                                                                                <select name="academic_year" class="form-control" readonly="">
                                                                                        <?php if ($data['academic_year'] == 0) { ?>
                                                                                                <option value="0">select</option>
                                                                                        <?php } else { ?>
                                                                                                <option value="<?= $data['academic_year'] ?>"> <?= fetchRow('tbl_university_details', 'university_details_id=' . $data['academic_year'] . '')['academic_session'] ?> </option>
                                                                                                <?php
                                                                                                //}
                                                                                                // while ($row_ac_year = mysqli_fetch_array($result_ac_year)) {
                                                                                                //         $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                                                                                //         $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                                                                                                //         $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                                                                                ?>
                                                                                                <!-- <option value="<?= $row_ac_year['university_details_id'] ?>"> <?php echo $completeSessionOnlyYear; ?> </option> -->
                                                                                        <?php
                                                                                                // }
                                                                                        } ?>
                                                                                </select>


                                                                        </div>
                                                                </div>


                                                                <div class="col-3">
                                                                        <label>Section</label>
                                                                        <select name="section" class="form-control" readonly>
                                                                                <?php if ($data['section'] == '') { ?>
                                                                                        <option value="0" disabled>select</option>
                                                                                <?php } else { ?>
                                                                                        <option value="<?= $data['section'] ?>"> <?= $data['section'] ?> </option>

                                                                                <?php
                                                                                } ?>
                                                                                <!-- <option value="">Select Section</option>
                                                                                <?php
                                                                                $sql = "SELECT * FROM `tbl_section`";
                                                                                $result = $con->query($sql);
                                                                                while ($sec_row = $result->fetch_assoc()) { ?>
                                                                                        <option value="<?= $sec_row['section'] ?>"><?= $sec_row['section'] ?></option>

                                                                                <?php } ?> -->
                                                                        </select>
                                                                </div>


                                                                <div class="col-3">
                                                                        <label>Semester</label>
                                                                        <select name="semester" class="form-control" readonly>
                                                                                <?php if ($data['semester'] == '') { ?>
                                                                                        <option value="0" disabled>select</option>
                                                                                <?php } else { ?>
                                                                                        <option value="<?= $data['semester'] ?>"> <?= fetchRow('tbl_semester', '`semester_id`=' . $data['semester'] . '')['semester'] ?> </option>

                                                                                <?php
                                                                                } ?>

                                                                        </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Room No.</label>
                                                                                <input type="text" class="form-control" name="room_no" value="<?= $data['room_no'] ?>">
                                                                        </div>
                                                                </div>



                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Select Date</label>
                                                                                <?php $date = date('m/d/Y', time()); ?>
                                                                                <input type="text" id="date" class="form-control" name="date_of_start_time_table" value="<?= $data['date_of_start_time_table'] ?>">
                                                                        </div>
                                                                </div>








                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Timings :Start Time</label>
                                                                                <input type="time" id="time" class="form-control" onchange="getStaffData()" name="start_time" value="<?= $data['start_time']  ?>" Am>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>No. of Periods</label>
                                                                                <input type="number" class="form-control" id="no_of_period" value="<?= $data['no_of_period'] ?>" name="no_of_period" max="9" readonly>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Break 1: Time Duration(Min)</label>
                                                                                <input type="number" class="form-control" name="break1_time" value="<?= $data['break1_time'] ?>" value>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Break After Period(1st Break)</label>
                                                                                <input type="number" class="form-control" value="<?= $data['break_after_period_1']  ?>" name="break_after_period_1">
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Break 2 :Time Duration(Min)</label>
                                                                                <input type="number" class="form-control" value="<?= $data['break2_time'] ?>" name="break2_time">
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Break After Period(2nd Break)</label>
                                                                                <input type="number" class="form-control" value="<?= $data['break_after_period_2'] ?>" name="break_after_period_2">
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Each Period Duration(Min)</label>
                                                                                <input type="number" class="form-control" name="each_period_duration" value="<?= $data['each_period_duration'] ?>">
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Each Period Break Duration(Min)</label>
                                                                                <input type="number" class="form-control" name="each_period_break_duration" value="<?= $data['each_period_break_duration'] ?>">
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <center><input type="submit" name="submit" value="Update" class="btn btn-primary"></center>
                                                </div>
                                                <span id="error"></span>
                                                <!-- /.card-header -->
                                                <div class="row">
                                                        <div class="col-lg-12 grid-margin stretch-card">
                                                                <div class="card">
                                                                        <div class="card-body">

                                                                                <div id="demo">
                                                                                        <div class="table-responsive">
                                                                                                <table id="example1" class="table table-bordered table-striped">
                                                                                                        <thead>
                                                                                                                <tr>
                                                                                                                        <th>Period&rarr;<br><span>&#92;</span>Days&darr;</th>
                                                                                                                        <?php

                                                                                                                        $time = $data['start_time'];
                                                                                                                        for ($i = 1; $i <= $data['no_of_period']; $i++) { ?>
                                                                                                                                <th><?= $i ?><br>


                                                                                                                                        <?php

                                                                                                                                        if ($i > 1) { ?>
                                                                                                                                                <?php echo $time = date('H:i', strtotime($time . '+' . $data['each_period_break_duration'] . ' minutes'));
                                                                                                                                                $time1 = $time; ?>
                                                                                                                                                TO
                                                                                                                                                <?=
                                                                                                                                                $time = date('H:i', strtotime($time . '+' . $data['each_period_duration'] . ' minutes'));
                                                                                                                                                ?>



                                                                                                                                        <?php } else {
                                                                                                                                        ?>
                                                                                                                                                <?php echo $time = date('H:i', strtotime($time));
                                                                                                                                                $time1 = $time; ?>
                                                                                                                                                TO
                                                                                                                                                <?=
                                                                                                                                                $time = date('H:i', strtotime($time . '+' . $data['each_period_duration'] . ' minutes'));
                                                                                                                                                ?>
                                                                                                                                        <?php }




                                                                                                                                        if ($i == $data['break_after_period_1']) {
                                                                                                                                                $time =  date('H:i', strtotime($time . '+' . $data['break1_time'] . ' minutes'));
                                                                                                                                        }



                                                                                                                                        if ($i ==  $data['break_after_period_2']) {
                                                                                                                                                $time =  date('H:i', strtotime($time . '+' . $data['break2_time'] . ' minutes'));
                                                                                                                                        }
                                                                                                                                        ?>

                                                                                                                                        <input type="hidden" name="class_start_time[]" class="start_datetime" value="<?= $time1 . "-" . $time ?>">



                                                                                                                                </th>


                                                                                                                                <?php if ($i == $data['break_after_period_1']) {  ?>


                                                                                                                                        <th>
                                                                                                                                                <center style="color:red">BREAK 1</center>
                                                                                                                                        </th>

                                                                                                                                <?php } ?>


                                                                                                                                <?php if ($i ==  $data['break_after_period_2']) {  ?>


                                                                                                                                        <th>
                                                                                                                                                <center style="color:red">BREAK 2</center>
                                                                                                                                        </th>

                                                                                                                                <?php } ?>
                                                                                                                        <?php } ?>

                                                                                                                </tr>
                                                                                                        </thead>
                                                                                                        <tbody>

                                                                                                                <?php
                                                                                                                $staff_inc = 0;
                                                                                                                $child_data = fetchResult('time_table_child', 'master_id=' . $masterid . ' GROUP BY `date` ');
                                                                                                                $child_data1 = fetchResult('time_table_child', 'master_id=' . $masterid . '');
                                                                                                                while ($child_row = mysqli_fetch_array($child_data)) {
                                                                                                                ?>
                                                                                                                        <tr>
                                                                                                                                <td>
                                                                                                                                        <input type="hidden" value="<?= $child_row['date'] ?>" name="date[]">
                                                                                                                                        <strong> <?= date('D', strtotime($child_row['date'])) ?></strong>
                                                                                                                                </td>
                                                                                                                                <?php
                                                                                                                                for ($i = 0; $i < $data['no_of_period']; $i++) { ?>
                                                                                                                                        <?php if ($data['break_after_period_1'] != 0) { ?>
                                                                                                                                                <?php if ($i == $data['break_after_period_1']) { ?>
                                                                                                                                                        <td class="text-danger"><b> B1</b></td>
                                                                                                                                        <?php }
                                                                                                                                        } ?>
                                                                                                                                        <?php if ($data['break_after_period_2'] != 0) { ?>
                                                                                                                                                <?php if ($i == $data['break_after_period_2']) { ?>
                                                                                                                                                        <td class="text-danger"><b> B2</td>
                                                                                                                                        <?php }
                                                                                                                                        } ?>
                                                                                                                                        <?php
                                                                                                                                        $staff_data = fetchResult('teacher_allot_tbl', '`course_id`=' . $course_id . ' && `academic_year`=' . $academic_year . ' && `semester_id`=' . $semester_id . '');
                                                                                                                                        $row_child1 = mysqli_fetch_array($child_data1);

                                                                                                                                        ?>
                                                                                                                                        <td align="center">
                                                                                                                                                <input type="hidden" name="id" value="<?= $_GET['master_id']; ?>">
                                                                                                                                                <input type="hidden" id="course_id" name="class_id" value="<?= $_GET['class_id']; ?>">
                                                                                                                                                <select name="staff_id[]" class="staff form-control form-control-sm teachers " onchange="checkFaculty(this,<?= $i ?>,'<?= $row_child1['date'] ?>')" id="staff">
                                                                                                                                                        <?php if ($row_child1['staff_id'] == 0) { ?>
                                                                                                                                                                <option selected disabled> - Select Faculty - </option>
                                                                                                                                                        <?php } else { ?>
                                                                                                                                                                <option value="<?= $row_child1['staff_id'] ?>"> <?= fetchRow('tbl_staff', 'id=' . $row_child1['staff_id'] . '')['name'] ?> </option>
                                                                                                                                                                <?php }
                                                                                                                                                        while ($staff_row = mysqli_fetch_array($staff_data)) {
                                                                                                                                                                if ($staff_row['staff_id'] != $row_child1['staff_id']) {
                                                                                                                                                                ?>
                                                                                                                                                                        <option value="<?= $staff_row['staff_id'] ?>"> <?= fetchRow('tbl_staff', 'id=' .  $staff_row['staff_id'] . '')['name'] ?> </option>
                                                                                                                                                        <?php
                                                                                                                                                                }
                                                                                                                                                        } ?>
                                                                                                                                                </select><br>
                                                                                                                                                <select name="subject_id[]" class="form-control form-control-sm subjects">
                                                                                                                                                        <?php if ($row_child1['subject_id'] == 0) { ?>
                                                                                                                                                                <option selected disabled> - Select Subjects -</option>
                                                                                                                                                        <?php } else { ?>
                                                                                                                                                                <option value="<?= $row_child1['subject_id'] ?>"> <?= fetchRow('time_tbl_subject', 'id=' . $row_child1['subject_id'] . '')['subject_name'] ?> </option>
                                                                                                                                                        <?php
                                                                                                                                                        } ?>
                                                                                                                                                        <?php
                                                                                                                                                        $sql_sub = "SELECT * FROM `time_tbl_subject` WHERE `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `semester_id` = '$semester_id' ";
                                                                                                                                                        $sub_res = $con->query($sql_sub);
                                                                                                                                                        while ($sub_row = $sub_res->fetch_assoc()) {
                                                                                                                                                                if ($sub_row['id'] != $row_child1['subject_id']) {

                                                                                                                                                                        echo '<option value="' . $sub_row['id'] . '">' . $sub_row['subject_name'] . '</option>';
                                                                                                                                                                }
                                                                                                                                                        ?>
                                                                                                                                                        <?php } ?>
                                                                                                                                                </select>
                                                                                                                                        </td>

                                                                                                                                <?php $staff_inc++;
                                                                                                                                } ?>
                                                                                                                        </tr>
                                                                                                                <?php }
                                                                                                                ?>
                                                                                                        </tbody>
                                                                                                </table>
                                                                                                <center><button type="submit" value="Submit" name="add_time_table" class="btn btn-primary">Submit</button></center>

                                                                                        </div>
                                                                                </div>

                                                                        </div>
                                                                </div>
                                                        </div>
                                        </form>


                                </div>

                                <!-- /.card-body -->


                        </div>

        </div>
        </section>
        <!-- /.content -->


</div>
</div>



<?php include "../include/foot.php" ?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="text/javascript">
        //getStaffData();
        function getStaffData() {
                //$("#date").click(function() {
                var course_id = document.getElementById('course_id').value;
                var date = document.getElementById('date').value;
                var time = document.getElementById('time').value;
                console.log(course_id);
                console.log(date);
                console.log(time);
                $.ajax({
                        url: '<?= url('time-table/class-time-table/ajaxstaffdata') ?>',
                        type: 'POST',
                        data: {
                                'course_id': course_id,
                                'date': date,
                                'time': time
                        },
                        success: function(data) {
                                console.log(data);
                                $(".staff").html(data);

                        },
                });


                //});
        }





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

        function checkFaculty(data, time_position, date) {
                target_id = "error";
                var time = document.getElementsByClassName('start_datetime')[time_position].value;
                var url_name = '<?= url('time-table/class-time-table/checkstaff') ?>';

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                                if (this.responseText != '') {
                                        document.getElementById(target_id).innerHTML = this.responseText;
                                        data.value = '';
                                } else {
                                        document.getElementById(target_id).innerHTML = '';

                                }
                        }
                };
                xhttp.open("GET", url_name + "?time=" + time + "&date=" + date + "&staff_id=" + data.value, true);

                xhttp.send();


        }
</script>