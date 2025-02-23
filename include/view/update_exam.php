<?php
include_once("../config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id']; 
    $exam_name = $_POST['exam_name'];
    $exam_amount = $_POST['exam_amount'];
    $exam_t_id = $_POST['exam_t_id'];
    $exam_easebuzz_id = $_POST['exam_easebuzz_id'];

    if (empty($exam_name) || empty($exam_amount) || empty($exam_t_id) || empty($exam_easebuzz_id)) {
        echo "All fields are required!";
        exit;
    }

    $exam_name = mysqli_real_escape_string($con, $exam_name);
    $exam_amount = mysqli_real_escape_string($con, $exam_amount);
    $exam_t_id = mysqli_real_escape_string($con, $exam_t_id);
    $exam_easebuzz_id = mysqli_real_escape_string($con, $exam_easebuzz_id);

    $query = "UPDATE tbl_examination_form SET candidate_name = ?, amount = ?, transactionid = ?, easebuzzid = ? WHERE exam_id = ?";

    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $exam_name, $exam_amount, $exam_t_id, $exam_easebuzz_id, $exam_id);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../../exam_form_list.php");
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the SQL statement!";
    }
    mysqli_close($con);
}
?>
