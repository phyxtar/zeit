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

$staff_id_loop = 0;


$class_id = $_GET['class_id'];
$section = $_GET['sec'];
$sem = $_GET['sem'];
$roomno = $_GET['rno'];
$routinedate = $_GET['date'];


//Get course Name

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
                                                <div class="row">
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
                                      
                                                <!-- /.card-header -->
                                                <div class="row">
                                                        <div class="col-lg-12 grid-margin stretch-card table-responsive">
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

                                                                                                                                        <input type="hidden" name="class_start_time[]" value="<?= $time1 . "-" . $time ?>">



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
                                                                                                                                        $staff_data = fetchResult('tbl_staff', 'desg_id=1');
                                                                                                                                        $row_child1 = mysqli_fetch_array($child_data1);

                                                                                                                                        // $sub_data = fetchResult('tbl_subjects');
                                                                                                                                        // $row_child_sub = mysqli_fetch_array($child_data1);


                                                                                                                                        ?>
                                                                                                                                        <td align="center">
                                                                                                                                                <input type="hidden" name="id" value="<?= $_GET['master_id']; ?>">
                                                                                                                                                <input type="hidden" name="class_id" value="<?= $_GET['class_id']; ?>">



                                                                                                                                                <?php if ($row_child1['staff_id'] == 0) { ?>
                                                                                                                                                        Not Alloted <br>
                                                                                                                                                <?php } else { ?>
                                                                                                                                                        <b><?= fetchRow('tbl_staff', 'id=' . $row_child1['staff_id'] . '')['name'] ?></b>

                                                                                                                                                <?php
                                                                                                                                                }
                                                                                                                                                ?><br>

                                                                                                                                                <?php if ($row_child1['subject_id'] == 0) { ?>
                                                                                                                                                        - <br>
                                                                                                                                                <?php } else { ?>
                                                                                                                                                        <?= fetchRow('time_tbl_subject', 'id=' . $row_child1['subject_id'] . '')['subject_name'] ?>

                                                                                                                                                <?php
                                                                                                                                                }
                                                                                                                                                ?>




                                                                                                                                        </td>

                                                                                                                                <?php $staff_inc++;
                                                                                                                                } ?>
                                                                                                                        </tr>
                                                                                                                <?php }
                                                                                                                ?>
                                                                                                        </tbody>
                                                                                                </table>


                                                                                                <center>
                                                                                                        <!-- <button id="printPageButton" onclick="printpage()" class="btn btn-primary">Print</button> -->
                                                                                                        <input id="printpagebutton" type="button" class="btn btn-primary" value="Print" onclick="printpage()" />


                                                                                                        <!-- <button type="submit" value="Submit" name="add_time_table" class="btn btn-primary">Print</button> -->
                                                                                                </center>

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
</script>

<style>
        th {
                text-align: center;
        }
</style>