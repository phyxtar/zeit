<?php
$page_no = "17";
$page_no_inside = "17_2";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
//include __DIR__ . "../../../framwork/main.php";
$msg = '';
$sec_id = $_GET['id'];

//Get class Name
$row =  fetchRow('hostel_join_date', '`id`=' . $sec_id . '');


if (isset($_POST['date'])) {


    $result =  updateAll('hostel_join_date', $_POST, ' id=' . $_POST['id'] . '');

    if ($result == "success") {
        $msg =  success_alert('Data Updated Successfully');
        redirect('hostel/join_date/view');
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
                        <h1>Hotel Join Date</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Hotel Join Date</li>
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
                        <h3 class="card-title">Edit Hotel Join Date</h3>
                        <?= $msg ?>
                    </div>
                    <form action="" role="form" method="POST" enctype="multipart/form-data">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" id="error_section"></div>
                                <input type="hidden" name="id" value="<?= $sec_id; ?>">
                                <div class="col-4">
                                    <label>Select Year</label>
                                    <select class="form-control" name="year" required>
                                        <option value="<?= $row['year'] ?>"> <?= $row['year'] ?> </option>
                                        <?php for ($i = date('Y'); $i >= 2008; $i--) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label>Select Date</label>
                                    <input value="<?= $row['date'] ?>" type="date" class="form-control" name="date">
                                </div>

                            </div>
                        </div>
                        <center><input type="submit" value="Update" class="btn btn-primary"></center><br>
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