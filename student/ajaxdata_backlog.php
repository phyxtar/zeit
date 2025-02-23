<?php
include 'include/config.php';
$id = $_POST['depart1'];   // id
// var_dump($id);exit();
$today = date("Y-m-d");
$sql = "SELECT * FROM tbl_backlogs WHERE semester_id=" . $id;
//var_dump("SELECT exam_fee FROM tbl_semester WHERE semester_id=".$id);exit();

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
if (isset($row['exam_fee_last_date']) && $today > $row['exam_fee_last_date']) {
	if ($row["fee_status"] == "Active") {
		echo $row['exam_fee'] + $row['exam_fine'];
	} else {
		echo $row['exam_fee'];
	}
} else {
	echo $row['exam_fee'];
}
