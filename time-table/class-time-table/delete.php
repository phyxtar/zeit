
<?php
$page_no = "15";
$page_no_inside = "15_1";
include_once "../include/authentication.php";
include_once "../include/config.php";

$id = $_GET['id'];
//echo $id; exit;

$query = "DELETE FROM time_table_master WHERE id = $id";
$result = mysqli_query($conn, $query);
    
if ($result == "success") {
        $msg =  success_alert('Data Deleted Successfully');
        reload(1);
} else {
        //echo $msg = danger_alert($conn->error);
        $msg =  danger_alert('Oops!!!Something Went Wrong.');
}






    ?>        