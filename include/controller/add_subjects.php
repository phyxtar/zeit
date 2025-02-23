<?php

//Add new subject Start With Ajax
if ($_POST["action"] == "add_sub") {
    $course_id = $_POST["course_id"];
    $semester_id = $_POST["semester_id"];
    $academic_year = $_POST["academic_year"];
    $subject_name = str_replace("'", "&#39;", $_POST["subject_name"]);
    $subject_code = str_replace("'", "&#39;", $_POST["subject_code"]);
    if (empty($_POST["specialization"])) {
        $specialization_id = null;
    } else {
        $specialization_id = $_POST["specialization"];
    }
    $full_marks = $_POST["full_marks"];
    $pass_marks = $_POST["pass_marks"];
    $credit = $_POST["credit"];
    $exam_date=$_POST['exam_date'];
    if (!empty($course_id && $academic_year) && $subject_name[0] != "" && $subject_code[0] != ""  && $full_marks[0] != "" && $pass_marks[0] != "") {
        $allParticulars = count($subject_name);

        $sql = "";
        for ($i = 0; $i < $allParticulars; $i++) {
            $sql_check = "SELECT * FROM `tbl_subjects`
                                 WHERE `status` = '$visible' && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `subject_name` = '$subject_name[$i]';
                                 ";
            $result = $con->query($sql_check);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $sql .= "UPDATE `tbl_subjects` 
                                SET `subject_code`='$subject_code[$i]',`credit`='$credit[$i]',`specialization_id`='$specialization_id[$i]',`add_time`='$date_variable_today_month_year_with_timing'
                                WHERE `status` = '$visible' && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `subject_name` = '$subject_name[$i]';
                                ";
            } else {
                 $sql .= "INSERT INTO `tbl_subjects`
                                (`subject_id`, `course_id`,`semester_id`, `fee_academic_year`, `subject_name`, `subject_code`,`specialization_id`,`full_marks`,`pass_marks`,`credit`,`add_time`, `status`,`date_of_examination`) 
                                VALUES 
                                (NULL,'$course_id','$semester_id','$academic_year','$subject_name[$i]','$subject_code[$i]','$specialization_id[$i]','$full_marks[$i]','$pass_marks[$i]','$credit[$i]','$date_variable_today_month_year_with_timing','$visible','$exam_date[$i]');";
            }
        }
        if ($con->multi_query($sql))
            echo 'success';
        else
            echo 'error';
    } else
        echo 'empty';
}
//Add new Subject End With Ajax	 