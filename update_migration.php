<?php
include('include/config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_migration_id'])) {
   
    $migration_id = $_POST["edit_migration_id"];
    $course_id = $_POST["edit_course_name"];
    $reg_no = $_POST["edit_registration_no"];
    $candidate_name = $_POST["edit_candidate_name"];
    $father_name = $_POST["edit_father_name"];
    $dob = $_POST["edit_dob"];
    $email_id = $_POST["edit_email_id"];
    $semester = $_POST["edit_semester"];
    $passfail = $_POST["edit_passfail"];
    $name_of_the_exam = $_POST["edit_name_of_the_exam"];

    $sql = "UPDATE `tbl_migration_form` 
    SET 
    `course_id` = '$course_id', `registration_no` = '$reg_no', `candidate_name` = '$candidate_name', `father_name` = '$father_name', `dob` = '$dob', `email_id` = '$email_id', `semester` = '$semester', `passfail` = '$passfail',  `name_of_the_exam` = '$name_of_the_exam'
    WHERE `migration_id` = '$migration_id';
    ";
    if (mysqli_query($con, $sql)) {
       
        header("Location: migration_form_application.php"); 
    } else {
       
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
