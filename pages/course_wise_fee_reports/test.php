<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Particular Name</th>
            <th>Amount </th>
            <th>Paid</th>
            <th>Payment Date</th>
            <th>Last Date</th>
            <th>Txn No</th>
            <th>Rebate</th>
            <th>Fine</th>
            <th>Balance</th>
            <th>Fee Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
                                    $fee_inserted_date = '';
                                    if ($row['hostel_leave_date'] != '') {
                                        $hostel_leave_date = $row['hostel_leave_date'];
                                    } else {
                                        $hostel_leave_date = date('Y-m-d');
                                    }
                                    $arrayFee = array(); //In Amount or In Number
                                    $arrayFine = array(); //In Amount or In Number
                                    $arrayRemaining = array(); //In Amount or In Number
                                    $arrayRebate = array(); //In Amount or In Number
                                    $totalFee = 0; //In Amount or In Number
                                    $totalFine = 0; //In Amount or In Number
                                    $totalRemaining = 0; //In Amount or In Number
                                    $totalRemainings = 0; //In Amount or In Number
                                    $totalRebate = 0; //In Amount or In Number
                                    $totalPaid = 0; //In Amount or In Number
                                    $total_balance = 0;
                                    //String Variables
                                    $arrayPerticular = array();
                                    $arrayTblFee = array();
                                    $objTblFee = "";

                                    //Checking If Hostel If Available Or Not
                                    if (strtolower($row["admission_hostel"]) == "yes") {
                                        $sqlTblFee = "SELECT *
                                     FROM `tbl_fee`
                                     WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "'   ORDER BY `fee_particulars` ASC
                                     ";
                                        $resultTblFee = $con->query($sqlTblFee);
                                        if ($resultTblFee->num_rows > 0)
                                            while ($rowTblFee = $resultTblFee->fetch_assoc()) {

                                                //  checking the in particular have a hostel or not
                                                if (strripos($rowTblFee['fee_particulars'], "hostel") == '') {
                                                    if ($fee_inserted_date)
                                                        $totalFee = $totalFee + intval($rowTblFee["fee_amount"]);
                                                    if (strtotime(date($rowTblFee["fee_lastdate"])) < strtotime(date("Y-m-d")))
                                                        $noOfDays = (strtotime(date("Y-m-d")) - strtotime(date($rowTblFee["fee_lastdate"]))) / 60 / 60 / 24;
                                                    else
                                                        $noOfDays = 0;
                                                    if ($rowTblFee["fee_astatus"] == "Active")
                                                        $fine_particular = $rowTblFee["fee_fine"];
                                                    else
                                                        $fine_particular = 0;
                                                    $completeArray = array(
                                                        "fee_id" => $rowTblFee["fee_id"],
                                                        "fee_particulars" => $rowTblFee["fee_particulars"],
                                                        "fee_amount" => $rowTblFee["fee_amount"],
                                                        "txn_no" => '',
                                                        "payment_date" => '',
                                                        "fee_paid" => 0,
                                                        "fee_fine" => $fine_particular,
                                                        "fee_rebate" => 0,
                                                        "fee_remaining" => $rowTblFee["fee_amount"],
                                                        "fee_fine_days" => $noOfDays,
                                                        "fee_last_date" => $rowTblFee["fee_lastdate"],
                                                        "balace_amount" => 0,
                                                    );
                                                    array_push($arrayTblFee, $completeArray);
                                                } else {
                                                    // getting the date of the fee table 
                                                    $fee_inserted_date = date('Y-m-d', strtotime(str_replace(',', ' ', $rowTblFee['fee_time'])));
                                                    //  checking the hoster leave date
                                                    if (strtotime($fee_inserted_date) <= strtotime($hostel_leave_date)) {
                                                        if ($fee_inserted_date)
                                                            $totalFee = $totalFee + intval($rowTblFee["fee_amount"]);
                                                        if (strtotime(date($rowTblFee["fee_lastdate"])) < strtotime(date("Y-m-d")))
                                                            $noOfDays = (strtotime(date("Y-m-d")) - strtotime(date($rowTblFee["fee_lastdate"]))) / 60 / 60 / 24;
                                                        else
                                                            $noOfDays = 0;
                                                        if ($rowTblFee["fee_astatus"] == "Active")
                                                            $fine_particular = $rowTblFee["fee_fine"];
                                                        else
                                                            $fine_particular = 0;
                                                        $completeArray = array(
                                                            "fee_id" => $rowTblFee["fee_id"],
                                                            "fee_particulars" => $rowTblFee["fee_particulars"],
                                                            "fee_amount" => $rowTblFee["fee_amount"],
                                                            "fee_paid" => 0,
                                                            "txn_no" => '',
                                                            "payment_date" => '',
                                                            "fee_fine" => $fine_particular,
                                                            "fee_rebate" => 0,
                                                            "fee_remaining" => $rowTblFee["fee_amount"],
                                                            "fee_fine_days" => $noOfDays,
                                                            "fee_last_date" => $rowTblFee["fee_lastdate"],
                                                            "balace_amount" => 0,
                                                        );
                                                        array_push($arrayTblFee, $completeArray);
                                                    }
                                                }
                                            }
                                    } else {
                                        $sqlTblFee = "SELECT *
                                     FROM `tbl_fee`
                                     WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "'  AND `fee_particulars` NOT LIKE '%hostel%' AND `fee_particulars` NOT LIKE '%caution%' ORDER BY `fee_particulars` ASC
                                     ";
                                        $resultTblFee = $con->query($sqlTblFee);
                                        if ($resultTblFee->num_rows > 0)
                                            while ($rowTblFee = $resultTblFee->fetch_assoc()) {
                                                if ($fee_inserted_date)
                                                    $totalFee = $totalFee + intval($rowTblFee["fee_amount"]);
                                                if (strtotime(date($rowTblFee["fee_lastdate"])) < strtotime(date("Y-m-d")))
                                                    $noOfDays = (strtotime(date("Y-m-d")) - strtotime(date($rowTblFee["fee_lastdate"]))) / 60 / 60 / 24;
                                                else
                                                    $noOfDays = 0;
                                                if ($rowTblFee["fee_astatus"] == "Active")
                                                    $fine_particular = $rowTblFee["fee_fine"];
                                                else
                                                    $fine_particular = 0;
                                                $completeArray = array(
                                                    "fee_id" => $rowTblFee["fee_id"],
                                                    "fee_particulars" => $rowTblFee["fee_particulars"],
                                                    "fee_amount" => $rowTblFee["fee_amount"],
                                                    "fee_paid" => 0,
                                                    "txn_no" => '',
                                                    "payment_date" => '',
                                                    "fee_fine" => $fine_particular,
                                                    "fee_rebate" => 0,
                                                    "fee_remaining" => $rowTblFee["fee_amount"],
                                                    "fee_fine_days" => $noOfDays,
                                                    "fee_last_date" => $rowTblFee["fee_lastdate"],
                                                    "balace_amount" => 0,
                                                );
                                                array_push($arrayTblFee, $completeArray);
                                            }
                                    }
                                    $arrayTblFee = json_decode(json_encode($arrayTblFee));
                                    $sqlTblFeePaid = "SELECT *
                                                             FROM `tbl_fee_paid`
                                                             WHERE `status` = '$visible' AND `student_id` = '" . $row["admission_id"] . "' AND `payment_status` IN ('cleared', 'pending')
                                                             ";
                                    $resultTblFeePaid = $con->query($sqlTblFeePaid);
                                    if ($resultTblFeePaid->num_rows > 0)
                                        while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {
                                            $arrayPaidId = explode(",", $rowTblFeePaid["particular_id"]);
                                            $arrayPaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);
                                            for ($i = 0; $i < count($arrayPaidId); $i++) {
                                                foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                    if ($arrayTblFeeUpdate->fee_id == $arrayPaidId[$i]) {
                                                        $totalPaid = $totalPaid + intval($arrayPaidAmount[$i]);
                                                        if ($rowTblFeePaid["rebate_amount"] != "") {
                                                            $arrayRebateAmount = explode(",", $rowTblFeePaid["rebate_amount"]);
                                                            if ($arrayTblFeeUpdate->fee_id == intval($arrayRebateAmount[1])) {
                                                                $totalRebate = $totalRebate + intval($arrayRebateAmount[0]);
                                                                $arrayTblFeeUpdate->fee_rebate = $arrayTblFeeUpdate->fee_rebate + intval($arrayRebateAmount[0]);
                                                            }
                                                        }
                                                        $arrayTblFeeUpdate->fee_paid = $arrayTblFeeUpdate->fee_paid + intval($arrayPaidAmount[$i]);
                                                        $arrayTblFeeUpdate->fee_remaining = $arrayTblFeeUpdate->fee_remaining - intval($arrayPaidAmount[$i]);
                                                        $arrayTblFeeUpdate->payment_date = $rowTblFeePaid['paid_on'];
                                                        $arrayTblFeeUpdate->txn_no = $rowTblFeePaid['transaction_no'];
                                                    }
                                                }
                                            }
                                        }
                                    $tmpSNo = 1;
                                    $allNoDues = true; // Flag to track if all particulars have no dues
                                    foreach ($arrayTblFee as $arrayTblFeeUpdate) {

                                        foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                            $total_remaining_amount = ((int) $arrayTblFeeUpdate->fee_remaining) - ((int) $arrayTblFeeUpdate->fee_rebate);
                                        
                                            if ($total_remaining_amount > 0) {
                                                $allNoDues = false; // Mark as not all dues are cleared
                                            }

                                        
                                        if ((((int) $arrayTblFeeUpdate->fee_remaining) - ((int) $arrayTblFeeUpdate->fee_rebate)) == 0) {
                                            $totalRemainings = $totalRemainings + 0;
                                            $totalRemaining = $totalRemaining + 0;
                                            $totalFine = $totalFine + 0;
                                        } else {
                                            $totalRemainings = $totalRemainings + (($arrayTblFeeUpdate->fee_remaining) + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)) - ($arrayTblFeeUpdate->fee_rebate));
                                            $totalRemaining = $totalRemaining + (($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate));
                                            $totalFine = $totalFine + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days));
                                        }
                                        if (((int) $arrayTblFeeUpdate->fee_remaining - (int) $arrayTblFeeUpdate->fee_rebate) === 0) {
                                            $arrayTblFeeUpdate->fee_fine_days = 0;
                                            $arrayTblFeeUpdate->fee_fine = 0;
                                            $fee_remaining_from_database = remaining_fine_calculator_by_particular($con, $visible, $row["admission_id"], $arrayTblFeeUpdate->fee_id);
                                        } else {

                                            $fee_remaining_from_database = 0;
                                        }

                                    ?>
        <tr>
            <?php
                                            $total_remaining_amount = ((int) $arrayTblFeeUpdate->fee_remaining) - ((int) $arrayTblFeeUpdate->fee_rebate);
                                            $rebate_fine_by_particular = rebate_fine_calculator_by_particular($con, $visible, $row["admission_id"], $arrayTblFeeUpdate->fee_id);
                                            $fine_by_particular = fine_calculator_by_particular($con, $visible, $row["admission_id"], $arrayTblFeeUpdate->fee_id);
                                            $all_fine = ($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days) + $fee_remaining_from_database;
                                            $fine_by_particular_remaning = $all_fine - $fine_by_particular - $rebate_fine_by_particular;
                                            $total_remaing_amount_final = $total_remaining_amount + $fine_by_particular_remaning;

                                            $total_balance += $total_remaing_amount_final;

                                            
                                            $total_fee_amount = $total_fee_amount + $arrayTblFeeUpdate->fee_amount;
                                            $total_paid_amount = $total_paid_amount + $arrayTblFeeUpdate->fee_paid;
                                            $total_rebate_amount = $total_rebate_amount + $arrayTblFeeUpdate->fee_rebate;

                   if ($type == 'all') { ?>

        <tr>
            <td>
                <?= $tmpSNo; ?>
            </td>
            <td>
                <?= $arrayTblFeeUpdate->fee_particulars; ?>
            </td>
            <td>&#8377;
                <?= $arrayTblFeeUpdate->fee_amount; ?>
            </td>
            <td>&#8377;
                <?= $arrayTblFeeUpdate->fee_paid; ?>
            </td>
            <td>
                <?= $arrayTblFeeUpdate->payment_date == '' ? '' : date('d-M-Y', strtotime($arrayTblFeeUpdate->payment_date)); ?>
            </td>
            <td>
                <?= date('d-M-Y', strtotime($arrayTblFeeUpdate->fee_last_date)); ?>
            </td>
            <td>
                <?= $arrayTblFeeUpdate->txn_no; ?>
            </td>
            <td>&#8377;
                <?= $arrayTblFeeUpdate->fee_rebate; ?>
            </td>
            <td>&#8377;
                <?= $fine_by_particular_remaning ?>
            </td>
            <td>&#8377;
                <?= $total_remaing_amount_final ?>
                <?php $zero_amount[] = $total_remaing_amount_final; ?>
            </td>
            <td>
                <?php if ($total_remaing_amount_final == 0) { ?>
                <button type="button" class="btn btn-primary btn-sm"> No Dues</button>
                <?php } else { ?>
                <button type="button" class="btn btn-warning btn-sm"> Dues</button>
            </td>
            <?php } ?>

        </tr>
        <tr>
            <td colspan="11" style="text-align: center; font-weight: bold;">
                <?= $allNoDues ? 'Approve' : 'Not Approve'; ?>
            </td>
        </tr>
        <?php
                                            } ?>



        <?php
                                        $tmpSNo++;
                                    }
                           
                                     $check = $total_remaining_amount + $fine_by_particular_remaning;
                                    $fee_status_data = fetchRow('tbl_fee_status', ' admission_id=' . $row['admission_id'] . '');

                                    // Determine the current registration status
                                    $current_reg_status = $fee_status_data ? $fee_status_data['reg_status'] : 'Not Approve';

                                    // Determine the exam status based on total_remaining_amount and registration status
                                    if ($check == 0) {
                                        $current_exam_status = 'Approve';
                                    } else {
                                        $current_exam_status = 'Not Approve';
                                    }


                                    if ($fee_status_data) {

                                        $update_exam_status = "UPDATE `tbl_fee_status` 
                                                               SET `exam_status` = '" . mysqli_real_escape_string($con, $current_exam_status) . "' 
                                                               WHERE `manual_status` = 0 AND `admission_id` = '" . (int)$row['admission_id'] . "'";
                                        $result_update_exam = $con->query($update_exam_status);

                                        if (!$result_update_exam) {
                                            error_log("Database Update Error for admission_id {$row['admission_id']}: " . $con->error);
                                        }
                                    } else {

                                        $insert_exam_status = "INSERT INTO `tbl_fee_status` (`fee_status_id`, `admission_id`, `course_id`, `academic_year`, `particular_id`, `exam_particular_id`, `fee_status`, `exam_status`, `reg_status`, `manual_status`) 
                                                               VALUES (NULL, '" . $row['admission_id'] . "', $course_id, $academic_year, NULL, NULL, NULL, '" . $current_exam_status . "', 'Not Approve', '0')";
                                        $result_insert_exam = $con->query($insert_exam_status);

                                        if (!$result_insert_exam) {
                                            error_log("Database Insert Error for admission_id {$row['admission_id']}: " . $con->error);
                                        }
                                    }


                       



                            ?>


    </tbody>

</table>