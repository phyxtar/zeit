<?php
// Include the database connection file
include 'include/authentication.php';  // Make sure this file has the database connection

// Check if the grade ID is provided in the URL
if (isset($_GET['id'])) {
    $grade_id = $_GET['id'];

    // Sanitize the grade_id to avoid SQL injection
    $grade_id = mysqli_real_escape_string($con, $grade_id);

    // Delete the grade from the database
    $sql = "DELETE FROM `tbl_grade` WHERE `grade_id` = '$grade_id'";

    if ($con->query($sql) === TRUE) {
        // Redirect back to the grade list with a success message
        header("Location: grade.php?status=success");
    } else {
        // Redirect back with an error message
        header("Location: grade.php?status=error");
    }
}
?>