<?php
include_once "../../../include/config.php";
include_once "../../../framwork/main.php";
$course_id=$_POST['course_id'];
$session_id=$_POST['session_id'];
$semster_id=$_POST['semster_id'];
 $sql_sub = "SELECT * FROM `teacher_allot_tbl` WHERE `course_id` = '$course_id' && `academic_year` = '$session_id' && `semester_id` = '$semster_id' ";
$sub_res = $con->query($sql_sub);

echo '<option  selected disabled > - Select Faculty - </option>';

while ($sub_row = $sub_res->fetch_assoc()) {
    $staff_id = $sub_row['staff_id'];
    $child_data1 = fetchResult('tbl_staff', 'id=' . $staff_id . '');
    $row_child1 = mysqli_fetch_assoc($child_data1);
    // echo '<pre>';
    // print_r($sub_row);
    echo '<option value="' . $row_child1['id'] . '">' . $row_child1['name'] . '</option>';
}
