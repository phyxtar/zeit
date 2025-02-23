<?php 
include_once "../../framwork/main.php";

$id = $_POST['building_id'];
$get_floor = fetchRow('hostel_building', 'id=' . $id . '');
?>
<option selected disabled > - Select Floor - </option>

<?php 
for ($i = 1; $i <= $get_floor['floar']; $i++) {
   
   $floor_data= fetchRow("hostel_room","building_id=".$id." && `floor_no`=".$i."");
?>
<option value="<?= $i ?>"><?= $i ?> Floor</option>

<?php
}
?>