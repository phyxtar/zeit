<?php /* ------------------------------------------------- Fee Payment Start -------------------------------------------------- */
// Student fee start
if ($_GET["action"] == "fetch_student_fee_details") {
    include_once "../../../framwork/main.php";
    include_once "../../../include/function.php";
    $studentRegistrationNo = $_POST["studentRegistrationNo"];
    if (!empty($studentRegistrationNo)) {
        $sql = "SELECT *
                        FROM `tbl_admission`
                        INNER JOIN `tbl_university_details` ON `tbl_admission`.`admission_session` = `tbl_university_details`.`university_details_id`
                        INNER JOIN `tbl_course` ON `tbl_admission`.`admission_course_name` = `tbl_course`.`course_id`
                        WHERE `tbl_admission`.`admission_id` = '$studentRegistrationNo' && `tbl_admission`.`status` = '$visible' && `tbl_course`.`status` = '$visible' && `tbl_university_details`.`status` = '$visible'
                        ";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['hostel_leave_date'] != '') {
                $hostel_leave_date = $row['hostel_leave_date'];
            } else {
                $hostel_leave_date = date('Y-m-d');
            }
            //Define Variables Section Start
            //Numeric Veriables
            $fee_inserted_date = '';
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
            $total_fine_payment = 0; //total fine amount 
            $total_fine_payment_remaining = 0;
            //String Variables
            $arrayPerticular = array();
            $arrayTblFee = array();
            $objTblFee = "";
            $overall_total_paid = 0;
            $total_fine_after_paying = 0;
            $total_fine_remaining = 0;
            $fee_remaining_from_database = 0;
            $rebate_fine_by_particular = 0;
            $total_rebate_fine_payment = 0;
            $fine_by_particular_remaning = 0;

            include_once "../../../pages/pay_fee/function.php";
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
                            $fee_inserted_date =  date('Y-m-d', strtotime(str_replace(',', ' ', $rowTblFee['fee_time'])));
                            $applicable_date =   $rowTblFee['applicable'] == '0000-00-00' ? date('Y-m-d') : $rowTblFee['applicable'];
                            $hostel_join_date =   $row['hostel_join_date'];
                            // checking particular fee exits or not into the student feepaid table


                            if (strtotime($hostel_join_date) >= strtotime($applicable_date) || is_hostel_fee_paid($rowTblFee["fee_id"]) > 0) {
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

                                    // checking student if student are leave befor the date of fee applicable date
                                    if (is_hostel_leave_date()) {

                                        if (((strtotime(date($hostel_leave_date)) - strtotime(date($applicable_date)))  / 60 / 60 / 24) > 182) {
                                            $particular_fee_amount =  $rowTblFee["fee_amount"];
                                        } else {
                                            $particular_fee_amount = $rowTblFee["fee_amount"] / 2;
                                        }
                                    } else {
                                        $particular_fee_amount =  $rowTblFee["fee_amount"];
                                    }

                                    $completeArray = array(
                                        "fee_id" => $rowTblFee["fee_id"],
                                        "fee_particulars" => $rowTblFee["fee_particulars"],
                                        "fee_amount" => $particular_fee_amount,
                                        "fee_paid" => 0,
                                        "fee_fine" => $fine_particular,
                                        "fee_rebate" => 0,
                                        "fee_remaining" => $particular_fee_amount,
                                        "fee_fine_days" => $noOfDays,
                                        "fee_last_date" => $rowTblFee["fee_lastdate"],
                                        "balace_amount" => 0,
                                    );
                                    array_push($arrayTblFee, $completeArray);
                                }
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
            // echo "<pre>";
            // print_r($arrayTblFee);
            $lastpaymentDate = "";
            $sqlTblFeePaid = "SELECT *
                                     FROM `tbl_fee_paid`
                                     WHERE `status` = '$visible' AND `student_id` = '" . $studentRegistrationNo . "' AND `payment_status` IN ('cleared', 'pending')
                                     ";
            $resultTblFeePaid = $con->query($sqlTblFeePaid);

            if ($resultTblFeePaid->num_rows > 0)
                while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {
                    $lastpaymentDate = $rowTblFeePaid; //get last payment data

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
                            }
                        }
                    }
                    $total_balance_amount_after_pay = ($arrayTblFeeUpdate->balace_amount + $rowTblFeePaid["balance"]);
                }
            //Define Variables Section End

            // echo "<pre>";
            // print_r( $fineArray);


