<?php 
if ($_GET["action"] == "fetch_student_marks") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        if ($academic_year != 0) {
            ?>
            <form method="POST" action="delete_marks">
                <div style="margin-bottom: 20px;">
                    <input type="submit" name="deleteAll" class="btn btn-lg btn-warning" style="font-size: 15px;" value="Delete All">
                </div>
                <table id="" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" id="selectall" />
                            </th>
                            <th width="10%">S.No</th>
                            <th width="10%">Course</th>
                            <th width="10%">Semester</th>
                            <th width="10%">Session</th>
                            <th width="10%">Reg. No</th>
                            <th width="10%">Subject</th>
                            <th width="10%">Internal Marks</th>
                            <th width="10%">External Marks</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM `tbl_marks`
                                INNER JOIN  `tbl_course` ON `tbl_marks`.`course_id` = `tbl_course`.`course_id`
                                INNER JOIN  `tbl_subjects` ON `tbl_marks`.`subject_id`  = `tbl_subjects`.`subject_id`
                                WHERE `tbl_subjects`.`status` = '$visible' && `tbl_marks`.`status` = '$visible' && `tbl_marks`.`fee_academic_year` = '$academic_year' && `tbl_marks`.`course_id` = '$course_id' && `tbl_marks`.`semester_id` = '$semester_id'
                        ";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="name" name="chkl[]" value="<?= $row["marks_id"] ?>" />
                                    </td>
                                    <td><?php echo $s_no; ?></td>
                                    <?php
                                    $sql_course = "SELECT * FROM `tbl_course`
                                   WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                   ";
                                    $result_course = $con->query($sql_course);
                                    $row_course = $result_course->fetch_assoc();
                                    ?>
                                    <td><?php echo $row_course["course_name"]; ?></td>
                                    <?php
                                    $sql_semester = "SELECT * FROM `tbl_semester`
                                   WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                                   ";
                                    $result_semester = $con->query($sql_semester);
                                    $row_semester = $result_semester->fetch_assoc();
                                    ?>
                                    <td><?php echo $row_semester["semester"]; ?></td>
                                    <?php
                                    $sql_ac_year = "SELECT * FROM `tbl_university_details`
                            WHERE university_details_id = '" . $row["fee_academic_year"] . "';";
                                    $result_ac_year = $con->query($sql_ac_year);
                                    $row_ac_year = $result_ac_year->fetch_assoc(); ?>
                                    <?php
                                    $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                    $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                                    $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                    ?>
                                    <td>
                                        <option value="<?php echo $row_ac_year["university_details_id"]; ?>"><?php echo $completeSessionOnlyYear; ?></option>
                                    </td>
                                    <td><?php echo $row["reg_no"] ?></td>
                                    <td><?php echo $row["subject_name"] ?></td>
                                    <td><?php echo $row["internal_marks"]; ?></td>
                                    <td><?php echo $row["external_marks"]; ?></td>
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
            </form>
            <script>
                $(document).ready(function() {
                    $('#dtHorizontalExample').DataTable({
                        "scrollX": true
                    });
                    $('.dataTables_length').addClass('bs-select');
                });
            </script>
            <script language="javascript">
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
            </script>
<?php
        } else
            echo "0";
    }
    ?>