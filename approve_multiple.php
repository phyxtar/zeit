<?php
include 'include/authentication.php'; // Ensure this includes the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registration_ids']) && is_array($_POST['registration_ids'])) {
        $registration_ids = $_POST['registration_ids'];
        // Sanitize the input to prevent SQL injection
        $ids_string = implode(",", array_map('intval', $registration_ids));

        // Prepare the SQL update query
        $sql = "UPDATE `tbl_registration_form` SET `reg_status` = 'Approve' WHERE `registration_id` IN ($ids_string)";

        // Execute the query and check the result
        if ($con->query($sql) === TRUE) {
            echo 'success'; // Return success message
        } else {
            echo 'Error: ' . $con->error; // Return error message
        }
    } else {
        echo 'No registration IDs provided.'; // Handle the case where no IDs are sent
    }
} else {
    echo 'Invalid request method.'; // Handle invalid request
}
?>