<?php
include_once "include/config.php";
include_once "framwork/main.php";
include_once "include/function.php";

$building_id = $_POST['building_id'];
$floor_no = $_POST['floor_no'];
$room_no = $_POST['room_no'];

// Fetch the number of beds in the specified room
$get_floor = fetchRow('hostel_bed', 'building_id=' . $building_id . ' && floor_no=' . $floor_no . ' && room_no=' . $room_no);

echo '<option selected disabled> Select Bed </option>';

if ($get_floor) {
    for ($i = 1; $i <= $get_floor['no_of_bed']; $i++) {
        $alloted_student = fetchRow('hostel_allotment', 'building_id=' . $building_id . ' && floor_no=' . $floor_no . ' && room_no=' . $room_no . ' && bed_no=' . $i);
        
        if ($alloted_student == '') {
            echo '<option value="' . $i . '">' . $i . ' Bed</option>';
        } else {
            $admission_data = fetchRow('tbl_admission', 'admission_id=' . $alloted_student['admission_id']);
            $course_name = get_course($admission_data['admission_course_name']);
            $session_name = get_session($admission_data['admission_session']);
            echo '<option title="' . $admission_data['admission_first_name'] . ' ' . $admission_data['admission_middle_name'] . ' ' . $admission_data['admission_last_name'] . ' - ' . $course_name . ' - ' . $session_name . ' - ' . $admission_data['admission_id'] . '" disabled>' . $i . ' Bed</option>';
        }
    }
} else {
    echo '<option disabled>No beds available</option>';
}
?>
