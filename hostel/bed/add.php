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
                        <h1>Bed</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Bed</li>
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
                        <h3 class="card-title">Add Bed</h3>
                        <?= $msg ?>
                    </div>
                    <form id="form_id" role="form" method="POST" enctype="multipart/form-data">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="error_section"></div>

                                <div class="col-4">
                                    <label>Select Building</label>
                                    <select type="text" class="form-control" name="building_id" onchange="ajaxCall('form_id', 'get_floor', 'floor')" required>
                                        <option selected disabled> -Select Building- </option>
                                        <?php while ($building_row = mysqli_fetch_assoc($building)) { ?>
                                            <option value="<?= $building_row['id'] ?>"><?= $building_row['name'] ?> - <?= $building_row['building_code'] ?> - <?= $building_row['floar'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label>Select floor</label>
                                    <select type="text" onchange="ajaxCall('form_id', 'get_room', 'success')" class="form-control" name="floor_no" id="floor"  required>
                                        <option selected disabled> -Select floor- </option>
                                       
                                    </select>
                                </div>

                                <span id="success" class="col-12 card mt-3">

                                </span>
                            </div>
                        </div>
                        <center><button type="button" onclick="ajaxCall('form_id', 'add_bed', 'error_section')" class="btn btn-primary">Add Bed </button>
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