<?php
// Assuming you already have a connection in `$con`
include_once "include/config.php";

// Define the particular fee to search for
$particular = "1st Installment"; // Define the particular fee type
$particularEscaped = mysqli_real_escape_string($con, $particular); // Escape input

// Query to fetch student IDs who paid 1st installment fee, balance is 0, and academic year is 31, 32, 33, or 34
$query = "
    SELECT 
        fp.student_id AS admission_id, 
        fp.course_id, 
        f.fee_academic_year AS academic_year, 
        fp.particular_id
    FROM 
        tbl_fee_paid fp
    JOIN 
        tbl_fee f ON fp.particular_id = f.fee_id
    WHERE 
        f.fee_particulars LIKE '%$particularEscaped%' 
        AND fp.balance = 0
        AND f.fee_academic_year IN ('31', '32', '33', '34')
";

$result = mysqli_query($con, $query);

$dataArray = []; // To store result data

// Initialize counters and arrays for tracking student IDs
$approvedCount = 0;  // Approved records
$updatedCount = 0;   // Updated records
$insertedCount = 0;  // Inserted records
$disapprovedCount = 0; // Disapproved records

$approvedIds = [];  // Array to store approved student IDs
$updatedIds = [];   // Array to store updated student IDs
$insertedIds = [];  // Array to store inserted student IDs
$disapprovedIds = []; // Array to store disapproved student IDs

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $admission_id = $row['admission_id'];
        $course_id = $row['course_id'];
        $academic_year = $row['academic_year'];
        $particular_id = $row['particular_id'];

        // Check if admission_id already exists in tbl_fee_status
        $checkQuery = "
            SELECT fee_status_id 
            FROM tbl_fee_status 
            WHERE admission_id = '$admission_id'
        ";
        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // If admission_id exists, update reg_status, exam_status, academic_year, course_id, and particular_id
            $updateQuery = "
                UPDATE tbl_fee_status 
                SET 
                    reg_status = 'Approve', 
                    exam_status = 'Not Approved', 
                    academic_year = '$academic_year', 
                    course_id = '$course_id', 
                    particular_id = '$particular_id'
                WHERE 
                    admission_id = '$admission_id'
            ";
            mysqli_query($con, $updateQuery);
            $updatedCount++; // Increment updated count
            $updatedIds[] = $admission_id; // Store updated admission_id
        } else {
            // If admission_id does not exist, insert new record
            $insertQuery = "
                INSERT INTO tbl_fee_status 
                (admission_id, course_id, academic_year, particular_id, reg_status) 
                VALUES 
                ('$admission_id', '$course_id', '$academic_year', '$particular_id', 'Approve')
            ";
            mysqli_query($con, $insertQuery);
            $insertedCount++; // Increment inserted count
            $insertedIds[] = $admission_id; // Store inserted admission_id
        }

        // Add approved record to result array
        $dataArray[] = [
            'admission_id' => $admission_id,
            'course_id' => $course_id,
            'academic_year' => $academic_year,
            'particular_id' => $particular_id,
            'reg_status' => 'Approve',
        ];

        $approvedCount++; // Increment approved count
        $approvedIds[] = $admission_id; // Store approved admission_id
    }
}

// Output the result data in a readable format
echo "<pre>";
echo "Approved Records: $approvedCount\n";
echo "Updated Records: $updatedCount\n";
echo "Inserted Records: $insertedCount\n";
echo "Disapproved Records: $disapprovedCount\n"; // If you have logic for disapproval

echo "\nApproved Student IDs:\n";
print_r($approvedIds); // Output the array of approved student IDs

echo "\nUpdated Student IDs:\n";
print_r($updatedIds); // Output the array of updated student IDs

echo "\nInserted Student IDs:\n";
print_r($insertedIds); // Output the array of inserted student IDs

echo "\nDisapproved Student IDs:\n";
print_r($disapprovedIds); // Output the array of disapproved student IDs (if you add disapproval logic)
echo "</pre>";
?>