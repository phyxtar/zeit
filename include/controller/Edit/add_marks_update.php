<?php
include_once "../../../framwork/main.php";
if (isset($_POST['subject_id']) && $_POST['subject_id'] != '') {
    
  $result=  updateAll('tbl_subjects',$_POST,' subject_id='.$_POST['subject_id'].'');
  if($result=="success"){
  echo   success_alert("Subject Successfully Updated");

  }else{
    echo warning_alert($conn->error);
  }
}
