<?php
// Create connection
include_once "include/config.php";
include_once "framwork/main.php";
include_once "include/PHPExcel/PHPExcel.php";
if (isset($_POST["action"]) && $_POST["action"] == "export_fees_details") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $visible = md5("visible");
    $regNo = "";
    $studentName = "";
    $fees_details_fee_particulars = "";
    $fees_details_fee_amount = "";
    $fees_details_fee_paid = "";
    $fees_details_fee_rebate = "";
    $fees_details_fee_fine = "";
    $fees_details_fee_balance = "";
    $fee_status = "";
    $fees_details = array();
    $dataArray = array();
   //Here The Code
   if ($course_id == "all" && $academic_year == "all") {
    $sql = "SELECT * FROM `tbl_admission`
            WHERE `status` = '$visible' 
            AND `stud_status` = 1
            AND `admission_hostel` = 'yes'
            AND (`hostel_leave_date` IS NULL OR `hostel_leave_date` = '')
            AND `completed` = 0
            ORDER BY `admission_id` ASC";
} else {
    $sql = "SELECT * FROM `tbl_admission`
            WHERE `status` = '$visible' 
            AND `admission_session` = '$academic_year' 
            AND `admission_course_name` = '$course_id'  
            AND `admission_hostel` = 'yes' 
            AND (`hostel_leave_date` IS NULL OR `hostel_leave_date` = '')
            AND `stud_status` = 1 
            AND `completed` = 0
            ORDER BY `admission_id` ASC";
}
    
    
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $s_no = 1;
        while ($row = $result->fetch_assoc()) {
            $sql_session = "SELECT * FROM `tbl_university_details` WHERE `status` = '" . $visible . "' AND `university_details_id` =  '" . $row['admission_session'] . "'";

            $result_session = $con->query($sql_session);
            $row_session = $result_session->fetch_assoc();

            $completeSessionStart = explode("-", $row_session["university_details_academic_start_date"]);
            $completeSessionEnd = explode("-", $row_session["university_details_academic_end_date"]);
            $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];

            $regNo = "";
            $studentName = "";
            $fees_details = array();
            $temp_all_array = array();
            $sql_course = "SELECT * FROM `tbl_course`
                               WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                               ";
            $result_course = $con->query($sql_course);
            $row_course = $result_course->fetch_assoc();
            $regNo = $row["admission_id"];
            $studentName = $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"];
            $fee_inserted_date = '';
            $admission_id = $row["admission_id"];
            $date_of_admission = $row["date_of_admission"];
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
                                    if (isset($arrayRebateAmount[1])) {
                                        if ($arrayTblFeeUpdate->fee_id == intval($arrayRebateAmount[1])) {
                                            $totalRebate = $totalRebate + intval($arrayRebateAmount[0]);
                                            $arrayTblFeeUpdate->fee_rebate = $arrayTblFeeUpdate->fee_rebate + intval($arrayRebateAmount[0]);
                                        }
                                    }
                                }
                                $arrayTblFeeUpdate->fee_paid = $arrayTblFeeUpdate->fee_paid + intval($arrayPaidAmount[$i]);
                                $arrayTblFeeUpdate->fee_remaining = $arrayTblFeeUpdate->fee_remaining - intval($arrayPaidAmount[$i]);
                            }
                        }
                    }
                }
            $tmpSNo = 1;
            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                $temp_fee_array = array();
                $fees_details_fee_particulars = "";
                $fees_details_fee_amount = "";
                $fees_details_fee_paid = "";
                $fees_details_fee_rebate = "";
                $fees_details_fee_fine = "";
                $fees_details_fee_balance = "";
                $fee_status = "";
                if ((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) {
                    $totalRemainings = $totalRemainings + 0;
                    $totalRemaining = $totalRemaining + 0;
                    $totalFine = $totalFine + 0;
                } else {
                    $totalRemainings = $totalRemainings + (($arrayTblFeeUpdate->fee_remaining) + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)) - ($arrayTblFeeUpdate->fee_rebate));
                    $totalRemaining = $totalRemaining + (($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate));
                    $totalFine = $totalFine + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days));
                }
                $fees_details_fee_particulars = $arrayTblFeeUpdate->fee_particulars;
                $fees_details_fee_amount = number_format($arrayTblFeeUpdate->fee_amount);
                $fees_details_fee_paid = number_format($arrayTblFeeUpdate->fee_paid);
                $fees_details_fee_rebate = number_format($arrayTblFeeUpdate->fee_rebate);


                if ((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) {
                    $fees_details_fee_fine = 0;
                    $fees_details_fee_balance = 0;
                    $fee_status = "No Dues";
                } else {
                    $fees_details_fee_fine = number_format(($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days));
                    $fees_details_fee_balance = number_format(($arrayTblFeeUpdate->fee_remaining) + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)) - ($arrayTblFeeUpdate->fee_rebate));
                    $fee_status = "Dues";
                }

                $temp_fee_array = array(
                    "fee_s_no" => $tmpSNo,
                    "particular_name" => $fees_details_fee_particulars,
                    "amount" => $fees_details_fee_amount,
                    "paid" => $fees_details_fee_paid,
                    "rebate" => $fees_details_fee_rebate,
                    "fine" => $fees_details_fee_fine,
                    "balance" => $fees_details_fee_balance,
                    "fee_status" => $fee_status
                );
                array_push($fees_details, $temp_fee_array);
                $tmpSNo++;
            }
            $temp_all_array = array(
                "s_no" => $s_no,
                "reg_no" => $regNo,
                "student_name" => $studentName,
                "admission_id" => $admission_id,
                "fees_details" => $fees_details,
                "date_of_admission" => $date_of_admission,
            );
            array_push($dataArray, $temp_all_array);
            $s_no++;
        }
    } else {
        echo "Something Went Wrong, Please try again.";
        exit(0);
    }
    //Set Filename
    $fileName = "Course-And-Year-Wise-Hostel-Fee-Report-" . date('d-m-Y') . ".xlsx";
    //Set BackGround
    function cellColor($cells, $color)
    {
        global $objPHPExcel;

        $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(
            array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            )
        );
    }
    //Set Color
    function fontColor($cells, $color, $size, $style, $bold)
    {
        global $objPHPExcel;

        $objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(
            array(
                'font' => array(
                    'bold' => $bold,
                    'color' => array('rgb' => $color),
                    'size' => $size,
                    'name' => $style
                )
            )
        );
    }
    //Thin Border
    $thinBorder = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
            )
        )
    );
    //Thick Border
    $thickBorder = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THICK,
                'color' => array('rgb' => '000000')
            )
        )
    );
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Nsucms")
        ->setLastModifiedBy("Nsucms")
        ->setTitle("$fileName")
        ->setSubject("$fileName")
        ->setDescription("Here is your $fileName.")
        ->setKeywords("$fileName")
        ->setCategory("$fileName");
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:Q2');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', "Course And Year Wise Hostel Fee Report - " . $row_course['course_name'] . " (" . $completeSessionOnlyYear . ")");



    //         cellColor('B2', 'FFC107');
    cellColor('B2', 'DC3545');
    fontColor('B2', 'FFFFFF', '16', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('B2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B2:L2')->applyFromArray($thinBorder);

    //Setting Header --------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', "S. No.");
    fontColor('B4', 'DC3545', '10', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', "Reg. No.");
    fontColor('C4', 'DC3545', '10', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', "Student Name");
    fontColor('D4', 'DC3545', '10', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', "Date of Admission");
    fontColor('E4', 'DC3545', '10', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', "Building");
    fontColor('F4', 'DC3545', '10', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', "Floor");
    fontColor('G4', 'DC3545', '10', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('G4')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', "Room");
    fontColor('H4', 'DC3545', '10', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', "Bed");
    fontColor('I4', 'DC3545', '10', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('J4:Q4');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', "Fees Details");
    //         cellColor('B2', '8A0410');
    cellColor('J4', '17A2B8');
    fontColor('J4', 'FFFFFF', '16', 'serif', true);
    $objPHPExcel->getActiveSheet()->getStyle('J4:Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('J4:Q4')->applyFromArray($thinBorder);


    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J5', "S. No.");
    fontColor('J5', '000000', '10', 'serif', true);
    cellColor('J5', 'FFC107');
    $objPHPExcel->getActiveSheet()->getStyle('J5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('J5')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K5', "Particular Name");
    fontColor('K5', '000000', '10', 'serif', true);
    cellColor('K5', 'FFC107');
    $objPHPExcel->getActiveSheet()->getStyle('K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('K5')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L5', "Amount");
    fontColor('L5', '000000', '10', 'serif', true);
    cellColor('L5', 'FFC107');
    $objPHPExcel->getActiveSheet()->getStyle('L5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('L5')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M5', "Paid");
    fontColor('M5', '000000', '10', 'serif', true);
    cellColor('M5', 'FFC107');
    $objPHPExcel->getActiveSheet()->getStyle('M5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('M5')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N5', "Rebate");
    fontColor('N5', '000000', '10', 'serif', true);
    cellColor('N5', 'FFC107');
    $objPHPExcel->getActiveSheet()->getStyle('N5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('N5')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O5', "Fine");
    fontColor('O5', '000000', '10', 'serif', true);
    cellColor('O5', 'FFC107');
    $objPHPExcel->getActiveSheet()->getStyle('O5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('O5')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P5', "Balance");
    fontColor('P5', '000000', '10', 'serif', true);
    cellColor('P5', 'FFC107');
    $objPHPExcel->getActiveSheet()->getStyle('P5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('P5')->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q5', "Fee Status");
    fontColor('Q5', '000000', '10', 'serif', true);
    cellColor('Q5', 'FFC107');
    $objPHPExcel->getActiveSheet()->getStyle('Q5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('Q5')->applyFromArray($thinBorder);

    // ----------------------------------------------------------------
    // Data Section Start
    // ----------------------------------------------------------------
    $inc = 6;
    $dataArray = json_decode(json_encode($dataArray));
    $grandTotalPaid = 0;
    $grandTotalRebate = 0;
    $grandTotalFine = 0;
    $grandTotalBalance = 0;
    foreach ($dataArray as $completeInfoEach) {

        $building = fetchResult('hostel_building');
        $check_student = fetchRow('hostel_allotment', 'admission_id=' . $completeInfoEach->admission_id);
        
        // Default values
        $row = array(
            "name" => 'No building associated',
            "floar" => 'No floor associated'
        );
        $check_student_defaults = array(
            "room_no" => 'No room associated',
            "bed_no" => 'No bed associated'
        );
        
        if ($check_student && !empty($check_student['building_id'])) {
            $selectedBuilding = "SELECT * FROM `hostel_building` WHERE `id` = '". $check_student['building_id']."'";
            $result = $con->query($selectedBuilding);
            $fetchedRow = $result->fetch_assoc();
            if ($fetchedRow) {
                $row = $fetchedRow; // Use the fetched row if it exists
            }
        } else {
            // Use default values for check_student if no student record is found
            $check_student = $check_student_defaults;
        }
        
        // Ensure check_student has necessary keys
        if (!isset($check_student['room_no'])) {
            $check_student['room_no'] = $check_student_defaults['room_no'];
        }
        if (!isset($check_student['bed_no'])) {
            $check_student['bed_no'] = $check_student_defaults['bed_no'];
        }
        
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B' . $inc, $completeInfoEach->s_no . ". ")
            ->setCellValue('C' . $inc, $completeInfoEach->reg_no)
            ->setCellValue('D' . $inc, $completeInfoEach->student_name)
            ->setCellValue('E' . $inc, !empty($completeInfoEach->date_of_admission) ? $completeInfoEach->date_of_admission : 'Null')
            ->setCellValue('F' . $inc, $row["name"])
            ->setCellValue('G' . $inc, $row["floar"])
            ->setCellValue('H' . $inc, $check_student["room_no"])
            ->setCellValue('I' . $inc, $check_student["bed_no"]);
        
        
        $objPHPExcel->getActiveSheet()->getStyle('B' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        fontColor('B' . $inc, '000000', '12', '', true);
        fontColor('C' . $inc, '000000', '12', '', true);
        fontColor('D' . $inc, '17A2B8', '12', '', true);
        fontColor('E' . $inc, '17A2B8', '12', '', true);
        fontColor('F' . $inc, '17A2B8', '12', '', true);
        fontColor('G' . $inc, '17A2B8', '12', '', true);
        fontColor('H' . $inc, '17A2B8', '12', '', true);
        fontColor('I' . $inc, '17A2B8', '12', '', true);
        $tempInc = $inc;
        foreach ($completeInfoEach->fees_details as $completeInfoEachDetails) {
            $grandTotalPaid = $grandTotalPaid + intval(str_replace(",", "", $completeInfoEachDetails->paid));
            $grandTotalRebate = $grandTotalRebate + intval(str_replace(",", "", $completeInfoEachDetails->rebate));
            $grandTotalFine = $grandTotalFine + intval(str_replace(",", "", $completeInfoEachDetails->fine));
            $grandTotalBalance = $grandTotalBalance + intval(str_replace(",", "", $completeInfoEachDetails->balance));
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('J' . $tempInc, $completeInfoEachDetails->fee_s_no . ". ")
                ->setCellValue('K' . $tempInc, $completeInfoEachDetails->particular_name)
                ->setCellValue('L' . $tempInc, $completeInfoEachDetails->amount)
                ->setCellValue('M' . $tempInc, $completeInfoEachDetails->paid)
                ->setCellValue('N' . $tempInc, $completeInfoEachDetails->rebate)
                ->setCellValue('O' . $tempInc, $completeInfoEachDetails->fine)
                ->setCellValue('P' . $tempInc, $completeInfoEachDetails->balance)
                ->setCellValue('Q' . $tempInc, $completeInfoEachDetails->fee_status);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $tempInc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $tempInc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $tempInc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $tempInc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('N' . $tempInc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('O' . $tempInc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('P' . $tempInc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('Q' . $tempInc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            fontColor('J' . $tempInc, '000000', '12', '', true);
            fontColor('K' . $tempInc, '17A2B8', '12', '', true);
            fontColor('L' . $tempInc, '000000', '12', '', true);
            fontColor('M' . $tempInc, 'DC3545', '12', '', true);
            fontColor('N' . $tempInc, '000000', '12', '', true);
            fontColor('O' . $tempInc, '000000', '12', '', true);
            fontColor('P' . $tempInc, 'DC3545', '12', '', true);
            fontColor('Q' . $tempInc, 'FFFFFF', '12', '', true);
            if ($completeInfoEachDetails->fee_status == "Dues")
                cellColor('Q' . $tempInc, 'DC3545');
            else
                cellColor('Q' . $tempInc, '28A745');
            $tempInc++;
        }
        // ----------------------------------------------------------------
        $objPHPExcel->getActiveSheet()->getStyle('E' . $inc . ':Q' . --$tempInc)->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $inc = $tempInc;
        $inc++;
        $inc++;
    }
    // --$inc;
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('L' . $inc, "Total")
        ->setCellValue('M' . $inc, number_format($grandTotalPaid))
        ->setCellValue('N' . $inc, number_format($grandTotalRebate))
        ->setCellValue('O' . $inc, number_format($grandTotalFine))
        ->setCellValue('P' . $inc, number_format($grandTotalBalance));
    $objPHPExcel->getActiveSheet()->getStyle('L' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('M' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('N' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('O' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('P' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    fontColor('L' . $inc, '000000', '12', '', true);
    fontColor('M' . $inc, '000000', '12', '', true);
    fontColor('N' . $inc, '000000', '12', '', true);
    fontColor('O' . $inc, '000000', '12', '', true);
    fontColor('P' . $inc, '000000', '12', '', true);
    ++$inc;
    // ----------------------------------------------------------------
    $objPHPExcel->getActiveSheet()->getStyle('B5:Q' . --$inc)->applyFromArray($thinBorder);
    // ----------------------------------------------------------------
    // Data Section End
    // ----------------------------------------------------------------
    // Rename worksheet
    // $objPHPExcel->getActiveSheet()->setTitle("$fileName");
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit(0);
}