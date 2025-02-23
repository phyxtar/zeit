<?php
if ($_GET["action"] == "fetch_student_list") {
    include_once "../framwork/ajax/method.php";
    $course_id = $_POST["course_id"];
    $semester_id = $_POST["semester_id"];
    $academic_year = $_POST["academic_year"];
    $subject_id = $_POST["subject_id"];
    $spec = $_POST["spec"];
    $admin_id = $_SESSION['admin_id'];
    ?>

<div class="card-header card-warning">

    <form method="POST" action="exportcsv_new">
        <input type="hidden" name="course_id" value="<?= $course_id; ?>" />
        <input type="hidden" name="academic_year" value="<?= $academic_year; ?>" />
        <input type="hidden" name="semester_id_name" value="<?= $semester_id; ?>" />
        <button type="submit" name="export" class="btn btn-info"> Export </button>
    </form>
    <br>
    <br>
</div>

<table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
    <thead>
        <tr>
            <th width="10%">S.No</th>
            <th width="20%">Subject Name</th>
            <th width="20%">Subject Code</th>
            <th width="20%">Exam Date</th>
            <th width="10%">Total Marks</th>
            <th width="10%">Pass Marks</th>
            <th width="10%">Credit</th>
            <th colspan="3" class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
            //$subject_id = $_POST["subject_id"];                        
            $sql = "SELECT * FROM `tbl_subjects` WHERE `status` = '$visible' && course_id = '$course_id' && semester_id = '$semester_id' && fee_academic_year = '$academic_year' && (specialization_id = '$spec' OR COALESCE(specialization_id, '') = '') ORDER BY `subject_id` ASC ";
            $row = $con->query($sql);
            while ($row_course = $row->fetch_assoc()) {
                ?>
        <tr>
            <td><?= $s_no; ?></td>
            <td><?= $row_course["subject_name"] ?></td>
            <td><?= $row_course["subject_code"] ?></td>
            <td><?= $row_course["date_of_examination"] ?></td>
            <td><?= $row_course["full_marks"] ?></td>
            <td><?= $row_course["pass_marks"] ?></td>
            <td><?= $row_course["credit"] ?></td>
            <?php
            $admin_id = $_SESSION['admin_id'];
            if ($admin_id == 94 || $admin_id == 1) {
            ?>
            <td align="center"><a class="btn btn-success btn-sm"
                    href="enter_marks?course_id=<?= $course_id ?>&semester_id=<?= $semester_id ?>&session_id=<?= $academic_year ?>&subject_id=<?= $row_course["subject_id"] ?>">Enter
                    Marks <i class="fas fa-sign-in-alt"></i></a></td>
            <?php
            }
            ?>
            <td align="center"><button
                    onclick="editForm('<?= url('include/controller/Edit/add_marks') ?>',<?= $row_course['subject_id'] ?>,'edit_form')"
                    type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                    <i class="fas fa-edit"></i>
                </button></td>
            <td align="center"><button id="success<?= $s_no ?>"
                    onclick="deleteForm('<?= url('pages/subjects/delete') ?>',<?= $row_course['subject_id'] ?>,'success<?= $s_no ?>')"
                    type="button" class="btn btn-danger btn-sm">
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
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

}

?>