<?php
$page_no = "4";
$page_no_inside = "4_1";
// update_status.php
include 'db_connection.php'; // Make sure to include your database connection file
include_once "include/authentication.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $company_name = $_POST['company_name'];
    $contact_person = $_POST['contact_person'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    $subscription_id = $_POST['subscription_type']; // This is the selected subscription ID
    $status = $_POST['status'];

    // Fetch subscription plan and service tenure
    $query = "SELECT plan, TIMESTAMPDIFF(YEAR, start_date, end_date) AS service_tenure FROM tbl_subscription WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $subscription_id);
    $stmt->execute();
    $stmt->bind_result($subscription_plan, $service_tenure);
    $stmt->fetch();
    $stmt->close();

    // Insert into tbl_customer
    $insertQuery = "INSERT INTO tbl_customer (company_name, contact_person, email, password, phone, service_tenure, subscription_type, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($insertQuery);
    $stmt->bind_param("ssssssss", $company_name, $contact_person, $email, $password, $phone, $service_tenure, $subscription_plan, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Customer added successfully!'); window.location.href='customer.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $con->close();
}
?>
