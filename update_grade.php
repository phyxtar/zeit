<?php
// Include database connection
 include 'include/authentication.php';

if (isset($_POST['grade_id']) && isset($_POST['grade_name'])) {
    $grade_id = $_POST['grade_id'];
    $grade_name = $_POST['grade_name'];

    // Sanitize inputs
    $grade_name = $con->real_escape_string($grade_name);

    // Update query
    $sql = "UPDATE tbl_grade SET grade_name = '$grade_name' WHERE grade_id = '$grade_id'";

    if ($con->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>