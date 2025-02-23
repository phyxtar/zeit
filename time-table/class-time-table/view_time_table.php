<?php
$page_no = "15";
$page_no_inside = "15_1";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";

$class_id = $_GET['class_id'];
//Get class Name
$row =  fetchRow('tbl_course', '`course_id`=' . $class_id . '');

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
                                                <h3 class="card-title">View Time Table For <b><?= $row['course_name'] ?></b></h3>
                                                <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                                                </div>
                                        </div>
                                        <form action="#" role="form" method="POST">


                                                <!-- /.card-header -->
                                                <div class="row">
                                                        <div class="col-lg-12 grid-margin stretch-card">
                                                                <div class="card">
                                                                        <div class="card-header">
                                                                                <div class="float-sm-right">
                                                                                        <a href="add_time_table.php?class_id=<?= $_GET['class_id'] ?>" class="btn btn-success">Add Time Table</a>
                                                                                </div>
                                                                        </div>
                                                                        <div class="card-body">

                                                                                <div id="demo">
                                                                                        <div class="table-responsive">
                                                                                                <table id="example1" class="table table-bordered table-striped">
                                                                                                        <thead>
                                                                                                                <tr>
                                                                                                                        <th>S No</th>
                                                                                                                        <th>Section</th>
                                                                                                                        <th>Semester</th>
                                                                                                                        <th>Room No</th>
                                                                                                                        <th>Date</th>
                                                                                                                        <th>Start Time</th>
                                                                                                                        <th>No Of Period</th>
                                                                                                                        <th>Break 1 Time Duration</th>
                                                                                                                        <th>Break 2 Time Duration</th>
                                                                                                                        <th>Each Period Break Duration</th>
                                                                                                                        <th>Created</th>
                                                                                                                        <th>Action</th>

                                                                                                                </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                                <?php
                                                                                                                $s_no = 1;

                                                                                                               
                                                                                                                  $sql = "SELECT * FROM `time_table_master`
                                                                                                                  WHERE `class_id` = '$class_id' ORDER BY id DESC";
                                                                                                                  $result = $con->query($sql);

                                                                                                                if ($result->num_rows > 0) {
                                                                                                                        while ($row = $result->fetch_assoc()) {

                                                                                                                ?>

                                                                                                                                <tr>
                                                                                                                                        <td><?php echo $s_no; ?></td>
                                                                                                                                        <td><?php echo $row["section"] ?></td>
                                                                                                                                        <td><?php echo $row["semester"] ?></td>
                                                                                                                                        <td><?php echo $row["room_no"] ?></td>
                                                                                                                                        <td><?php echo $row["date_of_start_time_table"] ?></td>
                                                                                                                                        <td><?php echo $row["start_time"] ?></td>
                                                                                                                                        <td><?php echo $row["no_of_period"] ?></td>
                                                                                                                                        <td><?php echo $row["break1_time"] ?></td>
                                                                                                                                        <td><?php echo $row["break2_time"] ?></td>
                                                                                                                                        <td><?php echo $row["each_period_break_duration"] ?></td>
                                                                                                                                        <td><?php echo $row["doc"] ?></td>
                                                                                                                                        <td class="project-actions text-center">
                                                                                                                                        <a href="viewtimetable.php?class_id=<?= $_GET['class_id'] ?>&master_id=<?= $row['id'] ?>&sec=<?= $row['section'] ?>&sem=<?= $row['semester'] ?>&rno=<?= $row['room_no'] ?>&date=<?= $row['date_of_start_time_table']?>" class="btn btn-success btn-sm" title="Time Table View"><i class="fa fa-eye"></i></a>
                                                                                                                                        <a href="edit_time_table.php?class_id=<?= $_GET['class_id'] ?>&master_id=<?= $row['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                                                                                                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>



                                                                                                                                        </td>


                                                                                                                                </tr>

                                                                                                                <?php
                                                                                                                                $s_no++;
                                                                                                                        }
                                                                                                                } ?>

                                                                                                        </tbody>
                                                                                                </table>

                                                                                        </div>
                                                                                </div>

                                                                        </div>
                                                                </div>
                                                        </div>


                                                </div>
                                        </form>
                                        <!-- /.card-body -->


                                </div>

                        </div>
                </section>
                <!-- /.content -->


        </div>



        <?php include "../include/foot.php" ?>