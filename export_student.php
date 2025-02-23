<?php
include_once 'include/config.php';
$visible = md5('visible');
$s_no = 1;

function s_no_gen($sno)
{
	$no = 0;
	if ($sno <= 9) {
		$no = '00' . $sno;
	} else if ($sno > 9 && $sno < 100) {
		$no = '0' . $sno;
	} else {
		$no = $sno;
	}
	return $no;
}

if (isset($_POST["course_id"]) && isset($_POST["academic_year"]) && isset($_POST["semester_id_name"])) {
	//$sql = "SELECT admission_id,admission_first_name,admission_middle_name,admission_last_name,admission_course_name,admission_session FROM `tbl_admission` where `admission_session` = '$academic_year' && `admission_course_name` = '$course_id' ";  

	$sql = "SELECT * FROM `tbl_admission`
    INNER JOIN `tbl_course` ON `tbl_course`.`course_id` = `tbl_admission`.`admission_course_name`
    INNER JOIN `tbl_university_details` ON `tbl_university_details`.`university_details_id` = `tbl_admission`.`admission_session`
    WHERE `tbl_admission`.`admission_course_name` = '" . $_POST["course_id"] . "' 
    AND `tbl_admission`.`admission_session` = '" . $_POST["academic_year"] . "' 
    AND `tbl_admission`.`stud_status` = 1 
    AND `tbl_admission`.`status` = '$visible' 
    ORDER BY `tbl_admission`.`admission_first_name` ASC";

	$setRec = mysqli_query($con, $sql);
	$columnHeader = '';
	$columnHeader = "Admission Reg No" . "\t"
		. "Student Reg No" . "\t"
		. "Course" . "\t"
		. "Academic Session" . "\t"
		. "Student Roll No" . "\t"
		. "Semester" . "\t"
		. "Type" . "\t"
		. "Section" . "\t"
		. "Marksheet Serial No" . "\t"
		. "Section" . "\t"
		. "Student Name" . "\t"
		. "Father Name" . "\t"
		. "Mother Name" . "\t"
		. "Dob" . "\t"
		. "Mobile No" . "\t"
		. "Gender" . "\t";

	$setData = '';

	//echo "<pre>";
	while ($rec = mysqli_fetch_array($setRec)) {
		$rowData = '';
		//print_r($rec);
		$sql_course = "SELECT * FROM `tbl_course`
		WHERE `status` = '$visible' && `course_id` = '" . $rec["admission_course_name"] . "'";
		$result_course = $con->query($sql_course);
		$row_course = $result_course->fetch_assoc();

		// getting the sesion and course 
		$sql_session = "SELECT * FROM `tbl_university_details`
		WHERE `status` = '$visible' && `university_details_id` = '" . $rec["admission_session"] . "'";
		$result_session = $con->query($sql_session);
		$row_session = $result_session->fetch_assoc();
		$session = $row_session["academic_session"];
		$session_year = explode('-', $session)[0];
		// getting the session year
		$session_year_first = $session_year[2] . $session_year[3];
		$code_gen =  $row_course['course_code'] > 9 ? $row_course['course_code'] : '0' . $row_course['course_code'];

		$rowData .= $rec["admission_id"] . "\t"
			. 'NSU' . $session_year_first . $code_gen  . s_no_gen($s_no) . "\t"
			. $rec["course_name"] . "\t"
			. $rec["academic_session"] . "\t"

			.  $session_year_first . $code_gen . s_no_gen($s_no) . "\t"
			.  $_POST["semester_id_name"] . "\t"
			. "Regular" . "\t"
			. "A" . "\t"
			. $session_year_first . $code_gen . s_no_gen($s_no) . "\t"
			. "A" . "\t"
			. $rec["admission_first_name"] . " "
			. $rec["admission_middle_name"] . " "
			. $rec["admission_last_name"] . "\t"
			. $rec["admission_father_name"] . "\t"
			. $rec["admission_mother_name"] . "\t"
			. $rec["admission_dob"] . "\t"
			. $rec["admission_mobile_student"] . "\t"
			. $rec["admission_gender"];


		$setData .= trim($rowData) . "\n";
		$s_no++;
	}
	// exit; 
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Student List.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo ucwords($columnHeader) . "\n" . $setData . "\n";