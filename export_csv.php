<?php
include_once 'include/config.php';
error_reporting(0);
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

	$semester_id = $_POST["semester_id_name"];
	$course_id = $_POST["course_id"];
	$academic_year = $_POST["academic_year"];

	$columnHeader = '';
	$columnHeader = "Admission Reg No" . "\t"
		. "Department Name" . "\t"
		. "Student Reg No" . "\t"
		. "Course" . "\t"
		. "Academic Session" . "\t"
		. "Student Roll No" . "\t"
		. "Semester" . "\t"
		. "Student Name" . "\t"
		. "Gender" . "\t"
		. "DOB" . "\t"
		. "Father Name" . "\t"
		. "Mother Name" . "\t"
		. "Result" . "\t"
		. "Month-Year" . "\t"
		. "Division" . "\t"
		. "Percentage" . "\t"
		. "Date of Issue" . "\t"
		. "Exam Type" . "\t"
		. "Total Marks" . "\t"
		. "Total Credit" . "\t"
		. "Total Credit Points" . "\t"
		. "Total Grade Points" . "\t"
		. "CGPA" . "\t"
		. "Remarks" . "\t"
		. "SGPA" . "\t"
		. "ABC Account ID" . "\t"
		. "Term Type" . "\t"
		. "Total Grade" . "\t"
		. "Subject" . "\t"
		. "Subject Code" . "\t"
		. "Subject ID" . "\t"
		. "Full Internal Marks" . "\t"
		. "Full External Marks" . "\t"
		. "Full Practical Marks" . "\t"
		. "Total Full Marks" . "\t"
		. "Internal Marks" . "\t"
		. "External Marks" . "\t"
		. "Practical Marks" . "\t"
		. "Total Obtained Marks" . "\t"
		. "Grade" . "\t"
		. "Grade Points" . "\t"
		. "Credit" . "\t"
		. "Credit Points" . "\t";


	$setData = '';

	$sql_subject = "SELECT * FROM `tbl_subjects` WHERE `status` = '$visible' && course_id = '$course_id' && semester_id = '$semester_id' && fee_academic_year = '$academic_year' ORDER BY `subject_id` ASC ";
	$result_subject = $con->query($sql_subject);

	while ($row_subject = $result_subject->fetch_assoc()) {

		$sql = "SELECT * FROM `tbl_admission`
		INNER JOIN `tbl_course` ON `tbl_course`.`course_id` = `tbl_admission`.`admission_course_name`
		INNER JOIN `tbl_university_details` ON `tbl_university_details`.`university_details_id` = `tbl_admission`.`admission_session`
		WHERE `tbl_admission`.`admission_course_name` = '" . $_POST["course_id"] . "' && `tbl_admission`.`admission_session` = '" . $_POST["academic_year"] . "' && `tbl_admission`.`status` = '$visible' ORDER BY  `tbl_admission`.`admission_first_name` ASC
		";

		$setRec = mysqli_query($con, $sql);

		//echo "<pre>";
		while ($rec = mysqli_fetch_array($setRec)) {
			$rowData = '';
			//print_r($rec);

			$sql_allot = "SELECT * FROM `tbl_allot_semester`
                                    WHERE `academic_year` = '$academic_year' && `course_id` = '$course_id' && `semester_id`='$semester_id' && `admission_id` = '" . $rec["admission_id"] . "'";
			$result_allot = $con->query($sql_allot);
			$row_allot = $result_allot->fetch_assoc();

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
			$code_gen = $row_course['course_code'] > 9 ? $row_course['course_code'] : '0' . $row_course['course_code'];

			$rowData .= $rec["admission_id"] . "\t"
				. "" . "\t" //department name
				. $row_allot["reg_no"] . "\t"
				. $rec["course_name"] . "\t"
				. $rec["academic_session"] . "\t"
				. $row_allot["roll_no"] . "\t"
				. $_POST["semester_id_name"] . "\t"
				. $rec["admission_first_name"] . " " . $rec["admission_middle_name"] . " " . $rec["admission_last_name"] . "\t"
				. $rec["admission_gender"] . "\t"
				. $rec["admission_dob"] . "\t"
				. $rec["admission_father_name"] . "\t"
				. $rec["admission_mother_name"] . "\t"
				. "" . "\t" //result
				. "" . "\t" //month-year
				. "" . "\t" //division
				. "" . "\t" //percentage
				. "" . "\t" //date of issue
				. "" . "\t" //exam type
				. "" . "\t" //total marks
				. "" . "\t" //total credit
				. "" . "\t" //total credit points
				. "" . "\t" //total grade points
				. "" . "\t" //cgpa
				. "" . "\t" //remarks
				. "" . "\t" //sgpa
				. "" . "\t" //abc account
				. "" . "\t" //term type
				. "" . "\t" //total grade
				. $row_subject["subject_name"] . "\t"
				. $row_subject["subject_code"] . "\t"
				. $row_subject["subject_id"];


			$setData .= trim($rowData) . "\n";
			$s_no++;
		}
	}
	// exit; 
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Student List.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo ucwords($columnHeader) . "\n" . $setData . "\n";
