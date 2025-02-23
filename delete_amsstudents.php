<?php
include 'include/config.php';
$id = $_GET['id'];
$sql = "DELETE FROM tbl_students WHERE student_id = $id";
if ($con->query($sql) === TRUE) {
    echo "<script>alert('Record deleted successfully');</script>";
    echo "<script>window.location.href='amsstudents';</script>";
} else {
    echo "Error deleting record: " . $con->error;
}
?>