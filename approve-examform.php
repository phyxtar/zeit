<?php  
include_once "include/authentication.php"; 
if(isset($_POST["approvedAll"])){
	if(isset($_POST["chkl"]) && count($_POST["chkl"]) > 0){
		$c = 0;
		foreach($_POST["chkl"] as $allChecks){
			$sql_update = "UPDATE `tbl_examination_form` 
							SET 
							`verified_by` = 'Verified'
							WHERE  `exam_id` = '$allChecks';
							";
			if($con->query($sql_update))
				$c++;
		}
		if($c > 0)
			echo "
				<script>
					alert('".$c." student has been approved successfully...');
					location.replace('exam_form_list');
				</script>
			";
		else
			echo "
				<script>
					alert('Something went wrong please try again...');
					location.replace('exam_form_list');
				</script>
			";
	} else{
		echo "
			<script>
				alert('Please select atleast one data...');
				location.replace('exam_form_list');
			</script>
		";
	}
}
if(isset($_POST["disapprovedAll"])){
	if(isset($_POST["chkl"]) && count($_POST["chkl"]) > 0){
		$c = 0;
		foreach($_POST["chkl"] as $allChecks){
			$sql_update = "UPDATE `tbl_examination_form` 
							SET 
							`verified_by` = 'Not Verified'
							WHERE  `exam_id` = '$allChecks';
							";
			if($con->query($sql_update))
				$c++;
		}
		if($c > 0)
			echo "
				<script>
					alert('".$c." student has been disapproved successfully...');
					location.replace('exam_form_list');
				</script>
			";
		else
			echo "
				<script>
					alert('Something went wrong please try again...');
					location.replace('exam_form_list');
				</script>
			";
	} else{
		echo "
			<script>
				alert('Please select atleast one data...');
				location.replace('exam_form_list');
			</script>
		";
	}
}

if (isset($_POST["PrintAll"])) {
	
}
?>