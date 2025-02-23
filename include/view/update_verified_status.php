<?php
include_once "include/authentication.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];
    $verified_by = $_POST['verified_by'];

    // Log received data
    error_log("Exam ID: " . $exam_id);
    error_log("Verified By: " . $verified_by);

    $sql = "UPDATE `tbl_examination_form` SET `verified_by` = '$verified_by' WHERE `exam_id` = '$exam_id'";
    
    if ($con->query($sql) === TRUE) {
        echo 'success';
    } else {
        // Log error message
        error_log("Error updating record: " . $con->error);
        echo 'error';
    }
}
?>