<?php 
include "../../../framwork/main.php";

$allot_id=$_GET['id'];
echo delete('tbl_allot_semester',' allot_id='.$allot_id.'');
?>