<?php
include_once "../../../framwork/main.php";
if (isset($_POST['id']) && $_POST['id'] != '') {

    $result =  updateAll('teacher_allot_tbl', $_POST, ' id=' . $_POST['id'] . '');
    if ($result == "success") {
        echo   success_alert("Staff Successfully Updated");
    } else {
        echo warning_alert($conn->error);
    }
}
