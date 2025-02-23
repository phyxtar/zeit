<?php
include "include/config.php";

if (isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    $check_sql = "SELECT why_rejected FROM tbl_apply_leave WHERE id = '$teacher_id'";
    $check_result = mysqli_query($con, $check_sql);
    
    if ($check_result) {
        $row = mysqli_fetch_assoc($check_result);
        $why_rejected = $row['why_rejected'];

        if (!empty($why_rejected)) {
            $reject = "Rejected";
        } else {
            $reject = "Reject";
        }

        $update_sql = "UPDATE tbl_apply_leave SET reject = '$reject' WHERE id = '$teacher_id'";
        $result = mysqli_query($con, $update_sql);

        if ($result) {
            echo json_encode(['status' => 'success', 'reject' => $reject]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update reject button']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error fetching data']);
    }
}
?>
