<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="School Management 	" />
    <meta name="keywords" content="School Management   " />
    <title> NETAJI SUBHAS UNIVERSITY : Fee Payment</title>
    <link rel="stylesheet" href="dist/css/print.css">
    <?php
   
    include_once "../framwork/main.php";

    function get_total_fee_paid($studentRegistrationNo)
    {
        global $visible;
        $total_fee = 0;
        $total_rebate = 0;
        $result = fetchResult('tbl_fee_paid', 'student_id=' . $studentRegistrationNo . ' && `status`="' . $visible . '" && `payment_status` NOT IN ("deleted","refunded","bounced")');
        while ($fee = mysqli_fetch_assoc($result)) {

            $after_expoide_id = explode(",", $fee['particular_id']);
            $after_PaidAmount = explode(",", $fee["paid_amount"]);
            if ($fee["rebate_amount"] != "") {
                $arrayRebateAmount = explode(",", $fee["rebate_amount"]);
                if ($arrayRebateAmount[1] != "fine")
                    $total_rebate = $total_rebate + $arrayRebateAmount[0];
            }
            for ($i = 0; $i < count($after_expoide_id); $i++) {
                if ($after_PaidAmount[$i] != '') {
                     $total_fee = $total_fee + $after_PaidAmount[$i];
                }
            }
      
        }
         return  (int)$total_fee + (int)$total_rebate;
    }



    if (isset($_POST["paidId"])) {
        $paidId = $_POST["paidId"];
        $sql = "SELECT *
            FROM `tbl_fee_paid`
            INNER JOIN `tbl_admission` ON `tbl_fee_paid`.`student_id` = `tbl_admission`.`admission_id`
            INNER JOIN `tbl_university_details` ON `tbl_fee_paid`.`university_details_id` = `tbl_university_details`.`university_details_id`
            INNER JOIN `tbl_course` ON `tbl_fee_paid`.`course_id` = `tbl_course`.`course_id`
            WHERE `tbl_fee_paid`.`status` = '$visible' && `tbl_fee_paid`.`feepaid_id` = '$paidId'
            ";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        //Define Variables Section Start
        //Numeric Veriables
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
        $rebateOn = "";
        //Checking If Hostel If Available Or Not
        if (strtolower($row["admission_hostel"]) == "yes" && $row["hostel_leave_date"] == "")
            $sqlTblFee = "SELECT *
                     FROM `tbl_fee`
                     WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "' ORDER BY `fee_particulars` ASC
                     ";
        else
            $sqlTblFee = "SELECT *
                     FROM `tbl_fee`
                     WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "' AND `fee_particulars` NOT IN ('Caution fee','CAUTION FEE','Caution Fee','Caution fee','HOSTEL FEE', 'hostel fee', 'Hostel Fee', 'HOSTELS FEES', 'hostels fees', 'Hostels Fees', 'HOSTELS FEE', 'hostels fee', 'Hostels Fee', 'HOSTEL FEES', 'hostel fees', 'Hostel Fees', '1st Year Hostel Fee', '1ST YEAR HOSTEL FEE', '2nd Year Hostel Fee', '2ND YEAR HOSTEL FEE', '3rd Year Hostel Fee', '3RD YEAR HOSTEL FEE', '4th Year Hostel Fee', '4TH YEAR HOSTEL FEE', '5th Year Hostel Fee', '5TH YEAR HOSTEL FEE', '6th Year Hostel Fee', '6TH YEAR HOSTEL FEE') ORDER BY `fee_particulars` ASC
                     ";
        $resultTblFee = $con->query($sqlTblFee);
        if ($resultTblFee->num_rows > 0)
            while ($rowTblFee = $resultTblFee->fetch_assoc()) {
                $totalFee = $totalFee + intval($rowTblFee["fee_amount"]);
                if (strtotime(date($rowTblFee["fee_lastdate"])) < strtotime(date("Y-m-d")))
                    $noOfDays = (strtotime(date("Y-m-d")) - strtotime(date($rowTblFee["fee_lastdate"]))) / 60 / 60 / 24;
                else
                    $noOfDays = 0;
                $completeArray = array(
                    "fee_id" => $rowTblFee["fee_id"],
                    "fee_particulars" => $rowTblFee["fee_particulars"],
                    "fee_amount" => $rowTblFee["fee_amount"],
                    "fee_paid" => 0,
                    "fee_fine" => $rowTblFee["fee_fine"],
                    "fee_rebate" => 0,
                    "fee_remaining" => $rowTblFee["fee_amount"],
                    "fee_fine_days" => $noOfDays
                );
                array_push($arrayTblFee, $completeArray);
            }
        $arrayTblFee = json_decode(json_encode($arrayTblFee));
        $arrayPaidId = explode(",", $row["particular_id"]);
        $arrayPaidAmount = explode(",", $row["paid_amount"]);
        for ($i = 0; $i < count($arrayPaidId); $i++) {
            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                if ($arrayTblFeeUpdate->fee_id == $arrayPaidId[$i]) {
                    $totalPaid = $totalPaid + intval($arrayPaidAmount[$i]);
                    if ($row["rebate_amount"] != "") {
                        $arrayRebateAmount = explode(",", $row["rebate_amount"]);
                        if ($arrayTblFeeUpdate->fee_id == intval($arrayRebateAmount[1])) {
                            $rebateOn = $arrayTblFeeUpdate->fee_particulars;
                            $totalRebate = $totalRebate + intval($arrayRebateAmount[0]);
                            $arrayTblFeeUpdate->fee_rebate = $arrayTblFeeUpdate->fee_rebate + intval($arrayRebateAmount[0]);
                        }
                    }
                    $arrayTblFeeUpdate->fee_paid = $arrayTblFeeUpdate->fee_paid + intval($arrayPaidAmount[$i]);
                    $arrayTblFeeUpdate->fee_remaining = $arrayTblFeeUpdate->fee_remaining - intval($arrayPaidAmount[$i]);
                }
            }
        }
        if ($row["fine"] != "")
            $fineAmount = $row["fine"];
        else
            $fineAmount = 0;
        if (!empty($row["extra_fine"])) {
            $show_extra = explode("|separator|", $row["extra_fine"]);
            $fineAmount = intval($fineAmount) + intval($show_extra[0]);
        }
    ?>


    <script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
    </script>

