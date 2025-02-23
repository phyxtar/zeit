<?php
include_once "../../framwork/main.php";

if (isset($_POST['date'])) {
    $result =  insertAll('hostel_join_date', $_POST);
}

if ($result == "success") {
    echo success_alert('Data Added Successfully');
} else {
    echo  danger_alert($conn->error);
}
