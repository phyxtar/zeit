<?php
include "../../framwork/main.php";
$reg_status = $_GET['reg_status'];
$id = $_GET['id'];
$admission_data = fetchRow('tbl_admission', '`admission_id`=' . $id . '');

if ($reg_status == "Approve") {
    $status1 = 1;
    $status = array(
        'admission_id' => $id,
        'course_id' => $admission_data['admission_course_name'],
        'academic_year' => $admission_data['admission_session'],
        'particular_id' => 0,
        'fee_status' => "dues",
        'reg_status' => "Not Approve",
    );
} else {
    $status1 = 0;
    $status = array(
        'admission_id' => $id,
        'course_id' => $admission_data['admission_course_name'],
        'academic_year' => $admission_data['admission_session'],
        'particular_id' => 0,
        'fee_status' => "dues",
        'reg_status' => "Approve",
    );
}
$fee_status_data = fetchRow('tbl_fee_status',  ' admission_id=' . $id . '');

if ($fee_status_data == '') {
    $result = insertAll('tbl_fee_status', $status);
    echo $status1;
} else {
    updateAll('tbl_fee_status', $status, '`admission_id`=' . $id . '');
    echo $status1;
}