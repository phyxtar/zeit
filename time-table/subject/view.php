<?php
if ($_GET["action"] == "fetch_student_list") {
    include_once "../../framwork/main.php";
    include_once "../include/config.php";
    include_once "../../include/function.php";
    $course_id = $_POST["course_id"];
    $semester_id = $_POST["semester_id"];
    $academic_year = $_POST["academic_year"];
    $id = $_POST["subject_id"];
    $s_no = 1;
?>
    <table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
        <thead>
            <tr>
                <th width="10%">S.No</th>
                <th>Course </th>
                <th>Session</th>
                <th width="20%">Subject Name</th>
                <th width="20%">Subject Code</th>
                <th colspan="2" width="5%" class="project-actions text-center">Action </th>
            </tr>
        </thead>
        <tbody>
            <?php
            //$id = $_POST["subject_id"];
            $sql = "SELECT * FROM `time_tbl_subject` WHERE  course_id = '$course_id' && semester_id = '$semester_id' && fee_academic_year = '$academic_year' ORDER BY `id` DESC ";
            $row = $con->query($sql);
            while ($row_course = $row->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $s_no; ?></td>
                    <td><?= get_course($row_course["course_id"]) ?></td>
                    <td><?= get_session($row_course["fee_academic_year"]) ?></td>
                    <td><?= $row_course["subject_name"] ?></td>
                    <td><?= $row_course["subject_code"] ?></td>

                    <td align="center"><button onclick="editForm('<?= url('time-table/subject/edit_subject') ?>','<?= $row_course['id'] ?>','edit_form')" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-edit"></i>
                        </button></td>
                    <td align="center"><button id="success<?= $s_no ?>" onclick="deleteForm('<?= url('time-table/subject/delete') ?>',<?= $row_course['id'] ?>,'success<?= $s_no ?>')" type="button" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button></td>

                </tr>
            <?php
                $s_no++;
            }
            ?>
        </tbody>
    </table>

    <!-- Button trigger modal -->

    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Class Subject Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edit_form">
                </div>

            </div>
        </div>
    </div>

<?php
    include_once "../../framwork/ajax/method.php";
}

?>