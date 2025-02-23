<?php
$page_no = "17";
$page_no_inside = "17_2";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
include_once "../../include/function.php";
$msg = '';
$sec_id = $_GET['id'];
$building = fetchResult('hostel_building');
//Get class Name
$row =  fetchRow('hostel_room', '`id`=' . $sec_id . '');
if (isset($_POST['floor_no'])) {
    $result =  updateAll('hostel_room', $_POST, ' id=' . $sec_id . '');
    if ($result == "success") {
        $msg =  success_alert('Data Updated Successfully');
        redirect('hostel/room/view');
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
                        <h1>Room</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Room</li>
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
                        <h3 class="card-title">Edit Room</h3>
                        <?= $msg ?>
                    </div>
                    <form action="" role="form" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="error_section"></div>
                                <div class="col-4">
                                    <label>Select Building</label>
                                    <select type="text" class="form-control form-control-sm" name="building_id" required>
                                        
                                        <?php //while ($building_row = mysqli_fetch_assoc($building)) {
                                             ?>
                                            <option  value="<?= $row['building_id'] ?>"><?= get_building($row['building_id']) ?> </option>
                                        <?php // } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label for="">floor No</label>
                                    <input readonly name="floor_no" class="form-control form-control-sm " type="number"  value="<?= $row['floor_no'] ?>">
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label for="">start Room No</label>
                                    <input name="start" class="form-control form-control-sm  " value="<?= $row['start'] ?>" type="number">
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label for="">end Room No</label>
                                    <input name="end" class="form-control form-control-sm  " value="<?= $row['end'] ?>" type="number">
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label for=""> Total No of Room</label>
                                    <input name="total_room" class="form-control form-control-sm  " value="<?= $row['total_room'] ?>" type="number">
                                </div>
                            </div>
                        </div>
                        <center><button type="submit"  class="btn btn-primary">Submit</button>
                        </center><br>
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