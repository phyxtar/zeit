
<?php
include_once "../include/config.php";
$id = $_GET['id'];
$query = "DELETE FROM time_tbl_subject WHERE id = $id";
$result = mysqli_query($conn, $query);
if ($result == "success") {
    echo "success";
} else {
    echo "error";
}

?>