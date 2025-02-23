<?php
include_once "../../framwork/main.php";

if (isset($_POST['building_id'])) {
    $student_allotment = array();
    if (isset($_POST['bed_no']) && count($_POST['bed_no']) > 0) {
        for ($i = 0; $i < count($_POST['bed_no']); $i++) {
            if (isset($_POST['bed_no'][$i]) && $_POST['bed_no'][$i] != '') {
                $student_allotment['building_id'] = $_POST['building_id'][$i];
                $student_allotment['admission_id'] = $_POST['admission_id'][$i];
                $student_allotment['floor_no'] = $_POST['floor_no'][$i];
                $student_allotment['room_no'] = $_POST['room_no'][$i];
                $student_allotment['bed_no'] = $_POST['bed_no'][$i];
                $student_allotment['allot_by'] = $_SESSION['logger_username'];

                $check_student =  fetchRow('hostel_allotment', ' admission_id=' . $student_allotment['admission_id'] . '');
                if ($check_student == '') {
                    $result =  insertAll('hostel_allotment', $student_allotment);
                } else {
                    $result =  updateAll('hostel_allotment', $student_allotment, ' admission_id=' . $student_allotment['admission_id'] . '');
                    if ($result != "success") {
                        echo danger_alert(" This room no is already alloted to the Another student ");
                        exit;
                    }
                }
            }
        }

        if ($result == "success") {
            echo "<span class='text-success'> Success </span>";
        } else {
            //  echo  danger_alert($conn->error);
            echo "<span class='text-danger'> " . $conn->error . " </span>";
        }
    } else {
        echo warning_alert("Select All inputs Like - Building, Floor, Room, Bed ");
    }
} else {
    echo warning_alert("Select atleast one Student all inputs Like - Building, Floor, Room, Bed ");
}
