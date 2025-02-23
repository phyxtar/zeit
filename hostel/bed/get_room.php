<?php
include_once "../../framwork/main.php";
$building_id = $_POST['building_id'];
$floor_no = $_POST['floor_no'];
$get_floor = fetchRow('hostel_room', 'building_id=' . $building_id . ' && floor_no=' . $floor_no . '');
for ($i = 1; $i <= $get_floor['total_room']; $i++) {
    $room_no=$get_floor['start']-1+ $i;
    $floor_data = fetchRow("hostel_bed", "building_id=" . $building_id . " && `floor_no`=" . $floor_no . " && room_no=" . $room_no . " ");
?>
    <div class="row  p-2">
        <div class="col-sm-2 form-group">
            <input type="hidden" name="id[]" value="<?= $floor_data!=''? $floor_data['id'] :'' ?>">
            <label for="">Room No</label>
            <input name="room_no[]" class="form-control form-control-sm " type="number" readonly value="<?=  $room_no ?>">
        </div>

        <div class="col-sm-2 form-group">
            <label for=""> Total No of Bed</label>
            <input name="no_of_bed[]" class="form-control form-control-sm  " value="<?= $floor_data['no_of_bed'] ?>" type="number">
        </div>
    </div>

<?php
}
?>