<?php
// Include database connection
include "include/authentication.php"; // Replace with your actual DB connection file

if (isset($_POST['admission_id'])) {
    $admission_id = $_POST['admission_id'];

    // SQL query to update the exam_status to "Approve" based on admission_id
    $sql = "UPDATE `tbl_fee_status` SET `exam_status` = 'Approve' WHERE `admission_id` = '$admission_id'";

    if ($con->query($sql) === TRUE) {
        echo "success"; // Return success response
    } else {
        echo "error"; // Return error response
    }
}
?>
