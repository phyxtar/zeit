<?php
include_once "../../framwork/main.php";

if (isset($_POST['building_id'])) {
    $bed = array();
    for ($i = 0; $i < sizeof($_POST['room_no']); $i++) {
        $id = $_POST['id'][$i];
        $bed['building_id'] = $_POST['building_id'];
        $bed['floor_no'] = $_POST['floor_no'];
        $bed['room_no'] = $_POST['room_no'][$i];
        $bed['no_of_bed'] = $_POST['no_of_bed'][$i];
        if ($id != '' && $id > 0) {
            $result =  updateAll('hostel_bed', $bed, ' id=' . $id . '');
        } else {
            $result =  insertAll('hostel_bed', $bed);
        }
    }
    if ($result == "success") {
        echo success_alert('Data Added Successfully');
    } else {
        echo  danger_alert($conn->error);
    }
}
