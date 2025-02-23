<?php
$page_no = "11";
$page_no_inside = "11_31";
include 'include/authentication.php'; // Ensure connection is included

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admission_id = $_POST['admission_id'];
    $registration_no = $_POST['registration_no'];

    if (empty($admission_id) || empty($registration_no)) {
        echo json_encode(['error' => 'Missing required fields']);
        exit();
    }

    $sql = "UPDATE tbl_migration_form SET registration_no = ? WHERE admission_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['error' => 'SQL preparation failed: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param("si", $registration_no, $admission_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Database update failed: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>