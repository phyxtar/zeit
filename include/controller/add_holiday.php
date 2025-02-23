<?php
//Add Holiday Start With Ajax
if ($_POST["action"] == "add_holiday") {
    $name = $_POST["name"];
    $date_from = $_POST["date_from"];
    $date_to = $_POST["date_to"];

    if (!empty($name) && !empty($date_from) && !empty($date_to)) {
        $sql = "SELECT * FROM `tbl_holiday`
                WHERE `h_name` = '$name'
                ";
        $result = $con->query($sql);
        if ($result->num_rows > 0)
            echo '
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-exclamation-triangle"></i> This Holiday already exsits!!!
                </div>';
        else {
            $sql = "INSERT INTO `tbl_holiday`
                    (`h_name`,
                     `h_date_from`,
                     `h_date_to`) 
                    VALUES 
                    ('$name',
                    '$date_from',
                    '$date_to')
                    ";
            if ($con->query($sql))
                echo '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> Holiday added successfully!!!
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
                <i class="icon fas fa-exclamation-triangle"></i>  Please fill Properly!!!
            </div>';
}
//Add Holiday End With Ajax