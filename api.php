<!-- <?php
include_once 'include/config.php';
$visible = md5("visible");
$id = $_GET['id'];
 $sql = "SELECT `tbl_admission`.`admission_emailid_student`, `tbl_admission`.`admission_first_name`,`tbl_admission`.`admission_middle_name`,`tbl_admission`.`admission_last_name`, `tbl_university_details`.`academic_session`,`tbl_course`.`course_name` FROM `tbl_admission` join `tbl_university_details` on `tbl_admission`.`admission_session`= `tbl_university_details`.university_details_id join `tbl_course` ON `tbl_admission`.`admission_course_name`= `tbl_course`.`course_id` WHERE `tbl_admission`.`status`='$visible' && `admission_id`=$id";

$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
}
?> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prevent Inspect Mode</title>
    <script type="text/javascript">
    // Prevent Ctrl+Shift+I and Right Click
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.addEventListener('keydown', event => {
        if (event.ctrlKey && event.shiftKey && event.key === 'I') {
            event.preventDefault();
        }
    });
    </script>
</head>

<body>
    <?php
include_once 'include/config.php';

// Check if the admin_type is superadmin
if ($_SESSION['admin_type'] === 'superadmin') {
    $visible = md5("visible");
    $id = $_GET['id'];
    $sql = "SELECT `tbl_admission`.`admission_emailid_student`, `tbl_admission`.`admission_first_name`,`tbl_admission`.`admission_middle_name`,`tbl_admission`.`admission_last_name`, `tbl_university_details`.`academic_session`,`tbl_course`.`course_name` FROM `tbl_admission` join `tbl_university_details` on `tbl_admission`.`admission_session`= `tbl_university_details`.university_details_id join `tbl_course` ON `tbl_admission`.`admission_course_name`= `tbl_course`.`course_id` WHERE `tbl_admission`.`status`='$visible' && `admission_id`=$id";

    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo json_encode($row);
        }
    } else {
        echo "No data found for the given ID.";
    }
} else {
    echo "You do not have access.";
}
?>

</body>

</html>