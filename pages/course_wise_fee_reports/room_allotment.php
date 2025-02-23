<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_GET["action"] == "fetch_hostel_list") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $type = 'all';
    $gender = $_POST['gender'];
    $s_no = 1;
    $total_fee_amount = 0;
    $total_paid_amount = 0;
    $total_rebate_amount = 0;
?>

<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="">S.Nos</th>
            <th width="">Reg. No</th>
            <th width="">Student Name</th>
            <th width="">Father Name</th>
            <th width="">Date of Admission</th>
            <th width="">Building</th>
            <th width="">Floor</th>
            <th width="">Room</th>
            <th width="">Bed</th>
        </tr>
    </thead>
    <tbody id="myTable">


        <?php
        //     if ($course_id == "all" && $academic_year == "all" && $gender == "all")
        //         $sql = "SELECT * FROM `tbl_admission`
        //                      WHERE `status` = '$visible' && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''
        //                      ORDER BY `admission_id` ASC
        //                      ";
        //     else if ($course_id == "all" && $academic_year == "all")
        //         $sql = "SELECT * FROM `tbl_admission`
        //     WHERE `status` = '$visible' && `admission_gender` = '$gender' && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''
        //     ORDER BY `admission_id` ASC
        //     ";
        //     else if ($gender == "all")
        //         $sql = "SELECT * FROM `tbl_admission`
        //  WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_course_name` = '$course_id'  && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''
        //  ORDER BY `admission_id` ASC
        //  ";
        //     else
        //         $sql = "SELECT * FROM `tbl_admission`
        //  WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_gender` = '$gender' && `admission_course_name` = '$course_id'  && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''
        //  ORDER BY `admission_id` ASC
        //  ";


        if ($course_id == "all" && $academic_year == "all" && $gender == "all")
        $sql = "SELECT * FROM `tbl_admission`
                     WHERE `status` = '$visible' && `admission_hostel` = 'yes' 
                     ORDER BY `admission_id` ASC
                     ";
    else if ($course_id == "all" && $academic_year == "all")
        $sql = "SELECT * FROM `tbl_admission`
    WHERE `status` = '$visible' && `admission_gender` = '$gender' && `admission_hostel` = 'yes' 
    ORDER BY `admission_id` ASC
    ";
    else if ($gender == "all")
        $sql = "SELECT * FROM `tbl_admission`
 WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_course_name` = '$course_id'  && `admission_hostel` = 'yes' 
 ORDER BY `admission_id` ASC
 ";
    else
        $sql = "SELECT * FROM `tbl_admission`
 WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_gender` = '$gender' && `admission_course_name` = '$course_id'  && `admission_hostel` = 'yes' 
 ORDER BY `admission_id` ASC
 ";

            $result = $con->query($sql);
            if (!$result) {
                die("Query failed: " . $con->error);
            }

            if ($result->num_rows > 0) {
                // Fetch all buildings for dropdown
                $all_buildings_query = "SELECT `id`, `name`, `building_code` FROM `hostel_building`";
                $all_buildings_result = $con->query($all_buildings_query);
                $buildings = [];
                if ($all_buildings_result->num_rows > 0) {
                    while ($building = $all_buildings_result->fetch_assoc()) {
                        $buildings[] = $building;
                    }
                }

                while ($row = $result->fetch_assoc()) {
                    $admission_id = $row['admission_id'];
                    $check_student = $con->query("SELECT * FROM `hostel_allotment` WHERE `admission_id` = '$admission_id'");
                    $student_details = $check_student->fetch_assoc();

                    // Get the allotted building ID
                    $allotted_building_id = isset($student_details['building_id']) ? $student_details['building_id'] : null;
                    $allotted_floor_no = isset($student_details['floor_no']) ? $student_details['floor_no'] : null;
                    $allotted_room_no = isset($student_details['room_no']) ? $student_details['room_no'] : null;
                    $allotted_bed_no = isset($student_details['bed_no']) ? $student_details['bed_no'] : null;
            ?>
        <tr class="search-row">
            <td><?php echo $s_no; ?></td>
            <td><?php echo $row["admission_id"]; ?></td>
            <td><?php echo $row["admission_first_name"] . ' ' . $row["admission_middle_name"] . ' ' . $row["admission_last_name"]; ?>
            </td>
            <td><?php echo $row["admission_father_name"]; ?></td>
            <td><?php echo $row["date_of_admission"]; ?></td>
            <td>
                <select id="building_dropdown_<?php echo $admission_id; ?>"
                    name="building_dropdown_<?php echo $admission_id; ?>" class="form-control">
                    <option value="">Select Building</option>
                    <?php
                                foreach ($buildings as $building) {
                                    $selected = ($building['id'] == $allotted_building_id) ? 'selected' : '';
                                    echo '<option value="' . $building['id'] . '" ' . $selected . '>' . $building['name'] . ' (' . $building['building_code'] . ')</option>';
                                }
                                ?>
                </select>
            </td>
            <td>
                <select id="floor_dropdown_<?php echo $admission_id; ?>"
                    name="floor_dropdown_<?php echo $admission_id; ?>" class="form-control">
                    <option value="">Select Floor</option>
                    <?php
                                for ($i = 1; $i <= 10; $i++) {
                                    $selected = ($i == $allotted_floor_no) ? 'selected' : '';
                                    echo '<option value="' . $i . '" ' . $selected . '>' . $i . ' Floor</option>';
                                }
                                ?>
                </select>
            </td>
            <td>
                <select id="room_dropdown_<?php echo $admission_id; ?>"
                    name="room_dropdown_<?php echo $admission_id; ?>" class="form-control">
                    <option value="">Select Room</option>
                    <?php
                                if ($allotted_building_id && $allotted_floor_no) {
                                    $get_floor = fetchRow('hostel_room', 'building_id=' . $allotted_building_id . ' && floor_no=' . $allotted_floor_no);
                                    if ($get_floor) {
                                        for ($i = 1; $i <= $get_floor['total_room']; $i++) {
                                            $room_no = $get_floor['start'] - 1 + $i;
                                            $total_bed = fetchRow("hostel_bed", "building_id=" . $allotted_building_id . " && `floor_no`=" . $allotted_floor_no . " && `room_no`=" . $room_no)['no_of_bed'];
                                            $total_alloted_bed = get_count('hostel_allotment', 'bed_no', 'building_id=' . $allotted_building_id . ' && floor_no=' . $allotted_floor_no . ' && room_no=' . $room_no);
                                            $selected = ($room_no == $allotted_room_no) ? 'selected' : '';
                                            $disabled = ($total_bed == $total_alloted_bed && $room_no != $allotted_room_no) ? 'disabled' : '';
                                            $color = ($disabled) ? 'style="color: red;"' : '';
                                            echo "<option value='$room_no' $selected $disabled $color>$room_no Room</option>";
                                        }
                                    }
                                }
                                ?>
                </select>
            </td>
            <td>
                <select id="bed_dropdown_<?php echo $admission_id; ?>" name="bed_dropdown_<?php echo $admission_id; ?>"
                    class="form-control">
                    <option value="">Select Bed</option>
                    <?php
                                if ($allotted_building_id && $allotted_floor_no && $allotted_room_no) {
                                    $get_beds = fetchRow('hostel_bed', 'building_id=' . $allotted_building_id . ' && floor_no=' . $allotted_floor_no . ' && room_no=' . $allotted_room_no);
                                    if ($get_beds) {
                                        for ($i = 1; $i <= $get_beds['no_of_bed']; $i++) {
                                            $alloted_student = fetchRow('hostel_allotment', 'building_id=' . $allotted_building_id . ' && floor_no=' . $allotted_floor_no . ' && room_no=' . $allotted_room_no . ' && bed_no=' . $i);
                                            $selected = ($i == $allotted_bed_no) ? 'selected' : '';
                                            $disabled = ($alloted_student && $i != $allotted_bed_no) ? 'disabled' : '';
                                            $color = ($disabled) ? 'style="color: red;"' : '';
                                            echo "<option value='$i' $selected $disabled $color>$i Bed</option>";
                                        }
                                    }
                                }
                                ?>
                </select>
            </td>

            <td>
                <button type="button" onclick="saveAllocation('<?php echo $admission_id; ?>')"
                    class="btn btn-success btn-sm">Save</button>

            </td>
            <td>
                <button type="button" id="success<?= $s_no ?>" class="btn btn-danger btn-sm"
                    onclick="deleteAllocation('<?= $admission_id ?>', '<?= $s_no ?>')">
                    <i class="fas fa-trash"></i>
                </button>
            </td>


        </tr>
        <?php
                    $s_no++;
                }
            } else {
                echo '<div class="alert alert-warning alert-dismissible">
                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                  </div>';
            }
            ?>
    </tbody>
