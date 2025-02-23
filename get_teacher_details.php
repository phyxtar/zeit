<?php
$page_no = "18";
$page_no_inside = "18_5";
include_once "include/authentication.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $_POST['id'];
    $sql = "SELECT * FROM tbl_teacher WHERE teacher_id = '$teacher_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'Teacher not found']);
    }
}
?>