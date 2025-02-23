<?php

$page_no = "15";
$page_no_inside = "15_1";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
include_once "../../framwork/main.php";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<?php
$msg = '';
$data = array();
$visible = md5("visible");

$class_id = $_GET['class_id'];
$child_data = array();
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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}


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

    if ($id != '') {
        $msg =  updateAll('time_table_master', $master_data);

        for ($i = 0; $i < count($_POST['staff_id']); $i++) {
            for ($k = 0; $k < count($_POST['class_start_time']); $k++) {
                $child_data['staff_id'] = $_POST['staff_id'][$i];
                $child_data['course_id'] = $_POST['class_id'];
                $child_data['start_time'] = $_POST['class_start_time'][$i];
                $child_data['date'] = $_POST['date_of_start_time_table'];
                $result =  updateAll('time_table_child', $child_data, 'master_id=' . $id . '');
            }
        }
    } else {
        $id =  insertGetId('time_table_master', $master_data);
        $staff_id_loop = 0;
        for ($i = 0; $i < count($_POST['date']); $i++) {
            for ($k = 0; $k < count($_POST['class_start_time']); $k++) {
                $child_data['master_id'] = $id;
                $child_data['staff_id'] = $_POST['staff_id'][$staff_id_loop];
                $child_data['subject_id'] = $_POST['subject_id'][$staff_id_loop];
                $child_data['course_id'] = $_POST['class_id'];
                $child_data['start_time'] = $_POST['class_start_time'][$k];
                $child_data['date'] = $_POST['date'][$i];
                $child_data['allocated_by'] = 'Admin';

                //  print_r($child_data);

                $result = insertAll('time_table_child', $child_data);
                $staff_id_loop++;
            }
            echo   $i;
        }
    }
    if ($result == "success") {
        $msg =  success_alert('Data Added Successfully');
        reload(1);
    } else {
        echo $msg = danger_alert($conn->error);
    }
}




if (isset($_POST['submit'])) {

    $post = array();
    $time_table_update['section'] = $_POST['section'];
    $time_table_update['semester'] = $_POST['semester'];
    $time_table_update['room_no'] = $_POST['room_no'];
    $time_table_update['academic_year'] = $_POST['academic_year'];
    $time_table_update['no_of_period'] = $_POST['no_of_period'];
    $time_table_update['start_time'] = $_POST['start_time'];
    $time_table_update['each_period_duration'] = $_POST['each_period_duration'];
    $time_table_update['each_period_break_duration'] = $_POST['each_period_break_duration'];
    $time_table_update['break_after_period_1'] = $_POST['break_after_period_1'];
    $time_table_update['break_after_period_2'] = $_POST['break_after_period_2'];
    $time_table_update['break1_time'] = $_POST['break1_time'];
    $time_table_update['break2_time'] = $_POST['break2_time'];
    $time_table_update['date_of_start_time_table'] = $_POST['date_of_start_time_table'];
    updateAll('time_table_update', $time_table_update, ' 1');
}
$class_id = $_GET['class_id'];

//Get class Name
$row =  fetchRow('tbl_course', '`course_id`=' . $class_id . '');
$data = fetchRow('time_table_update');
if ($get_masterdata != '') {
    $data = $get_masterdata;
}
// function is_exist_staff($staff_id)
// {
//         $flag = "no";
//         global $masterid;
//         global $class_id;
//         global $con;
//         $child_sql = "SELECT * FROM `time_table_child`
//         WHERE `master_id` = '$masterid' && `course_id` = '$class_id' && `staff_id`=$staff_id GROUP BY `staff_id`";
//         $child_result = $con->query($child_sql);
//         while ($row = mysqli_fetch_assoc($child_result)) {
//                 if ($row['staff_id'] == $staff_id) {
//                         $flag = 'yes';
//                         break;
//                 }
//         }
//         return $flag;
// }

