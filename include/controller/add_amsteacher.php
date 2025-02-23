<?php
//Add grade Start With Ajax
if ($_POST["action"] == "add_amsteacher") {

    $add_amsteacher_name = $_POST["add_amsteacher_name"];
    $add_amsteacher_address = $_POST["add_amsteacher_address"];
    $add_amsteacher_email = $_POST["add_amsteacher_email"];
    $add_amsteacher_password = md5($_POST["add_amsteacher_password"]);
    $add_amsteacher_qualification = $_POST["add_amsteacher_qualification"];
    $add_amsteacher_doj = $_POST["add_amsteacher_doj"];
    
    // Convert the array of grades into a comma-separated string
    $add_amsteacher_grade = implode(',', $_POST["add_amsteacher_grade"]);

    $sql = "INSERT INTO `tbl_teacher`
            (`teacher_name`, `teacher_address`, `teacher_emailid`, `teacher_password`, `teacher_qualification`, `teacher_doj`, `teacher_grade_id`) 
            VALUES 
            ('$add_amsteacher_name', '$add_amsteacher_address', '$add_amsteacher_email', '$add_amsteacher_password', '$add_amsteacher_qualification', '$add_amsteacher_doj', '$add_amsteacher_grade')";

    if ($con->query($sql)) {
        echo '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-check"></i> AMS teacher added successfully!!!
            </div>';
    } else {
        echo '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-ban"></i> Something went wrong, please try again!!!
            </div>';
    }
}