<body class="body_pop">
    <!-- <p style="position: fixed;right: 3%;">
        <a href="" id="printbutton" value="&nbsp;Print" onclick="return printing();"><img src="images/print.jpg"
                style="height: 80px;"></a>
    </p> -->
    <div id="divToPrint">
        <table width="645" align="center" class="tb2_grid"
            style=" border: 2px solid #4DC8EE;border-color: #4dc8ee !important;">

            <tr>
                <td width="635">
                    <table width="100%" border="0" style="margin-top:12px;">
                        <tr>
                            <td align="right" valign="top" colspan="3">
                                <table width="100%" border="0" style="border-color: #4dc8ee !important;">

                                    <tr>
                                        <td width="8%" rowspan="4" align="center" valign="top"><img
                                                src="../images/nsu_logo_edit.png" style="width: 158px;" alt="Image"
                                                border="0" title="Images">&nbsp;</td>
                                        <td width="92%" align="center" valign="top"><span class="style1"
                                                style="font-size:30px;">NETAJI SUBHAS UNIVERSITY</span></td>
                                    </tr>
                                    <tr style="font-size: 13px;">
                                        <td align="center" valign="top" style="padding-bottom: 25px;"><strong>POKHARI,
                                                P.O : BHILAI PAHARI, P.S : M.G.M Dist : EAST SINGHBHUM,<br> JAMSHEDPUR -
                                                831012 Jharkhand Ph. +91 9835203429 <br>Website : https://nsuniv.ac.in/
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center" valign="top"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" align="center" valign="top"
                                            style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px;">
                                            <strong></strong>
                                        </td>
                                    </tr>

                                </table>
                        </tr>
                        <tr>
                            <td height="93" colspan="3">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                    style="margin-top: -25px;" style="border-color: #4dc8ee !important;">
                                    <tr>
                                        <td height="3" colspan="3"></td>
                                    </tr>
                                    <tr>
                                        <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span
                                                class="admin">Money Receipt</span></td>
                                    </tr>
                                    <tr>
                                        <td width="1" class="bgcolor_02"></td>
                                        <td align="left" valign="top">
                                            <table width="100%">
                                                <tr>
                                                    <td>

                                                        <table width="95%" border="0" cellspacing="2" cellpadding="0"
                                                            align="center" style="border-color: #4dc8ee !important;">
                                                            <tr>

                                                                <td align="left" class="narmal">Admission No. </td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["course_name"]; ?><?php echo date("y", strtotime($row['university_details_academic_start_date'])) ?><?php echo date("y", strtotime($row['university_details_academic_end_date'])); ?><?php
                                                                                                                                                                                                                                                                                                        $admission_id = 1;
                                                                                                                                                                                                                                                                                                        printf("%03d", $row['admission_id']);
                                                                                                                                                                                                                                                                                                        ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td align="left" class="narmal">Registration No.</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["admission_id"]; ?></td>
                                                                <td align="left" class="narmal">Receipt No</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["receipt_no"]; ?> </td>

                                                            </tr>

                                                            <tr>
                                                                <td align="left" class="narmal">Course</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo strtoupper($row["course_name"]); ?></td>
                                                                <td align="left" class="narmal">Payment Date</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo date("d-m-Y", strtotime($row["transaction_date"]));  ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" class="narmal">Academic Session</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["academic_session"]; ?></td>


                                                                <td align="left" class="narmal">Receipt Date</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo date("d-m-Y", strtotime($row["receipt_date"]));  ?>
                                                                    <?php echo str_split($row['fee_paid_time'], 13)[1]; ?>
                                                                </td>

                                                            </tr>


                                                            <tr>
                                                                <td align="left" class="narmal" width="31%">Student Name
                                                                </td>
                                                                <td align="left" class="narmal" width="1%">:</td>
                                                                <td align="left" class="narmal" width="27%">
                                                                    <?php echo strtoupper($row["admission_first_name"]); ?>
                                                                    <?php echo strtoupper($row["admission_middle_name"]); ?>
                                                                    <?php echo strtoupper($row["admission_last_name"]); ?>
                                                                </td>

                                                                <td align="left" class="narmal">Bank Name</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["bank_name"]; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td align="left" class="narmal">Father/Guardian Name
                                                                </td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo strtoupper($row["admission_father_name"]); ?>
                                                                </td>
                                                                <td align="left" class="narmal">NEFT/Cheque No</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["transaction_no"]; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td align="left" class="narmal">Hostel</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo strtoupper($row["admission_hostel"]); ?>
                                                                </td>


                                                                <td align="left" class="narmal"> Cash Deposit To</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["cash_deposit_to"]; ?></td>

                                                            </tr>

                                                            <tr>
                                                                <td align="left" class="narmal"> Notes</td>
                                                                <td align="left" class="narmal">:</td>

                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["notes"]; ?></td>

                                                                <td align="left" class="narmal">Payment Mode</td>
                                                                <td align="left" class="narmal">:</td>
                                                                <td align="left" class="narmal">
                                                                    <?php echo $row["payment_mode"]; ?></td>
                                                            </tr>


                                                        </table>
                                                    </td>
                                                </tr>



                                                <tr>
                                                    <td>
                                                        <table width="100%" border="1" cellspacing="0" cellpadding="0"
                                                            class="tbl_grid" style="border-color: #4dc8ee !important;">
                                                            <br>
                                                            <tr>
                                                                <td align="left" class="adminfont" colspan="7">
                                                                    &nbsp;<b>Fee Details for Course :
                                                                        <?php echo $row["course_name"]; ?></b> </td>
                                                            </tr>
                                                            <tr class="bgcolor_02" height="25">
                                                                <td align="center" class="admin" width="14%">&nbsp;S No
                                                                </td>
                                                                <td align="center" class="admin" width="40%">Particulars
                                                                </td>
                                                                <td align="center" class="admin" width="17%">Total</td>
                                                                <!--<td align="center" class="admin" width="29%">  Fee Type</td>-->
                                                            </tr>

                                                            <?php
                                                            $tmpSNo = 1;
                                                            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                            ?>
                                                            <tr>
                                                                <td align="center" class="narmal"><?php echo $tmpSNo; ?>
                                                                </td>
                                                                <td align="center" class="narmal">
                                                                    <?php echo strtoupper($arrayTblFeeUpdate->fee_particulars); ?>
                                                                </td>
                                                                <td align="center" class="narmal"><span
                                                                        class="text-bold">Rs.
                                                                        <?php echo $arrayTblFeeUpdate->fee_amount; ?>.00</span>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                $tmpSNo++;
                                                            }
                                                            ?>
                                                            <!-- TOTAL AMOUNT -->
                                                            <tr>
                                                                <td align="center"></td>
                                                                <td align="center">Total</td>
                                                                <td align="center">Rs.
                                                                    <strong><?php echo $totalFee; ?>.00</strong>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <table width="100%" border="1" cellspacing="0" cellpadding="0"
                                                            class="tbl_grid" style="border-color: #4dc8ee !important;">
                                                            <br>
                                                            <tr>
                                                                <td align="left" class="adminfont" colspan="7"
                                                                    style="border-color: #4dc8ee !important;">
                                                                    &nbsp;<b>Total Fee Paid</b></td>
                                                            </tr>

                                                            <tr class="bgcolor_02" height="25">
                                                                <td width="33%" align="center" valign="middle"
                                                                    class="admin">&nbsp;S.No.</td>
                                                                <td width="37%" align="center" valign="middle"
                                                                    class="admin">Particulars</td>

                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">Amount (Paid)</td>
                                                            </tr>

                                                            <?php
                                                            $tmpSNo = 1;
                                                            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                                if ($arrayTblFeeUpdate->fee_paid != 0) {
                                                            ?>
                                                            <tr>
                                                                <td width="33%" align="center" valign="middle"
                                                                    class="admin"><?php echo $tmpSNo; ?></td>
                                                                <td width="37%" align="right" valign="right"
                                                                    class="admin">
                                                                    <?php echo strtoupper($arrayTblFeeUpdate->fee_particulars); ?>
                                                                </td>
                                                                <td width="30%" align="right" valign="right"
                                                                    class="admin"><span class="text-bold">Rs.
                                                                        <?php echo $arrayTblFeeUpdate->fee_paid; ?>.00</span>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                    $tmpSNo++;
                                                                }
                                                            }
                                                            ?>
                                                            <!-- TOTAL AMOUNT -->
                                                            <tr>
                                                                <td align="right"></td>
                                                                <td align="right">Total</td>
                                                                <td align="right">Rs.
                                                                    <strong><?php echo $totalPaid; ?>.00</strong>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                </tr>



                                                <tr>
                                                    <td>
                                                        <table width="100%" border="1" cellspacing="0" cellpadding="0"
                                                            class="tbl_grid" style="border-color: #4dc8ee !important;">
                                                            <br>
                                                            <tr>
                                                                <td align="left" class="adminfont" colspan="7">
                                                                    &nbsp;<b>Summary</b> </td>
                                                            </tr>
                                                            <tr class="bgcolor_02" height="25">
                                                                <!--	<td width="33%" align="center" valign="middle" class="admin">&nbsp;Total Amount(Fee+Hostel)</td> -->
                                                                <!--<td width="30%" align="center" valign="middle" class="admin">REBATE ON</td>-->
                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">TOTAL PAID</td>
                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">REBATE AMOUNT</td>
                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">TOTAL FINE</td>
                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">BALANCE DUE</td>
                                                            </tr>

                                                            <tr height="25">
                                                                <!-- <td width="30%" align="center" valign="middle" class="admin"><?php // echo $rebateOn; 
                                                                                                                                    ?></td>-->
                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">Rs.
                                                                    <?php echo $totalPaid + $fineAmount; ?>.00</td>
                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">Rs. <?php echo $totalRebate; ?>.00
                                                                </td>
                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">Rs. <?php echo $fineAmount ?>.00</td>
                                                                <td width="30%" align="center" valign="middle"
                                                                    class="admin">Rs. <?php echo $row["balance"]   ?>.00
                                                                </td>
                                                            </tr>

                                                            <tr height="70">
                                                                <td align="left" colspan="6"></td>

                                                            </tr>
                                                            <tr height="25">
                                                                <td align="right" colspan="6"
                                                                    style="padding-right:25px;" class="admin">Authorised
                                                                    Signatory</td>
                                                            </tr>
                                                            <tr height="25">
                                                                <td align="left" colspan="6"
                                                                    style="padding-right:25px; font-size: 10px;"
                                                                    class="admin">Note:- Fees once paid will not be
                                                                    refunded and please keep this slip for your
                                                                    reference. If there are any questions regarding your
                                                                    UTR/NEFT/CHEQUE NO. You will receive a call
                                                                    regarding the same. Your receipt shall not be a
                                                                    confirmation of payment in such case.

                                                                    <!--  Fee once paid will not be refunded and Please keep this slip for your reference -->
                                                                </td>

                                                            </tr>



                                                        </table>
                                                    </td>
                                                </tr>


                                            </table>
                                            <span style="margin-left: 15px; bottom:0px">Generated
                                                By:<?php echo $row["print_generated_by"]; ?> </span>



                                        </td>
                                        <td width="1" class="bgcolor_02"></td>
                                    </tr>
                                    <tr>
                                        <td width="1" class="bgcolor_02"></td>
                                        <td height="10">&nbsp;</td>
                                        <td width="1" class="bgcolor_02"></td>
                                    </tr>
                                    <tr>
                                        <td height="1" colspan="3" class="bgcolor_02"></td>
                                    </tr>
                                </table>

                                <style>
                                .fee_card {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;
                                    font-size: 9px;
                                }
                                </style>

                            </td>
                        </tr>

                        <!--<tr>-->
                        <!--     <td colspan="3" align="right"><input type="button" id="printbutton" value="&nbsp;Print" onclick="return printing();" class="bgcolor_02" /></td>-->
                        <!-- </tr>-->

                    </table>
                </td>
            </tr>
            <script type="text/javaScript">
                // function printing(){
        //   document.getElementById("printbutton").style.display = "none";
          window.print();
        //   window.close();
        //  }

      </script>

        </table>
    </div>