?>
<div class="main-panel">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course Time Table</h1>
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
                        <h3 class="card-title">Add Time Table For <b><?= $row['course_name'] ?></b></h3>
                        <?= $msg ?>
                    </div>
                    <form action="" role="form" method="POST" id="start_date_time">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="error_section"></div>
                                <input type="hidden" name="class_id" id="course_id" value="<?= $_GET['class_id']; ?>">
                                <?php
                                $child_data1 = fetchResult('time_table_update');
                                $row_child1 = mysqli_fetch_array($child_data1);
                                ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <select name="academic_year" onchange="showdesg(this.value)" class="form-control rounded-pill" id="session_id">
                                            <option selected disabled>Select Academic Year</option>
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
                                <div class="col-sm-3">
                                    <label>Semester</label>
                                    <select name="semester" onchange="semchange()" class="form-control rounded-pill" id="sem" required>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Section</label>
                                    <select name="section" class="form-control rounded-pill" required>

                                        <option value="" disabled>Select Section</option>
                                        <?php
                                        $sql = "SELECT * FROM `tbl_section`";
                                        $result = $con->query($sql);
                                        while ($sec_row = $result->fetch_assoc()) { ?>
                                            <option value="<?= $sec_row['section'] ?>"><?= $sec_row['section'] ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Room No.</label>
                                    <input type="text" id="" class="form-control rounded-pill" name="room_no" value="<?= $data['room_no'] ?>">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Select Date</label>
                                        <?php $date = date('m/d/Y', time()); ?>
                                        <input type="text" id="date" onchange="get_staff(this.value)" class="form-control rounded-pill" name="date_of_start_time_table" value="<?= $data['date_of_start_time_table'] ?>">
                                    </div>
                                </div>
                                <?php
                                $child_data1 = fetchResult('time_table_update');
                                $row_child1 = mysqli_fetch_array($child_data1);
                                ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Timings :Start Time</label>
                                        <input type="time" id="time" class="form-control rounded-pill" name="start_time" value="<?= $data['start_time']  ?>" Am>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No. of Periods</label>
                                        <input type="number" class="form-control rounded-pill" id="no_of_period" value="<?= $data['no_of_period'] ?>" name="no_of_period" max="9" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Break 1: Time Duration(Min)</label>
                                        <input type="number" class="form-control rounded-pill" name="break1_time" value="<?= $data['break1_time'] ?>" value>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Break After Period(1st Break)</label>
                                        <input type="number" class="form-control rounded-pill" value="<?= $data['break_after_period_1']  ?>" name="break_after_period_1">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Break 2 :Time Duration(Min)</label>
                                        <input type="number" class="form-control rounded-pill" value="<?= $data['break2_time'] ?>" name="break2_time">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Break After Period(2nd Break)</label>
                                        <input type="number" class="form-control rounded-pill" value="<?= $data['break_after_period_2'] ?>" name="break_after_period_2">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Each Period Duration(Min)</label>
                                        <input type="number" class="form-control rounded-pill" name="each_period_duration" value="<?= $data['each_period_duration'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Each Period Break Duration(Min)</label>
                                        <input type="number" class="form-control rounded-pill" name="each_period_break_duration" value="<?= $data['each_period_break_duration'] ?>">
                                    </div>
                                </div>
                            </div>

                            <center><input type="submit" name="submit" value="Update" class="btn btn-primary"></center>
                        </div>
                        <span id="error"></span>
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
                                                                    <input type="hidden" name="class_start_time[]" class="start_datetime" id="class_start_time" value="<?= $time1 . "-" . $time ?>">
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
                                                        <!-- weekdays -->
                                                        <?php
                                                        for ($j = 1; $j <= 5; $j++) {
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <?php
                                                                    echo  $dd =  date("l", strtotime($data['date_of_start_time_table'] . '+' . ($j - 1) .  ' days')); // create weekdays array.
                                                                    ?>
                                                                    <input type="hidden" id="date" name="date[]" value="<?= date("Y-m-d", strtotime($data['date_of_start_time_table'] . '+' . ($j - 1) . ' days')) ?>">
                                                                </td>

                                                                <?php


                                                                for ($i = 1; $i <= $data['no_of_period']; $i++) { ?>
                                                                    <?php if ($data['break_after_period_1'] != 0) { ?>

                                                                        <?php if ($i == $data['break_after_period_1'] + 1) { ?>

                                                                            <td style="color: red;"><strong>B1</strong></td>

                                                                    <?php }
                                                                    } ?>
                                                                    <?php if ($data['break_after_period_2'] != 0) { ?>

                                                                        <?php if ($i == $data['break_after_period_2'] + 1) { ?>

                                                                            <td style="color: red;"><strong>B2</strong></td>
                                                                    <?php }
                                                                    } ?>
                                                                    <?php
                                                                    $class_id = $_GET['class_id'];

                                                                    $select_date = date("Y-m-d", strtotime($data['date_of_start_time_table']));
                                                                    $start_time = $data['start_time'];
                                                                    $qr = "SELECT * FROM `time_table_child` WHERE `start_time` LIKE '%$start_time%' && `date` = '" . $select_date . "' &&  `course_id` = '" . $class_id . "' ";
                                                                    $result = mysqli_query($con, $qr);
                                                                    $row =  mysqli_fetch_array($result);

                                                                    // $dateTime = "start_time like '%" . $start_time ."%' and date='" .$select_date ."'";
                                                                    // $result = fetchResult('time_table_child', $dateTime);
                                                                    //while ($row = mysqli_fetch_array($result)) {

                                                                    //echo $alloted_staff_id = $row['staff_id'];
                                                                    //}
                                                                    $alloted_staff_id = $row['staff_id'];
                                                                    //if ($alloted_staff_id != '') {
                                                                    $sql_staff = "SELECT * FROM `tbl_staff` WHERE `desg_id` = '1' && `course_id` = '$class_id'";
                                                                    $res = $con->query($sql_staff);
                                                                    ?>
                                                                    <td>
                                                                        <select name="staff_id[]" class="staff form-control rounded-pill form-control-sm teachers " onchange="checkFaculty(this,<?= $i - 1 ?>,'<?= date('Y-m-d', strtotime($data['date_of_start_time_table'] . '+' . ($j - 1) . ' days')) ?>')" id="staff">
                                                                            <option selected disabled>Select Faculty</option>
                                                                            <?php
                                                                            while ($staff_row = $res->fetch_assoc()) {
                                                                                echo '<option value="' . $staff_row['id'] . '">' . $staff_row['name'] . '</option>';
                                                                            ?>

                                                                            <?php }
                                                                            ?>
                                                                        </select>
                                                                        <?php
                                                                        // $sql_sub = "SELECT * FROM `time_tbl_subject` WHERE `course_id` = '$class_id' ";
                                                                        $sql_sub = "SELECT * FROM `teacher_allot_tbl` WHERE `course_id` = '$class_id' ";
                                                                        $sub_res = $con->query($sql_sub);
                                                                        ?>
                                                                        <select class="form-control rounded-pill form-control-sm subjects" name="subject_id[]">
                                                                            <option selected disabled>Select Subject</option>
                                                                            <?php
                                                                            while ($sub_row = $sub_res->fetch_assoc()) {
                                                                                $sub_id = $sub_row['subject_id'];
                                                                                $child_data1 = fetchResult('time_tbl_subject', 'id=' . $sub_id . '');
                                                                                $row_child1 = mysqli_fetch_array($child_data1);
                                                                                // echo '<pre>';
                                                                                // print_r($sub_row);
                                                                                echo '<option value="' . $row_child1['id'] . '">' . $row_child1['subject_name'] . '</option>';

                                                                            ?>

                                                                            <?php } ?>
                                                                        </select>


                                                                    </td>

                                                                <?php } ?>


                                                            </tr>
                                                        <?php } ?>
                                                        <!-- weekdays -->



                                                    </tbody>
                                                </table>
                                                <center><button type="submit" value="Submit" name="add_time_table" class="btn btn-primary rounded-pill">Submit</button></center>

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
<?php include "../../framwork/ajax/method.php";
?>
<script type="text/javascript">
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

    change_semester(document.getElementById('course_id').value)

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
        var session = document.getElementById('session_id').value;
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

    function semchange() {
        get_teacher();
        get_subject();
    }

    function get_teacher() {
        course_id = document.getElementById('course_id').value;
        session_id = document.getElementById('session_id').value;
        semster_id = document.getElementById('sem').value;
        $.ajax({
            url: '<?= url('time-table/class-time-table/add_time_table/get_teacher') ?>',
            type: 'POST',
            data: {
                'course_id': course_id,
                'session_id': session_id,
                'semster_id': semster_id
            },
            success: function(data) {
                $(".teachers").html(data);
            },
        });


    }


    function get_subject() {
        course_id = document.getElementById('course_id').value;
        session_id = document.getElementById('session_id').value;
        semster_id = document.getElementById('sem').value;
        $.ajax({
            url: '<?= url('time-table/class-time-table/add_time_table/get_subject') ?>',
            type: 'POST',
            data: {
                'course_id': course_id,
                'session_id': session_id,
                'semster_id': semster_id
            },
            success: function(data) {
                $(".subjects").html(data);
            },
        });
    }
</script>

<style>
    th {
        text-align: center;
    }
</style>