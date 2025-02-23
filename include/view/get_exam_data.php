<?php
include('../config.php');

if (isset($_GET['exam_id'])) {
    $examId = $_GET['exam_id'];
    $examId = intval($examId); 
    
    $query = "SELECT * FROM tbl_examination_form WHERE exam_id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('i', $examId); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $examData = $result->fetch_assoc();
            echo json_encode(['success' => true, 'examData' => $examData]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No exam found with this ID.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare database query.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Exam ID is missing.']);
}
?>
