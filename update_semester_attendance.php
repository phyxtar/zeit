<?php
$page_no = "12";
$page_no_inside = "12_6";
include_once "framwork/main.php";


if (isset($_POST['submit'])) {
    // Check if attendance data is available
    if (!empty($_POST['attendance']) && !empty($_POST['admission_id'])) {
        $attendance_data = $_POST['attendance'];  // This contains the attendance data keyed by admission_id
        $admission_ids = $_POST['admission_id'];  // This contains the admission IDs of the students

        // Loop through each admission_id and update their attendance
        foreach ($attendance_data as $admission_id => $attendance_value) {
            // Sanitize the inputs to avoid SQL injection
            $admission_id = $con->real_escape_string($admission_id);
            $attendance_value = $con->real_escape_string($attendance_value);

            // Make sure the attendance value is a valid number
            if (is_numeric($attendance_value)) {
                // Update query for each student
                $update_query = "
                    UPDATE `tbl_allot_semester`
                    SET `attendance` = '$attendance_value'
                    WHERE `admission_id` = '$admission_id'
                ";

                // Execute the query
                if ($con->query($update_query) === TRUE) {
                    // Successfully updated
                    echo "<script>alert('Attendance updated successfully');
                    window.location.href='hod_attendance.php';
                    </script>";
                } else {
                    // Error in updating
                    echo "<script>alert('something went wrong');
                    window.location.href='hod_attendance.php';
                    </script>";
                }
            } else {
                // Handle invalid attendance input
                echo "<script>alert('something went wrong');
                window.location.href='hod_attendance.php';
                </script>";
            }
        }
    } else {
        echo "No attendance data found to update.<br>";
    }
}
?>