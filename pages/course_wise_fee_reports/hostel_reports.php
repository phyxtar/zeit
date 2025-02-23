<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
error_reporting(0);
if ($_GET["action"] == "fetch_fee_list_details") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $type = $_POST['type'];
    $gender = $_POST['gender'];
    $s_no = 1;
    $total_fee_amount = 0;
    $total_paid_amount = 0;
    $total_rebate_amount = 0;
    $all_total_fine = 0;
    // some import function for calculation

    function rebate_fine_calculator_by_particular($con, $visible, $studentRegistrationNo1, $particular_id)
    {
        $fine = 0; //fine variable is used for calculating the total fine for a particular id 

        $sqlTblFeePaid = "SELECT *
    FROM `tbl_fee_paid`
    WHERE `status` = '$visible' AND `student_id` = '$studentRegistrationNo1' AND `payment_status` IN ('cleared', 'pending')
    AND rebate_amount!='' ORDER BY `rebate_amount` ASC ";
        $resultTblFeePaid = $con->query($sqlTblFeePaid);

        if ($resultTblFeePaid->num_rows > 0) {

            while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {

                if ($rowTblFeePaid['rebate_amount'] > 0) {

                    $after_expoide_id = explode(",", $rowTblFeePaid['particular_id']);
                    $after_PaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);
                    // echo "<pre>";
                    //  print_r($after_expoide_id);
                    for ($i = 0; $i < count($after_expoide_id); $i++) {
                        if ($after_PaidAmount[$i] != '') {
                            if ($particular_id == $after_expoide_id[$i]) {
                                $rebate_fine = explode(",", $rowTblFeePaid['rebate_amount']);
                                if ($rebate_fine[1] === 'fine') {
                                    $fine = $fine + $rebate_fine[0];
                                }
                            }
                        }
                    }
                }
            }
        }
        return $fine;
    }

    // rebate fine calculator function end

    // fine particular function start
    function fine_calculator_by_particular($con, $visible, $studentRegistrationNo1, $particular_id)
    {
        $fine = 0; //fine variable is used for calculating the total fine for a particular id 

        $sqlTblFeePaid = "SELECT *
        FROM `tbl_fee_paid`
        WHERE `status` = '$visible' AND `student_id` = '$studentRegistrationNo1' AND `payment_status` IN ('cleared', 'pending')
        AND fine!=''";
        $resultTblFeePaid = $con->query($sqlTblFeePaid);

        if ($resultTblFeePaid->num_rows > 0) {

            while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {

                if ($rowTblFeePaid['fine'] > 0) {

                    $after_expoide_id = explode(",", $rowTblFeePaid['particular_id']);
                    $after_PaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);

                    for ($i = 0; $i < count($after_expoide_id); $i++) {
                        if ($after_PaidAmount[$i] != '') {
                            if ($particular_id == $after_expoide_id[$i]) {
                                $fine = $fine + $rowTblFeePaid['fine'];
                            }
                        }
                    }
                }
            }
        }
        return $fine;
    }
    // fine particular function end


    // remaining fine calculator function start
    function remaining_fine_calculator_by_particular($con, $visible, $studentRegistrationNo1, $particular_id)
    {
        $fine = 0; //fine variable is used for calculating the total fine for a particular id 

        $sqlTblFeePaid = "SELECT *
    FROM `tbl_fee_paid`
    WHERE `status` = '$visible' AND `student_id` = '$studentRegistrationNo1' AND `payment_status` IN ('cleared', 'pending')
    AND remaining_fine!='' ORDER BY `remaining_fine` ASC ";
        $resultTblFeePaid = $con->query($sqlTblFeePaid);

        if ($resultTblFeePaid->num_rows > 0) {

            while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {

                if ($rowTblFeePaid['remaining_fine'] > 0) {

                    $after_expoide_id = explode(",", $rowTblFeePaid['particular_id']);
                    $after_PaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);
                    for ($i = 0; $i < count($after_expoide_id); $i++) {
                        if ($after_PaidAmount[$i] != '') {
                            if ($particular_id == $after_expoide_id[$i]) {
                                $fine = $rowTblFeePaid['remaining_fine'];
                            }
                        }
                    }
                }
            }
        }
        return $fine;
    }


    ?>

