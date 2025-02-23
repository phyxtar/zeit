<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include_once "include/config.php";
include_once "framwork/main.php";
include_once "include/function.php";

$course_id = $_POST['course_id'];
$academic_year = $_POST['academic_year'];

if ($course_id != 'all' && $academic_year != 'all') {
    $result = fetchResult('tbl_admission', '`status` = "' . $visible . '" && `admission_session` IN (' . $academic_year . ') && `admission_course_name` = "' . $course_id . '" ORDER BY `admission_id` DESC');
} else {
    $result = fetchResult('tbl_admission', '`status` = "' . $visible . '"');
}

// Generate HTML for the PDF
$html = '<h3>Student List</h3>';
$html .= '<table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Reg. No</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Hostel</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Contact No.</th>
                    <th>DOB</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    // Path to the student image
    $image_path = 'images/student_images/' . $row["admission_profile_image"];
    $image_full_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $image_path;

    // Check if the image exists
    if (file_exists($image_full_path)) {
        $image_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $image_path;
    } else {
        $image_url = 'http://' . $_SERVER['HTTP_HOST'] . '/images/default.png'; // Default image path
    }

    $html .= '<tr>
                <td><img src="' . $image_url . '" width="50" height="50" alt="Student Image"></td>
                <td>' . $row["admission_id"] . '</td>
                <td>' . $row["admission_first_name"] . ' ' . $row["admission_last_name"] . '</td>
                <td>' . $row["admission_course_name"] . '</td>
                <td>' . $row["admission_hostel"] . '</td>
                <td>' . $row["admission_father_name"] . '</td>
                <td>' . $row["admission_mother_name"] . '</td>
                <td>' . $row["admission_mobile_student"] . '</td>
                <td>' . date("d-m-Y", strtotime($row["admission_dob"])) . '</td>
                <td>' . $row["admission_gender"] . '</td>
            </tr>';
}

$html .= '</tbody></table>';

// Configure Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Enable remote resources (for images)
$dompdf = new Dompdf($options);

// Load HTML content
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the PDF
$dompdf->render();

// Output the generated PDF
$dompdf->stream("student_list.pdf", ["Attachment" => true]);
exit();