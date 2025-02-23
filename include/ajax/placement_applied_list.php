<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
//Fetching Precious Fees Due Dates Start
if ($_GET["action"] == "fetch_fees") {
    $academic_year = $_POST["academic_year"];
    $course_id = $_POST["course_id"];
    
    // echo $academic_year;

    $sql_course = "SELECT * FROM tbl_course
    WHERE status = '$visible' and course_id ='$course_id' ";
    
    $result_course = $con->query($sql_course);
            // $res =  mysqli_fetch_assoc( $result_course);
            $res =  $result_course -> fetch_assoc();
            // echo $res['course_name'];
     

            $sql_course1 = "SELECT * FROM tbl_university_details
    WHERE status = '$visible' and university_details_id =$academic_year ";
      $result_course1 = $con->query($sql_course1);
      $res1 =  $result_course1 -> fetch_assoc();
    //   echo $res1['academic_session'];

    // echo $res;
    // print_r($res);
    // print_r($result_course);
// exit;
    // echo  $course_id;
    // echo $data;

    // print_r($_POST);
    // exit;

    $s_no = 1;
?>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Student Name</th>
                <th>Course Name</th>
                <th>Session</th>
                <th>Company Name</th>
                <th>Job title</th>
                <th>Apply Date</th>
                <!-- <th class="project-actions text-center">Action </th> -->
            </tr>
        </thead>
        <tbody>
            <?php 
            if(isset($course_id)){
            $sql = "SELECT * FROM `tbl_placement_applied`
                                WHERE  `std_session` = '{$res1['academic_session']}' && `std_course`= '{$res['course_name']}'
                                ORDER BY `std_course` ASC
                                ";
            }else{
                $sql = "SELECT * FROM `tbl_placement_applied`
                WHERE `status` = '$visible' 
                ORDER BY `id` ASC
                ";
            }
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $s_no; ?></td>
                        <?php
                      

                        ?>
                        <td><?php echo $row["std_name"]; ?></td>
                        <td><?php echo $row["std_course"]; ?></td>
                        <td><?php echo $row["std_session"] ?></td>
                        <td><?php echo $row["company_name"] ?></td>
                        <td><?php echo $row["job_type"] ?></td>
                        <td><?php echo $row["add_time"] ?></td>
                        
                    </tr>
            <?php
                    $s_no++;
                }
                include_once "../../framwork/ajax/method.php";
            } else
                echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
            ?>
        </tbody>
    </table>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
<?php
} ?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <header class="container" style="background:#343a40; color:white;">
                <button type="button" class="close pt-2 p-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 align="center">Edit Fees Details</h2>
            </header>

            <div class="modal-body" id="edit_form">
            </div>

        </div>
    </div>
</div>