?>
<div class="row">
    <div class="col-md-12">
        <!-- Profile Image -->
        <div class="card card-primary">
            <div class="card-body box-profile">
                <div class="alert alert-success"
                    style="border-left: 5px solid #17a2b8; padding: 20px; margin: 25px 0; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h4 style="color: #555; margin-bottom: 15px; font-weight: 600;">
                        <i class="fas fa-info-circle"></i> Important Notice
                    </h4>
                    <div style="font-size: 15px; line-height: 1.6;">
                        <p style="margin-bottom: 15px;">
                            Dear Student,
                        </p>
                        <p style="margin-bottom: 10px;">
                            Please note the following regarding your Registration Form status:
                        </p>
                        <ul style="margin: 15px 0; padding-left: 20px;">
                            <li style="margin-bottom: 10px;">
                                If your status shows as "Not Approved", it likely means your dues are
                                pending. Please clear these dues to proceed with your University Examination Form.
                            </li>
                            <li>
                                If your status shows as "Approved", simply refresh the Examnination page to begin
                                filling your form.
                            </li>
                        </ul>
                        <p style="margin-top: 15px; font-style: italic; color: #666;">
                            For any queries, please contact the Admin Department.
                        </p>
                    </div>
                </div>
                <?php
                            $completeSessionStart = explode("-", $row["university_details_academic_start_date"]);
                            $completeSessionEnd = explode("-", $row["university_details_academic_end_date"]);
                            $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                            ?>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#payfee" data-toggle="tab">Fee Payment</a>
                    </li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="payfee">
                        <form method="POST" id="PayFeeForm" onSubmit="return">
                            <!-- Table row -->
                            <div class="row">
                                <input type="hidden" name="registrationNumber"
                                    value="<?php echo $studentRegistrationNo; ?>" readonly />
                                <input type="hidden" name="courseId" value="<?php echo $row["course_id"]; ?>"
                                    readonly />
                                <input type="hidden" name="academicYear"
                                    value="<?php echo $row["university_details_id"]; ?>" readonly />
                                <div class="col-12 table-responsive" style="overflow-x:auto;">
                                    <h5>Fee Details <b><a
                                                href="javascript:void(0);"><?php echo $row["course_name"] . " | " . $completeSessionOnlyYear; ?></a></b>
                                    </h5>
                                    <table class="table table-bordered table-sm table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Particulars</th>
                                                <th>Last Date</th>
                                                <th>Amount</th>
                                                <th>Paid</th>
                                                <th>Rebate</th>
                                                <th>Remaining</th>
                                                <th>Fine</th>
                                                <th>Fine paid</th>
                                                <th>Fine Rebate </th>
                                                <th>Fine Remaining</th>
                                                <th>Total Paid</th>
                                                <th><span class="text-red">Total Due</span></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                        $Idno = 0;
                                                        $tmpSNo = 1;
                                                        $fine_array = 0;
                                                        $particular_remaining_amount_session = array();
                                                        $particular_paid_id_seesion = array();
                                                        $particular_fine_session = array();
                                                        foreach ($arrayTblFee as $arrayTblFeeUpdate) {

                                                            if (($arrayTblFeeUpdate->fee_remaining - $arrayTblFeeUpdate->fee_rebate) === 0) {
                                                                $arrayTblFeeUpdate->fee_fine_days = 0;
                                                                $arrayTblFeeUpdate->fee_fine = 0;
                                                                $fee_remaining_from_database = remaining_fine_calculator_by_particular($con, $visible, $studentRegistrationNo, $arrayTblFeeUpdate->fee_id);
                                                            } else {

                                                                $fee_remaining_from_database = 0;
                                                            }
                                                        ?>
                                            <tr>
                                                <td><?php echo $tmpSNo; ?></td> <!-- serial number -->
                                                <td><?php echo $arrayTblFeeUpdate->fee_particulars; ?></td>
                                                <!-- particular -->
                                                <td><?php echo  date("d-m-Y", strtotime($arrayTblFeeUpdate->fee_last_date))  ?>
                                                </td> <!--  last date -->
                                                <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_amount); ?>
                                                </td> <!-- amount -->
                                                <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_paid); ?>
                                                </td> <!-- paid -->
                                                <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_rebate); ?>
                                                </td> <!-- rebate -->

                                                <!-- Remaining -->
                                                <td>&#8377;
                                                    <?php echo $total_remaining_amount = ($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate); ?>
                                                </td>
                                                <?php $totalRemaining = $totalRemaining + $total_remaining_amount;
                                                                array_push($particular_remaining_amount_session, $total_remaining_amount);

                                                                ?>

                                                <!-- Fine -->
                                                <td>&#8377;
                                                    <?php echo $all_fine = ($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days) + $fee_remaining_from_database ?>
                                                </td>
                                                <!-- total fine -->
                                                <?php $totalFine = $totalFine + $all_fine ?>
                                                <!-- Fine paid -->
                                                <td>&#8377;
                                                    <?php echo $fine_by_particular = fine_calculator_by_particular($con, $visible, $studentRegistrationNo, $arrayTblFeeUpdate->fee_id) ?>
                                                </td>
                                                <!-- total fine paid -->
                                                <?php $total_fine_payment = $total_fine_payment + $fine_by_particular;   ?>
                                                <!-- fine rebate -->
                                                <td>&#8377;
                                                    <?php
                                                                    echo $rebate_fine_by_particular =  rebate_fine_calculator_by_particular($con, $visible, $studentRegistrationNo, $arrayTblFeeUpdate->fee_id); ?>
                                                </td>
                                                <!-- total fine paid -->
                                                <?php

                                                                $total_rebate_fine_payment = $total_rebate_fine_payment + $rebate_fine_by_particular;   ?>

                                                <!-- fine remaining  -->
                                                <td>&#8377; <?php

                                                                            echo $fine_by_particular_remaning =  $all_fine - $fine_by_particular - $rebate_fine_by_particular;
                                                                            array_push($particular_fine_session, $fine_by_particular_remaning);
                                                                            array_push($particular_paid_id_seesion, $arrayTblFeeUpdate->fee_id);
                                                                            ?></td>

                                                <!-- total fine remaining -->
                                                <?php $total_fine_payment_remaining = $total_fine_payment_remaining + $fine_by_particular_remaning ?>

                                                <!-- Total paid particular -->
                                                <td>&#8377;
                                                    <?php echo $overall_total_paid_particular =  ($arrayTblFeeUpdate->fee_paid) + fine_calculator_by_particular($con, $visible, $studentRegistrationNo, $arrayTblFeeUpdate->fee_id) + $arrayTblFeeUpdate->fee_rebate + $rebate_fine_by_particular ?>
                                                </td>

                                                <!-- total paid -->
                                                <?php $overall_total_paid = $overall_total_paid + $overall_total_paid_particular ?>


                                                <!-- total remaining including fine -->

                                                <td><span class="text-red text-bold">&#8377;
                                                        <?php echo  $total_remaing_amount_final = $total_remaining_amount + $fine_by_particular_remaning  ?></span>
                                                </td>

                                                <?php $totalRemainings = $totalRemainings + $total_remaing_amount_final;  ?>
                                                <?php //} 
                                                                ?>
                                                <!--check last payment date -->
                                                <input type="hidden" id="particular_paid_id[<?php echo $Idno; ?>]"
                                                    name="particular_paid_id[<?php echo $Idno; ?>]"
                                                    value="<?php echo $arrayTblFeeUpdate->fee_id; ?>" />
                                                <input type="hidden" id="particular_paid_lastDate[<?php echo $Idno; ?>]"
                                                    name="particular_paid_lastDate[<?php echo $Idno; ?>]"
                                                    value="<?php echo $arrayTblFeeUpdate->fee_last_date; ?>" />
                                                <input type="hidden"
                                                    id="particular_paid_fineAmount[<?php echo $Idno; ?>]"
                                                    name="particular_paid_fineAmount[<?php echo $Idno; ?>]"
                                                    value="<?php echo $arrayTblFeeUpdate->fee_fine; ?>" />
                                                <input type="hidden" id="particular_paid_amount1[<?php echo $Idno; ?>]"
                                                    name="particular_paid_amount1[<?php echo $Idno; ?>]"
                                                    value="<?php echo ($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate) ?>" />
                                                <input type="hidden"
                                                    id="particular_fine_remaining[<?php echo $arrayTblFeeUpdate->fee_id; ?>]"
                                                    name="particular_fine_remaining[<?php echo $Idno; ?>]"
                                                    value="<?php echo $fine_by_particular_remaning  ?>" />
                                                <input type="hidden"
                                                    id="fine_by_particular[<?php echo $arrayTblFeeUpdate->fee_id; ?>]"
                                                    name="fine_by_particular[<?php echo $Idno; ?>]"
                                                    value="<?php echo $fine_by_particular  ?>" />

                                                <input type="hidden"
                                                    id="particular_fine_for_database[<?php echo $arrayTblFeeUpdate->fee_id; ?>]"
                                                    name="particular_fine_for_database[<?php echo $arrayTblFeeUpdate->fee_id; ?>]"
                                                    value="<?php echo $all_fine  ?>" />

                                                <?php
                                                                //} 
                                                                ?>

                                            </tr>
                                            <?php
                                                            $tmpSNo++;
                                                            $fine_array++;
                                                            $Idno++;
                                                        }
                                                        $_SESSION['particular_remaining_amount_session'] = $particular_remaining_amount_session;
                                                        $_SESSION['particular_paid_id_seesion'] = $particular_paid_id_seesion;
                                                        $_SESSION['particular_fine_session'] = $particular_fine_session;

                                                        ?>
                                            <input type="hidden" id="total_fine_payment_remaining"
                                                value="<?php echo $total_fine_payment_remaining  ?>" />

                                            <tr>
                                                <td></td>
                                                <td class="text-right text-bold"></td>

                                                <td class="text-right text-bold">Total</td>

                                                <td class="text-bold">&#8377; <?php echo number_format($totalFee); ?>
                                                </td>
                                                <td class="text-bold">&#8377; <?php echo number_format($totalPaid); ?>
                                                </td>
                                                <td class="text-bold">&#8377; <?php echo number_format($totalRebate); ?>
                                                </td>
                                                <td class="text-bold">&#8377;
                                                    <?php echo number_format($totalRemaining); ?></td>
                                                <td class="text-bold">&#8377; <?php echo number_format($totalFine); ?>
                                                </td>
                                                <td class="text-bold">&#8377;
                                                    <?php echo number_format($total_fine_payment); ?></td>
                                                <td class="text-bold">&#8377;
                                                    <?php echo number_format($total_rebate_fine_payment); ?></td>
                                                <td class="text-bold">&#8377;
                                                    <?php echo number_format($total_fine_payment_remaining); ?></td>
                                                <td class="text-bold">&#8377;
                                                    <?php echo number_format($overall_total_paid); ?></td>

                                                <td class="text-bold" rowspan="2"><span class="text-red"> &#8377;
                                                        <?php
                                                                    $_SESSION['totalRemainings'] = $totalRemainings;
                                                                    echo number_format($totalRemainings); ?></span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="12">
                                                    <span class="text-success text-bold">
                                                        <?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($totalRemainings <= 0) {
    // If remaining amount is 0 or less, approve the record
    $status = 'Approve';
} else {
    // If remaining amount is greater than 0, not approve
    $status = 'Not Approved';
}

