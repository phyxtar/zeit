<?php
include_once "../../framwork/main.php";

// id
$time = $_GET['time'];
$staff_id = $_GET['staff_id'];
$select_date = date("Y-m-d", strtotime($_GET['date']));

 $sql_staff = "SELECT * FROM `time_table_child` WHERE `start_time` = '$time' && `staff_id` = '$staff_id' && `date` = '$select_date'";
  $res =mysqli_query($con,$sql_staff);
if(mysqli_num_rows($res)>0){
    echo danger_alert("Faculty is already alloted!!!" );
}
?>