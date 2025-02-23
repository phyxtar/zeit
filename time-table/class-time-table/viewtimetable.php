<style>
    .card-header p {
        margin-bottom: 0px;
    }
</style>

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
                            <div class="col-3">
                                <h4 class="text-center">
                                    <img src="<?= url('images/logo.png') ?>" width="90%" alt="Image" border="0" title="Images" style="margin-top:5px;-webkit-filter: drop-shadow(5px 5px 5px #222 ); filter: drop-shadow(5px 5px 5px #222);">
                                </h4>
                            </div>
                            <div class="col-7">
                                <div class="text-center mt-5" style="font-family: Times New Roman;">
                                    <h1 class="text-bold">NETAJI SUBHAS UNIVERSITY</h1>
                                    <p>POKHARI, P.O : BHILAI PAHARI, P.S : M.G.M Dist : EAST SINGHBHUM,<br /> JAMSHEDPUR - 831012 Jharkhand. Contact - (+91) 9835203429 </p>
                                </div>
                            </div>
                            <div class="col-2 pt-1">
                                <h4>
                                    <small class="float-right">Date: <?php echo date('d/m/Y', strtotime($routinedate)); ?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>



                        <div class="row">
                            <div class="col-7" style="font-family: Times New Roman;">
                                <h4 class="text-center">
                                    <h4 class="text-bold">Time Table For <b><?= $row['course_name'] ?></h4>
                                    <!-- <p><b>Date - <? //= date('d/m/Y',strtotime($routinedate)) 
                                                        ?></b></p> -->
                                    <p style="font-family: Times New Roman;"><b>Section - <b><?= $section ?></b></p>
                                    <p style="font-family: Times New Roman;"><b>Semester -<b><?= fetchRow('tbl_semester', 'semester_id=' . $sem . '')['semester'] ?></b></p>
                                    <p style="font-family: Times New Roman;"><b>Room no - <b><?= $roomno ?></b></p>

                                </h4>
                            </div>
                            <!-- <div class="col-3">
                                <div class="text-center mt-5" style="font-family: Times New Roman;">
                                     
                                </div>
                            </div>  -->

                            <!-- /.col -->
                        </div>

                        <?= $msg ?>
                    </div>
                    <form action="" role="form" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="error_section"></div>
                                <input type="hidden" name="id" value="<?= $_GET['master_id']; ?>">

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card table-responsive">
                                <div class="card">
                                    <div class="card-body">

                                        <div id="demo">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
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

<script>
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