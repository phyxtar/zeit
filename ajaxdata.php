<?php
include_once 'include/config.php';
$id = $_POST['depart'];   // id
$session=$_POST['session'];
$visible = md5("visible");
  $sql = "SELECT * FROM `tbl_semester` WHERE `course_id`=".$id." && `fee_academic_year`=".$session." && `status`='".$visible."' ";
$result = mysqli_query($con,$sql);
while( $row = mysqli_fetch_array($result) ){
   echo '<option value="'.$row['semester_id'].'">'.$row['semester'].'   </option>';
}
