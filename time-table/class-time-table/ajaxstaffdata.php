<?php
//include_once "../include/authentication.php";
//include_once "../include/head.php";
include_once "../include/config.php";

// id
print_r($_POST);
$course_id = $_POST['class_id'];
$time = $_POST['time'];
$select_date = date("Y-m-d", strtotime($_POST['date']));

echo $sql_staff = "SELECT * FROM `tbl_staff` WHERE `desg_id` = '1' && `course_id` = '$course_id'";
$res = $con->query($sql_staff);
echo '<option value="">Select Faculty</option>';
while ($staff_row = $res->fetch_assoc()) {
    //echo "<pre>";
    // print_r($staff_row['id']);
    $staff_id = $staff_row['id'];
    //check data value exist
    $qr = "SELECT * FROM `time_table_child` WHERE `start_time` LIKE '%$time%' && `date` = '" . $select_date . "' &&  `staff_id` = '" . $staff_id . "' ";
    $result = mysqli_query($con, $qr);
    //$anything_found = mysqli_num_rows($result);
    $rowchild =  mysqli_fetch_array($result);
    if (mysqli_num_rows($result) ==0) {


        echo '<option value="' . $staff_row['id'] . '">' . $staff_row['name'] . '</option>';
        
        

    }
}
