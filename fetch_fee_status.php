<?php
include 'include/authentication.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admission_id'])) {
    $admission_id = $_POST['admission_id'];

    $query = "SELECT reg_status FROM tbl_fee_status WHERE admission_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $admission_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            echo "<p>Registration Status: " . htmlspecialchars($row['reg_status']) . "</p>";
        } else {
            echo "<p>No registration status found for this admission ID.</p>";
        }
    } else {
        echo "Query error: " . $conn->error;
    }
}
?>
