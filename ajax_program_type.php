<?php
include_once 'include/config.php';
$id = $_POST['p_type'];
$sql = "SELECT program_type FROM tbl_course WHERE course_id=".$id;

$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result); 
    
   echo '<option value="'.$row['program_type'].'">'.$row['program_type'].'   </option>';

?>