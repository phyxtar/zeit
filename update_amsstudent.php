<?php
// Include database connection
include 'include/authentication.php';
include 'include/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $student_roll_number = $_POST['student_roll_number'];
    $parent_mob_no_1 = $_POST['parent_mob_no_1'];
    $parent_mob_no_2 = $_POST['parent_mob_no_2'];
    $student_dob = $_POST['student_dob'];
    $student_grade_id = $_POST['student_grade_id'];

    // Update student information
    $sql = "
        UPDATE tbl_students 
        SET student_name = '$student_name', student_roll_number = '$student_roll_number', parent_mob_no_1 = '$parent_mob_no_1', 
            parent_mob_no_2 = '$parent_mob_no_2', student_dob = '$student_dob', student_grade_id = '$student_grade_id'
        WHERE student_id = $student_id
    ";

    if ($con->query($sql)) {
        echo "Student updated successfully!";
    } else {
        echo "Error updating student: " . $con->error;
    }
}
?>