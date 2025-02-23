<?php
// Debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$page_no = "2";
$page_no_inside = "";
include_once "framwork/main.php";
include_once "include/function.php";
include_once "include/config.php";

// Define start and length for pagination
$start = isset($_POST['start']) ? (int)$_POST['start'] : 0;
$length = isset($_POST['length']) ? (int)$_POST['length'] : 10;

// Get the search value from DataTable (if any)
$searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Get total row count
$queryCount = "SELECT COUNT(*) FROM `tbl_attendance`";
$resultCount = mysqli_query($conn, $queryCount);
$totalRecords = $resultCount ? mysqli_fetch_row($resultCount)[0] : 0;

// Prepare the base query with JOIN
$query = "SELECT 
            `tbl_attendance`.`attendance_id`, 
            `tbl_students`.`student_name`, 
            `tbl_students`.`student_roll_number`, 
            `tbl_attendance`.`attendance_status`, 
            `tbl_attendance`.`attendance_date`, 
            `tbl_attendance`.`teacher_id`,
            `tbl_grade`.`grade_name`
          FROM `tbl_attendance`
          JOIN `tbl_students` 
            ON `tbl_attendance`.`student_id` = `tbl_students`.`student_id`
          JOIN `tbl_grade` 
            ON `tbl_attendance`.`grade_id` = `tbl_grade`.`grade_id`";

// Apply search filter if present
if (!empty($searchValue)) {
    $query .= " WHERE `tbl_attendance`.`attendance_id` LIKE '%$searchValue%' OR 
                       `tbl_students`.`student_name` LIKE '%$searchValue%' OR 
                       `tbl_students`.`student_roll_number` LIKE '%$searchValue%' OR 
                       `tbl_attendance`.`attendance_status` LIKE '%$searchValue%' OR 
                       `tbl_attendance`.`attendance_date` LIKE '%$searchValue%' OR 
                       `tbl_attendance`.`teacher_id` LIKE '%$searchValue%' OR 
                       `tbl_grade`.`grade_name` LIKE '%$searchValue%'";
}

// Get total records after applying filter
$resultFilteredCount = mysqli_query($conn, $query);
$recordsFiltered = $resultFilteredCount ? mysqli_num_rows($resultFilteredCount) : 0;

// Add pagination
$query .= " LIMIT $start, $length";

// Execute the query
$result = mysqli_query($conn, $query);

// Prepare the data
$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

// Prepare the response
$response = [
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $recordsFiltered,
    "data" => $data
];

// Output JSON
header('Content-Type: application/json');
echo json_encode($response);

if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("JSON Error: " . json_last_error_msg());
}
?>