<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(0);

// Create connection
include_once "include/config.php";
include_once "include/PHPExcel/PHPExcel.php";
if (isset($_POST["course_id"]) && isset($_POST["academic_year"]) && isset($_POST["semester_id_name"])) {
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    $semester_id = $_POST["semester_id_name"];
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];

    $visible = md5("visible");
    //Here The Code
    if ($course_id == "all") {
        $sql = "SELECT * FROM `tbl_admission`
                INNER JOIN `tbl_course` ON `tbl_course`.`course_id` = `tbl_admission`.`admission_course_name`
                INNER JOIN `tbl_university_details` ON `tbl_university_details`.`university_details_id` = `tbl_admission`.`admission_session`
                WHERE `tbl_admission`.`admission_session` = '$academic_year' AND `tbl_admission`.`stud_status` = 1";
    } else {
        $sql = "SELECT * FROM `tbl_admission`
                INNER JOIN `tbl_course` ON `tbl_course`.`course_id` = `tbl_admission`.`admission_course_name`
                INNER JOIN `tbl_university_details` ON `tbl_university_details`.`university_details_id` = `tbl_admission`.`admission_session`
                WHERE `tbl_admission`.`admission_course_name` = '$course_id' AND `tbl_admission`.`admission_session` = '$academic_year' AND `tbl_admission`.`stud_status` = 1";
    }

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $fileName = "Student-List-with-marks" . date('d-m-Y') . ".xlsx";

        function cellColor($cells, $color)
        {
            global $objPHPExcel;
            $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(
                array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'startcolor' => array('rgb' => $color)
                )
            );
        }

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

        $thinBorder = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )
        );

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Nsucms")
            ->setLastModifiedBy("Nsucms")
            ->setTitle("$fileName")
            ->setSubject("$fileName")
            ->setDescription("Here is your $fileName.")
            ->setKeywords("$fileName")
            ->setCategory("$fileName");

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        // Add more columns as needed

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:R2');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', "Student List");
        cellColor('B2', 'DC3545');
        fontColor('B2', 'FFFFFF', '16', 'serif', true);
        $objPHPExcel->getActiveSheet()->getStyle('B2:R2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B2:R2')->applyFromArray($thinBorder);

        $headers = array("S. No.", "Admission Reg No", "Department Name", "Student Reg No", "Course", "Academic Session", "Student Roll No", "Semester", "Student Name", "Gender", "DOB", "Father Name", "Mother Name", "Result", "Month-Year", "Division", "Percentage", "Date of Issue", "Exam Type", "Total Marks", "Total Credit", "Total Credit Points", "Total Grade Points", "CGPA", "Remarks", "SGPA", "ABC Account ID", "Term Type", "Total Grade");

        $sub_headers = array("Subject Name", "Subject Code", "Subject ID", "Reg_no", "Full Internal Marks", "Full External Marks", "Full Practical Marks", "Internal", "External", "Practical", "Total Marks Obtained", "Grade", "Grade Points", "Credit", "Credit Points");

        $column = 'A';
        $row = 4;
        foreach ($headers as $header) {
            $objPHPExcel->getActiveSheet()->setCellValue($column . $row, $header);
            fontColor($column . $row, 'DC3545', '10', 'serif', true);
            $objPHPExcel->getActiveSheet()->getStyle($column . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($column . $row)->applyFromArray($thinBorder);
            $column++;
        }

        $inc = 5;
        $count_i = 0;
        while ($row = $result->fetch_assoc()) {

            $sql_session = "SELECT * FROM `tbl_university_details`
		WHERE `status` = '$visible' && `university_details_id` = '" . $row["admission_session"] . "'";
            $result_session = $con->query($sql_session);
            $row_session = $result_session->fetch_assoc();
            $completeSessionStart = explode("-", $row_session["university_details_academic_start_date"]);
            $completeSessionEnd = explode("-", $row_session["university_details_academic_end_date"]);
            $session1 = $completeSessionStart[0] . "-" . $completeSessionEnd[0];

            $sql_allot = "SELECT * FROM `tbl_allot_semester`
                                    WHERE `academic_year` = '$academic_year' && `course_id` = '$course_id' && `semester_id`='$semester_id' && `admission_id` = '" . $row["admission_id"] . "'";
            $result_allot = $con->query($sql_allot);
            $row_allot = $result_allot->fetch_assoc();

            $sql_sem = "SELECT * FROM `tbl_semester`
                                    WHERE `semester_id`='$semester_id'";
            $result_sem = $con->query($sql_sem);
            $row_sem = $result_sem->fetch_assoc();

            $arrayTblMark = array();

            $sql_marks = "SELECT * FROM `tbl_subjects` WHERE `fee_academic_year` = '$academic_year' && `course_id` = '$course_id' && `semester_id`='$semester_id'";
            $result_marks = $con->query($sql_marks);
            while ($row_marks = $result_marks->fetch_assoc()) {

                $completeArray = array(
                    "sub_name" => $row_marks["subject_name"],
                    "sub_code" => $row_marks["subject_code"],
                    "sub_id" => $row_marks["subject_id"],
                    "reg_no" => $row_allot["reg_no"],
                    "full_int" => " ",
                    "full_ext" => " ",
                    "full_prac" => " ",
                    "int" => " ",
                    "ext" => " ",
                    "prac" => " ",
                    "total" => " ",
                    "grade" => " ",
                    "grade_points" => " ",
                    "credit" => " ",
                    "credit_points" => " "
                );
                array_push($arrayTblMark, $completeArray);
            }
            $arrayTblMark = json_decode(json_encode($arrayTblMark));


            $count_i++;
            $column = 'A';
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($column++ . $inc, $count_i)
                ->setCellValue($column++ . $inc, $row["admission_id"])
                ->setCellValue($column++ . $inc, "department")
                ->setCellValue($column++ . $inc, $row_allot["reg_no"])
                ->setCellValue($column++ . $inc, $row["course_name"])
                ->setCellValue($column++ . $inc, $session1)
                ->setCellValue($column++ . $inc, $row_allot["roll_no"])
                ->setCellValue($column++ . $inc, $row_sem["semester_id"])
                ->setCellValue($column++ . $inc, $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"])
                ->setCellValue($column++ . $inc, $row["admission_gender"])
                ->setCellValue($column++ . $inc, $row["admission_dob"])
                ->setCellValue($column++ . $inc, $row["admission_father_name"])
                ->setCellValue($column++ . $inc, $row["admission_mother_name"])
                ->setCellValue($column++ . $inc, "result")
                ->setCellValue($column++ . $inc, "year")
                ->setCellValue($column++ . $inc, "division")
                ->setCellValue($column++ . $inc, "Percentage")
                ->setCellValue($column++ . $inc, "date of issue")
                ->setCellValue($column++ . $inc, "exam type")
                ->setCellValue($column++ . $inc, "total marks")
                ->setCellValue($column++ . $inc, "total credit")
                ->setCellValue($column++ . $inc, "total credit points")
                ->setCellValue($column++ . $inc, "total grade points")
                ->setCellValue($column++ . $inc, "cgpa")
                ->setCellValue($column++ . $inc, "remarks")
                ->setCellValue($column++ . $inc, "sgpa")
                ->setCellValue($column++ . $inc, "abc account id")
                ->setCellValue($column++ . $inc, "term type")
                ->setCellValue($column++ . $inc, "total grade");

            $sub_head = 4;
            $sub_column = 'AD';
            $tempInc = $inc;

            foreach ($arrayTblMark as $completeArray1) {
                foreach ($sub_headers as $subjects_headers) {
                    $objPHPExcel->getActiveSheet()->setCellValue($sub_column . $sub_head, $subjects_headers);
                    fontColor($sub_column . $sub_head, 'DC3545', '10', 'serif', true);
                    $objPHPExcel->getActiveSheet()->getStyle($sub_column . $sub_head)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $objPHPExcel->getActiveSheet()->getStyle($sub_column . $sub_head)->applyFromArray($thinBorder);
                    $sub_column++;
                }
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($column++ . $tempInc, $completeArray1->sub_name)
                    ->setCellValue($column++ . $tempInc, $completeArray1->sub_code)
                    ->setCellValue($column++ . $tempInc, $completeArray1->sub_id)
                    ->setCellValue($column++ . $tempInc, $completeArray1->reg_no)
                    ->setCellValue($column++ . $tempInc, $completeArray1->full_int)
                    ->setCellValue($column++ . $tempInc, $completeArray1->full_ext)
                    ->setCellValue($column++ . $tempInc, $completeArray1->full_prac)
                    ->setCellValue($column++ . $tempInc, $completeArray1->int)
                    ->setCellValue($column++ . $tempInc, $completeArray1->ext)
                    ->setCellValue($column++ . $tempInc, $completeArray1->prac)
                    ->setCellValue($column++ . $tempInc, $completeArray1->total)
                    ->setCellValue($column++ . $tempInc, $completeArray1->grade)
                    ->setCellValue($column++ . $tempInc, $completeArray1->grade_points)
                    ->setCellValue($column++ . $tempInc, $completeArray1->credit)
                    ->setCellValue($column++ . $tempInc, $completeArray1->credit_points);
            }
            $inc++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

    } else {
        echo "No records found.";
    }
}