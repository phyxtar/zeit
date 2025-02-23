<?php
include_once "../../framwork/main.php";

if (isset($_POST['student_id']) && count($_POST['student_id']) > 0) {
    for ($i = 0; $i < count($_POST['student_id']); $i++) {
        $id = $_POST['student_id'][$i];
        $status_check = fetchRow('tbl_admission', ' admission_id=' . $id . '');

        if ($status_check['completed'] == "0") {
            $data = array('completed' => "1");
        } else {
            $data = array('completed' => "0");
        }
        $result = updateAll('tbl_admission', $data, ' `admission_id`="' . $id . '"');
    }
    if ($result == "success") {
        echo $result;
    }else{
        echo $con->error;
    }
}
