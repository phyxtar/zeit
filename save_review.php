<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admission_id = $_POST['admission_id'];
    $review = $_POST['review'];

    if (!empty($admission_id) && !empty($review)) {
     echo   $sql = "UPDATE `tbl_migration_form` SET `lib_review` = ? WHERE `admission_id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $review, $admission_id);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        echo 'error: empty fields';
    }

    $conn->close();
} else {
    echo 'error: invalid request';
}
?>