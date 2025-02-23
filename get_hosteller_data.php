<?php
include 'include/config.php';

$visible = md5("visible");

$course_id = $_POST['course_id'];
$session_id = $_POST['session_id'];
$gender = $_POST['gender'];
$status = $_POST['status'];

if ($gender == "all" && $status == "all" && $course_id == "all" && $session_id == 0) {
    $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes'  ORDER BY `tbl_admission`.`admission_id`;";
} else if ($course_id == "all" && $gender == "all" && $session_id == 0) {
    if ($status == "yes") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`hostel_leave_date`='';";
    } else {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`hostel_leave_date`!='';";
    }
} else if ($gender == "all" && $status == "all" && $session_id == 0) {
    $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "';";
} else if ($course_id == "all" && $status == "all" && $session_id == 0) {
    $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "';";
} else if ($course_id == "all" && $gender == "all" && $status == "all") {
    $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "';";
} else if ($gender == "all" && $status == "all") {
    $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`admission_session`='" . $session_id . "';";
} else if ($course_id == "all" && $status == "all") {
    $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_session`='" . $session_id . "';";
} else if ($gender == "all" && $course_id == "all") {
    if ($status == "yes") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`='';";
    } else {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
    }
} else if ($session_id == 0 && $gender == "all") {
    if ($status == "yes") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_course_name`)='" . $course_id . "' && `tbl_admission`.`hostel_leave_date`='';";
    } else {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_course_name`)='" . $course_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
    }
} else if ($session_id == 0 && $status == "all") {
    $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`admission_gender`='" . $gender . "';";
} else if ($course_id == "all" && $session_id == 0) {
    if ($status == "yes") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`hostel_leave_date`='';";
    } 
    
    else {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`hostel_leave_date`!='';";
    }
} else if ($gender == "all") {
    if ($status == "yes") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`='';";
    } else {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
    }
} else if ($status == "all") {
    $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_session`='" . $session_id . "';";
} else if ($course_id == "all") {
    if ($status == "yes") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`='';";
    } else {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
    }
} else if ($session_id == 0) {
    if ($status == "yes") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`hostel_leave_date`='';";
    } else {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && `tbl_admission`.`hostel_leave_date`!='';";
    }
} else {
    if ($status == "yes") {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`hostel_leave_date`='';";
    } else {
        $query = "SELECT `tbl_admission`.`hostel_leave_date`, `tbl_admission`.`hostel_join_date`, `tbl_admission`.`admission_father_name`, `tbl_admission`.`admission_first_name`, `tbl_admission`.`admission_middle_name`, `tbl_admission`.`admission_last_name`, `tbl_admission`.`admission_id`, `tbl_course`.`course_name`, `tbl_university_details`.`academic_session`, `tbl_admission`.`admission_gender`, `tbl_admission`.`admission_hostel` FROM `tbl_admission` LEFT JOIN `tbl_university_details` ON `tbl_admission`.`admission_session`=`tbl_university_details`.`university_details_id` LEFT JOIN `tbl_course` ON `tbl_admission`.`admission_course_name`=`tbl_course`.`course_id` WHERE lower(`tbl_admission`.`admission_hostel`)='yes' && `tbl_admission`.`admission_session`='" . $session_id . "' && `tbl_admission`.`admission_course_name`='" . $course_id . "' && lower(`tbl_admission`.`admission_gender`)='" . $gender . "' && `tbl_admission`.`hostel_leave_date`!='';";
    }
}

$result = $con->query($query);

// print_r($query);
// die();

if ($result->num_rows > 0) {
    $s_no = 1;
    while ($row = $result->fetch_assoc()) {
?>
<tr>
    <!-- S.No. -->
    <td><?= $s_no; ?></td>

    <!-- Reg. No. -->
    <td><?= $row["admission_id"]  ?></td>

    <!-- Name -->
    <td><?= $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"] ?>
    </td>

    <!-- Father's Name -->
    <td><?= $row["admission_father_name"]  ?></td>

    <!-- Course -->
    <td><?= $row["course_name"]  ?></td>

    <!-- Session -->
    <td><?= $row["academic_session"]  ?></td>

    <!-- Gender -->
    <td><?= $row["admission_gender"]  ?></td>

    <!-- Status -->
    <td>
        <?php
                if ($row["hostel_leave_date"] == "") {
                    echo '<button class="btn btn-success">ACTIVE</button>';
                } else {
                    echo '<button class="btn btn-danger">INACTIVE</button>';
                }
                ?>
    </td>
</tr>
<?php
        $s_no++;
    }
} else
    echo '
            <div class="alert alert-warning alert-dismissible">
                <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
            </div>';
?>