<?php
if ($_POST["action"] == "delete_holiday") {
    $delete_holiday_id = $_POST["delete_holiday_id"];
    if (!empty($delete_holiday_id)) {
        $sql = "DELETE FROM `tbl_holiday`
                WHERE `id` = '$delete_holiday_id'";
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