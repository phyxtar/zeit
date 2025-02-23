<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_GET["action"] == "fetch_vacant_list") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $gender = $_POST['gender'];
    $status = $_POST['status']; // Added status filter
    $s_no = 1;
?>

<!-- <button id="exportButton" class="btn btn-success mb-3">Export List</button> -->

<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="">S.Nos</th>
            <th width="">Student Image</th>
            <th width="">Reg. No</th>
            <th width="">Course</th>
            <th width="">Session</th>
            <th width="">Student Name</th>
            <th width="">Father Name</th>
            <th width="">Gender</th>
            <th width="">Contact No.</th>
            <th width="">Parent Contact No.</th>
            <th width="">Address</th>
            <th width="">Building</th>
            <th width="">Floor</th>
            <th width="">Room</th>
            <th width="">Bed</th>
            <th width="">Student Status</th>
            <th width="">Status</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        // $condition = "WHERE `status` = '$visible' && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''";
        $condition = "WHERE `status` = '$visible' && `admission_hostel` = 'yes' ";

        if ($course_id != "all") {
            $condition .= " && `admission_course_name` = '$course_id'";
        }

        if ($academic_year != "all") {
            $condition .= " && `admission_session` = '$academic_year'";
        }

        if ($gender != "all") {
            $condition .= " && `admission_gender` = '$gender'";
        }

        if ($status == "occupied") {
            $condition .= " AND `admission_id` IN (SELECT `admission_id` FROM `hostel_allotment` WHERE `building_id` IS NOT NULL AND `floor_no` IS NOT NULL AND `room_no` IS NOT NULL AND `bed_no` IS NOT NULL)";
        } else if ($status == "unoccupied") {
            $condition .= " AND `admission_id` NOT IN (SELECT `admission_id` FROM `hostel_allotment` WHERE `building_id` IS NOT NULL AND `floor_no` IS NOT NULL AND `room_no` IS NOT NULL AND `bed_no` IS NOT NULL)";
        }

        $sql = "SELECT * FROM `tbl_admission` $condition ORDER BY `admission_id` ASC";

        $result = $con->query($sql);
        if (!$result) {
            die("Query failed: " . $con->error);
        }

        if ($result->num_rows > 0) {
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
                $allotted_building_id = isset($student_details['building_id']) ? $student_details['building_id'] : null;
                $allotted_floor_no = isset($student_details['floor_no']) ? $student_details['floor_no'] : null;
                $allotted_room_no = isset($student_details['room_no']) ? $student_details['room_no'] : null;
                $allotted_bed_no = isset($student_details['bed_no']) ? $student_details['bed_no'] : null;

                $sql_course = "SELECT * FROM `tbl_course`
                WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                ";
$result_course = $con->query($sql_course);
$row_course = $result_course->fetch_assoc();

$sql_ac_year = "SELECT * FROM `tbl_university_details`
                                       WHERE `status` = '$visible' && `university_details_id` = '" . $row["admission_session"] . "'
                                       ";
                                       $result_ac_year = $con->query($sql_ac_year);
                                        while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                                            $year = date('Y');
                                            $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                             $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                                            
                                             $total_year = $year - (int)$completeSessionStart[0];
                                            $get_course_duration = $completeSessionEnd[0] - $completeSessionStart[0];
                                            
                                                $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                            
                                        }
                                    
        ?>
        <tr class="search-row">
            <td><?php echo $s_no; ?></td>
            <td>
                <img src="images/student_images/<?php echo $row['admission_profile_image']; ?>" alt="Profile Image"
                    width="100" height="100">
            </td>
            <td><?php echo $row["admission_id"]; ?></td>
            <td><?php echo $row_course["course_name"]; ?></td>
            <td><?php echo $completeSessionOnlyYear; ?></td>
            <td><?php echo $row["admission_first_name"] . ' ' . $row["admission_middle_name"] . ' ' . $row["admission_last_name"]; ?>
            </td>
            <td><?php echo $row["admission_father_name"]; ?></td>
            <td><?php echo $row["admission_gender"]; ?></td>
            <td><?php echo $row["admission_mobile_student"]; ?></td>
            <td><?php echo $row["admission_father_phoneno"]; ?></td>
            <td><?php echo $row["admission_residential_address"]; ?></td>
            <td>
                <?php
                $building_name = 'No Building Associated';
                foreach ($buildings as $building) {
                    if ($building['id'] == $allotted_building_id) {
                        $building_name = $building['name'] . ' (' . $building['building_code'] . ')';
                        break;
                    }
                }
                echo $building_name;
                ?>
            </td>
            <td>
                <?php
                if ($allotted_floor_no) {
                    echo $allotted_floor_no . ' Floor';
                } else {
                    echo 'No Floor Associated';
                }
                ?>
            </td>
            <td>
                <?php echo $allotted_room_no ? $allotted_room_no . ' Room' : 'No Room Associated'; ?>
            </td>
            <td>
                <?php echo $allotted_bed_no ? $allotted_bed_no . ' Bed' : 'No Bed Associated'; ?>
            </td>
            <td><span
                    class="<?php echo $row["stud_status"] == 1 ? "badge bg-success" : "badge bg-danger"; ?>"><?php echo $row["stud_status"] == 1 ? "Active" : "Inactive"; ?></span>
            </td>
            <td><span
                    class="<?php echo $allotted_building_id && $allotted_floor_no && $allotted_room_no && $allotted_bed_no ? "badge bg-success" : "badge bg-danger"; ?>"><?php echo $allotted_building_id && $allotted_floor_no && $allotted_room_no && $allotted_bed_no ? "Alloted" : "Not Alloted"; ?></span>
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
<!-- Include required CSS for DataTables and Bootstrap -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
/* Target DataTable buttons specifically and enforce styles with !important */
.dt-buttons .dt-button {
    background-color: #4CAF50 !important;
    /* Green background */
    color: white !important;
    /* White text */
    border: none !important;
    /* Remove borders */
    padding: 10px 20px !important;
    /* Add padding */
    text-align: center !important;
    /* Center the text */
    text-decoration: none !important;
    /* Remove underline */
    display: inline-block !important;
    /* Display as inline-block */
    font-size: 14px !important;
    /* Set font size */
    margin: 4px 2px !important;
    /* Add some margin */
    cursor: pointer !important;
    /* Pointer cursor on hover */
    border-radius: 5px !important;
    /* Rounded corners */
}

/* Different colors for different buttons */
.dt-buttons .buttons-copy {
    background-color: #f44336 !important;
    /* Red */
}

.dt-buttons .buttons-csv {
    background-color: #008CBA !important;
    /* Blue */
}

.dt-buttons .buttons-excel {
    background-color: #4CAF50 !important;
    /* Green */
}

.dt-buttons .buttons-pdf {
    background-color: #e7e7e7 !important;
    /* Gray */
    color: black !important;
    /* Black text */
}

.dt-buttons .buttons-print {
    background-color: #555555 !important;
    /* Dark gray */
}

.dt-buttons .dt-button:hover {
    opacity: 0.8 !important;
    /* Slight transparency on hover */
}
</style>
<script>
$(document).ready(function() {
    $('#example1').DataTable({
        scrollX: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 20,
        lengthMenu: [5, 10, 25, 50, 100],
        responsive: true,
        columnDefs: [{
            className: "text-center",
            "targets": "_all"
        }]
    });

    $('#exportButton').click(function() {
        var wb = XLSX.utils.table_to_book(document.getElementById('example1'), {
            sheet: "Sheet JS"
        });
        XLSX.writeFile(wb, 'Hostel_Students_List.xlsx');
    });
});
</script>