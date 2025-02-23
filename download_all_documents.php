<?php
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
        // Define the base path to your files
        $base_path = '/var/www/html/nsucms/student/images/';
        $zip = new ZipArchive();
        $zip_name = "documents_$admission_id.zip";

        // Open or create the ZIP file
        if ($zip->open($zip_name, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            exit("Unable to create ZIP file");
        }

        // List of document fields and their folder names
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

        // Add each document to the ZIP file
        foreach ($documents as $field => $folder) {
            if (!empty($row[$field])) {
                $file_path = $base_path . $folder . '/' . $row[$field];

                // Check if the file exists
                if (file_exists($file_path)) {
                    // Add the file to the ZIP
                    $zip->addFile($file_path, $row[$field]);
                } else {
                    error_log("File not found: $file_path");
                    echo "File not found: $file_path<br>";
                }
            }
        }

        // Close the ZIP file
        $zip->close();

        // Check if the ZIP file was created and contains files
        if (filesize($zip_name) > 0) {
            // Send the ZIP file for download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zip_name . '"');
            header('Content-Length: ' . filesize($zip_name));

            // Clear output buffering to avoid download issues
            ob_clean();
            flush();

            // Read the file to start the download
            readfile($zip_name);

            // Delete the ZIP file from the server after download
            unlink($zip_name);
            exit;
        } else {
            echo "No files were added to the ZIP.";
        }
    } else {
        echo "No documents found for this admission ID.";
    }
} else {
    echo "Admission ID not provided.";
}
?>