<?php
include_once "../../framwork/main.php";

$id = end($_POST['building_id']);
$get_floor = fetchRow('hostel_building', 'id=' . $id . '');
?>
<option selected disabled> Select floor </option>

<?php
for ($i = 1; $i <= $get_floor['floar']; $i++) {

   $total_room = fetchRow("hostel_room", "building_id=" . $id . " && `floor_no`=" . $i . "")['room_no'];
   $total_alloted_room =  get_count('hostel_allotment', 'room_no', 'building_id=' . $id . ' && floor_no=' . $i . '');
   if ($total_room == $total_alloted_room) { ?>
<option disabled><?= $i ?> Floor</option>
<?php } else { ?>
<option value="<?= $i ?>"><?= $i ?> Floor</option>
<?php
   }
}
?>