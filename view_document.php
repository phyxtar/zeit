<?php
// view_document.php
$page_no = "11";
$page_no_inside = "11_31";
include 'include/authentication.php'; // Database connection

if (isset($_GET['admission_id'])) {
    $admission_id = $_GET['admission_id'];

    // Fetch the documents from tbl_migration_form
    $query = "SELECT doc_reg, doc_marksheet, doc_admitcard FROM tbl_migration_form WHERE admission_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $admission_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Define the folder path for the images for local
        // $image_path = 'http://localhost/nsucms-aws-latest/student/images/regslip/';
        // $image_path2 = 'http://localhost/nsucms-aws-latest/student/images/marksheet/';
        // $image_path3 = 'http://localhost/nsucms-aws-latest/student/images/admitcard/';

           // Define the folder path for the images for server
           $image_path = 'https://nsucms.in/nsucms/student/images/regslip/';
           $image_path2 = 'https://nsucms.in/nsucms/student/images/marksheet/';
           $image_path3 = 'https://nsucms.in/nsucms/student/images/admitcard/';
        
        // Add the image path to the file names
        $row['doc_reg'] = $image_path . $row['doc_reg'];
        $row['doc_marksheet'] = $image_path2 . $row['doc_marksheet'];
        $row['doc_admitcard'] = $image_path3 . $row['doc_admitcard'];

        // Send back the document data in JSON format
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No documents found for this admission ID']);
    }
}
?>