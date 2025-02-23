<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
error_reporting(0);
if ($_GET["action"] == "vacant_list") {
    
    $building = $_POST['building'];
    $floor = $_POST['floor'];
    $s_no = 1;

 ?>
<table id="parentTable" class="table table-bordered table-striped display" style="width:100%;">
    <thead>
        <tr data-child-table="childTable1">
            <th width="10%">S.Nos</th>
            <th width="10%">Reg. No</th>
            <th width="10%">Course</th>
            <th>Gender</th>
            <th width="10%">Student Name</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
               if ($building == "all")

               $sql = "SELECT * FROM `tbl_admission`
               WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `stud_status` = 1 && `admission_hostel` = 'yes' && `hostel_leave_date` = ''
               ORDER BY `admission_id` ASC
               ";
   else
   $sql = "SELECT * FROM `tbl_admission`
               WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_course_name` = '$course_id'  && `stud_status` = 1 && `admission_hostel` = 'yes' && `hostel_leave_date` = ''
               ORDER BY `admission_id` ASC
               ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                        $sql_course = "SELECT * FROM `tbl_course`
                                                   WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                                                   ";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();
                        ?>
            <td class="parent-td">
                <?php echo $row["admission_id"] ?>
            </td>
            <td class="parent-td">
                <?php echo $row_course["course_name"] ?>
            </td>
            <td class="parent-td">
                <?php echo $row["admission_gender"] ?>
            </td>
            <td class="parent-td">
                <?php echo $row["admission_first_name"] ?>
                <?php echo $row["admission_middle_name"] ?>
                <?php echo $row["admission_last_name"] ?>
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
    </tbody>
</table>
<?php
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    // Loop through each parent table row
    $('#parentTable tbody tr').each(function() {
        // Check if the associated child table has no rows with data cells
        if ($(this).find('.childTable tbody tr').length > 0) {
            var hasDataInChildTable = false;
            $(this).find('.childTable tbody tr').each(function() {
                // Check if the child table row has data cells
                if ($(this).find('td').length > 0) {
                    hasDataInChildTable = true;
                }
            });
            if (!hasDataInChildTable) {
                $(this)
                    .hide(); // Hide the parent table row if the child table has no rows with data cells
            }
        }
    });
});
</script>
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