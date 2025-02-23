<?php
include_once "../../framwork/main.php";
$id = $_POST['building_id'];
$get_floor = fetchRow('hostel_building', 'id=' . $id . '');
for ($i = 1; $i <= $get_floor['floar']; $i++) {

    $floor_data = fetchRow("hostel_room", "building_id=" . $id . " && `floor_no`=" . $i . "");
?>
    <div class="row  p-2">
        <input type="hidden" value="<?= $floor_data['id'] ?>" name="id[]">
        <div class="col-sm-2 form-group">
            <label for="">floor No</label>
            <input name="floor_no[]" class="form-control form-control-sm " type="number" readonly value="<?= $i ?>">
        </div>
        <div class="col-sm-2 form-group">
            <label for="">start Room No</label>
            <input name="start[]" class="form-control form-control-sm  start " value="<?= $floor_data != '' ? $floor_data['start'] : '' ?>" type="number">
        </div>
        <div class="col-sm-2 form-group">
            <label for="">end Room No</label>
            <input name="end[]" class="form-control form-control-sm  end " onkeyup="calculation1()" value="<?= $floor_data != '' ? $floor_data['end'] : '' ?>" type="number">
        </div>
        <div class="col-sm-2 form-group">
            <label for=""> Total No of Room</label>
            <input readonly name="total_room[]" class="form-control form-control-sm no_of_room " value="<?= $floor_data != '' ? $floor_data['total_room'] : '' ?>" type="number">
        </div>
    </div>

<?php
}
?>
