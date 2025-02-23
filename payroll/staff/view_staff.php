<?php
$page_no = "16";
$page_no_inside = "16_2";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
$msg = '';


//$class_id = $_GET['class_id'];
//Get class Name
//$row =  fetchRow('tbl_course', '`course_id`=' . $class_id . '');

?>

<div class="main-panel">
        <div class="content-wrapper">
                <section class="content-header">
                        <div class="container-fluid">
                                <div class="row mb-2">
                                        <div class="col-sm-6">
                                                <h1>Employee Management</h1>
                                        </div>
                                        <div class="col-sm-6">
                                                <ol class="breadcrumb float-sm-right">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active">Employee Management</li>
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
                                                <h3 class="card-title">Employee</b></h3>
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
                                                                                        <a href="add_staff.php" class="btn btn-success">Add Employee</a>
                                                                                </div>
                                                                                <?= $msg ?>

                                                                        </div>
                                                                        <div class="card-body">

                                                                                <div id="demo">
                                                                                        <div class="table-responsive">
                                                                                                <table id="example1" class="table table-bordered table-striped">
                                                                                                        <thead>
                                                                                                                <tr>

                                                                                                                        <th>S No</th>
                                                                                                                        <th>Course Name</th>
                                                                                                                        <th>Employee Type</th>
                                                                                                                        <th>Name</th>
                                                                                                                        <th>Email</th>
                                                                                                                        <th>Phone No.</th>
                                                                                                                        <th>Adhar No</th>
                                                                                                                        <th>Pan No</th>
                                                                                                                        <!--<th>Image</th> -->
                                                                                                                        <th>Created</th>
                                                                                                                        <th>Action</th>

                                                                                                                </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                                <?php
                                                                                                                $s_no = 1;


                                                                                                                $sql = "SELECT * FROM `tbl_staff`";
                                                                                                                $result = $con->query($sql);

                                                                                                                if ($result->num_rows > 0) {
                                                                                                                        while ($row = $result->fetch_assoc()) {
                                                                                                                                $course_id =  $row["course_id"];
                                                                                                                                $child_data1 = fetchResult('tbl_course', 'course_id=' . $course_id . '');
                                                                                                                                $row_child1 = mysqli_fetch_array($child_data1);


                                                                                                                                $desg_id =  $row["desg_id"];
                                                                                                                                $desg_data = fetchResult('tbl_designation', 'id=' . $desg_id . '');
                                                                                                                                $row_desg = mysqli_fetch_array($desg_data);



                                                                                                                ?>

                                                                                                                                <tr>
                                                                                                                                        <td><?php echo $s_no; ?></td>
                                                                                                                                        <?php if (!empty($row_child1)) { ?>
                                                                                                                                                <td><?php echo $row_child1["course_name"] ?></td>
                                                                                                                                        <?php } else { ?>
                                                                                                                                                <td></td>

                                                                                                                                        <?php  } ?>

                                                                                                                                        <?php if (!empty($row_desg)) { ?>
                                                                                                                                                <td><?php echo $row_desg["designation"] ?></td>
                                                                                                                                        <?php } else { ?>
                                                                                                                                                <td></td>

                                                                                                                                        <?php  } ?>
                                                                                                                                        <td><?php echo $row["name"] ?></td>
                                                                                                                                        <td><?php echo $row["email"] ?></td>
                                                                                                                                        <td><?php echo $row["phone"] ?></td>
                                                                                                                                        <td><?php echo $row["adhar_no"] ?></td>
                                                                                                                                        <td><?php echo $row["pan_no"] ?></td>
                                                                                                                                        <!-- <td><?php //echo $row["each_period_break_duration"] 
                                                                                                                                                        ?></td> -->
                                                                                                                                        <td><?php echo $row["created_at"] ?></td>
                                                                                                                                        <td class="project-actions text-center">
                                                                                                                                                <a href="edit_staff.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
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
