<?php
include '../../include/config.php';
error_reporting(0);
$visible = md5("visible");

$course_id = $_POST['course_id'];
$session_id = $_POST['session_id'];

$status = $_POST['status'];

if ($course_id == 'all') {
    if ($status == 'active') {
        $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` WHERE `hostel_leave_date` = '' ORDER BY `tbl_admission`.`admission_first_name` ASC
		";
    } else if ($status == 'inactive') {
        $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` WHERE `hostel_leave_date` != '' ORDER BY `tbl_admission`.`admission_first_name` ASC
		";
    } else {
        $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` ORDER BY `tbl_admission`.`admission_first_name` ASC
		";
    }
} elseif ($course_id == 'all' && $building_id != 'all' && $floor_id == 'all' && $room_id == 'all' && $bed_id == 'all' && $gender == 'all') {
    $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` WHERE
        `hostel_allotment`.`building_id` = '" . $building_id . "' ORDER BY  `tbl_admission`.`admission_first_name` ASC
		";
} elseif ($course_id == 'all' && $building_id == 'all' && $floor_id != 'all' && $room_id == 'all' && $bed_id == 'all' && $gender == 'all') {
    $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` WHERE
        `floor_no` = '" . $floor_id . "' ORDER BY  `tbl_admission`.`admission_first_name` ASC
		";
} elseif ($course_id == 'all' && $building_id == 'all' && $floor_id == 'all' && $room_id != 'all' && $bed_id == 'all' && $gender == 'all') {
    $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` WHERE
        `room_no` = '" . $room_id . "' ORDER BY  `tbl_admission`.`admission_first_name` ASC
		";
} elseif ($course_id == 'all' && $building_id == 'all' && $floor_id == 'all' && $room_id == 'all' && $bed_id != 'all' && $gender == 'all') {
    $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` WHERE
        `bed_no` = '" . $bed_id . "' ORDER BY  `tbl_admission`.`admission_first_name` ASC
		";
} elseif ($course_id != 'all' && $building_id == 'all' && $floor_id == 'all' && $room_id == 'all' && $bed_id == 'all' && $gender == 'all') {
    $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` WHERE
        `admission_course_name` = '" . $course_id . "' ORDER BY  `tbl_admission`.`admission_first_name` ASC
		";
} elseif ($course_id == 'all' && $building_id == 'all' && $floor_id == 'all' && $room_id == 'all' && $bed_id == 'all' && $gender != 'all') {
    $query = "SELECT * FROM `tbl_admission`
		INNER JOIN `hostel_allotment` ON `tbl_admission`.`admission_id` = `hostel_allotment`.`admission_id` WHERE
        `admission_gender` = '" . $gender . "' ORDER BY  `tbl_admission`.`admission_first_name` ASC
		";
}

$result = $con->query($query);

// print_r($query);
// die();

if ($result->num_rows > 0) {
    $s_no = 1;
    while ($row = $result->fetch_assoc()) {
        ?>

        <tr>
            <!-- S.No. -->
            <td><?= $s_no; ?></td>

            <!-- Reg. No. -->
            <td><?= $row["admission_id"] ?></td>

            <!-- Name -->
            <td><?= $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"] ?>
            </td>

            <!-- Father's Name -->
            <td><?= $row["admission_father_name"] ?></td>

            <!-- Course -->
            <td><?= $row["course_name"] ?></td>

            <!-- Session -->
            <td><?= $row["academic_session"] ?></td>

            <!-- Gender -->
            <td><?= $row["building_id"] ?></td>

            <td><?= $row["floor_no"] ?></td>

            <td><?= $row["room_no"] ?></td>

            <td><?= $row["bed_no"] ?></td>

            <!-- Status -->
            <td>
                <?php
                if ($row["hostel_leave_date"] == "") {
                    echo '<button class="btn btn-success">Occupied</button>';
                } else {
                    echo '<button class="btn btn-danger">Unoccupied</button>';
                }
                ?>
            </td>
        </tr>
        <?php
        $s_no++;
    }
} else
    echo '
            <div class="alert alert-warning alert-dismissible">
                <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
            </div>';
?>