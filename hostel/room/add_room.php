<?php
include_once "../../framwork/main.php";

if (isset($_POST['building_id'])) {
    $room = array();
    for ($i = 0; $i < sizeof($_POST['floor_no']); $i++) {
        $id = $_POST['id'][$i];
        $room['building_id'] = $_POST['building_id'];
        $room['floor_no'] = $_POST['floor_no'][$i];
        $room['start'] = $_POST['start'][$i];
        $room['end'] = $_POST['end'][$i];
        $room['total_room'] = $_POST['total_room'][$i];
        if ($id != '' && $id > 0) {
            $result =  updateAll('hostel_room', $room, ' id=' . $id . '');
        } else {
            $result =  insertAll('hostel_room', $room);
        }
    }
    if ($result == "success") {
        echo success_alert('Data Added Successfully');
    } else {
        echo  danger_alert($conn->error);
    }
}
