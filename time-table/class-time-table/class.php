<?php
$page_no = "15";
$page_no_inside = "15_1";
include "../include/authentication.php";
include "../include/head.php";
include_once "../include/config.php";



if (isset($_SESSION['massage'])) {
    echo $_SESSION['massage'];
    unset($_SESSION['massage']);
}
?>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Course</h3>
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Home </a></li>
                    <li class="breadcrumb-item active"> Course </li>
                </ol>
            </nav> -->
        </div>
        <!-- Button trigger modal -->
        <?php //include 'insert.php'; 
        ?>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div id="demo">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Course</th>
                                            <th class="project-actions text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s_no = 1;
                                        $sql = "SELECT * FROM `tbl_course`";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>


                                                <tr>
                                                    <td><?php echo $s_no; ?></td>
                                                    <td><?php echo $row["course_name"] ?></td>

                                                    <td class="project-actions text-center">
                                                        
                                                        <a href="view_time_table.php?class_id=<?php echo $row['course_id']; ?>" class="btn btn-success">Create Time Table</a>

                                                       
                                                    </td>


                                                </tr>

                                        <?php
                                                $s_no++;
                                            }
                                        } else {
                                            echo '
                                              <div class="alert alert-warning alert-dismissible">
                                                <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                                 </div>';
                                        }

                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<?php include "../include/foot.php" ?>