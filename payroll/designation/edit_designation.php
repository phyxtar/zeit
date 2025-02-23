<?php
$page_no = "16";
$page_no_inside = "16_1";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
//include __DIR__ . "../../../framwork/main.php";
$msg = '';
$desg_id = $_GET['id'];

//Get class Name
$row =  fetchRow('tbl_designation', '`id`=' . $desg_id . '');



if (isset($_POST['submit'])) {
       
        $desg_data = array();
        $desg_data['id'] = $_POST['id'];
        $desg_data['designation'] = $_POST['designation'];
        
        $result =  updateAll('tbl_designation', $desg_data, ' id=' . $_POST['id'] . '');
        
        if ($result == "success") {
                $msg =  success_alert('Data Updated Successfully');
                echo "<script> window.location.href = 'view_designation.php';</script>";

                
        } else {
                echo $msg = danger_alert($conn->error);
        }
    }

?>



<div class="main-panel">
        <div class="content-wrapper">
                <section class="content-header">
                        <div class="container-fluid">
                                <div class="row mb-2">
                                        <div class="col-sm-6">
                                                <h1>Staff Category</h1>
                                        </div>

                                        <div class="col-sm-6">
                                                <ol class="breadcrumb float-sm-right">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active">Edit Staff Category</li>
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
                                                <h3 class="card-title">Edit Staff Category</h3>
                                                <?= $msg ?>
                                        </div>
                                        <form action="" role="form" method="POST" enctype="multipart/form-data">

                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-md-12" id="error_section"></div>
                                                                <input type="hidden" name="id" value="<?= $desg_id; ?>">

                                                               
                                                                <div class="col-4">
                                                                        <label>Staff Category</label>
                                                                        <input type="text" class="form-control" name="designation" value="<?= $row['designation'] ?>">
                                                                </div>

                                                                



                                                        </div>
                                                </div>
                               

                        <center><input type="submit" name="submit" value="Update" class="btn btn-primary"></center><br>
 
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