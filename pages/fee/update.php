<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";

$fee_id = updateAll('tbl_fee', $_POST, ' fee_id=' . $_POST['fee_id'] . '');
if ($fee_id = "success") {
    echo success_alert("Data Successfully Updated");
} else {
    echo danger_alert($con->error);
}
