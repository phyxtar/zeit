<?php

$data = array();
include_once "../include/authentication.php";
include_once "../include/config.php";
if (isset($_POST['submit'])) {



    //get data
    $qr = "SELECT * FROM `time_table_child` WHERE `start_time` LIKE '%$start_time%' && `date` = '" . $select_date . "' &&  `course_id` = '" . $course_id . "' ";

    $result = mysqli_query($con, $qr);
    $row =  mysqli_fetch_array($result);
    $alloted_staff_id = $row['staff_id'];
}

?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card table-responsive">
        <div class="card">
            <div class="card-body">

                <div id="demo">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Teachers Name</th>
                                    <th>Course</th>
                                    <th>Session</th>
                                    <th>Semester</th>
                                    <th>time</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql_staff = "SELECT * FROM `tbl_staff` WHERE `desg_id` = '1' && `course_id`= '" . $row['course_id'] . "' && `id` != '$alloted_staff_id'";
                                $res = $con->query($sql_staff);
                                while ($child_row = mysqli_fetch_array($res)) {
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
    </div>
</div>