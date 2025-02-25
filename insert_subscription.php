<?php
$page_no = "2";
$page_no_inside = "2_4";
// update_status.php
include 'db_connection.php'; // Make sure to include your database connection file
include_once "include/authentication.php"; 

// Step 2: Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subscriber = $_POST['subscriber'];
    $plan = $_POST['plan'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

    // Step 3: Insert Data into Database
    $sql = "INSERT INTO tbl_subscription (subscriber, plan, start_date, end_date, amount, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())";

    // Step 4: Prepare and Bind Parameters
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssds", $subscriber, $plan, $start_date, $end_date, $amount, $status);

        // Step 5: Execute Query and Check Success
        if ($stmt->execute()) {
            echo "<script>alert('Subscription plan created successfully!'); window.location.href='subscription.php';</script>";
        } else {
            echo "<script>alert('Error creating subscription plan.'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Database error. Please try again.'); window.history.back();</script>";
    }

    // Step 6: Close Database Connection
    $conn->close();
}
?>