<div class="card">
    <div class="card-header">
        <?php if ($type == 'dues' && $total_remaing_amount_final != 0): ?>
        <form method="POST" action="export_course-yearwise_hostel_dues.php">
            <input type="hidden" name="course_id" value="<?= $course_id ?>" />
            <input type="hidden" name="academic_year" value="<?= $academic_year ?>" />
            <input type="hidden" name="gender" value="<?= $gender ?>" />
            <input type="hidden" name="action" value="export_fees_details" />
            <button type="submit" class="btn btn-warning float-right"><i class="fa fa-download"></i> Export
                Dues</button>
        </form>
        <?php elseif ($type == 'no' && $total_remaing_amount_final == 0): ?>
        <form method="POST" action="export_course-yearwise_hostel_nodues.php">
            <input type="hidden" name="course_id" value="<?= $course_id ?>" />
            <input type="hidden" name="academic_year" value="<?= $academic_year ?>" />
            <input type="hidden" name="gender" value="<?= $gender ?>" />
            <input type="hidden" name="action" value="export_fees_details" />
            <button type="submit" class="btn btn-warning float-right"><i class="fa fa-download"></i> Export No
                Dues</button>
        </form>
        <?php elseif ($type == 'all'): ?>
        <form method="POST" action="export_course_yearwise_hostel.php">
            <input type="hidden" name="course_id" value="<?= $course_id ?>" />
            <input type="hidden" name="academic_year" value="<?= $academic_year ?>" />
            <input type="hidden" name="gender" value="<?= $gender ?>" />
            <input type="hidden" name="action" value="export_fees_details" />
            <button type="submit" class="btn btn-warning float-right"><i class="fa fa-download"></i> Export All</button>
        </form>
        <?php else: ?>
        <!-- Default button in case the 'dues' condition isn't met -->
        <form method="POST" action="export_course-yearwise_hostel_dues.php">
            <input type="hidden" name="course_id" value="<?= $course_id ?>" />
            <input type="hidden" name="academic_year" value="<?= $academic_year ?>" />
            <input type="hidden" name="gender" value="<?= $gender ?>" />
            <input type="hidden" name="action" value="export_fees_details" />
            <button type="submit" class="btn btn-warning float-right"><i class="fa fa-download"></i> Export
                Dues</button>
        </form>
        <?php endif; ?>
    </div>
