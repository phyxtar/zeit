<?php
include_once('include/config.php');
if ($_POST["action"] == "delete_loan_applications") {
    $delete_loan_app_id = $_POST["delete_loan_app_id"];
    if (!empty($delete_loan_app_id)) {
        $sql = "DELETE FROM `tbl_loan`
                WHERE `id` = '$delete_loan_app_id'";
        if ($con->query($sql)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'empty';
    }
}
?>