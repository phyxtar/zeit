<?php
if ($_POST["action"] == "examStatus") {
    if (isset($_POST["fee_status_id"])) {
        $admission_id = $_POST["admission_id"];
        $fee_status_id = $_POST["fee_status_id"];
        $exam_status = $_POST["exam_status"];
        $sqlTblFeeStatus = "SELECT *
                                     FROM `tbl_fee_status`
                                     WHERE  `admission_id` = '$admission_id'
                                     ";
        $resultTblFeeStatus = $con->query($sqlTblFeeStatus);
        if ($resultTblFeeStatus->num_rows > 0) {
            $rowTblFeeStatus = $resultTblFeeStatus->fetch_assoc();
            if ($rowTblFeeStatus["exam_status"] == "Approve")
                $sql_update = "UPDATE `tbl_fee_status` 
                                        SET 
                                        `exam_status` = 'Not Approve'
                                        WHERE  `admission_id` = '$admission_id';
                                        ";
            else
                $sql_update = "UPDATE `tbl_fee_status` 
                                        SET 
                                        `exam_status` = 'Approve'
                                        WHERE   `admission_id` = '$admission_id';
                                        ";
            if ($con->query($sql_update))
                echo "success";
            else
                echo "error";
        } else {
             $sql_insert = "INSERT INTO `tbl_fee_status`(`fee_status_id`, `admission_id`, `course_id`, `academic_year`, `particular_id`, `fee_status`, `exam_status`) VALUES 
            (NULL,'$admission_id','0','0','0','No dues','Approve')";
            if ($con->query($sql_insert))
                echo "success";
            else
                echo "error";
        }
    }
}
