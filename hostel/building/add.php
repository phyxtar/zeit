<?php
$page_no = "17";
$page_no_inside = "17_1";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
$msg = '';


if (isset($_POST['name'])) {

    $result =  insertAll('hostel_building', $_POST);
    if ($result == "success") {
        $msg =  success_alert('Data Added Successfully');
        echo "<script> window.location.href = 'view.php';</script>";
        //reload(1);
    } else {
        $msg = danger_alert($conn->error);
    }
}

?>

<div class="main-panel">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Building</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Building</li>
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
                        <h3 class="card-title">Add Building</h3>
                        <?= $msg ?>
                    </div>
                    <form action="" role="form" method="POST" enctype="multipart/form-data">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="error_section"></div>

                                <div class="col-4">
                                    <label>Building Name</label>
                                    <input placeholder="Enter building Name" type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-4">
                                    <label>building code</label>
                                    <input placeholder="Enter Building Code" type="text" class="form-control" name="building_code" required>
                                </div>
                                <div class="col-2">
                                    <label>short name</label>
                                    <input placeholder="Enter Short Name of the Building" type="text" class="form-control" name="short_name">
                                </div>
                                <div class="col-2">
                                    <label>No of Floor</label>
                                    <input placeholder="Enter Short Name of the Building" type="number" class="form-control" name="floar" min="1">
                                </div>
                                <div class="col-12">
                                    <label>Address</label>
                                    <textarea placeholder="Enter Full Address of the Building" type="text" class="form-control" name="address" required></textarea>
                                </div>


                            </div>
                        </div>
                        <center>
                            <button type="submit"  class="btn btn-primary"> Add Building </button>
                        </center><br>

                </div>

            </div>

            </form>
            <div class="col-md-12">
                <div id="loader_section"></div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>





<!-- /.card-header -->





<?php include "../include/foot.php" ?>