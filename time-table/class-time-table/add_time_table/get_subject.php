<?php
include_once "../../../include/config.php";
include_once "../../../framwork/main.php";
$course_id = $_POST['course_id'];
$session_id = $_POST['session_id'];
$semster_id = $_POST['semster_id'];
echo $sql_sub = "SELECT * FROM `time_tbl_subject` WHERE `course_id` = '$course_id' && `fee_academic_year` = '$session_id' && `semester_id` = '$semster_id' ";
$sub_res = $con->query($sql_sub);

echo '<option  selected disabled > - Select Subjects - </option>';

while ($sub_row = $sub_res->fetch_assoc()) {

    echo '<option value="' . $sub_row['id'] . '">' . $sub_row['subject_name'] . '</option>';
}