</table>

<?php
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function saveAllocation(admissionId) {
    var buildingId = $('#building_dropdown_' + admissionId).val();
    var floorNo = $('#floor_dropdown_' + admissionId).val();
    var roomNo = $('#room_dropdown_' + admissionId).val();
    var bedNo = $('#bed_dropdown_' + admissionId).val();
    var allotBy = "<?php echo $_SESSION['logger_username']; ?>";
    if (buildingId && floorNo && roomNo) {
        $.ajax({
            url: 'save_allocation.php', // URL of the PHP script to save allocation
            type: 'POST',
            data: {
                admission_id: admissionId,
                building_id: buildingId,
                floor_no: floorNo,
                room_no: roomNo,
                bed_no: bedNo,
                allot_by: allotBy // Send allot_by to PHP
            },
            success: function(response) {
                alert(response); // You can customize this response handling
                if (response === 'Success') {
                    // Optionally refresh or update the table
                } else {
                    console.error('Error:', response); // Handle errors
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error); // Handle AJAX errors
            }
        });
    } else {
        alert('Please select both building and floor');
    }
}

function deleteAllocation(admissionId, sNo) {
    if (confirm("Are you sure you want to delete this allocation?")) {
        $.ajax({
            url: 'delete_allocation.php', // The URL of your PHP script to handle deletion
            type: 'POST',
            data: {
                admission_id: admissionId
            },
            success: function(response) {
                if (response === 'Success') {
                    // Optionally, remove the row from the table
                    $('#success' + sNo).closest('tr').remove();
                    alert('Allocation deleted successfully.');
                } else {
                    console.error('Error:', response);
                    alert('Failed to delete allocation.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('An error occurred while trying to delete the allocation.');
            }
        });
    }
}
</script>
<script>
$(document).ready(function() {
    // Event listener for building dropdown change
    $('select[id^="building_dropdown_"]').on('change', function() {
        var buildingDropdownId = $(this).attr('id');
        var admissionId = buildingDropdownId.split('_').pop(); // Extract admission ID
        var buildingId = $(this).val();

        if (buildingId) {
            $.ajax({
                url: 'get_floors.php', // URL of the PHP script to fetch floors
                type: 'POST',
                data: {
                    building_id: buildingId,
                    admission_id: admissionId
                },
                success: function(data) {
                    // Populate the floor dropdown
                    $('#floor_dropdown_' + admissionId).html(data);
                }
            });
        } else {
            $('#floor_dropdown_' + admissionId).html('<option value="">Select Floor</option>');
        }
    });

    // Event listener for floor dropdown change
    $('select[id^="floor_dropdown_"]').on('change', function() {
        var floorDropdownId = $(this).attr('id');
        var admissionId = floorDropdownId.split('_').pop(); // Extract admission ID
        var floorNo = $(this).val();
        var buildingId = $('#building_dropdown_' + admissionId).val();

        if (floorNo && buildingId) {
            $.ajax({
                url: 'get_rooms.php', // URL of the PHP script to fetch rooms
                type: 'POST',
                data: {
                    building_id: buildingId,
                    floor_no: floorNo
                },
                success: function(data) {
                    // Populate the room dropdown
                    $('#room_dropdown_' + admissionId).html(data);
                }
            });
        } else {
            $('#room_dropdown_' + admissionId).html('<option value="">Select Room</option>');
        }
    });

    // Event listener for room dropdown change
    $('select[id^="room_dropdown_"]').on('change', function() {
        var roomDropdownId = $(this).attr('id');
        var admissionId = roomDropdownId.split('_').pop(); // Extract admission ID
        var roomNo = $(this).val();
        var buildingId = $('#building_dropdown_' + admissionId).val();
        var floorNo = $('#floor_dropdown_' + admissionId).val();

        if (roomNo && buildingId && floorNo) {
            $.ajax({
                url: 'get_beds.php', // URL of the PHP script to fetch beds
                type: 'POST',
                data: {
                    building_id: buildingId,
                    floor_no: floorNo,
                    room_no: roomNo
                },
                success: function(data) {
                    // Populate the bed dropdown
                    $('#bed_dropdown_' + admissionId).html(data);
                }
            });
        } else {
            $('#bed_dropdown_' + admissionId).html('<option value="">Select Bed</option>');
        }
    });
});
</script>