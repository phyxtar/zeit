<?php
include_once "../../framwork/main.php";
$course_id = $_POST['course_id'];
$session_id = $_POST['academic_year'];
$get_student = fetchResult('tbl_admission', 'admission_course_name=' . $course_id . ' && admission_session=' . $session_id . ' && admission_hostel="Yes" && hostel_leave_date="" ');
$sno = 1;
if (mysqli_num_rows($get_student) > 0) {
    ?>
    <div class="row  p-2">
        <!-- <form action="">
            <button type="submit" class="btn btn-warning mb-3"><i class="fa fa-download"></i> Export All</button>
        </form> -->
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
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($get_student)) {
                    $building = fetchResult('hostel_building');
                    $check_student = fetchRow('hostel_allotment', 'admission_id=' . $row['admission_id'] . '');

                    ?>
                    <tr>
                        <input type="hidden" name="id[]" value="<?= $check_student['id'] ?>">
                        <td>
                            <?= $sno ?>
                        </td>
                        <input type="hidden" value="<?= $row['admission_id'] ?>" name="admission_id[]">
                        <td>
                            <?= $row['admission_id'] ?>
                        </td>
                        <td>
                            <?= $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>
                        </td>
                        <td>
                            <?= $row['admission_father_name'] ?>
                        </td>
                        <td>
                            <?= date('d-M-Y', strtotime($row['date_of_admission'])) ?>
                        </td>
                        <td>
                            <?php
                            if ($check_student && !empty($check_student['building_id'])) {

                                $selectedBuilding = mysqli_fetch_assoc(fetchResult('hostel_building', 'id=' . $check_student['building_id']));
                                ?>
                                <span>
                                    <?= $selectedBuilding['name'] ?> -
                                    <?= $selectedBuilding['building_code'] ?> -
                                    <?= $selectedBuilding['floar'] ?>
                                </span>
                                <?php
                            } else {

                                echo '<span>No building associated</span>';
                            }
                            ?>
                        </td>

                        <td>
                            <?php
                            $floor_number = '';
                            if (!empty($check_student['admission_id'])) {
                                $floor_info = fetchRow('hostel_allotment', 'admission_id=' . $check_student['admission_id']);
                                if (!empty($floor_info['floor_no'])) {
                                    $floor_number = $floor_info['floor_no'];
                                }
                            }
                            echo $floor_number !== '' ? $floor_number . ' Floor' : 'No floor associated';
                            ?>
                        </td>
                        <td>
                            <?php
                            $room_number = '';
                            if (!empty($check_student['admission_id'])) {
                                $room_info = fetchRow('hostel_allotment', 'admission_id=' . $check_student['admission_id']);
                                if (!empty($room_info['room_no'])) {
                                    $room_number = $room_info['room_no'];
                                }
                            }
                            echo $room_number !== '' ? $room_number . ' Room' : 'No room associated';
                            ?>
                        </td>
                        <td>
                            <?php
                            $bed_number = '';
                            if (!empty($check_student['admission_id'])) {
                                $bed_info = fetchRow('hostel_allotment', 'admission_id=' . $check_student['admission_id']);
                                if (!empty($bed_info['bed_no'])) {
                                    $bed_number = $bed_info['bed_no'];
                                }
                            }
                            echo $bed_number !== '' ? $bed_number . ' Bed' : 'No bed associated';
                            ?>
                            <small id="bed_data_<?= $sno ?>"></small>
                        </td>
                    </tr>
                    <?php
                    $sno++;
                }
                ?>
            </tbody>
        </table>
    </div>
<?php } else {
    echo '
    <div class="alert alert-warning alert-dismissible">
        <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
    </div>';
}
?>