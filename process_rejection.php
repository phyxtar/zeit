
<?php
// update_status.php
include "include/config.php";// Make sure to include your database connection file
include_once "include/authentication.php"; 

header('Content-Type: application/json');

$response = [];

if (isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    // Fetch the current status
    $sql = "SELECT status FROM tbl_apply_leave WHERE id = '$teacher_id'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_status = $row['status'];

            // Toggle the status
            $new_status = ($current_status === 'Pending') ? 'Approved' : 'Pending';

            // Update the status in the database
            $update_sql = "UPDATE tbl_apply_leave SET status = '$new_status' WHERE id = '$teacher_id'";
            if ($conn->query($update_sql) === TRUE) {
                $response['new_status'] = $new_status;
            } else {
                $response['error'] = 'Failed to update status: ' . $conn->error;
            }
        } else {
            $response['error'] = 'ID not found';
        }
    } else {
        $response['error'] = 'Query failed: ' . $conn->error;
    }
} else {
    $response['error'] = 'ID not set';
}

echo json_encode($response);
?>
