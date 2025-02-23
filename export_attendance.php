<?php
include_once "framwork/main.php";
include_once "include/function.php";
include_once "include/config.php";
require 'vendor/autoload.php';  // Make sure PhpSpreadsheet is autoloaded via Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Retrieve data from the POST request
$from_date = isset($_POST['from_date']) ? $_POST['from_date'] : null;
$to_date = isset($_POST['to_date']) ? $_POST['to_date'] : null;
$grade_id = isset($_POST['grade_id']) ? $_POST['grade_id'] : null;

if ($from_date && $to_date && $grade_id) {
    // Calculate total working days in the date range
    $total_working_days_query = "SELECT COUNT(DISTINCT attendance_date) AS working_days
                                 FROM tbl_attendance
                                 WHERE attendance_date BETWEEN '$from_date' AND '$to_date'
                                   AND grade_id = '$grade_id'";

    $working_days_result = $con->query($total_working_days_query);
    
    if (!$working_days_result) {
        die('Error with query: ' . $con->error);
    }
    
    $working_days_row = $working_days_result->fetch_assoc();
    $total_working_days = $working_days_row['working_days'];

    if ($total_working_days > 0) {
        // Query to fetch attendance data with present days per student
        $sql = "SELECT 
                    a.student_id, 
                    s.student_name, 
                    g.grade_name, 
                    COUNT(CASE WHEN a.attendance_status = 'Present' THEN 1 END) AS present_days
                FROM tbl_attendance a
                JOIN tbl_students s ON a.student_id = s.student_id
                JOIN tbl_grade g ON a.grade_id = g.grade_id
                WHERE a.grade_id = '$grade_id' 
                  AND a.attendance_date BETWEEN '$from_date' AND '$to_date'
                GROUP BY a.student_id";
        $result = $con->query($sql);

        if (!$result) {
            die('Error with query: ' . $con->error);
        }

        if ($result && $result->num_rows > 0) {
            // Create new Spreadsheet object
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set column headers
            $sheet->setCellValue('A1', 'S.No.')
                  ->setCellValue('B1', 'Student ID')
                  ->setCellValue('C1', 'Student Name')
                  ->setCellValue('D1', 'Grade')
                  ->setCellValue('E1', 'Present Days')
                  ->setCellValue('F1', 'Total Working Days')
                  ->setCellValue('G1', 'Attendance Percentage');

            $serial_no = 2;  // Starting row for data

            // Loop through the result set and populate the spreadsheet
            while ($row = $result->fetch_assoc()) {
                $present_days = $row['present_days'];
                $percentage = ($present_days / $total_working_days) * 100;

                $sheet->setCellValue("A{$serial_no}", $serial_no - 1)
                      ->setCellValue("B{$serial_no}", $row['student_id'])
                      ->setCellValue("C{$serial_no}", $row['student_name'])
                      ->setCellValue("D{$serial_no}", $row['grade_name'])
                      ->setCellValue("E{$serial_no}", $present_days)
                      ->setCellValue("F{$serial_no}", $total_working_days)
                      ->setCellValue("G{$serial_no}", round($percentage, 2) . "%");

                $serial_no++;
            }

            // Set the appropriate headers for Excel download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="attendance_report_' . date('Y-m-d') . '.xlsx"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');  // For IE 6
            header('Pragma: public');  // For IE 5.0

            // Create writer and output the file
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;  // Ensure no further output is sent

        } else {
            echo "No data found for the selected date range and grade.";
        }
    } else {
        echo "No working days found for the selected date range.";
    }
} else {
    echo "Invalid input. Please ensure all fields are selected.";
}
?>