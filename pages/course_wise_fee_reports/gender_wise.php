<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
error_reporting(0);
if ($_GET["action"] == "gender_wise") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $type = $_POST['status']; 
    $gender = $_POST['gender'];
    $s_no = 1;

    // Determine the status condition
    $status_condition = "";
    if ($type == "active") {
        $status_condition = " AND `stud_status` = 1 AND `hostel_leave_date` = ''  AND `completed` = 0 ";
    } else if ($type == "inactive") {
        $status_condition = " AND `stud_status` = 0 AND `hostel_leave_date` != ''  AND `completed` = 0 ";
    }

    ?>

<table id="parentTable" class="table table-bordered table-striped display" style="width:100%;">
    <thead>
        <tr data-child-table="childTable1">
            <th>S.Nos</th>
            <th>Reg. No</th>
            <th>Course</th>
            <th>Session</th>
            <th>Gender</th>
            <th>Student Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
           if ($course_id == "all" && $academic_year == "all" && $gender == "all") {
            $sql = "SELECT * FROM `tbl_admission`
                    WHERE `status` = '$visible' AND `admission_hostel` = 'yes' 
                    $status_condition
                    ORDER BY `admission_id` ASC";
        } else if ($course_id == "all" && $academic_year == "all") {
            $sql = "SELECT * FROM `tbl_admission`
                    WHERE `status` = '$visible' AND `admission_gender` = '$gender' AND `admission_hostel` = 'yes' 
                    $status_condition
                    ORDER BY `admission_id` ASC";
        } else if ($gender == "all") {
            $sql = "SELECT * FROM `tbl_admission`
                    WHERE `status` = '$visible' AND `admission_session` = '$academic_year' AND `admission_course_name` = '$course_id' AND `admission_hostel` = 'yes' 
                    $status_condition
                    ORDER BY `admission_id` ASC";
        } else {
            $sql = "SELECT * FROM `tbl_admission`
                    WHERE `status` = '$visible' AND `admission_session` = '$academic_year' AND `admission_gender` = '$gender' AND `admission_course_name` = '$course_id' AND `admission_hostel` = 'yes' 
                    $status_condition
                    ORDER BY `admission_id` ASC";
        }

            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
        <tr>
            <td><?php echo $s_no; ?></td>
            <?php
                        $sql_course = "SELECT * FROM `tbl_course`
                                       WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "'";
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
            <td class="parent-td"><?php echo $row["admission_id"] ?></td>
            <td class="parent-td"><?php echo $row_course["course_name"] ?></td>
            <td class="parent-td"><?php echo $completeSessionOnlyYear; ?></td>
            <td class="parent-td"><?php echo $row["admission_gender"] ?></td>
            <td class="parent-td">
                <?php echo $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"] ?>
            </td>
            <td class="parent-td">
                <?php if ($row["stud_status"] == 1) { ?>
                <span class="badge rounded-pill bg-success">Active</span>
                <?php } else { ?>
                <span class="badge rounded-pill bg-danger">Inactive</span>
                <?php } ?>
            </td>
        </tr>
        <?php
                    $s_no++;
                }
            } else {
                echo '
                    <div class="alert alert-warning alert-dismissible">
                        <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                    </div>';
            }
            ?>
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#parentTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 100,
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


<?php
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
</style>

<script>
function change_status(student_id, status) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        console.log(this.responseText);
        if (this.responseText == 1) {
            // adding the class show success
            document.getElementById("status" + student_id).classList.add('btn-danger');
            document.getElementById("status-fa" + student_id).classList.add('fa-user-times');

            // removing the class
            document.getElementById("status" + student_id).classList.remove('btn-success');
            document.getElementById("status-fa" + student_id).classList.remove('fa-user-check');


        } else {
            document.getElementById("status" + student_id).classList.add('btn-success');
            document.getElementById("status-fa" + student_id).classList.add('fa-user-check');
            document.getElementById("status" + student_id).classList.remove('btn-danger');
            document.getElementById("status-fa" + student_id).classList.remove('fa-user-times');
        }
    }
    xhttp.open("GET", "pages/course_wise_fee_reports/status.php?id=" + student_id + "&status=" + status, true);
    xhttp.send();
}
</script>