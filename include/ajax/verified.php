<?php
$visible = md5('visible');
include '../../include/config.php';
$exam_id = $_POST['data'];

$update = "UPDATE `tbl_examination_form` SET `verified_by` = 'Verified' WHERE `exam_id` = '$exam_id'";
$verify = mysqli_query($con, $update);

if ($verify) {
    $sql = "SELECT * FROM `tbl_examination_form` WHERE `exam_id` = '$exam_id'";
    $result = mysqli_query($con, $sql);
    $row = $result->fetch_assoc();
    echo $row['verified_by'];
}