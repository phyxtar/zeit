<?php
$page_no = "7";
$page_no_inside = "7_10";
include_once "include/authentication.php";

// Get parameters from DataTables
$limit = $_POST['length'];
$start = $_POST['start'];
$search = $_POST['search']['value'];

// Base query
$query = "SELECT * FROM `tbl_fee_paid`";

// Search filtering
if (!empty($search)) {
    $query .= " WHERE (`student_id` LIKE '%$search%' OR `bank_name` LIKE '%$search%')";
}

// Total records without filtering
$totalRecordsQuery = "SELECT COUNT(*) FROM `tbl_fee_paid`";
$totalRecordsResult = mysqli_query($con, $totalRecordsQuery);
$totalRecords = mysqli_fetch_array($totalRecordsResult)[0];

// Total records after filtering
$filteredQuery = $query;
$filteredQueryResult = mysqli_query($con, $filteredQuery);
$totalFilteredRecords = mysqli_num_rows($filteredQueryResult);

// Apply ordering, limits, and offset
$query .= " ORDER BY feepaid_id DESC LIMIT $start, $limit";
$results = mysqli_query($con, $query);

// Prepare data for DataTables
$data = [];
$s_no = $start + 1; // Serial number starts at the offset
while ($results && $row = mysqli_fetch_assoc($results)) {
    // Fetch Full Name from tbl_admission
    $row_name = fetchRow('tbl_admission', '`admission_id` = ' . $row["student_id"]);
    $full_name = $row_name["admission_first_name"] . " " . 
                 ($row_name["admission_middle_name"] ? $row_name["admission_middle_name"] . " " : "") . 
                 $row_name["admission_last_name"];

    // Fetch Course Name from tbl_course
    $row_course = fetchRow('tbl_course', '`course_id` = ' . $row["course_id"]);
    $course_name = $row_course["course_name"];

    // Fetch Session from tbl_university_details
    $row_session = fetchRow('tbl_university_details', '`university_details_id` = ' . $row["university_details_id"]);
    $session = intval($row_session["university_details_academic_start_date"]) . " - " . intval($row_session["university_details_academic_end_date"]);

    // Fetch Particulars from tbl_fee
    $sql_particular = "SELECT * FROM `tbl_fee` WHERE `fee_id` = '" . $row["particular_id"] . "' ";
    $result_particular = $con->query($sql_particular);
    
    // Check if the result is valid
    if ($result_particular && $row_particular = $result_particular->fetch_assoc()) {
        $particular_name = $row_particular["fee_particulars"]; // Get the fee particulars
    } else {
        $particular_name = 'N/A'; // Fallback value in case no record found
    }

    // Format the Paid Amount
    $paidAmt = $row["paid_amount"];
    $newVal = str_replace(',,', ',', $paidAmt);
    $formattedPaidAmt = trim($newVal, ',');

    // Prepare row data for DataTables
    $data[] = [
        $s_no++, // Serial number
        date("d-m-Y", strtotime($row["paid_on"])), // Column 1: Receipt Date
        date("d-m-Y", strtotime($row["receipt_date"])), // Column 2: Fee Paid Date
        $row["student_id"], // Column 3: Reg No
        $full_name, // Column 4: Name
        $course_name, // Column 5: Course
        $session, // Column 6: Session
        $particular_name, // Column 7: Particulars (Fee Particulars)
        $formattedPaidAmt, // Column 8: Paid Fee
        $row["balance"], // Column 9: Remaining Fee
        $row["payment_mode"], // Column 10: Payment Mode
        $row["transaction_no"], // Column 11: Cheque/DD/Online No
        $row["bank_name"], // Column 12: Bank Name
        $row["remarks"] ?? '' // Column 13: Remarks
    ];
}

// Output data in JSON format for DataTables
echo json_encode([
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFilteredRecords,
    "data" => $data
]);
?>
