<?php
include_once "../../framwork/main.php"; // Include your database connection

// Get the admission ID from the request
$id = $_GET['id'];

// Fetch the current doc_status for the given admission_id
$status_check = fetchRow('tbl_admission', 'admission_id=' . $id);

if ($status_check['doc_status'] == "0") {
    // Update status to "Document Pending" (1)
    $new_status = 1;
} else {
    // Update status to "Document Clear" (0)
    $new_status = 0;
}

// Update query to change the doc_status in the database
$updateQuery = "UPDATE tbl_admission SET doc_status = '$new_status' WHERE admission_id = '$id'";

// Execute the update query and return JSON response
if (mysqli_query($conn, $updateQuery)) {
    echo json_encode(['success' => true, 'new_status' => $new_status]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}
?>