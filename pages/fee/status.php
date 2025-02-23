<?php
include "../../framwork/main.php";
include_once "../../framwork/ajax/method.php";
$id = $_GET['id'];
$status_check = fetchRow('tbl_fee', ' fee_id=' . $id . '');
if ($status_check['fee_astatus'] == "Active") {
    $data = array('fee_astatus' => "Inactive");
} else {
    $data = array('fee_astatus' => "Active");
}
echo $result = updateAll('tbl_fee', $data, ' fee_id=' . $id . '');
