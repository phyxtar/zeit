<?php

include_once "../../../framwork/main.php";

if (isset($_POST['staff_id']) && $_POST['staff_id'] != '') {
    for ($i = 0; $i < count($_POST['staff_id']); $i++) {
        $data['staff_id'] = $_POST['staff_id'][$i];
        $data['course_id'] = $_POST['course_id'];
        // $data['subject_id'] = $_POST['subject_id'][$i];
        $data['academic_year'] = $_POST['academic_year'];
        $data['semester_id'] = $_POST['semester_id'];
        $result = insertAll('teacher_allot_tbl', $data);
    }


    if ($result == "success") {
        echo success_alert('Data Added Successfully');
    } else {
        echo  danger_alert($conn->error);
    }
}
