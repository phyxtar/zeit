<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $building_id = $_POST['building_id'];
    $admission_id = $_POST['admission_id'];

    if ($building_id) {
        $sql = "SELECT `floor_no` FROM `hostel_room` WHERE `building_id` = '$building_id' ORDER BY `floor_no` ASC";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['floor_no'] . '">' . $row['floor_no'] . '</option>';
            }
        } else {
            echo '<option value="">No Floors Available</option>';
        }
    } else {
        echo '<option value="">Select Floor</option>';
    }
}
?>
