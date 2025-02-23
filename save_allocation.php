<?php
include_once "include/config.php";
include_once "framwork/main.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admission_id = $_POST['admission_id'];
    $building_id = $_POST['building_id'];
    $floor_no = $_POST['floor_no'];
    $room_no = $_POST['room_no'];
    $bed_no = $_POST['bed_no'];
    $allot_by = $_SESSION['logger_username']; // Fetching the allot_by from the session

    if ($admission_id && $building_id && $floor_no && $room_no && $bed_no) {
        // Check if a record already exists for the given admission_id
        $check_query = "SELECT * FROM `hostel_allotment` WHERE `admission_id` = '$admission_id'";
        $check_result = $con->query($check_query);

        if ($check_result->num_rows > 0) {
            // Update existing record
            $update_query = "UPDATE `hostel_allotment` 
                             SET `building_id` = '$building_id', 
                                 `floor_no` = '$floor_no',
                                 `room_no` = '$room_no', 
                                 `bed_no` = '$bed_no',
                                 `allot_by` = '$allot_by' 
                             WHERE `admission_id` = '$admission_id'";
            if ($con->query($update_query)) {
                echo 'Successfully updated allotment for ID: ' . $admission_id;
            } else {
                echo 'Error updating record: ' . $con->error;
            }
        } else {
            // Insert new record
            $insert_query = "INSERT INTO `hostel_allotment` (`admission_id`, `building_id`, `floor_no`, `room_no`, `bed_no`, `allot_by`) 
                             VALUES ('$admission_id', '$building_id', '$floor_no', '$room_no', '$bed_no', '$allot_by')";
            if ($con->query($insert_query)) {
                echo 'Successfully allotted to ID: ' . $admission_id;
            } else {
                echo 'Error inserting record: ' . $con->error;
            }
        }
    } else {
        echo 'Invalid input';
    }
}