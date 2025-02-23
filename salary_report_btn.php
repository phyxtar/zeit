<?php
include "include/config.php";
include_once "include/authentication.php"; 
header('Content-Type: application/json');

$response = [];

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT salary_status FROM tbl_staff WHERE id = '$id'";
    $result = $con->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_status = $row['salary_status'];

            $new_status = ($current_status === 'Unpaid') ? 'Paid' : 'Unpaid';
            $new_class = ($new_status === 'Paid') ? 'btn-success' : 'btn-warning';

            $name = $_SESSION["logger_username"];

            // Corrected SQL UPDATE statement
            $update_sql = "UPDATE tbl_staff SET salary_status = '$new_status', salary_status_updated_by = '$name' WHERE id = '$id'";
            if ($con->query($update_sql) === TRUE) {
                $response['new_status'] = $new_status;
                $response['new_class'] = $new_class;
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
