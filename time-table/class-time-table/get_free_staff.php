<?php
 
$page_no = "15";
$page_no_inside = "15_1";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";

$msg = '';
$select_date = $_GET['selectdate'];
echo $select_date;

//check data exist or not
$res =  fetchResult("time_table_child", "`date`='" . $select_date . "'");
if (mysqli_num_rows($res) > 0) {

       // echo "<script> window.location.href = 'add_time_table.php'</script>";

    } else {
        echo 'not found';
    }


// if (isset($_POST['submit'])) {
       
//         $data = array();
//         $data['id'] = $_POST['id'];
//         $data['section'] = $_POST['section'];
        
//         $result =  updateAll('tbl_section', $data, ' id=' . $_POST['id'] . '');
        
//         if ($result == "success") {
//                 $msg =  success_alert('Data Updated Successfully');
//                 echo "<script> window.location.href = 'view_section.php';</script>";

                
//         } else {
//                 echo $msg = danger_alert($conn->error);
//         }
//     }

?>



