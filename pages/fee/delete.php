<?php
include "../../framwork/main.php";
global $trash;
$data = array('status' => $trash);
$id = $_GET['id'];
echo $result = updateAll('tbl_fee', $data, ' fee_id=' . $id . '');

