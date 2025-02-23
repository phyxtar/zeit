 
<?php
include __DIR__ . "../../../framwork/main.php";

$id = $_GET['id'];
//echo $id; exit;

$query = "DELETE FROM tbl_bed WHERE id = $id";
$result = mysqli_query($conn, $query);
    
if ($result == "success") {
        $msg =  success_alert('Data Deleted Successfully');
        reload(1);
} else {
        //echo $msg = danger_alert($conn->error);
        $msg =  danger_alert('Oops!!!Something Went Wrong.');
}


?>  