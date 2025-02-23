<?php
include_once "../../framwork/main.php";

// Capture the values from the POST request
$course_id = $_POST['course_id'];
$session_id = $_POST['academic_year'];
$type = $_POST['type']; // Capture the type (male/female)

// Build the query string
$query = 'SELECT * FROM tbl_admission WHERE admission_course_name=' . $course_id . ' AND admission_gender="' . $type . '" AND admission_session=' . $session_id . ' AND admission_hostel="Yes" AND hostel_leave_date=""';

// Execute the query
$get_student = mysqli_query($con, $query); 

// Check for query execution errors
if (!$get_student) {
    die("Query Failed: " . mysqli_error($con));
}

// Check if there are any rows returned
if (mysqli_num_rows($get_student) > 0) {
    $sno = 1;
    ?>
<div class="row p-2">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.no </th>
                <th>Reg No</th>
                <th>Student Name</th>
                <th>Father name</th>
                <th>Date of Admission</th>
                <th>Building</th>
                <th>Floor</th>
                <th>Room</th>
                <th>Bed</th>
                <?php if ($_SESSION['admin']['admin_type'] == "superadmin" || $_SESSION['admin']['admin_type'] == "subadmin") { ?>
                <th>Dis Allotment</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($get_student)) {
                    $building = fetchResult('hostel_building');
                    $check_student = fetchRow('hostel_allotment', 'admission_id=' . $row['admission_id']);
                ?>
            <tr>
                <input type="hidden" name="id[]" value="<?= $check_student['id']   ?>">
                <td><?= $sno ?></td>
                <input type="hidden" value="<?= $row['admission_id'] ?>" name="admission_id[]">
                <td><?= $row['admission_id'] ?></td>
                <td><?= $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>
                </td>
                <td><?= $row['admission_father_name'] ?></td>
                <td><?= date('d-M-Y', strtotime($row['date_of_admission'])) ?></td>
                <td> <select type="text" class="form-control form-control-sm building" name="building_id[]"
                        onchange="ajaxCall('form_id', 'get_floor', 'floor_<?= $sno ?>')" required>
                        <?php if (!isset($check_student['building_id']) &&  $check_student['building_id'] == '') { ?>
                        <option selected disabled> -Select Building- </option>
                        <?php while ($building_row = mysqli_fetch_assoc($building)) { ?>
                        <option value="<?= $building_row['id'] ?>"><?= $building_row['name'] ?> -
                            <?= $building_row['building_code'] ?> - <?= $building_row['floar'] ?></option>
                        <?php } ?>
                        <?php } else { ?>
                        <?php while ($building_row = mysqli_fetch_assoc($building)) { ?>
                        <option <?= $check_student['building_id'] == $building_row['id'] ? "selected" : "" ?>
                            value="<?= $building_row['id'] ?>"><?= $building_row['name'] ?> -
                            <?= $building_row['building_code'] ?> - <?= $building_row['floar'] ?></option>
                        <?php }
                                } ?>
                            </select>
                        </td>
                        <td>
                            <select required type="text" onchange="ajaxCall('form_id', 'get_room', 'room_<?= $sno ?>')"
                                class="form-control form-control-sm floor" name="floor_no[]" id="floor_<?= $sno ?>" required>
                                <?php if (!isset($check_student['floor_no']) && $check_student['floor_no'] == '') { ?>
                                    <option selected disabled> -Select floor- </option>
                                <?php } else { ?>
                                    <option value="<?= $check_student['floor_no'] ?>"> <?= $check_student['floor_no'] ?> Floor
                                    </option>

                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <select required type="text" onchange="ajaxCall('form_id', 'get_bed', 'bed_<?= $sno ?>')"
                                class="form-control form-control-sm room" name="room_no[]" id="room_<?= $sno ?>" required>
                                <?php if (!isset($check_student['room_no']) && $check_student['room_no'] == '') { ?>
                                    <option selected disabled> -Select Room- </option>
                                <?php } else { ?>
                                    <option value="<?= $check_student['room_no'] ?>"> <?= $check_student['room_no'] ?> Room
                                    </option>

                                <?php } ?>
                            </select>
                        </td>
                        <td>

                    <select onchange="" required type="text" class="form-control form-control-sm bed" name="bed_no[]"
                        id="bed_<?= $sno ?>" required>
                        <?php if (!isset($check_student['bed_no']) &&  $check_student['bed_no'] == '') { ?>
                        <option selected disabled> -Select Room- </option>
                        <?php } else { ?>
                        <option value="<?= $check_student['bed_no'] ?>"> <?= $check_student['bed_no'] ?> Bed </option>

                                <?php } ?>
                            </select>
                            <small id="bed_data_<?= $sno ?>"></small>
                        </td>
                        <td>
                            <?php
                            if ($_SESSION['admin']['admin_type'] == "superadmin" || $_SESSION['admin']['admin_type'] == "subadmin") { ?>
                    <button type="button" id="success<?= $sno ?>" class="btn btn-danger btn-sm"
                        onclick="deleteForm('<?= url('hostel/disallotment/delete') ?>', '<?= $row['admission_id'] ?>', 'success<?= $sno ?>')">
                        <i class="fas fa-trash">
                        </i>
                    </button>
                    <?php } ?>
                </td>
                <td>
                    <button class="btn-sm btn btn-success"
                        onClick="ajaxCall('form_id', 'allot_student', 'bed_data_<?= $row['admission_id'] ?>')">Save</button>
                </td>
            </tr>
            <?php $sno++; } ?>
        </tbody>
    </table>
</div>
<?php
} else {
    echo "No students found.";
}
?>