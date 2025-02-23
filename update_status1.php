<?php
$page_no = "11";
$page_no_inside = "11_12";
// update_status.php
include 'db_connection.php'; // Make sure to include your database connection file
include_once "include/authentication.php"; 

// header('Content-Type: application/json');

$response = [];

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Fetch the current status
    $sql = "SELECT status FROM tbl_character WHERE student_id = '$student_id'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_status = $row['status'];

            // Toggle the status
            $new_status = ($current_status === 'pending') ? 'Approved' : 'pending';

            // Update the status in the database
            $update_sql = "UPDATE tbl_character SET status = '$new_status' WHERE student_id = '$student_id'";
            if ($conn->query($update_sql) === TRUE) {
                $response['new_status'] = $new_status;
            } else {
                $response['error'] = 'Failed to update status: ' . $conn->error;
            }
        } else {
            $response['error'] = 'Admission ID not found';
        }
    } else {
        $response['error'] = 'Query failed: ' . $conn->error;
    }
} else {
    $response['error'] = 'Admission ID not set';
}

echo json_encode($response);
?>