<?php
include "../../framwork/main.php";

$id = $_GET['id'];
$status2 = $_GET['status'];
$manual = isset($_GET['manual']) ? (int)$_GET['manual'] : 0;

// Fetch the admission data using the admission ID
$admission_data = fetchRow('tbl_admission', '`admission_id`=' . $id . '');

// Determine new status
if ($status2 == "Approve") {
    $status1 = 0; // Status changes to 'Not Approve'
    $exam_status = "Approve";
} else {
    $status1 = 1; // Status changes to 'Approve'
    $exam_status = "Not Approve";
}

// Prepare the status array for updating or inserting
$status = array(
    'admission_id' => $id,
    'course_id' => $admission_data['admission_course_name'],
    'academic_year' => $admission_data['admission_session'],
    'particular_id' => 0,
    'fee_status' => "dues",
    'exam_status' => $exam_status,
    'manual_status' => $manual,
);

// Fetch the current fee status data using the admission ID
$fee_status_data = fetchRow('tbl_fee_status', ' admission_id=' . $id . '');

if ($fee_status_data == '') {
    // If no existing fee status data, insert the new status
    $result = insertAll('tbl_fee_status', $status);
} else {
    // If fee status data exists, update the existing record
    updateAll('tbl_fee_status', $status, '`admission_id`=' . $id . '');
}

echo $status1; // Output the status value (1 or 0)
?>