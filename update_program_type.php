<?php
// Include your database connection
include('include/config.php'); 

// Check if the action is to update the data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_program_type') {
    // Collect the POST data
    $id = $_POST['id'];
    $tenMark = $_POST['ten_mark'];
    $tenCert = $_POST['ten_cert'];
    $twelveMark = $_POST['twelve_mark'];
    $twelveCert = $_POST['twelve_cert'];
    $gradMark = $_POST['grad_mark'];
    $gradCert = $_POST['grad_cert'];
    $masMark = $_POST['mas_mark'];
    $masCert = $_POST['mas_cert'];
    $transferCert = $_POST['transfer_cert'];
    $migrationCert = $_POST['migration_cert'];
    $uidCard = $_POST['uid_card'];
    $f_uid_card = $_POST['f_uid_card'];
    $cast_cert = $_POST['cast_cert'];
    $res_cert = $_POST['res_cert'];

    // Prepare the update SQL statement
    $sql = "UPDATE `mandatory_documents` 
            SET `ten_mark` = ?, `ten_cert` = ?, `twelve_mark` = ?, `twelve_cert` = ?, 
                `grad_mark` = ?, `grad_cert` = ?, `mas_mark` = ?, `mas_cert` = ?, 
                `transfer_cert` = ?, `migration_cert` = ?, `uid_card` = ?, `father_uid_card` = ?, `cast_cert` = ?, `res_cert` = ?
            WHERE `id` = ?";

    // Prepare the statement
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("iiiiiiiiiiiiiii", $tenMark, $tenCert, $twelveMark, $twelveCert, 
                          $gradMark, $gradCert, $masMark, $masCert, 
                          $transferCert, $migrationCert, $uidCard, $f_uid_card, $cast_cert, $res_cert, $id);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database update failed.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }

    $con->close();
}
?>
