<?php
include "include/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $teacher_id = $_POST["teacher_id"];
    $reason = $_POST["rejection_reason"];

    $qry = "UPDATE  tbl_loan SET why_rejected = '$reason' WHERE id = '$teacher_id'";

    $result = mysqli_query($con, $qry);

    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to insert rejection reason']);
    }
}
?>