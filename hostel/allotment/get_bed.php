<?php
include_once "../../framwork/main.php";
include_once "../../include/function.php";

$building_id = end($_POST['building_id']);
$floor_no = end($_POST['floor_no']);
$room_no = end($_POST['room_no']);

$get_floor = fetchRow('hostel_bed', 'building_id=' . $building_id . ' && floor_no=' . $floor_no . ' &&  room_no=' . $room_no . '');
?>
<option selected disabled> Select Room </option>
<?php
if ($get_floor != '') {
    for ($i = 1; $i <= $get_floor['no_of_bed']; $i++) {
        $alloted_student =  fetchRow('hostel_allotment', 'building_id=' . $building_id . ' && floor_no=' . $floor_no . ' &&  room_no=' . $room_no . ' && bed_no=' . $i . '');
        if ($alloted_student == '') { ?>
<option value="<?= $i ?>"><?= $i ?> Bed</option>
<?php
        } else {
            $admission_data = fetchRow('tbl_admission', ' admission_id=' . $alloted_student['admission_id'] . ''); ?>
<option
    title="<?= $admission_data['admission_first_name'] . " " . $admission_data['admission_middle_name'] . " " . $admission_data['admission_last_name'] ?> - <?= get_course($admission_data['admission_course_name']) ?> - <?= get_session($admission_data['admission_session']) ?> - <?= $admission_data['admission_id'] ?>"
    disabled><?= $i ?> Bed</option>
<?php
        }
    }
}
?>