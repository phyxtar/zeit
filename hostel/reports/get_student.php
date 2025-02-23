<?php
include_once "../../framwork/main.php";
$course_id = $_POST['course_id'];
$session_id = $_POST['academic_year'];
$get_student = fetchResult('tbl_admission', 'admission_course_name=' . $course_id . ' && admission_session=' . $session_id . ' && admission_hostel="Yes" && hostel_leave_date="" ');
$sno = 1;
if (mysqli_num_rows($get_student) > 0) {
?>
    <div class="row  p-2">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S.no </th>
                    <th>Reg No</th>
                    <th>Studdent Name</th>
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
                    $check_student = fetchRow('hostel_allotment', 'admission_id=' . $row['admission_id'] . ' && bed_no!=""');
                    // if ( isset($check_student['bed_no']) && $check_student['bed_no'] != '') {
                ?>
                        <tr>
                            <input type="hidden" name="id[]" value="<?= $check_student['id']   ?>">
                            <td><?= $sno ?></td>
                            <input type="hidden" value="<?= $row['admission_id'] ?>" name="admission_id[]">
                            <td><?= $row['admission_id'] ?></td>
                            <td><?= $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?></td>
                            <td><?= $row['admission_father_name'] ?></td>
                            <td><?= date('d-M-Y', strtotime($row['date_of_admission'])) ?></td>
                            <td>
                                <?php while ($building_row = mysqli_fetch_assoc($building)) { ?>
                                    <?=  $check_student['building_id'] == $building_row['id'] ?  $building_row['name'] . " - " . $building_row['building_code'] : '' ?>
                                <?php } ?>

                            </td>
                            <td>
                                <?= $check_student==''?'': $check_student['floor_no'] ?>
                            </td>
                            <td>
                                <?=$check_student==''?'': $check_student['room_no'] ?>
                            </td>
                            <td>
                                <?= $check_student==''?'': $check_student['bed_no'] ?>
                            </td>
                        </tr>
                <?php
                        $sno++;
                    }
                // }
                ?>
            </tbody>
        </table>
        <!-- <div class="text-center col-12">
            <button type="button" onclick="ajaxCall('form_id', 'allot_student', 'success')" class="btn btn-primary"> Submit </button>
        </div> -->
    </div>
<?php } ?>