echo $status;  // Output status for debugging

$check_sql = "SELECT fee_status_id, manual_status, exam_status FROM tbl_fee_status WHERE admission_id='$studentRegistrationNo'";
$check_result = mysqli_query($con, $check_sql);

// Debugging - Check if query was successful
if (!$check_result) {
    die('Check query failed: ' . mysqli_error($con));
}

// Check if any rows exist for the student
if (mysqli_num_rows($check_result) > 0) {
    $row = mysqli_fetch_assoc($check_result);
    $manual_status = $row['manual_status'];  // Get the current manual_status
    $current_exam_status = $row['exam_status'];  // Get the current exam_status

    // Update exam_status based on remaining fees and manual status
    if ($manual_status == 0) {
        if ($current_exam_status != $status) {
            // Update status if it is different from the current exam status
            $update_sql = "UPDATE tbl_fee_status 
                           SET exam_status='$status', added_time = NOW() 
                           WHERE admission_id='$studentRegistrationNo'";

            // Debugging - Check if update query was successful
            if (!mysqli_query($con, $update_sql)) {
                die('Update failed: ' . mysqli_error($con));
            }
        }
    } else {
        echo ", But not able to fill the form please visit admin department.";
    }
} else {
    // If no record exists for the student, insert a new one
    if ($status == 'Approve' && $totalRemainings <= 0) {
        $course_id = $row['admission_course_name'];
        $academic_year = $row['university_details_id'];
    } else {
        // Insert a record even if not approved (remaining fee exists)
        $course_id = NULL;  // Assuming NULL if not available
        $academic_year = NULL;  // Assuming NULL if not available
    }

    $particular_id = NULL;  // Assuming NULL if not available
    $exam_particular_id = NULL;  // Assuming NULL if not available
    $fee_status = NULL;  // Assuming NULL if not available
    $reg_status = NULL;  // Assuming NULL if not available
    $manual_status = 0;  // Default manual status is 0

    $insert_sql = "INSERT INTO tbl_fee_status 
                   (admission_id, course_id, academic_year, particular_id, exam_particular_id, fee_status, exam_status, reg_status, manual_status, added_time) 
                   VALUES ('$studentRegistrationNo', '$course_id', '$academic_year', '$particular_id', '$exam_particular_id', '$fee_status', '$status', '$reg_status', '$manual_status', NOW())";

    // Debugging - Check if insert query was successful
    if (!mysqli_query($con, $insert_sql)) {
        die('Insert failed: ' . mysqli_error($con));
    }
}
?>





                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->

                            </div>
                            <br />

                        </form>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<?php
        } else
            echo '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  No Student Found!!!</div>';
    } else
        echo "0";
}