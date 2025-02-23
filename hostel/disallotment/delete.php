<?php
include "../../framwork/main.php";
global $trash;
$id = $_GET['id'];
echo $result = delete('hostel_allotment', ' admission_id=' . $id . '');

