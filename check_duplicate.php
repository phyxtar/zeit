<?php
include_once "include/config.php"; // Include your database configuration

// Set headers to prompt download of an Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_export.xls");
header("Pragma: no-cache");
header("Expires: 0");

// SQL query to fetch all records
$query = "
    SELECT 
    admission_id, 
    course_id, 
    reg_no, 
    academic_year, 
    roll_no, 
    semester_id, 
    type, 
    attendance, 
    section, 
    admitcard_status, 
    status
FROM 
    tbl_allot_semester
WHERE 
    course_id = 5 AND 
    academic_year = 21 AND
    admission_id IN (
        SELECT admission_id
        FROM tbl_allot_semester
        WHERE course_id = 5 AND academic_year = 21
        GROUP BY admission_id
        HAVING COUNT(*) > 1
    )
ORDER BY admission_id";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query returned results
if ($result && mysqli_num_rows($result) > 0) {
    // Print column headers
    echo "Admission ID\tCourse ID\tReg No\tAcademic Year\tRoll No\tSemester ID\tType\tAttendance\tSection\tAdmit Card Status\tStatus\n";
    
    // Fetch and output data row by row
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['admission_id'] . "\t" .
             $row['course_id'] . "\t" .
             $row['reg_no'] . "\t" .
             $row['academic_year'] . "\t" .
             $row['roll_no'] . "\t" .
             $row['semester_id'] . "\t" .
             $row['type'] . "\t" .
             $row['attendance'] . "\t" .
             $row['section'] . "\t" .
             $row['admitcard_status'] . "\t" .
             $row['status'] . "\n";
    }
} else {
    echo "No data available to export.";
}
?>