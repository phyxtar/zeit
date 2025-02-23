<?php
include_once('include/config.php');
if ($_POST["action"] == "delete_leave_applications") {
    $delete_leave_app_id = $_POST["delete_leave_app_id"];
    if (!empty($delete_leave_app_id)) {
        $sql = "DELETE FROM `tbl_apply_leave`
                WHERE `id` = '$delete_leave_app_id'";
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