</div>
<table id="parentTable" class="table table-bordered table-striped display" style="width:100%;">
    <thead>
        <tr data-child-table="childTable1">
            <th width="10%">S.Nos</th>
            <th width="10%">Reg. No</th>
            <th width="10%">Course</th>
            <th>Gender</th>
            <th width="10%">Student Name</th>
            <th width="10%">Fees Details <span id="total_fee_show"></span></th>

        </tr>
    </thead>
    <tbody id="myTable">
        <?php
            if ($course_id == "all" && $academic_year == "all" && $gender == "all")
                $sql = "SELECT * FROM `tbl_admission`
                             WHERE `status` = '$visible' && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''
                             ORDER BY `admission_id` ASC
                             ";
            else if ($course_id == "all" && $academic_year == "all")
                $sql = "SELECT * FROM `tbl_admission`
            WHERE `status` = '$visible' && `admission_gender` = '$gender' && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''
            ORDER BY `admission_id` ASC
            ";
            else if ($gender == "all")
                $sql = "SELECT * FROM `tbl_admission`
         WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_course_name` = '$course_id'  && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''
         ORDER BY `admission_id` ASC
         ";
            else
                $sql = "SELECT * FROM `tbl_admission`
         WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_gender` = '$gender' && `admission_course_name` = '$course_id'  && `admission_hostel` = 'yes' && `stud_status` = 1 && `hostel_leave_date` = ''
         ORDER BY `admission_id` ASC
         ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                        $sql_course = "SELECT * FROM `tbl_course`
                                                   WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                                                   ";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();
                        ?>
            <td class="parent-td">
                <?php echo $row["admission_id"] ?>
            </td>
            <td class="parent-td">
                <?php echo $row_course["course_name"] ?>
            </td>
            <td class="parent-td">
                <?php echo $row["admission_gender"] ?>
            </td>
            <td class="parent-td">
                <?php echo $row["admission_first_name"] ?>
                <?php echo $row["admission_middle_name"] ?>
                <?php echo $row["admission_last_name"] ?>
            </td>
            <td>
                <table class="childTable">
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
                                    //String Variables
                                    $arrayPerticular = array();
                                    $arrayTblFee = array();
                                    $objTblFee = "";

                                    //Checking If Hostel If Available Or Not
                                    if (strtolower($row["admission_hostel"]) == "yes") {
                                        $sqlTblFee = "SELECT *
                                      FROM `tbl_fee`
                                     WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "'  AND (`fee_particulars` LIKE '%hostel%' OR `fee_particulars` LIKE '%Hostel%')   ORDER BY `fee_particulars` ASC
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
                                            WHERE `status` = '$visible'
                                                AND `course_id` = '" . $row["admission_course_name"] . "'
                                                AND `fee_academic_year` = '" . $row["admission_session"] . "'
                                                AND (`fee_particulars` LIKE '%hostel%' OR `fee_particulars` LIKE '%Hostel%')
                                            ORDER BY `fee_particulars` ASC ";
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
                                    foreach ($arrayTblFee as $arrayTblFeeUpdate) {

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

                                            $total_fee_amount = $total_fee_amount + $arrayTblFeeUpdate->fee_amount;
                                            $total_paid_amount = $total_paid_amount + $arrayTblFeeUpdate->fee_paid;
                                            $total_rebate_amount = $total_rebate_amount + $arrayTblFeeUpdate->fee_rebate;
                                            $all_total_fine = $all_total_fine + $all_fine;
                                            if ($total_remaing_amount_final != 0 && $type == 'dues') {
                                                ?>
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
                                <?= $arrayTblFeeUpdate->payment_date ? '' : date('d-M-Y', strtotime($arrayTblFeeUpdate->payment_date)); ?>
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
                            </td>
                            <td>
                                <?php if ($total_remaing_amount_final == 0) { ?>
                                <button type="button" class="btn btn-primary btn-sm"> No Dues</button>
                                <?php } else { ?>
                                <button type="button" class="btn btn-warning btn-sm"> Dues</button>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php
                                            } elseif ($total_remaing_amount_final == 0 && $type == "no") { ?>
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
                                <?= $arrayTblFeeUpdate->payment_date ? '' : date('d-M-Y', strtotime($arrayTblFeeUpdate->payment_date)); ?>
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
                            </td>
                            <td>
                                <?php if ($total_remaing_amount_final == 0) { ?>
                                <button type="button" class="btn btn-primary btn-sm"> No Dues</button>
                                <?php } else { ?>
                                <button type="button" class="btn btn-warning btn-sm"> Dues</button>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } elseif ($type == 'all') { ?>
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
                            </td>
                            <td>
                                <?php if ($total_remaing_amount_final == 0) { ?>
                                <button ty.pe="button" class="btn btn-primary btn-sm"> No Dues</button>
                                <?php } else { ?>
                                <button type="button" class="btn btn-warning btn-sm"> Dues</button>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php
                                            } ?>
                        <?php
                                        $tmpSNo++;
                                    }
                                    ?>

                    </tbody>
                </table>
            </td>


        </tr>
        <?php
                    $s_no++;
                }
            } else
                echo '
                            <div class="alert alert-warning alert-dismissible">
                                <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                            </div>';
            ?>
    </tbody>
</table>


<div class="row" id="total_fee_hide">
    <div class="col-2">
    </div>
    <div class="col-2">
        <div class="btn btn-primary btn-sm">Total Fee -
            <?= $total_fee_amount ?>
        </div>
    </div>
    <div class="col-2">
        <div class="btn btn-success btn-sm">Total Fee Paid -
            <?= $total_paid_amount ?>
        </div>
    </div>
    <div class="col-2">
        <div class="btn btn-warning btn-sm">Total Fee Rebate -
            <?= $total_rebate_amount ?>
        </div>
    </div>
    <div class="col-2">
        <div class="btn btn-info btn-sm">Total Fine -
            <?= $total_fine_by_particular_remaning ?>
        </div>
    </div>
    <div class="col-2">
        <div class="btn btn-danger btn-sm">Total Due -
            <?= (int) $total_fee_amount - (int) $total_paid_amount - (int) $total_rebate_amount ?>
        </div>
    </div>
    <div class="col-2">
        <div class="btn btn-secondary btn-sm"> <strong>Overall Paid -
                <?= (int) $total_rebate_amount + (int) $total_paid_amount ?>
            </strong> </div>
    </div>
</div>
<?php
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    // Loop through each parent table row
    $('#parentTable tbody tr').each(function() {
        // Check if the associated child table has no rows with data cells
        if ($(this).find('.childTable tbody tr').length > 0) {
            var hasDataInChildTable = false;
            $(this).find('.childTable tbody tr').each(function() {
                // Check if the child table row has data cells
                if ($(this).find('td').length > 0) {
                    hasDataInChildTable = true;
                }
            });
            if (!hasDataInChildTable) {
                $(this)
                    .hide(); // Hide the parent table row if the child table has no rows with data cells
            }
        }
    });
});
</script>
<script>
function change_status(student_id, status) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        console.log(this.responseText);
        if (this.responseText == 1) {
            // adding the class show success
            document.getElementById("status" + student_id).classList.add('btn-danger');
            document.getElementById("status-fa" + student_id).classList.add('fa-user-times');

            // removing the class
            document.getElementById("status" + student_id).classList.remove('btn-success');
            document.getElementById("status-fa" + student_id).classList.remove('fa-user-check');


        } else {
            document.getElementById("status" + student_id).classList.add('btn-success');
            document.getElementById("status-fa" + student_id).classList.add('fa-user-check');
            document.getElementById("status" + student_id).classList.remove('btn-danger');
            document.getElementById("status-fa" + student_id).classList.remove('fa-user-times');
        }
    }
    xhttp.open("GET", "pages/course_wise_fee_reports/status.php?id=" + student_id + "&status=" + status, true);
    xhttp.send();
}
</script>