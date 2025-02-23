<?php
$page_no = "17";
$page_no_inside = "17_3";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
//include_once __DIR__ . "../../../framwork/main.php";
$msg = '';



$building = fetchResult('hostel_building');
?>

<div class="main-panel">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hotel Join Date</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Hotel Join Date</li>
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
                        <h3 class="card-title">Add Hotel Join Date</h3>
                        <?= $msg ?>
                    </div>
                    <form id="form_id" role="form" method="POST" enctype="multipart/form-data">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="error_section"></div>

                                <div class="col-4">
                                    <label>Select Year</label>
                                    <select  class="form-control" name="year"  required>
                                        <option selected disabled> -Select Year- </option>
                                        <?php for ($i = date('Y'); $i >= 2008; $i--) { ?>
                                            <option value="<?= $i?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label>Select Date</label>
                                   <input type="date" class="form-control" name="date">
                                </div>

                                <span id="success" class="col-12 card mt-3">

                                </span>
                            </div>
                        </div>
                        <center>
                        <a href="view" class="btn btn-secondary"> Back To View</a>    
                        <button type="button" onclick="ajaxCall('form_id', 'add_bed', 'error_section')" class="btn btn-primary">Add Hotel Join Date </button>
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

<?php
include_once "../../framwork/ajax/method.php";
include "../include/foot.php" ?>