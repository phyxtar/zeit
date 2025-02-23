
<?php
include_once "../../../framwork/main.php";
$id = $_GET['id'];
$query = "DELETE FROM teacher_allot_tbl WHERE id = $id";
$result = mysqli_query($conn, $query);
if ($result == "success") {
    echo "success";
} else {
    echo "error";
}

?>