<?php
include_once "include/config.php";
$visible = md5("visible");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is for updating reg_no
    if (isset($_POST['allot_id']) && isset($_POST['reg_no'])) {
        $allot_id = $_POST['allot_id'];
        $new_reg_no = $_POST['reg_no'];

        // Update the reg_no for the specified allotment ID
        $update_query = "UPDATE `tbl_allot_semester` SET `reg_no` = '$new_reg_no' WHERE `allot_id` = '$allot_id'";

        $result = $con->query($update_query);

        // Check if the update was successful
        if ($result) {
            echo "<script>
            alert('Registration No. updated successfully!');
            location.replace('student_semester');
          </script>";
          exit;
        } else {
            echo "Error updating Reg No: " . $con->error;
        }
        exit; // Stop further execution
    }

    // Original code for inserting data into tbl_allot_semester
    $reg_no = $_POST["reg_no"];
    $admission_id = $_POST["admission_id"];
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $roll_no = $_POST["roll_no"];
    $semester_id = $_POST["semester_id"];
    $sql_get = '';

    $all = count($semester_id);

    for ($i = 0; $i < $all; $i++) {
        $sql_get .= "INSERT INTO `tbl_allot_semester`(`allot_id`, `admission_id`,`reg_no`,`course_id`, `academic_year`, `roll_no`,`semester_id`, `status`) 
                     VALUES (NULL,'$admission_id[$i]','$reg_no[$i]','$course_id[$i]','$academic_year[$i]','$roll_no[$i]','$semester_id[$i]','$visible');";
    }

    if ($con->multi_query($sql_get)) {
        echo "<script>
                alert('Data added successfully!');
                location.replace('student_semester');
              </script>";
    } else {
        echo "Error adding data: " . $con->error;
    }
}
