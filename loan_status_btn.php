<?php
include "include/config.php";
include_once "include/authentication.php"; 
header('Content-Type: application/json');

$response = [];

if (isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    // Fetch the current status
    $sql = "SELECT status FROM tbl_loan WHERE id = '$teacher_id'";
    $result = $con->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_status = $row['status'];

           
            $new_status = ($current_status === 'Pending') ? 'Approved' : 'Pending';

           
            $update_sql = "UPDATE tbl_loan SET status = '$new_status' WHERE id = '$teacher_id'";
            if ($con->query($update_sql) === TRUE) {
                $response['new_status'] = $new_status;
            } else {
                $response['error'] = 'Failed to update status: ' . $con->error;
            }
        } else {
            $response['error'] = 'ID not found';
        }
    } else {
        $response['error'] = 'Query failed: ' . $con->error;
    }
} else {
    $response['error'] = 'ID not set';
}

echo json_encode($response);
?>
