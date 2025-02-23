<?php
include_once "../../framwork/main.php";
$id = $_GET['id'];

$status_check = fetchRow('tbl_admission', ' admission_id=' . $id . '');

if ($status_check['stud_status'] == "0") {
    $data = array('stud_status' => "1");
} else {
    $data = array('stud_status' => "0");
}
echo updateAll('tbl_admission', $data, ' `admission_id`="' . $id . '"');
