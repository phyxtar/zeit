<?php
include('../config.php');
//Add grade Start With Ajax
if ($_POST["action"] == "add_amsstudent") {
    $add_student_name = $_POST["add_student_name"];
    $add_roll_no = $_POST["add_roll_no"];
    $add_parent_no = $_POST["add_parent_no"];
    $add_alt_no = $_POST["add_alt_no"];
    $add_dob = $_POST["add_dob"];
    $add_grade = $_POST["add_grade"];
            $sql = "INSERT INTO `tbl_students`
                    (`student_name`,`student_roll_number`,`parent_mob_no_1`,`parent_mob_no_2`,`student_dob`,`student_grade_id`) 
                    VALUES 
                    ('$add_student_name','$add_roll_no','$add_parent_no','$add_alt_no','$add_dob','$add_grade')";
            if ($con->query($sql))
                echo '<script>
                    alert("Success! Student Added Sucessfully.");
                    window.location.href = "../../amsstudents.php"; 
                </script>';
            else
                echo '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                    </div>';
    
}
//Add grade End With Ajax
//Add grade End With Ajax