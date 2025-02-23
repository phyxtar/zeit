<?php

include_once "../include/config.php";

$return = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($con, $_POST["query"]);
     $query = "SELECT * FROM tbl_course
	WHERE course_name  LIKE '%" . $search . "%'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {

        while ($row1 = mysqli_fetch_array($result)) {
            $return .= '<option value="' . $row1['course_id'] . '">' . $row1['course_name'] . '</option>';

        }
        echo $return;

    } else {
        echo 'No results containing all your search terms were found.';

    }
}else{
    echo 'No results containing all your search terms were found.';

}


