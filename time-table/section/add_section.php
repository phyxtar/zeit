<?php
$page_no = "15";
$page_no_inside = "15_2";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
//include_once __DIR__ . "../../../framwork/main.php";
$msg = '';




if (isset($_POST['submit'])) {

//    echo "<pre>";
//    print_r($_POST); 
   $data = array();
   $data['section'] = $_POST['section'];
   $result =  insertAll('tbl_section', $data);
   if ($result == "success") {
    $msg =  success_alert('Data Added Successfully');
    echo "<script> window.location.href = 'view_section.php';</script>";
     //reload(1);
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
                                                <h1>Section</h1>
                                        </div>

                                        <div class="col-sm-6">
                                                <ol class="breadcrumb float-sm-right">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active">Section</li>
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
                                                <h3 class="card-title">Add Section</h3>
                                                <?= $msg ?>
                                        </div>
                                        <form action="" role="form" method="POST" enctype="multipart/form-data">

                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-md-12" id="error_section"></div>

                                                                


                                                                <div class="col-4">
                                                                        <label>Section</label>
                                                                        <input type="text" class="form-control" name="section" required>
                                                                </div>

                                                        </div>
                                                </div>
                                                <center><input type="submit" name="submit" value="Add" class="btn btn-primary"></center><br>

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