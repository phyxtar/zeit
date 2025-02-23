<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $page_no = "18";
$page_no_inside = "18_5";
include_once "include/authentication.php";

    $teacher_id = $_POST['teacher_id'];
    $teacher_name = $_POST['teacher_name'];
    $teacher_address = $_POST['teacher_address'];
    $teacher_emailid = $_POST['teacher_emailid'];
    $teacher_qualification = $_POST['teacher_qualification'];
    $teacher_doj = $_POST['teacher_doj'];
    $teacher_pass = md5($_POST['teacher_pass']);
    $teacher_grade_ids = implode(',', $_POST['teacher_grade_id']);
    $sql = "UPDATE tbl_teacher SET
                        teacher_name = '$teacher_name',
                        teacher_address = '$teacher_address',
                        teacher_emailid = '$teacher_emailid',
                        teacher_password = '$teacher_pass',
                        teacher_qualification = '$teacher_qualification',
                        teacher_doj = '$teacher_doj',
                        teacher_grade_id = '$teacher_grade_ids'
                    WHERE teacher_id = '$teacher_id'";

    if ($con->query($sql) === TRUE) {
        echo "Teacher details updated successfully!";
    } else {
        echo "Error updating teacher details: " . $con->error;
    }
}
?>