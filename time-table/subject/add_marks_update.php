<?php
include_once "../../framwork/main.php";
if (isset($_POST['id']) && $_POST['id'] != '') {

    $result =  updateAll('time_tbl_subject', $_POST, ' id=' . $_POST['id'] . '');
    if ($result == "success") {
        echo   success_alert("Subject Successfully Updated");
    } else {
        echo warning_alert($conn->error);
    }
}
