<?php
$page_no = "17";
$page_no_inside = "17_0";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
include_once "../../include/function.php";
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
                        <h1>Hotel Join Date Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Hotel Join Date Management</li>
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
                        <h3 class="card-title">Hotel Join Date</b></h3>

                    </div>
                    <form action="#" role="form" method="POST">


                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-sm-right">
                                            <a class="btn btn-info " href="export?export='export'">Export</a>
                                            <a href="add.php" class="btn btn-success">Add Hotel Join Date</a>
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
                                                            <th>Year </th>
                                                            <th>Date</th>
                                                            <th>Created At </th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $s_no = 1;
                                                        $sql = "SELECT * FROM `hostel_join_date`";
                                                        $result = $con->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $s_no; ?></td>
                                                                    <td><?= $row['year'] ?></td>
                                                                    <td><?= date('d-M-Y', strtotime($row['date'])) ?></td>
                                                                    <td><?= $row['created_at'] ?></td>
                                                                    <td class="project-actions text-center">
                                                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
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