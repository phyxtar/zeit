<?php
// Include database connection
include 'db_connection.php';
include_once "include/authentication.php";

// Set the filename for export
$filename = "admission_data_" . date('Ymd') . ".csv";

// SQL Query
$sql = "SELECT * FROM `tbl_admission` WHERE admission_session IN (1, 2, 3, 5, 6, 9, 10, 11)";
$result = $conn->query($sql);

// Check if records exist
if ($result->num_rows > 0) {
    // Set headers for CSV download
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Open output stream
    $output = fopen("php://output", "w");

    // Fetch column names dynamically
    $columns = array_keys($result->fetch_assoc());
    fputcsv($output, $columns); // Add column headers

    // Reset result pointer and fetch all rows
    $result->data_seek(0);

    // Function to sanitize output
    function sanitize_output($data) {
        return strip_tags($data); // Removes any HTML or JavaScript
    }

    // Fetch and write data to CSV
    while ($row = $result->fetch_assoc()) {
        $sanitized_row = array_map('sanitize_output', $row);
        fputcsv($output, $sanitized_row);
    }

    // Close file pointer
    fclose($output);
    exit;
} else {
    echo "No records found.";
}
?>
