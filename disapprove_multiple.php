<?php
include 'include/authentication.php'; // Assuming you have a connection setup file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registration_ids = $_POST['registration_ids'];

    if (!empty($registration_ids)) {
        foreach ($registration_ids as $id) {
            // Update the status to "Not Approved" or any relevant status in your table
            $sql = "UPDATE tbl_registration_form SET reg_status = 'Not Approved' WHERE registration_id = '$id'";
            $con->query($sql); // Execute the query
        }
        echo 'success'; // Respond with success if all updates are processed
    } else {
        echo 'error'; // Handle error if no registration_ids are provided
    }
}
?>