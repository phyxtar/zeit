<?php if ($_GET["action"] == "get_student_admitcard") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $semester_id = $_POST["semester_id"];
    // echo $course_id;
    // echo $academic_year;
    // echo $semester_id;

    ?>

<div>
    <form method="POST" action="admit_card_all">
        <input type="hidden" name="course_id" value="<?= $course_id; ?>" />
        <input type="hidden" name="academic_year" value="<?= $academic_year; ?>" />
        <input type="hidden" name="semester_id" value="<?= $semester_id; ?>" />
        <button type="submit" name="printall" class="btn btn-info"> Print All </button>
    </form>
</div>
<form method="POST" action="approve-admitcard">
    <div style="margin-bottom: 20px;">
        <input type="submit" name="approvedAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Approved Selected">
        <input type="submit" name="disapprovedAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Dispproved Selected">
    </div>
    <!-- <div>
            <a target="_blank"
                href="admit_card_all.php?course_id=<?= $_POST["course_id"] ?>&academic_year=<?= $_POST["academic_year"] ?>&semester_id=<?= $_POST["semester_id"] ?>"
                class="btn btn-success btn">Print All</a>
        </div> -->
    <table id="dtHorizontalExample" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" id="selectall" />
                </th>
                <th>S.No</th>
                <th>Admission Reg No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Marksheet Reg No</th>
                <th>Marksheet Roll No</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $exam = "SELECT * FROM `tbl_examination_form` WHERE `status` = '$visible' 
                                && `course_id` = '$course_id' && `semester_id` = '$semester_id'
                                && `academic_year`='$academic_year'
                                
                                 ";
                $exam_result = $con->query($exam);

                if ($exam_result->num_rows > 0) {
                    while ($row_exam = $exam_result->fetch_assoc()) {
                        // print_r($row_exam);
                        ?>
            <?php
                        $sql = "SELECT * FROM `tbl_allot_semester` WHERE `status` = '$visible' 
                                && `course_id` = '" . $row_exam["course_id"] . "' && `semester_id` = '" . $row_exam["semester_id"] . "'
                                && `academic_year`='" . $row_exam["academic_year"] . "'
                                && `admission_id`='" . $row_exam["admission_id"] . "'
                                ";
                        $result = $con->query($sql);
                        $row_allot = $result->fetch_assoc();
                        ?>
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="name" name="chkl[]" value="<?= $row_allot["allot_id"] ?>" />
                </td>
                <td><?php echo $s_no; ?></td>
                <td><?php echo $row_exam["admission_id"]; ?></td>
                <?php
                            $sql_name = "SELECT * FROM `tbl_admission`
                               WHERE `status` = '$visible' && `admission_id` = '" . $row_exam["admission_id"] . "';
                               ";
                            $result_name = $con->query($sql_name);
                            $row_name = $result_name->fetch_assoc();
                            ?>
                <td><?php echo $row_name["admission_first_name"]; ?> <?php echo $row_name["admission_middle_name"]; ?>
                    <?php echo $row_name["admission_last_name"]; ?>
                </td>
                <?php
                            $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row_exam["course_id"] . "';
                                                       ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();
                            ?>
                <td><?php echo $row_course["course_name"]; ?></td>
                <?php
                            $sql_sem = "SELECT * FROM `tbl_semester`
                                                       WHERE `status` = '$visible' && `semester_id` = '" . $row_exam["semester_id"] . "';
                                                       ";
                            $result_sem = $con->query($sql_sem);
                            $row_sem = $result_sem->fetch_assoc();
                            ?>
                <td><?php echo $row_sem["semester"] ?></td>
                <td><?php echo $row_exam["registration_no"]; ?></td>
                <td><?php echo $row_exam["roll_no"]; ?></td>
                <td> <button type="button" id="edit_admitcard_status_button<?php echo $row_allot["allot_id"]; ?>" class="btn <?php if ($row_allot["admitcard_status"] == "Approve")
                                   echo "btn-primary";
                               else
                                   echo "btn-warning" ?> btn-sm"><span
                            id="loader_id<?php echo $row_allot["allot_id"]; ?>"></span>
                        <?php if ($row_allot["admitcard_status"] == "Approve")
                                        echo "Approve";
                                    else
                                        echo "Not Approve" ?></button>
                </td>
                <td> <a target="_blank" href="admit_card_exam.php?id=<?= $row_allot['allot_id'] ?>"
                        class="btn btn-success btn">Print</a></td>
            </tr>
            <input type='hidden' name='admitcard_status'
                id="edit_admitcard_status_button<?php echo $row_allot["allot_id"]; ?>"
                value='<?php echo $row_allot["admitcard_status"] ?>' />
            <script>
            $(function() {
                $('#edit_admitcard_status_button<?php echo $row_allot["allot_id"]; ?>').click(function() {
                    $('#loader_id<?php echo $row_allot["allot_id"]; ?>').append(
                        '<img id = "edit_load" width="20px" src = "images/ajax-loader.gif" alt="Currently loading" />'
                    );
                    $('#edit_admitcard_status_button<?php echo $row_allot["allot_id"]; ?>').prop(
                        'disabled', true);
                    var action = "admitcardStatus";
                    var allot_id = '<?php echo $row_allot["allot_id"]; ?>';
                    var admitcard_status = '<?php echo $row_allot["admitcard_status"]; ?>';

                    var dataString = 'action=' + action + '&allot_id=' + allot_id +
                        '&admitcard_status=' + admitcard_status;

                    $.ajax({
                        url: 'include/controller.php',
                        type: 'POST',
                        data: dataString,
                        success: function(result) {
                            console.log(result);
                            if (result == "success")
                                showUpdatedData();

                            function showUpdatedData() {
                                $.ajax({
                                    url: 'include/view.php?action=get_student_admitcard',
                                    type: 'POST',
                                    data: $('#fetchStudentDataForm')
                                        .serializeArray(),
                                    success: function(result) {
                                        $('#response').remove();
                                        $('#data_table').append(
                                            '<div id = "response">' +
                                            result + '</div>');
                                    }
                                });
                            }
                            $('#loader_id<?php echo $row_allot["allot_id"]; ?>  ').fadeOut(
                                500,
                                function() {
                                    $(this).remove();
                                    $('#edit_admitcard_status_button<?php echo $row_allot["allot_id"]; ?>')
                                        .prop('disabled', false);
                                });

                        }

                    });

                });
            });
            </script>
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
</form>
<script>
$(document).ready(function() {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>
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
<?php
}
?>