<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
//Fetching Precious Fees Due Dates Start
if ($_GET["action"] == "fetch_fees") {
    $data = $_POST["data"];
    $course_id = $_POST["course_id"];
    
    $s_no = 1;
?>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Course Name</th>
                <th>Particulars</th>
                <th>Amount</th>
                <th>Fine</th>
                <th>Fee Last Date</th>
                <th>Status</th>
                <th class="project-actions text-center">Action </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($course_id) && $course_id>0){
            $sql = "SELECT * FROM `tbl_fee`
                                WHERE `status` = '$visible' && `fee_academic_year` = '$data' && `course_id`='$course_id'
                                ORDER BY `course_id` ASC
                                ";
            }else{
                $sql = "SELECT * FROM `tbl_fee`
                WHERE `status` = '$visible' && `fee_academic_year` = '$data' 
                ORDER BY `course_id` ASC
                ";  
            }
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $s_no; ?></td>
                        <?php
                        $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();
                        ?>
                        <td><?php echo $row_course["course_name"]; ?></td>
                        <td><?php echo $row["fee_particulars"] ?></td>
                        <td><?php echo $row["fee_amount"] ?></td>
                        <td><?php echo $row["fee_fine"] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($row["fee_lastdate"])) ?></td>
                        <td>

                            <button id="success<?= $s_no ?>" class="btn  <?php if ($row["fee_astatus"] == "Active") echo "btn-success";
                                                                            else echo "btn-warning" ?> btn-sm"><span id="loader_id<?php echo $row["fee_id"]; ?> btn-sm" onclick="changeStatus('<?= url('pages/fee/status') ?>', '<?= $row['fee_id'] ?>', 'success<?= $s_no ?>')">
                                    <?php echo  $row["fee_astatus"] ?>
                            </button>
                        </td>
                        <td class="project-actions text-center">
                            <button onclick="editForm('<?= url('pages/fee/edit') ?>',<?= $row['fee_id'] ?>,'edit_form')" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button id="success<?= $s_no ?>" class="btn btn-danger btn-sm" onclick="deleteForm('<?= url('pages/fee/delete') ?>', '<?= $row['fee_id'] ?>', 'success<?= $s_no ?>')">
                                <i class="fas fa-trash">
                                </i>
                            </button>
                        </td>


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
