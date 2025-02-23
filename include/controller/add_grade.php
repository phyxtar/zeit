<?php
//Add grade Start With Ajax
if ($_POST["action"] == "add_grade") {
    $add_grade_name = $_POST["add_grade_name"];
  

    if (!empty($add_grade_name)) {
        $sql = "SELECT * FROM `tbl_grade`
                WHERE `grade_name` = '$add_grade_name'
                ";
        $result = $con->query($sql);
        if ($result->num_rows > 0)
            echo '
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-exclamation-triangle"></i> This grade already exsits!!!
                </div>';
        else {
            $sql = "INSERT INTO `tbl_grade`
                    (`grade_name`) 
                    VALUES 
                    ('$add_grade_name')";
            if ($con->query($sql))
                echo '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> Grade added successfully!!!
                    </div>';
            else
                echo '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                    </div>';
        }
    } else
        echo '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-exclamation-triangle"></i>  Please fill out grade Name!!!
            </div>';
}
//Add grade End With Ajax