</body>

</html>
<?php
    } elseif (isset($_GET["studentId"])) {
        $studentRegistrationNo = $_GET["studentId"];
        $sql = "SELECT *
                FROM `tbl_admission`
                INNER JOIN `tbl_university_details` ON `tbl_admission`.`admission_session` = `tbl_university_details`.`university_details_id`
                INNER JOIN `tbl_course` ON `tbl_admission`.`admission_course_name` = `tbl_course`.`course_id`
                WHERE `tbl_admission`.`admission_id` = '$studentRegistrationNo' && `tbl_admission`.`status` = '$visible' && `tbl_course`.`status` = '$visible' && `tbl_university_details`.`status` = '$visible'
                ";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        //Define Variables Section Start
        //Numeric Veriables
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
        $rebateOn = "";
        //Checking If Hostel If Available Or Not
        if (strtolower($row["admission_hostel"]) == "yes" && $row["hostel_leave_date"] == "")
            $sqlTblFee = "SELECT *
                         FROM `tbl_fee`
                         WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "' ORDER BY `fee_particulars` ASC
                         ";
        else
            $sqlTblFee = "SELECT *
                         FROM `tbl_fee`
                         WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "' AND `fee_particulars` NOT IN ('HOSTEL FEE', 'hostel fee', 'Hostel Fee', 'HOSTELS FEES', 'hostels fees', 'Hostels Fees', 'HOSTELS FEE', 'hostels fee', 'Hostels Fee', 'HOSTEL FEES', 'hostel fees', 'Hostel Fees', '1st Year Hostel Fee', '1ST YEAR HOSTEL FEE', '2nd Year Hostel Fee', '2ND YEAR HOSTEL FEE', '3rd Year Hostel Fee', '3RD YEAR HOSTEL FEE', '4th Year Hostel Fee', '4TH YEAR HOSTEL FEE', '5th Year Hostel Fee', '5TH YEAR HOSTEL FEE', '6th Year Hostel Fee', '6TH YEAR HOSTEL FEE') ORDER BY `fee_particulars` ASC
                         ";
        $resultTblFee = $con->query($sqlTblFee);
        if ($resultTblFee->num_rows > 0)
            while ($rowTblFee = $resultTblFee->fetch_assoc()) {
                $totalFee = $totalFee + intval($rowTblFee["fee_amount"]);
                if (strtotime(date($rowTblFee["fee_lastdate"])) < strtotime(date("Y-m-d")))
                    $noOfDays = (strtotime(date("Y-m-d")) - strtotime(date($rowTblFee["fee_lastdate"]))) / 60 / 60 / 24;
                else
                    $noOfDays = 0;
                $completeArray = array(
                    "fee_id" => $rowTblFee["fee_id"],
                    "fee_particulars" => $rowTblFee["fee_particulars"],
                    "fee_amount" => $rowTblFee["fee_amount"],
                    "fee_paid" => 0,
                    "fee_fine" => $rowTblFee["fee_fine"],
                    "fee_rebate" => 0,
                    "fee_remaining" => $rowTblFee["fee_amount"],
                    "fee_fine_days" => $noOfDays,
                    "fee_paid_on" => "",
                    "fee_receipt_date" => "",
                    "fee_transaction_no" => "",
                    "fee_bank_name" => "",
                    "fee_balance" => ""
                );
                array_push($arrayTblFee, $completeArray);
            }
        $arrayTblFee = json_decode(json_encode($arrayTblFee));
        $sqlTblFeePaid = "SELECT *
                         FROM `tbl_fee_paid`
                         WHERE `status` = '$visible' AND `student_id` = '" . $studentRegistrationNo . "' AND `payment_status` IN ('cleared', 'pending')
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
                            $arrayTblFeeUpdate->fee_paid_on = $rowTblFeePaid["paid_on"];
                            $arrayTblFeeUpdate->fee_receipt_date = $rowTblFeePaid["receipt_date"];
                            $arrayTblFeeUpdate->fee_transaction_no = $rowTblFeePaid["transaction_no"];
                            $arrayTblFeeUpdate->fee_bank_name = $rowTblFeePaid["bank_name"];
                            $arrayTblFeeUpdate->fee_balance = $rowTblFeePaid["balance"];
                        }
                    }
                }
            }
