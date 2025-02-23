<?php
include 'include/config.php';
error_reporting(0);
$id = $_POST['depart1'];   // id
// var_dump($id);exit();
$today = date("Y-m-d");
$sql = "SELECT * FROM tbl_reg_semester WHERE course_id=" . $id;
//var_dump("SELECT reg_fee FROM tbl_semester WHERE semester_id=" . $id);
//exit();

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
if (isset($row['reg_fee_last_date']) && $today > $row['reg_fee_last_date']) {
    if ($row["regfee_status"] == "Active") {
        echo $row['reg_fee'] + $row['reg_fine'];
    } else {
        echo $row['reg_fee'];
    }
} else {
    echo $row['reg_fee'];
}