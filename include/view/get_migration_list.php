<?php
if ($_GET["action"] == "get_migration_list") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $migration_id = $_POST["migration_id"];
    ?>
<div class="row">
    <div class="col-2">
        <form method="POST" action="export-exam">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
            <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
            <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>" />
            <button type="submit" name="export" class="btn btn-info btn-sm rounded-pill"> Export to CSV </button>
        </form>
    </div>
    <div class="col-2">
        <form method="POST" action="exam_form_print">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
            <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
            <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>" />
            <button type="submit" class="btn btn-lg btn-warning rounded-pill btn-sm">Print All</button>
        </form>
    </div>
</div>
</div>
<form method="POST" action="approve-examform" class='mt-5'>
    <div style="margin-bottom: 20px;">
        <input type="submit" name="approvedAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Approved Selected">
        <input type="submit" name="disapprovedAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Dispproved Selected">
    </div>
    <table id="example1" class="table table-bordered table-striped table-responsive  " style="overflow-x:auto;">
        <!-- <table id="dtHorizontalExample" class="table table-bordered table-striped">-->
        <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" id="selectall" />
                </th>
                <th>S.No</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Registration No</th>
                <th>Roll No</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Department</th>
                <th>Paid Amount</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_migration_form` WHERE `status` = '$visible' &&
                                `academic_year` = '$academic_year' && `course_id` = '$course_id' && `migration_id`='$semester_id' && `amount`>0
                                ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="name" name="chkl[]" value="<?= $row["exam_id"] ?>" />
                </td>
                <td>
                    <?php echo $s_no; ?>
                </td>
                <?php
                        $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();
                        ?>
                <td>
                    <?php echo $row_course["course_name"]; ?>
                </td>
                <?php
                        $sql_sem = "SELECT * FROM `tbl_semester`
                                                       WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                                                       ";
                        $result_sem = $con->query($sql_sem);
                        $row_sem = $result_sem->fetch_assoc();
                        ?>
                <td>
                    <?php echo $row_sem["semester"]; ?>
                </td>
                <td>
                    <?php echo $row["registration_no"]; ?>
                </td>
                <td>
                    <?php echo $row["roll_no"]; ?>
                </td>
                <td>
                    <?php echo $row["candidate_name"]; ?>
                </td>
                <td>
                    <?php echo $row["father_name"]; ?>
                </td>
                <td>
                    <?php echo $row["department"]; ?>
                </td>
                <td>
                    <?php echo $row["amount"]; ?>
                </td>
                <td>
                    <?php echo $row["create_time"]; ?>
                </td>
                <td>
                    <?php if ($row["verified_by"] == 'Verified'): ?>
                    <span class="badge badge-success"><?php echo $row["verified_by"]; ?></span>
                    <?php else: ?>
                    <span class="badge badge-danger"><?php echo $row["verified_by"]; ?></span>
                    <?php endif; ?>
                </td>
                <td class="project-actions text-center">
                    <a class="btn btn-info btn-sm" id="see-button-<?= $row["exam_id"] ?>">
                        <i class="fas fa-eye">
                        </i>
                    </a>
                </td>
</form>
<SCRIPT language="javascript">
$(function() {
    // add multiple select / deselect functionality
    $("#selectall").click(function() {
        $('.name').attr('checked', this.checked);
    });
    // if all checkbox are selected, then check the select all checkbox
    // and viceversa
    $(".name").click(function() {
        if ($(".name").length == $(".name:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });
});
</SCRIPT>
<script>
$("#see-button-<?= $row["exam_id"] ?>").click(function() {
    $("#view_exam_lists").css("display", "block");
    $('#see-section').html(
        '<center id="see-loading"><img width="50px" src="images/ajax-loader.gif" alt="Loading..." /></center>'
    );
    var formData = {
        "action": "fetchExaminationForm",
        "id": "<?= $row["exam_id"] ?>"
    };
    $.ajax({
        url: 'include/view.php',
        type: 'GET',
        data: formData,
        success: function(data) {
            $('#see-loading').fadeOut(500, function() {
                $(this).remove();
                $('#see-section').html(data);
            });
        }
    });
});
</script>


</tr>
<?php
                    $s_no++;
                }
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
}
if ($_GET["action"] == "fetchExaminationForm") {
    $id = $_GET["id"];
    $sql = "SELECT * FROM `tbl_examination_form` WHERE `status` = '$visible' && `exam_id` = '" . $_GET["id"] . "'
            ";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    // $verifiedStatus = $row["verified_by"] == 1 ? "Verified" : "Not Verified";
    ?>

<center>
    <h2 style="color: #c70013;font-weight: bolder;"><img src="images/nsu.png" style="width: 160px;
    margin-left: 0px;"><b style="font-size: 40;">NETAJI SUBHAS UNIVERSITY</b></h2>
    <h2 style="color: #055ac3fc;font-weight: bolder;margin-top: -60px;">EXAMINATION FORM</h2>
    <h6 style="margin-top: -5px;">For University Campus Programme. </h6>
</center>

<?php
}
?>
<script type="text/javascript">
function verifyForm() {
    $.ajax({
        url: 'include/ajax/verified.php',
        type: 'POST',
        data: {
            'data': "<?= $row["exam_id"] ?>"
        },
        success: function(result) {
            document.getElementById('verified_by_display').innerHTML = result;
        }

    });
}
</script>