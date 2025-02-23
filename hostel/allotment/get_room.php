<?php
include_once "../../framwork/main.php";

$building_id = end($_POST['building_id']);
$floor_no = end($_POST['floor_no']);
$get_floor = fetchRow('hostel_room', 'building_id=' . $building_id . ' && floor_no=' . $floor_no . '');
?>
<option selected disabled> Select Room </option>
<?php
for ($i = 1; $i <= $get_floor['total_room']; $i++) {
    $room_no=$get_floor['start']-1+ $i;
    $total_bed = fetchRow("hostel_bed", "building_id=" . $building_id . " && `floor_no`=" . $floor_no . " && `room_no`=" . $room_no . "")['no_of_bed'];
    $total_alloted_bed =  get_count('hostel_allotment', 'bed_no', 'building_id=' . $building_id . ' && floor_no=' . $floor_no . ' &&  room_no=' . $room_no . '');
    if ($total_bed == $total_alloted_bed) { ?>
<option disabled><?= $room_no ?> Room</option>
<?php
    } else {
    ?>
<option value="<?= $room_no ?>"><?= $room_no ?> Room</option>
<?php
    }
}
?>