<?php
include "../../../framwork/main.php";
$academic_year = $_GET['academic_year'];
$course_id = $_GET['course_id'];
$semester_id = $_GET['semester_id'];

$sql = "DELETE FROM `tbl_allot_semester` WHERE `academic_year` = '$academic_year' AND `course_id` = '$course_id' AND `semester_id` = '$semester_id'";
$stmt = $con->prepare($sql);

if ($stmt->execute()) {
    // Use PHP to generate JavaScript alert
    echo '<script type="text/javascript">alert("Records deleted successfully");</script>';
} else {
    echo "Error deleting records: " . $stmt->error;
}
?>