?>



<body class="body_pop">
    <table width="645" align="center" class="tb2_grid"
        style="border-color: #4dc8ee !important; border: 2px solid #4dc8ee;">
        <p style="position: fixed;right: 3%;">
            <a href="" id="printbutton" value="&nbsp;Print" onclick="return printing();"><img src="images/print.jpg"
                    style="height: 80px;"></a>
        </p>
        <tr>
            <td width="635">
                <table width="100%" border="0" style="border-color: #4dc8ee !important;margin-top:12px;">
                    <tr>
                        <td align="right" valign="top" colspan="3">
                            <table width="100%" border="0" style="border-color: #4dc8ee !important;">
                                <!--<tr>
                                    <td colspan="2" align="center" valign="top">&nbsp;</td>
                                </tr>-->
                                <tr>
                                    <td width="8%" rowspan="4" align="center" valign="top"><img
                                            src="images/nsu_logo_edit.png" style="width: 158px;" alt="Image" border="0"
                                            title="Images">&nbsp;</td>
                                    <td width="92%" align="center" valign="top"><span class="style1"
                                            style="font-size:30px;">NETAJI SUBHAS UNIVERSITY</span></td>
                                </tr>
                                <tr style="font-size: 13px;">
                                    <td align="center" valign="top" style="padding-bottom: 25px;"><strong>POKHARI, P.O :
                                            BHILAI PAHARI, P.S : M.G.M Dist : EAST SINGHBHUM,<br> JAMSHEDPUR - 831012
                                            Jharkhand Ph. +91 9835203429 <br>Website : https://nsuniv.ac.in/</td>

                                </tr>

                                <tr>
                                    <td align="center" valign="top"></td>
                                </tr>

                                <tr>
                                    <td colspan="2" align="center" valign="top"
                                        style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px;">
                                        <strong></strong>
                                    </td>
                                </tr>

                            </table>
                    </tr>
                    <tr>
                        <td height="93" colspan="3">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: -25px;"
                                style="border-color: #4dc8ee !important;">
                                <tr>
                                    <td height="3" colspan="3"></td>
                                </tr>
                                <tr>
                                    <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span
                                            class="admin"><b>STUDENT FEE CARD</b></span></td>
                                </tr>
                                <tr>
                                    <td width="1" class="bgcolor_02"></td>
                                    <td align="left" valign="top">
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <table width="95%" border="0" cellspacing="2" cellpadding="0"
                                                        align="center">

                                                        <tr>

                                                            <td align="left" class="narmal">Admission No. </td>
                                                            <td align="left" class="narmal">:</td>
                                                            <td align="left" class="narmal">
                                                                <?php echo $row["course_name"]; ?><?php echo date("y", strtotime($row['university_details_academic_start_date'])) ?><?php echo date("y", strtotime($row['university_details_academic_end_date'])); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="narmal">Registration No.</td>
                                                            <td align="left" class="narmal">:</td>
                                                            <td align="left" class="narmal">
                                                                <?php echo $row["admission_id"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="narmal">Academic Session</td>
                                                            <td align="left" class="narmal">:</td>
                                                            <td align="left" class="narmal">
                                                                <?php echo date("Y", strtotime($row["university_details_academic_start_date"])) . " to " . date("Y", strtotime($row["university_details_academic_end_date"])); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="narmal">Course</td>
                                                            <td align="left" class="narmal">:</td>
                                                            <td align="left" class="narmal">
                                                                <?php echo $row["course_name"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="narmal" width="31%">Student Name
                                                            </td>
                                                            <td align="left" class="narmal" width="1%">:</td>
                                                            <td align="left" class="narmal" width="27%">
                                                                <?php echo $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"]; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="narmal">Father/Guardian Name </td>
                                                            <td align="left" class="narmal">:</td>
                                                            <td align="left" class="narmal">
                                                                <?php echo $row["admission_father_name"]; ?></td>
                                                        <tr>
                                                        <tr>
                                                            <td align="left" class="narmal">Hostel</td>
                                                            <td align="left" class="narmal">:</td>
                                                            <td align="left" class="narmal">
                                                                <?php echo $row["admission_hostel"]; ?></td>
                                                        <tr>
                                                        </tr>

                                                    </table>
                                                </td>
                                            </tr>



                                            <tr>
                                                <td>
                                                    <table width="100%" border="1" cellspacing="0" cellpadding="0"
                                                        class="tbl_grid" style="border-color: #4dc8ee !important;"><br>
                                                        <tr>
                                                            <td align="left" class="adminfont" colspan="7">&nbsp;Fee
                                                                Details for Course : <?php echo $row["course_name"]; ?>
                                                            </td>
                                                        </tr>
                                                        <tr class="bgcolor_02" height="25">
                                                            <td align="center" class="admin" width="14%">&nbsp;S No</td>
                                                            <td align="center" class="admin" width="40%">Particulars
                                                            </td>
                                                            <td align="center" class="admin" width="17%">Total</td>
                                                        </tr>

                                                        <?php
                                                            $tmpSNo = 1;
                                                            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                            ?>
                                                        <tr>
                                                            <td align="left" class="narmal"><?php echo $tmpSNo; ?></td>
                                                            <td align="left" class="narmal">
                                                                <?php echo strtoupper($arrayTblFeeUpdate->fee_particulars); ?>
                                                            </td>
                                                            <td align="left" class="narmal">Rs.
                                                                <?php echo $arrayTblFeeUpdate->fee_amount; ?>.00</td>
                                                        </tr>
                                                        <?php
                                                                $tmpSNo++;
                                                            }
                                                            ?>
                                                        <!-- TOTAL AMOUNT -->
                                                        <tr>
                                                            <td></td>
                                                            <td align="left"><strong>TOTAL</strong></td>
                                                            <td align="left"><strong>Rs.
                                                                    <?php echo $totalFee; ?>.00</strong></td>
                                                        </tr>

                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <table width="100%" border="1" cellspacing="0" cellpadding="0"
                                                        class="tbl_grid" style="border-color: #4dc8ee !important;"><br>
                                                        <tr>
                                                            <td align="left" class="adminfont" colspan="7">&nbsp;Total
                                                                Fee Paid</td>
                                                        </tr>

                                                        <tr class="bgcolor_02" height="25">
                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">S. No.</td>
                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">Payment Date</td>
                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">RECEIPT Date</td>
                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">CHEQUE/DD NO/ONLINE NO</td>
                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">Bank Name</td>
                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">PARTICULARS</td>

                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">Rebate.</td>
                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">Paid Amount</td>
                                                            <td width="10%" align="center" valign="middle"
                                                                class="admin">Balance</td>

                                                        </tr>
                                                        <tbody>
                                                            <?php
                                                                $tmpSNo = 1;
                                                                foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                                    if ($arrayTblFeeUpdate->fee_paid != 0) {
                                                                ?>
                                                            <tr>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"><?php echo $tmpSNo; ?></td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin">
                                                                    <?php echo $arrayTblFeeUpdate->fee_paid_on; ?></td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin">
                                                                    <?php echo $arrayTblFeeUpdate->fee_receipt_date; ?>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin">
                                                                    <?php echo $arrayTblFeeUpdate->fee_transaction_no; ?>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin">
                                                                    <?php echo $arrayTblFeeUpdate->fee_bank_name; ?>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin">
                                                                    <?php echo strtoupper($arrayTblFeeUpdate->fee_particulars); ?>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"><span
                                                                        class="text-bold">Rs.<?php echo $arrayTblFeeUpdate->fee_rebate; ?>.00</span>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"><span
                                                                        class="text-bold">Rs.<?php echo $arrayTblFeeUpdate->fee_paid; ?>.00</span>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"><span
                                                                        class="text-bold">Rs.<?php echo $arrayTblFeeUpdate->fee_balance; ?>.00</span>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                        $totalRemaining = $totalRemaining + $arrayTblFeeUpdate->fee_balance;
                                                                    }
                                                                    $tmpSNo++;
                                                                }
                                                                ?>
                                                            <!-- TOTAL AMOUNT -->
                                                            <tr>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"></td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"></td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"></td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"></td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"></td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"><span
                                                                        class="float-right mr-3 text-bold">Total</span>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"><span
                                                                        class="text-bold">Rs.<?php echo $totalRebate; ?>.00</span>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"><span
                                                                        class="text-bold">Rs.<?php echo $totalPaid; ?>.00</span>
                                                                </td>
                                                                <td width="10%" align="center" valign="middle"
                                                                    class="admin"><span
                                                                        class="text-bold">Rs.<?php echo $totalRemaining; ?>.00</span>
                                                                </td>
                                                            </tr>

                                                    </table>

                                                </td>
                                            </tr>




                                            <tr>
                                                <td>
                                                    <table width="100%" border="1" cellspacing="0" cellpadding="0"
                                                        class="tbl_grid" style="border-color: #4dc8ee !important;">
                                                        <tr height="50">
                                                            <td align="left" colspan="4"></td>

                                                        </tr>
                                                        <tr height="25">
                                                            <td align="right" colspan="4" style="padding-right:25px;"
                                                                class="admin">Authorised Signatory
                                                            </td>
                                                        </tr>
                                                        <tr height="25">
                                                            <td align="left" colspan="4"
                                                                style="padding-right:25px; font-size: 10px;"
                                                                class="admin">Note:- Fees once paid will not be refunded
                                                                and please keep this slip for your reference. If there
                                                                are any questions regarding your UTR/NEFT/CHEQUE NO. You
                                                                will receive a call regarding the same. Your receipt
                                                                shall not be a confirmation of payment in such case.

                                                                <!--Fee once paid will not be refunded and Please keep this slip for your reference -->
                                                            </td>
                                                        </tr>



                                                    </table>
                                                </td>

                                            </tr>

                                        </table>



                                    </td>
                                    <td width="1" class="bgcolor_02"></td>
                                </tr>
                                <tr>
                                    <td width="1" class="bgcolor_02"></td>
                                    <td height="10">&nbsp;</td>
                                    <td width="1" class="bgcolor_02"></td>
                                </tr>
                                <tr>
                                    <td height="1" colspan="3" class="bgcolor_02"></td>
                                </tr>
                            </table>
                            <style>
                            .fee_card {
                                font-family: Verdana, Arial, Helvetica, sans-serif;
                                font-size: 9px;
                            }
                            </style>

                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <script type="text/javaScript">
            // function printing(){
        //   document.getElementById("printbutton").style.display = "none";
          window.print();
          window.close();
        //  }

      </script>

    </table>
</body>

</html>
<?php
    } else {
        echo "<script> location.replace('payfee'); </script>";
    }
?>