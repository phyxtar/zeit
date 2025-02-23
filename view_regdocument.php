<?php
// view_document.php
$page_no = "11";
$page_no_inside = "11_31";
include 'include/authentication.php'; // Database connection

if (isset($_GET['admission_id'])) {
    $admission_id = $_GET['admission_id'];

    // Fetch the documents from tbl_registration_form
    $query = "SELECT * FROM tbl_registration_form WHERE admission_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $admission_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Base image path for all documents
        $base_url = 'https://nsucms.in/nsucms/student/images/';
        $documents = [
            '10th_marksheet' => '10th_marksheet',
            '10th_certificate' => '10th_certificate',
            '12th_marksheet' => '12th_marksheet',
            '12th_certificate' => '12th_certificate',
            'bachelor_marksheet' => 'bachelor_marksheet',
            'bachelor_certificate' => 'bachelor_certificate',
            'master_marksheet' => 'master_marksheet',
            'master_certificate' => 'master_certificate',
            'transfer_certificate' => 'transfer_certificate',
            'migration_certificate' => 'migration_certificate',
            'adhar_card' => 'adhar_card',
            'fadhar_card' => 'fadhar_card',
            'caste_certificate' => 'caste_certificate',
            'residential_certificate' => 'residential_certificate'
        ];

        // Loop through each document type and check if it exists
        foreach ($documents as $key => $folder) {
            if (!empty($row[$key])) {
                $row[$key] = $base_url . $folder . '/' . $row[$key];
            } else {
                $row[$key] = "Document not uploaded";  // Set 'Document not uploaded' if empty
            }
        }

        // Send back the document data in JSON format
        echo json_encode($row);
    } else {
        // No records found for the given admission_id
        echo json_encode(['error' => 'No documents found for this admission ID']);
    }
} else {
    // admission_id not provided in the request
    echo json_encode(['error' => 'Admission ID not provided']);
}
?>