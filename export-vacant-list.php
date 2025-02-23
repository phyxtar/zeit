<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);

// Create connection
include_once "include/config.php";
include_once "include/PHPExcel/PHPExcel.php";
if (isset($_POST["action"]) && $_POST["action"] == "export_student_detailss") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $visible = md5("visible");
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
        //Set Filename
        $fileName = "Student-List-" . date('d-m-Y') . ".xlsx";
        //Set BackGround
        function cellColor($cells, $color)
        {
            global $objPHPExcel;

            $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            ));
        }
        //Set Color
        function fontColor($cells, $color, $size, $style, $bold)
        {
            global $objPHPExcel;

            $objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(array(
                'font'  => array(
                    'bold'  => $bold,
                    'color' => array('rgb' => $color),
                    'size'  => $size,
                    'name'  => $style
                )
            ));
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:R2');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', "Hosteler List");
        //cellColor('B2', 'FFC107');
        cellColor('B2', 'DC3545');
        fontColor('B2', 'FFFFFF', '16', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('B2:R2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B2:R2')->applyFromArray($thinBorder);

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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', "Course");
        fontColor('D4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', "Student Name");
        fontColor('E4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', "Father Name");
        fontColor('F4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', "Mother Name");
        fontColor('G4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', "Contact No.");
        fontColor('H4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', "Email Id");
        fontColor('I4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', "Date Of Birth");
        fontColor('J4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K4', "Admission No.");
        fontColor('K4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('K4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('K4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L4', "Form No.");
        fontColor('L4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('L4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M4', "User Id");
        fontColor('M4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('M4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N4', "Password");
        fontColor('N4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('N4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O4', "Address");
        fontColor('O4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('O4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('O4')->applyFromArray($thinBorder);

        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P4', "Gender");
        fontColor('P4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('P4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('P4')->applyFromArray($thinBorder);

        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q4', "Father Contact No.");
        fontColor('Q4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('Q4')->applyFromArray($thinBorder);


        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R4', "Father Whatsapp No.");
        fontColor('R4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('R4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('R4')->applyFromArray($thinBorder);

        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S4', " Category ");
        fontColor('S4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('S4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('S4')->applyFromArray($thinBorder);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T4', " Religion ");
        fontColor('T4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('T4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('T4')->applyFromArray($thinBorder);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U4', " Aadhar Card ");
        fontColor('U4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('U4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('U4')->applyFromArray($thinBorder);

        // ----------------------------------------------------------------
        // Data Section Start
        // ----------------------------------------------------------------
        $inc = 5;
        $count_i = 0;
        while ($row = $result->fetch_assoc()) {
            $orgDate = $row["admission_dob"];
            $newDate = date("d-m-Y", strtotime($orgDate));
            $count_i++;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B' . $inc, $count_i . ". ")
                ->setCellValue('C' . $inc, $row["admission_id"])
                ->setCellValue('D' . $inc, $row["course_name"])
                ->setCellValue('E' . $inc, $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"])
                ->setCellValue('F' . $inc, $row["admission_father_name"])
                ->setCellValue('G' . $inc, $row["admission_mother_name"])
                ->setCellValue('H' . $inc, $row["admission_mobile_student"])
                ->setCellValue('I' . $inc, $row["admission_emailid_student"])
                ->setCellValue('J' . $inc,  $newDate)
                ->setCellValue('K' . $inc, $row["admission_no"])
                ->setCellValue('L' . $inc, $row["admission_form_no"])
                ->setCellValue('M' . $inc, $row["admission_username"])
                ->setCellValue('N' . $inc, $row["admission_password"])
                ->setCellValue('O' . $inc, $row["admission_residential_address"] . " " . $row["admission_state"] . " " . $row["admission_city"] . " " . $row["admission_district"] . " " . $row["admission_pin_code"])
                ->setCellValue('P' . $inc, $row["admission_gender"])
                ->setCellValue('Q' . $inc, $row["admission_father_phoneno"])
                ->setCellValue('R' . $inc, $row["admission_father_whatsappno"])
                ->setCellValue('S' . $inc, $row["admission_category"])
                ->setCellValue('T' . $inc, $row["admission_religion"])
                ->setCellValue('U' . $inc, $row["admission_aadhar_no"]);


            $objPHPExcel->getActiveSheet()->getStyle('B' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('N' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('O' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('P' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('Q' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('R' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('R' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            fontColor('C' . $inc, '17A2B8', '12', '', true);
            fontColor('E' . $inc, '17A2B8', '12', '', true);
            fontColor('H' . $inc, '17A2B8', '12', '', true);
            $inc++;
        }
        // ----------------------------------------------------------------
        $objPHPExcel->getActiveSheet()->getStyle('B5:P' . --$inc)->applyFromArray($thinBorder);
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
    } else {
        echo "Something Went Wrong, Please try again.";
        exit(0);
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "export_all_prospectus_detailss") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $visible = md5("visible");
    //Here The Code
    $sql = "SELECT * FROM `tbl_prospectus` WHERE `type` = 'enquiry' && `status` = '" . $visible . "' ORDER BY `id` DESC";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        //Set Filename
        $fileName = "Prospectus-List-" . date('d-m-Y') . ".xlsx";
        //Set BackGround
        function cellColor($cells, $color)
        {
            global $objPHPExcel;

            $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            ));
        }
        //Set Color
        function fontColor($cells, $color, $size, $style, $bold)
        {
            global $objPHPExcel;

            $objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(array(
                'font'  => array(
                    'bold'  => $bold,
                    'color' => array('rgb' => $color),
                    'size'  => $size,
                    'name'  => $style
                )
            ));
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:R2');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', "Prospectus List (Online)");
        //cellColor('B2', 'FFC107');
        cellColor('B2', 'DC3545');
        fontColor('B2', 'FFFFFF', '16', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('B2:R2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B2:R2')->applyFromArray($thinBorder);

        //Setting Header --------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', "S. No.");
        fontColor('B4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', "Course");
        fontColor('C4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', "Fill Up Date");
        fontColor('D4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', "Prospectus No.");
        fontColor('E4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', "Applicant Name");
        fontColor('F4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', "Gender");
        fontColor('G4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', "Father Name");
        fontColor('H4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', "Contact No.");
        fontColor('I4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', "Email Id");
        fontColor('J4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K4', "Date Of Birth");
        fontColor('K4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('K4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('K4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L4', "State");
        fontColor('L4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('L4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M4', "City");
        fontColor('M4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('M4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N4', "Postal Code");
        fontColor('N4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('N4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O4', "Address");
        fontColor('O4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('O4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('O4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P4', "Prospectus Rate");
        fontColor('P4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('P4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('P4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q4', "Payment Status");
        fontColor('Q4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('Q4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R4', "Transaction No.");
        fontColor('R4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('R4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('R4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        // Data Section Start
        // ----------------------------------------------------------------
        $inc = 5;
        $count_i = 0;
        while ($row = $result->fetch_assoc()) {
            $count_i++;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B' . $inc, $count_i . ". ")
                ->setCellValue('C' . $inc, $row["prospectus_course_name"])
                ->setCellValue('D' . $inc, $row["post_at"])
                ->setCellValue('E' . $inc, $row["prospectus_no"])
                ->setCellValue('F' . $inc, $row["prospectus_applicant_name"])
                ->setCellValue('G' . $inc, $row["prospectus_gender"])
                ->setCellValue('H' . $inc, $row["prospectus_father_name"])
                ->setCellValue('I' . $inc, $row["mobile"])
                ->setCellValue('J' . $inc, $row["prospectus_emailid"])
                ->setCellValue('K' . $inc, $row["prospectus_dob"])
                ->setCellValue('L' . $inc, $row["prospectus_state"])
                ->setCellValue('M' . $inc, $row["prospectus_city"])
                ->setCellValue('N' . $inc, $row["prospectus_postal_code"])
                ->setCellValue('O' . $inc, $row["prospectus_address"])
                ->setCellValue('P' . $inc, $row["prospectus_rate"])
                ->setCellValue('Q' . $inc, $row["payment_status"])
                ->setCellValue('R' . $inc, $row["easebuzz_id"]);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('N' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('O' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('P' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('Q' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('R' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            fontColor('C' . $inc, '17A2B8', '12', '', true);
            fontColor('E' . $inc, '17A2B8', '12', '', true);
            fontColor('F' . $inc, '17A2B8', '12', '', true);
            fontColor('R' . $inc, '17A2B8', '12', '', true);
            if (strtolower($row["payment_status"]) == "no") {
                cellColor('Q' . $inc, 'DC3545');
                fontColor('Q' . $inc, 'FFFFFF', '12', '', true);
            } else {
                cellColor('Q' . $inc, '3D7990');
                fontColor('Q' . $inc, 'FFFFFF', '12', '', true);
            }
            $inc++;
        }
        // ----------------------------------------------------------------
        $objPHPExcel->getActiveSheet()->getStyle('B5:R' . --$inc)->applyFromArray($thinBorder);
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
    } else {
        echo "Something Went Wrong, Please try again.";
        exit(0);
    }
} elseif (isset($_POST["action"]) && $_POST["action"] == "export_hostellers_detailss") {
    // print_r("Hello");
    // die();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $course_id = $_POST["course_id"];
    $session_id = $_POST["session_id"];
    $gender = $_POST["gender"];
    $status = $_POST["status"];
    $visible = md5("visible");
    //Here The Code
    if ($gender == "all" && $status == "all" && $course_id == "all" && $session_id == 0) {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' AND (`tbl_admission`.`hostel_leave_date` IS NULL OR `tbl_admission`.`hostel_leave_date`='') ORDER BY `tbl_admission`.`admission_id`;";
    } else if ($course_id == "all" && $gender == "all" && $session_id == 0) {
        if ($status == "yes") {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`hostel_leave_date`='';";
        } else {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`hostel_leave_date`!='';";
        }
    } else if ($gender == "all" && $status == "all" && $session_id == 0) {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "';";
    } else if ($course_id == "all" && $status == "all" && $session_id == 0) {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "';";
    } else if ($course_id == "all" && $gender == "all" && $status == "all") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "';";
    } else if ($gender == "all" && $status == "all") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`admission_session`='" . $session_id . "';";
    } else if ($course_id == "all" && $status == "all") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_session`='" . $session_id . "';";
    } else if ($gender == "all" && $course_id == "all") {
        if ($status == "yes") {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`='';";
        } else {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
        }
    } else if ($session_id == 0 && $gender == "all") {
        if ($status == "yes") {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_course_name`)='" . $course_id . "' && `tbl_admission`.`hostel_leave_date`='';";
        } else {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_course_name`)='" . $course_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
        }
    } else if ($session_id == 0 && $status == "all") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`admission_gender`='" . $gender . "';";
    } else if ($course_id == "all" && $session_id == 0) {
        if ($status == "yes") {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`hostel_leave_date`='';";
        } else {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`hostel_leave_date`!='';";
        }
    } else if ($gender == "all") {
        if ($status == "yes") {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`='';";
        } else {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
        }
    } else if ($status == "all") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_session`='" . $session_id . "';";
    } else if ($course_id == "all") {
        if ($status == "yes") {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`='';";
        } else {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
        }
    } else if ($session_id == 0) {
        if ($status == "yes") {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`hostel_leave_date`='';";
        } else {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
        }
    } else {
        if ($status == "yes") {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`hostel_leave_date`='';";
        } else {
            $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`hostel_leave_date`!='';";
        }
    }

    $result = $con->query($query);
    if ($result->num_rows > 0) {

        //Set Filename
        $fileName = "Hostellers-Vacant-List-" . date('d-m-Y') . ".xlsx";
        //Set BackGround
        function cellColor($cells, $color)
        {
            global $objPHPExcel;

            $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            ));
        }
        //Set Color
        function fontColor($cells, $color, $size, $style, $bold)
        {
            global $objPHPExcel;

            $objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(array(
                'font'  => array(
                    'bold'  => $bold,
                    'color' => array('rgb' => $color),
                    'size'  => $size,
                    'name'  => $style
                )
            ));
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:M2');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', "Hostellers Vacant List");
        //cellColor('B2', 'FFC107');
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', "Course");
        fontColor('D4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', "Student Name");
        fontColor('E4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', "Father Name");
        fontColor('F4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', "Gender");
        fontColor('G4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', "Session");
        fontColor('H4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', "Student Status");
        fontColor('I4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray($thinBorder);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', "Building");
        fontColor('J4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K4', "Floor");
        fontColor('K4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('K4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('K4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L4', "Room");
        fontColor('L4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('L4')->applyFromArray($thinBorder);
        // ----------------------------------------------------------------
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M4', "Bed");
        fontColor('M4', 'DC3545', '10', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('M4')->applyFromArray($thinBorder);


        // ----------------------------------------------------------------
        // Data Section Start
        // ----------------------------------------------------------------
        $inc = 5;
        $count_i = 0;
        while ($row = $result->fetch_assoc()) {

            // $orgDate = $row["admission_dob"];
            // $newDate = date("d-m-Y", strtotime($orgDate));
            $count_i++;

            if ($row["hostel_leave_date"] == "") {
                $status = 'ACTIVE';
            } else {
                $status = 'INACTIVE';
            }
// Fetch data from hostel_allotment table
$admission_id = $row["admission_id"];
$query = "SELECT * FROM `hostel_allotment` WHERE `admission_id` = '$admission_id'";
$hostel_result = $con->query($query);

// Check if the query executed successfully
if (!$hostel_result) {
    die("Query failed: " . $con->error);
}

// Initialize values
$building = $floor = $room = $bed = '';

if ($hostel_result->num_rows > 0) {
    // Fetch and process the data
    $hostel_row = $hostel_result->fetch_assoc();
    $id = $hostel_row["id"];
    $floor = $hostel_row["floor_no"];
    $room = $hostel_row["room_no"];
    $bed = $hostel_row["bed_no"];

    // Fetch building name from hostel_building table
    $building_query = "SELECT `name` FROM `hostel_building` WHERE `id` = '$id'";
    $building_result = $con->query($building_query);

    // Check if the building query executed successfully
    if (!$building_result) {
        die("Building query failed: " . $con->error);
    }

    if ($building_result->num_rows > 0) {
        $building_row = $building_result->fetch_assoc();
        $building = $building_row["name"];
    } else {
        $building = 'No building name found';
    }
} 
    
    

    // Set data in Excel sheet
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B' . $inc, $count_i . ". ")
        ->setCellValue('C' . $inc, $row["admission_id"])
        ->setCellValue('D' . $inc, $row["course_name"])
        ->setCellValue('E' . $inc, $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"])
        ->setCellValue('F' . $inc, $row["admission_father_name"])
        ->setCellValue('G' . $inc, $row["admission_gender"])
        ->setCellValue('H' . $inc, $row["academic_session"])
        ->setCellValue('I' . $inc, $status)
        ->setCellValue('J' . $inc, $building ? $building : 'No building associated')
        ->setCellValue('K' . $inc, $floor ? $floor : 'No floor associated' )
        ->setCellValue('L' . $inc, $room ? $room : 'No floor associated')
        ->setCellValue('M' . $inc, $bed ? $bed : 'No floor associated');


            $objPHPExcel->getActiveSheet()->getStyle('B' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $inc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            fontColor('C' . $inc, '17A2B8', '12', '', true);
            fontColor('E' . $inc, '17A2B8', '12', '', true);
            fontColor('H' . $inc, '17A2B8', '12', '', true);
            $inc++;
        }
        // ----------------------------------------------------------------
        $objPHPExcel->getActiveSheet()->getStyle('B5:M' . --$inc)->applyFromArray($thinBorder);
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
        // echo "Failed";
        // die();
        exit(0);
    } else {
        echo "Something Went Wrong, Please try again.";
        exit(0);
    }
}