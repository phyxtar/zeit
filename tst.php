<?php
include_once "include/config.php";

// Get the student ID from the session
$student_id = $_SESSION['user']["admission_id"];

// SQL query to fetch fee details along with particular name
$sql = "SELECT 
            tfp.feepaid_id, 
            tfp.student_id, 
            tfp.course_id, 
            tfp.particular_id, 
            tf.fee_particulars AS particular_name, 
            tfp.paid_amount, 
            tfp.rebate_amount, 
            tfp.fine, 
            tfp.remaining_fine, 
            tfp.extra_fine, 
            tfp.balance, 
            tfp.payment_mode, 
            tfp.cash_deposit_to, 
            tfp.cash_date, 
            tfp.notes, 
            tfp.receipt_date, 
            tfp.bank_name, 
            tfp.transaction_no, 
            tfp.transaction_date, 
            tfp.receipt_no, 
            tfp.paid_on, 
            tfp.university_details_id, 
            tfp.fee_paid_time, 
            tfp.payment_status, 
            tfp.print_generated_by, 
            tfp.status 
        FROM tbl_fee_paid tfp
        LEFT JOIN tbl_fee tf ON tfp.particular_id = tf.fee_id
        WHERE tfp.student_id = '$student_id'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Initialize an array to store the fetched data
$dataArray = [];

// Fetch records into the array
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dataArray[] = $row;
    }
} else {
    $dataArray = ["message" => "No fee records found for the student."];
}

// Display the data using print_r inside <pre> tags
echo "<pre>";
print_r($dataArray);
echo "</pre>";

// Free result set
mysqli_free_result($result);
?>