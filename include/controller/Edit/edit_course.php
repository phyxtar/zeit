<?php
if ($_POST["action"] == "edit_courses") {
    $edit_course_name = $_POST["edit_course_name"];
    $edit_prospectus_rate = $_POST["edit_prospectus_rate"];
    $edit_course_duration = $_POST["edit_course_duration"];
    $edit_course_id = $_POST["edit_course_id"];
    $course_code = $_POST["edit_course_code"];
    $edit_program_type = $_POST["edit_program_type"];
       
    $sql = "UPDATE `tbl_course` 
                    SET 
                     `course_name` = '$edit_course_name',
                     `prospectus_rate` = '$edit_prospectus_rate',
                     `duration` = '$edit_course_duration' ,
                     `course_code` = '$course_code' ,
                     `program_type` = '$edit_program_type' ,
                     `course_time` = '$date_variable_today_month_year_with_timing' 
                    WHERE `status` = '$visible' && `course_id` = '$edit_course_id';
                    ";
    if ($con->query($sql))
        echo 'success';
    else
        echo 'error';
}

