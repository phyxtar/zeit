<?php
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
include_once "../../include/function.php";


$id = $_POST["id"];
$change_status = $_POST["status_change"];
//var_dump($_POST); exit;

$sqlTblFeeStatus = "SELECT *
                                 FROM `hostel_room`
                                 WHERE  `id` = '$id'
                                 ";
$resultTblFeeStatus = $con->query($sqlTblFeeStatus);
if ($resultTblFeeStatus->num_rows > 0) {
    $rowTblFeeStatus = $resultTblFeeStatus->fetch_assoc();
    if ($rowTblFeeStatus["status"] == 1)
        $sql_update = "UPDATE `hostel_room` 
                                    SET 
                                    `status` = 0
                                    WHERE  `id` = '$id';
                                    ";
    else
        $sql_update = "UPDATE `hostel_room` 
                                    SET 
                                    `status` = 1
                                    WHERE  `id` = '$id';
                                    ";
    if ($con->query($sql_update))
        echo "success";
    else
        echo "error";
} else
    echo 'empty';
?>