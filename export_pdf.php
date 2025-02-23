<?php
require 'vendor/autoload.php'; // Adjust the path if necessary
// require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include_once "include/config.php";
include_once "framwork/main.php";
include_once "include/function.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "export_student_pdf") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    
    // Fetch student data based on the given course_id and academic_year
    $condition = '';
    
    if ($course_id != 'all') {
        $condition .= ' AND admission_course_name = "' . $course_id . '"';
    }
    
    if ($academic_year != 'all') {
        $condition .= ' AND admission_session IN (' . $academic_year . ')';
    }
    
    $query = "SELECT * FROM tbl_admission WHERE status = '$visible' $condition";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Query Failed: ' . mysqli_error($con));
    }

    // Create a new PDF document
    $options = new Options();
    $options->set('defaultFont', 'Courier');
    $options->set('isRemoteEnabled', true); // Enable remote file access
    $dompdf = new Dompdf($options);

    // Prepare HTML content for the PDF
    $html = '<h1>Student List</h1>';
    $html .= '<table border="1" width="100%" style="border-collapse: collapse;">';
    $html .= '<thead>
                <tr>
                    <th>Reg. No</th>
                    <th>Student Name</th>
                    <th>Profile Image</th>
                    <th>Course</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Contact No.</th>
                    <th>DOB</th>
                    <th>Gender</th>
                </tr>
              </thead>
              <tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        // Construct the full path for the profile image
        $profileImage = !empty($row["admission_profile_image"]) 
            ? 'https://nsucms.in/nsucms/images/student_images/' . $row["admission_profile_image"] 
            : 'https://nsucms.in/nsucms/uploads/default_image.png'; // Default image if none provided
            

        $html .= '<tr>
                    <td>' . $row["admission_id"] . '</td>
                    <td>' . $row["admission_first_name"] . ' ' . $row["admission_middle_name"] . ' ' . $row["admission_last_name"] . '</td>
                    <td><img src="' . $profileImage . '" style="width: 50px; height: auto;"/></td>
                    <td>' . $row["admission_course_name"] . '</td>
                    <td>' . $row["admission_father_name"] . '</td>
                    <td>' . $row["admission_mother_name"] . '</td>
                    <td>' . $row["admission_mobile_student"] . '</td>
                    <td>' . date("d-m-Y", strtotime($row["admission_dob"])) . '</td>
                    <td>' . $row["admission_gender"] . '</td>
                </tr>';
    }

    $html .= '</tbody></table>';

    // Load HTML content into Dompdf
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Set paper size and orientation
    $dompdf->render(); // Render the PDF

    // Output the generated PDF to the browser
    $dompdf->stream('student_list.pdf', array("Attachment" => 0)); // Set to 1 to force download
}
?>