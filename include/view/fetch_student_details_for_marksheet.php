<?php
if ($_GET["action"] == "fetch_student_list_details_for_marksheet") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $semester_id_name=$_POST['semester_id'];
    if ($academic_year != 0) {
?>
        <div class="card-header card-warning">
            <form method="POST" action="export_student">
                <input type="hidden" name="course_id" value="<?= $course_id; ?>" />
                <input type="hidden" name="academic_year" value="<?= $academic_year; ?>" />
                <input type="hidden" name="semester_id_name" value="<?= $semester_id_name; ?>" />
                <button type="submit" name="export" class="btn btn-info"> Export to CSV </button>
            </form>
        </div>
        <form id="student_details" action="" method="POST">
            <table id="" class="table table-bordered table-striped table-responsive" style="overflow-x:auto;">
                <thead>
                    <tr>
                        <th width="10%">S.No</th>
                        <th width="10%">Admission Reg. No</th>
                        <th width="10%">Name</th>
                        <th width="10%"> Father Name</th>
                        <th width="10%">Course</th>
                        <th width="10%">Session</th>
                        <th width="10%">Semester
                            <select class="form-control form-control-sm" onchange="change_all_semester(this)">
                                <option selected disabled>- Select Semester -</option>
                                <?php

                                $get_semester = "SELECT * FROM `tbl_semester`
													   WHERE `course_id` = '" . $course_id . "' && `fee_academic_year`='" . $academic_year . "';
													   ";
                                $semester = $con->query($get_semester);
                                while ($semester_row = $semester->fetch_assoc()) {
                                ?>
                                    <option value="<?= $semester_row["semester_id"]; ?>"><?= $semester_row["semester"]; ?></option>
                                <?php } ?>
                            </select>
                        </th>
                        <th width="10%">Marksheet Serial No</th>
                        <th width="10%">Marksheet Reg No</th>
                        <th width="10%">Marksheet Roll No</th>
                        <th width="10%">Examination Type</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($course_id == "all")
                        $sql = "SELECT * FROM `tbl_admission`
                                WHERE `status` = '$visible' && `admission_session` = '$academic_year'
                                ORDER BY `admission_first_name` ASC
                                ";
                    else
                        $sql = "SELECT * FROM `tbl_admission`
                                WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_course_name` = '$course_id'
                                ORDER BY `admission_first_name` ASC
                                ";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $s_no; ?></td>
                                <?php
                                $sql_course = "SELECT * FROM `tbl_course`
                                                   WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                                                   ";
                                $result_course = $con->query($sql_course);
                                $row_course = $result_course->fetch_assoc();
                                ?>
                                <td><?= $row["admission_id"] ?> <input type="hidden" name="admission_id[]" value="<?= $row["admission_id"] ?>"> </td>
                                <td><?= $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"] ?> <input type="hidden" name="student_name[]" value="<?= $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"] ?>"></td>
                                <td><?= $row["admission_father_name"]  ?></td>

                                <td><?= $row_course["course_name"]; ?> <input type="hidden" value="<?= $row["admission_course_name"]; ?>" name="course_id[]"> </td>
                                <?php
                                // getting the sesion and course 
                                $sql_session = "SELECT * FROM `tbl_university_details`
                                WHERE `status` = '$visible' && `university_details_id` = '" . $row["admission_session"] . "';
                                ";
                                $result_session = $con->query($sql_session);
                                $row_session = $result_session->fetch_assoc();
                                $session = $row_session["academic_session"];
                                ?>
                                <td><?= $session ?> <input type="hidden" name="academic_year[]" value="<?= $row["admission_session"] ?>"> </td>
                                <td> <select class="form-control form-control-sm semester_name input" name="semester_id[]">
                                        <option selected disabled>- Select Semester -</option>
                                        <?php

                                        $get_semester = "SELECT * FROM `tbl_semester`
													   WHERE `course_id` = '" . $course_id . "' && `fee_academic_year`='" . $academic_year . "';
													   ";
                                        $semester = $con->query($get_semester);
                                        while ($semester_row = $semester->fetch_assoc()) {
                                        ?>
                                            <option value="<?= $semester_row["semester_id"]; ?>"><?= $semester_row["semester"]; ?></option>
                                        <?php } ?>
                                    </select> </td>
                                <?php $session_year = explode('-', $session)[0];
                                $session_year_first = $session_year[2] . $session_year[3]; ?>
                                <td> <input class="input" value="<?= $session_year . '/' . $session_year_first ?>" type="text" name="serial_no[]" /> </td>
                                <td> <input class="input" value="<?= 'NSU' . $session_year_first . $row['admission_id'] . '00' . $s_no ?>" type="text" name="reg_no[]" /> </td>
                                <td> <input class="input" value="<?=  $session_year_first . $row['admission_id'] . '00' . $s_no  ?>" type="text" name="roll_no[]" /> </td>
                                <td> <input class="input" value="REGULAR" type="text" name="exam_type[]" /> </td>
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
            <div class="text-center">
                <button class="btn btn-primary">Import All Student</button>
            </div>
        </form>
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

            function change_all_semester(semster) {
                var all_semester = document.getElementsByClassName('semester_name');
                for (i = 0; i < all_semester.length; i++) {
                    all_semester[i][semster.selectedIndex].selected = "true"
                }

            }
        </script>
        <style>
    .input {
        width: 144px;
    }
</style>
<?php
    } else
        echo "0";
}
?>


