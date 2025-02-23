<?php
$page_no = "17";
$page_no_inside = "17_1";
include_once  "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
$msg = '';
?>

<div class="main-panel">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Building Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Building Management</li>
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
                        <h3 class="card-title">Building</b></h3>

                    </div>
                    <form action="#" role="form" method="POST">


                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-sm-right">
                                            <a href="add" class="btn btn-success">Add Building</a>
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
                                                            <th>Name</th>
                                                            <th>Code</th>
                                                            <th> No. of Floor</th>
                                                            <th>Short Name</th>
                                                            <th>Address</th>
                                                            <th>Created At</th>
                                                            <th>Updated At</th>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $s_no = 1;
                                                        $sql = "SELECT * FROM `hostel_building`";
                                                        $result = $con->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {


                                                        ?>

                                                                <tr>
                                                                    <td><?php echo $s_no; ?></td>
                                                                    <td><?php echo $row["name"] ?></td>
                                                                    <td><?php echo $row["building_code"] ?></td>
                                                                    <td><?php echo $row["floar"] ?></td>
                                                                    <td><?php echo $row["short_name"] ?></td>
                                                                    <td><?php echo $row["address"] ?></td>
                                                                    <td><?php echo $row["created_at"] ?></td>
                                                                    <td><?php echo $row["updated_at"] ?></td>

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
        <!-- /.content --
        </div>
        <?php include "../include/foot.php" ?>