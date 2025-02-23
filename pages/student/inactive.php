<?php
include_once "../../framwork/main.php";
$course_id=$_POST['course_id'];
$academic_year=$_POST['academic_year'];
$data=array('stud_status'=>0);
echo updateAll('tbl_admission',$data,' `admission_session`="'.$academic_year.'" && `admission_course_name`= "'.$course_id.'"');