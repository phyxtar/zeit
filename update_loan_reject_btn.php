<?php
include "include/config.php";
if (isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    $check_sql = "SELECT why_rejected FROM tbl_loan WHERE id = '$teacher_id'";
    $check_result = mysqli_query($con, $check_sql);
    
    if ($check_result) {
        $row = mysqli_fetch_assoc($check_result);
        $why_rejected = $row['why_rejected'];

        if (!empty($why_rejected)) {
            $reject = "Rejected";
            $update_sql = "UPDATE tbl_loan SET reject = '$reject' WHERE id = '$teacher_id'";
            $result = mysqli_query($con, $update_sql);

            if ($result) {
                echo 'yes';
            } else {
                echo 'no';
            }
        } else {
            echo 'why_rejected is empty';
        }
    } else {
        echo 'Error fetching data';
    }
}
?>
