<?php
include 'include/authentication.php'; // Ensure database connection is included

// SQL query to fetch fee details
$query = "SELECT fee_id, course_id, fee_academic_year, fee_particulars, fee_amount, fee_fine, fee_lastdate, applicable, fee_astatus FROM tbl_fee";

// Run the query
$result = mysqli_query($conn, $query);

// Check for SQL errors
if (!$result) {
    // If there was an error in the query, send a response with the error message
    echo json_encode(["error" => "SQL query failed: " . mysqli_error($conn)]);
    exit;
}

// Fetch the results as an associative array
$feeDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Check if any records were fetched
if ($feeDetails) {
    // If data exists, return it as JSON
    echo json_encode($feeDetails);
} else {
    // If no data found, return an empty array
    echo json_encode([]);
}
?>