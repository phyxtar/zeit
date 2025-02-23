<?php
include_once "include/config.php";
include_once "framwork/main.php";

$building_id = $_POST['building_id'];
$floor_no = $_POST['floor_no'];

// Fetch floor details
$get_floor = fetchRow('hostel_room', 'building_id=' . $building_id . ' && floor_no=' . $floor_no);

echo '<option selected disabled> Select Room </option>';

for ($i = 1; $i <= $get_floor['total_room']; $i++) {
    $room_no = $get_floor['start'] - 1 + $i;
    $total_bed = fetchRow("hostel_bed", "building_id=" . $building_id . " && `floor_no`=" . $floor_no . " && `room_no`=" . $room_no)['no_of_bed'];
    $total_alloted_bed = get_count('hostel_allotment', 'bed_no', 'building_id=' . $building_id . ' && floor_no=' . $floor_no . ' && room_no=' . $room_no);
    
    if ($total_bed == $total_alloted_bed) {
        echo '<option disabled>' . $room_no . ' Room</option>';
    } else {
        echo '<option value="' . $room_no . '">' . $room_no . ' Room</option>';
    }
}
?>
