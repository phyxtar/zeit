<?php
include_once "../include/config.php";

//Add new subject Start With Ajax
if ($_POST["action"] == "add_sub") {
    $course_id = $_POST["course_id"];
    $semester_id = $_POST["semester_id"];
    $academic_year = $_POST["academic_year"];
    $subject_name = $_POST["subject_name"];
    $subject_code = $_POST["subject_code"];

    if (!empty($course_id && $academic_year) && $subject_name[0] != "" && $subject_code[0] != "") {
        $allParticulars = count($subject_name);

        $sql = "";
        for ($i = 0; $i < $allParticulars; $i++) {
            $sql_check = "SELECT * FROM `time_tbl_subject`
                                 WHERE `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `subject_name` = '$subject_name[$i]';
                                 ";
            $result = mysqli_query($con, $sql_check);
            if (mysqli_num_rows($result) > 0) {
                $sql .= "UPDATE `time_tbl_subject`
                                SET `subject_code`='$subject_code[$i]' , `subject_name`='$subject_name[$i]',
                                WHERE  && `course_id` = '$course_id' && `fee_academic_year` = '$academic_year' && `subject_name` = '$subject_name[$i]';
                                ";
            } else {
                $sql .= "INSERT INTO `time_tbl_subject`
                                (`id`, `course_id`,`semester_id`, `fee_academic_year`, `subject_name`, `subject_code`)
                                VALUES
                                (NULL,'$course_id','$semester_id','$academic_year','$subject_name[$i]','$subject_code[$i]')";
            }
        }
        if ($con->multi_query($sql)) {
            echo 'success';
        } else {
            echo 'error';
        }

    } else {
        echo 'empty';
    }

}
//Add new Subject End With Ajax
