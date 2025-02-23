
<?php
include_once('../config.php');
if ($_POST["action"] == "edit_holiday") {
    $edit_holiday_name = $_POST["edit_holiday_name"];
    $edit_holiday_from = $_POST["edit_holiday_from"];
    $edit_holiday_to = $_POST["edit_holiday_to"];
    $edit_holiday_id = $_POST["edit_holiday_id"];
    
    $sql = "UPDATE `tbl_holiday` 
            SET `h_name` = '$edit_holiday_name',
                `h_date_from` = '$edit_holiday_from',
                `h_date_to` = '$edit_holiday_to'
            WHERE `id` = '$edit_holiday_id'";
    
    if ($con->query($sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}














