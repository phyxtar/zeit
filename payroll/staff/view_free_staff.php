<?php
$page_no = "16";
$page_no_inside = "16_3";

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

if (isset($_POST['submit'])) {

        //      echo "<pre>";
        //         print_r($_POST);
        $course_id = $_POST['course_id'];
        $select_date = date("Y-m-d", strtotime($_POST['date_of_start_time_table']));
        $start_time = $_POST['start_time'];

        //get data
        $qr = "SELECT * FROM `time_table_child` WHERE `start_time` LIKE '%$start_time%' && `date` = '" . $select_date . "' &&  `course_id` = '" . $course_id . "' ";

        $result = mysqli_query($con, $qr);
        $row =  mysqli_fetch_array($result);
        $alloted_staff_id = $row['staff_id'];


        $sql_staff = "SELECT * FROM `tbl_staff` WHERE `desg_id` = '1' && `course_id`= '" . $row['course_id'] . "' && `id` != '$alloted_staff_id'";
        $res = $con->query($sql_staff);
        while ($staff_row = $res->fetch_assoc()) {

                echo "<pre>";
                print_r($staff_row);
        }


        // echo "<pre>";
        // print_r($row);




}

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



                                                <?= $msg ?>
                                        </div>
                                        <form action="" role="form" method="POST">
                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-md-12" id="error_section"></div>
                                                                <?php
                                                                //$child_data1 = fetchResult('time_table_update');
                                                                // $row_child1 = mysqli_fetch_array($child_data1);

                                                                ?>

                                                                <!-- <div class="col-4">
                                                                        <label>Select Course</label>
                                                                        <select name="course_id" class="form-control" required>
                                                                                <option value="">Select Course</option>
                                                                                <?php
                                                                                //$sql = "SELECT * FROM `tbl_course`";
                                                                                //$result = $con->query($sql);
                                                                                //while ($course_row = $result->fetch_assoc()) { 
                                                                                ?>
                                                                                        <option value="<? //= $course_row['course_id'] 
                                                                                                        ?>"><? //= $course_row['course_name'] 
                                                                                                                ?></option>

                                                                                <?php //} 
                                                                                ?>
                                                                        </select>
                                                                </div> -->



                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Select Date</label>
                                                                                <input type="text" id="date" class="form-control" name="date_of_start_time_table" value="">
                                                                        </div>
                                                                </div>

                                                                <!-- <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label>Select Time</label>
                                                                                <input type="time" id="time" class="form-control" name="start_time" value="">
                                                                        </div>
                                                                </div> -->

                                                                <div class="col-md-3">
                                                                        <div class="form-group">
                                                                                <label></label><br>
                                                                                <input type="submit" name="submit" value="Submit" class="btn btn-primary" style="margin-top:20px;">
                                                                        </div>
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
                                                                                              
                                                                                                <table id="example" class="table table-bordered table-striped">
                                                                                                        <thead>
                                                                                                                <tr>
                                                                                                                        <th>Period&rarr;<br><span>&#92;</span>Days&darr;</th>
                                                                                                                        <?php

                                                                                                                        // $time = $datastart_time'];
                                                                                                                        for ($i = 1; $i <= 4; $i++) { ?>
                                                                                                                                <th><?= $i ?><br>

                                                                                                                                        <!-- <input type="hidden" name="class_start_time[]" value="<?= $time1 . "-" . $time ?>"> -->

                                                                                                                                </th>


                                                                                                                        <?php } ?>

                                                                                                                </tr>
                                                                                                        </thead>
                                                                                                        <tbody>

                                                                                                                <?php
                                                                                                                //$staff_inc = 0;
                                                                                                                $child_data = fetchResult('time_table_child', 'master_id=' . 27 . ' GROUP BY `date` ');
                                                                                                                // $child_data1 = fetchResult('time_table_child', 'master_id=' . $masterid . '');

                                                                                                                while ($child_row = mysqli_fetch_array($child_data)) {

                                                                                                                ?>

                                                                                                                        <tr>
                                                                                                                                <td>
                                                                                                                                        <!-- <input type="hidden" value="<?= $child_row['date'] ?>" name="date[]"> -->
                                                                                                                                        <!-- <strong> <?= date('D', strtotime($child_row['date'])) ?></strong> -->
                                                                                                                                </td>
                                                                                                                                <td> </td>
                                                                                                                                <td> </td>
                                                                                                                                <td> </td>
                                                                                                                                <td> </td>


                                                                                                                        </tr>
                                                                                                                <?php } ?>

                                                                                                        </tbody>
                                                                                                </table>


                                                                                                <center>
                                                                                                        <input id="printpagebutton" type="button" class="btn btn-primary" value="Print" onclick="printpage()" />

                                                                                                </center>

                                                                                        </div>
                                                                                </div>

                                                                        </div>
                                                                </div>
                                                                <!-- </div>
                                        </form> -->


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