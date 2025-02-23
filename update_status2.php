<?php
// update_status.php
// include 'db_connection.php'; // Make sure to include your database connection file
include_once "include/authentication.php"; 

header('Content-Type: application/json');

$response = [];

if (isset($_POST['admission_id'])) {
    $admission_id = $_POST['admission_id'];

    // Fetch the current status
    $sql = "SELECT library FROM tbl_migration_form WHERE admission_id = '$admission_id'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_status = $row['library'];

            // Toggle the status
            $new_status = ($current_status === 'Not Approved') ? 'Approved' : 'Not Approved';

            // Update the status in the database
            $update_sql = "UPDATE tbl_migration_form SET library = '$new_status', lib_approvedby = '". $_SESSION['admin_name'] ."' WHERE admission_id = '$admission_id'";
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