<?php
include_once "include/config.php";
include_once "framwork/main.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['admission_id'])) {
        $admission_id = $_POST['admission_id'];

        // Prepare the DELETE statement
        $delete_sql = "DELETE FROM `hostel_allotment` WHERE `admission_id` = ?";
        
        if ($stmt = $con->prepare($delete_sql)) {
            $stmt->bind_param("i", $admission_id);

            if ($stmt->execute()) {
                // If the deletion was successful
                echo 'Success';
            } else {
                // If the deletion failed
                echo 'Error: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            echo 'Error: ' . $con->error;
        }
    } else {
        echo 'Error: Admission ID not provided';
    }
} else {
    echo 'Error: Invalid request method';
}
?>
