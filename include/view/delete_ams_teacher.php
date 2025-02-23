<?php
include('../config.php');
$teacher_id = $_GET['id'];  
$sql = "DELETE FROM tbl_teacher WHERE teacher_id = $teacher_id";
if ($con->query($sql) === TRUE) {
    echo "<><script>alert('Record deleted successfully');
    window.location.href='../../amsteacher.php';
    </script>";
} else {
    echo "<><script>alert('Something went wrong');
    window.location.href='../../amsteacher.php';
    </script>";
}
?>