<?php
$page_no = "11";
$page_no_inside = "11_6";
include "include/authentication.php";
include_once "include/function.php";
include_once "framwork/main.php";
$total_grade = 0;
error_reporting(0);



$sql = "SELECT * FROM `tbl_allot_semester` INNER JOIN `tbl_admission` WHERE `tbl_allot_semester`.`admission_id` = `tbl_admission`.`admission_id` && `tbl_allot_semester` .`allot_id` = '" . $_GET['id'] . "' ";
$result = $con->query($sql);
$row = $result->fetch_assoc();



// $specialization = $row['specialization'];
//  echo "<pre>";
//  print_r($row);
//  echo "</pre>";
$completeSessionStart = explode("-", $row["university_details_academic_start_date"]);
$completeSessionEnd = explode("-", $row["university_details_academic_end_date"]);
$completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];

$sql_course = "SELECT * FROM `tbl_course`
				   WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
				   ";
$result_course = $con->query($sql_course);
$row_course = $result_course->fetch_assoc();
$course_id = $row_course['course_id'];

$sql_semester = "SELECT * FROM `tbl_semester`
				   WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
				   ";
$result_semester = $con->query($sql_semester);
$row_semester = $result_semester->fetch_assoc();
$date_of_result = $row_semester['date_of_result'];

$sql_count = "SELECT COUNT(subject_name) as sub,course_id FROM `tbl_subjects` 
							              WHERE course_id= '" . $row["course_id"] . "'
										  ";
$result_count = $con->query($sql_count);
$row_count = $result_count->fetch_assoc();

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM `tbl_student` WHERE `student_id`='" . $_GET['id'] . "' AND `course_id`='" . $row["course_id"] . "' AND `semester_id`='" . $row["semester_id"] . "'";
    $result_student = $con->query($sql);
    if ($result_student->num_rows > 0) {
        $row_student = $result_student->fetch_assoc();
    } else {
        $sql = "INSERT INTO `tbl_student` (`student_id`, `course_id`, `semester_id`, `status`) VALUES (" . $_GET['id'] . "," . $row["course_id"] . "," . $row["semester_id"] . ", 'active');";
        $result_student = $con->query($sql);

        $sql = "SELECT * FROM `tbl_student` WHERE `student_id`='" . $_GET['id'] . "' AND `course_id`='" . $row["course_id"] . "' AND `semester_id`='" . $row["semester_id"] . "'";
        $result_student = $con->query($sql);
        $row_student = $result_student->fetch_assoc();
    }

    $sql = "SELECT * FROM `tbl_marksheet` WHERE `student_id`='" . $_GET['id'] . "' AND `session`='" . get_session($row["admission_session"]) . "' AND `course_id`='" . $row["course_id"] . "' AND `semester_id`='" . $row["semester_id"] . "'";
    $result_marksheet = $con->query($sql);
    if ($result_marksheet->num_rows > 0) {
        $row_marksheet = $result_marksheet->fetch_assoc();
    } else {
        $sql = "INSERT INTO `tbl_marksheet` (`student_id`, `session`, `course_id`, `semester_id`, `status`) VALUES (" . $_GET['id'] . ",'" . get_session($row["admission_session"]) . "'," . $row["course_id"] . "," . $row["semester_id"] . ", 'active');";
        $result_marksheet = $con->query($sql);

        $sql = "SELECT * FROM `tbl_marksheet` WHERE `student_id`='" . $_GET['id'] . "' AND `session`='" . get_session($row["admission_session"]) . "' AND `course_id`='" . $row["course_id"] . "' AND `semester_id`='" . $row["semester_id"] . "'";
        $result_marksheet = $con->query($sql);
        $row_marksheet = $result_marksheet->fetch_assoc();
    }

    ?>

<html>

<head>
    <style>
    .text-uppercase {
        text-transform: uppercase;
    }

    body {
        text-transform: uppercase !important;
        margin: 0;
        padding: 0;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .book {
        background-color: white;
        /* background-image: url(https://nsucms.in/nsucms/images/marksheet/nsu_print_bg.png); */
        background-size: cover;
        height: 95vh;
        padding-left: 5px;
        padding-right: 5px;
        /* padding-top: 5px; */
        padding-bottom: 5px;
        background-repeat: no-repeat;
    }

    .page {
        background-size: cover;
        background-image: url(uploads/Picture1.png);
        height: 100vh;
        width: 80%;
        margin: 0px auto;
        /* padding: 230px 100px 0px 100px; */
        padding: 60px 60px 0px 60px;
        border-radius: 5px;
    }


    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .subject {
        white-space: nowrap;
        overflow: hidden;
    }


    @page {
        size: A4;
        margin: 0;
    }

    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            page-break-after: always;
        }
    }

    .footer {
        width: 100%;
        color: black;
        text-align: center;
        margin-top: 0px;
        margin-left: 0px;
        /* page-break-after: always; */

    }

    .courseText h5 {
        font-size: 18px;
        text-align: center;
        margin-top: -9px;
        text-transform: uppercase;
        text-align: center;
    }

    .tableText {
        margin: 5px 0;
    }



    .tableText {
        margin: 5px 0;
    }

    .qr-code {
        position: relative;
    }

    .qr-code img {
        position: absolute;
        top: 0px;
        left: 50px;
    }

    .rm-left {
        border-left: none !important;
    }

    .table1 {
        font-family: tahoma;
        /* padding: 2px; */
        font-size: 12px;
        font-weight: normal;
        text-decoration: none;
        color: black;
        border: 1px solid black;
        width: 122%
    }

    .th {
        border: 0px;
    }

    .narmal {
        text-transform: uppercase;
        font-family: tahoma;
        padding: 2px;
        font-size: 12px;
        font-weight: normal;
        text-decoration: none;
        color: black;
    }

    .bgcolor_02 {
        font-weight: bold;
        font-family: tahoma;
        padding: 2px;
        font-size: 12px;
        /* font-weight: normal; */
        text-decoration: none;
        color: black;
    }
    </style>

    <link href="../student/dist/css/violet.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="book">
        <div class="page">
            <div class="subpage">
                <?php
                    $sql_check = "SELECT * FROM `tbl_barcode` WHERE `student_id` = '" . $_GET['id'] . "' ";
                    $result = $con->query($sql_check);
                    if ($result) {
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            unlink($row["barcode_image"]);

                            $sql_update = "UPDATE `tbl_barcode` SET  `total_marks` = '$grandtotal', `barcode_image` = '$file'  WHERE `student_id` = '" . $_GET['id'] . "' ";
                            $con->query($sql_update);
                        } else {
                            $sql_insert = "INSERT INTO `tbl_barcode`(`barcode_id`,`student_id`,`total_marks`,`barcode_image`,`result`)
						   VALUES('','" . $_GET['id'] . "','$grandtotal','$file','$resultVar')";
                            $query = mysqli_query($con, $sql_insert);
                        }
                    }
                    $sql = "SELECT * FROM `tbl_allot_semester` INNER JOIN `tbl_admission` WHERE `tbl_allot_semester`.`admission_id` = `tbl_admission`.`admission_id` && `tbl_allot_semester` .`allot_id` = '" . $_GET['id'] . "' ";
                    $result = $con->query($sql);
                    $row = $result->fetch_assoc();
                    ?>
                <!-- <img src="images/marksheet/nsu_print_bg.png"
                    style="height:100px; margin-left: -50px; margin-top:-125px;" />

                <img src="images/marksheet/5e68a7e326ea65e68a7e326ee1.png"
                    style="height:100px; margin-left: -75px; margin-top:-60px;" /> -->

                <?php
                    $session = get_session($row["admission_session"]); //to be updated manually, at the time of generating marksheet
                    $session_year = explode('-', $session)[0];
                    $session_year_first = $session_year[2] . $session_year[3];
                    ?>
                <div class="jhv">
                    <p>ABC ID: </p>
                    <p style="">Sl No:
                        <?= 'NSU/' . substr($session_year, -3, -1) . '/' . $row_marksheet['marksheet_id'] ?>
                    </p>
                    <style>
                    .jhv {
                        top: -30px;
                        display: flex;
                        justify-content: space-between;
                        content: '';
                        position: relative;
                    }

                    .underline {
                        border-bottom: 2px solid #000;
                        /* border-bottom: 1px solid #000; */
                        display: inline-block;
                        /* width: fit-content; */
                    }

                    .center-text {
                        text-align: center;
                    }
                    </style>
                </div>

                <!-- <img src="images/marksheet/nsu_image.png" style="height:200px; margin-left: 75px; margin-top:-55px;" /> -->
                <!-- <img src="https://nsucms.in/nsucms/images/marksheet/nsu_image.png"
                    style="height:200px; margin-left: 75px; margin-top:-55px;" /> -->
                <div class="courseText mb3 center-text" style="margin-top: 205px;">
                    <h5 style="margin-bottom: 6px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_course["course_name"] ?>
                    </h5>
                    <h5 class="underline" style="margin-bottom: 0;"><?php echo $row_semester["semester"] ?>
                        Examination
                        -
                        <?php
                            $dateString = $row_semester["add_time"];
                            $dateParts = explode(' ', $dateString);
                            $year = trim($dateParts[2], '.'); // Remove the trailing dot
                            echo $year;
                            ?>
                    </h5>
                </div>


                <div class="tableText">
                    <?php
                        //  echo "<pre>";
                        //  print_r($row);
                        //  echo "</pre>";
                        ?>
                    <p style="text-align: left; line-height: 7%;"><b>NAME
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            &nbsp;&nbsp;<?php echo $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"]; ?>&nbsp;
                        </b></p>
                    <p style="text-align: left; line-height: 50%;"><b>FATHER'S NAME
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?php echo $row["admission_father_name"] ?>
                        </b></p>
                    <p style="text-align: left; line-height: 50%;"><b>NAME OF SCHOOL
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?php echo $row_semester["name_of_school"] ?>
                        </b></p>
                    <p style="text-align: left; line-height: 50%;"><b>NAME OF COURSE
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?php echo $row_course["course_name"] ?>
                        </b></p>


                    <p style="text-align: left; line-height: 50%;"><b>UNIVERSITY REGN NO&nbsp;&nbsp;
                            :&nbsp;&nbsp;&nbsp;<?php echo $row["reg_no"] ?></b></p>
                    </b>
                    <p style="text-align: left; line-height: 50%;"><b>UNIVERSITY ROLL NO&nbsp;&nbsp;&nbsp;
                            :&nbsp;&nbsp;&nbsp;<?php echo $row["roll_no"] ?>
                        </b></p>

                    <p style="text-align: left; line-height: 50%;"><b>EXAMINATION TYPE
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $row["type"] ?></p>
                    </b>
                    <p style="text-align: left; line-height: 50%;"><b>EXAMINATION HELD IN THE
                            MONTH
                            OF <?php echo $row_semester["examination_month"] ?></b><b style="margin-left: 85px;">SESSION
                            :
                            <?= get_session($row["academic_year"]) ?></b></p>
                </div>



            </div>
            <style>
            th {
                font-size: 10px;
                padding: 0px 10px 0px 10px;
            }
            </style>
            <?php
                $percentage = ($grandtotal / $total_fullmarks) * 100;
                $sgpa = $total_grade / $totalcredit;
                $tempDate = new DateTime($date_of_result);
                ?>
            <table align="center" style="margin-left:-21px; border-top:0px" class="table" width="107%" border="0"
                cellspacing="0" cellpadding="0">
                <tr height="25" class="bgcolor_02" colspan="3" class="">
                    <!-- <th rowspan='2'>SL NO</th> -->
                    <th rowspan='2' style="border-bottom:1px solid black;border-right: 1px solid black;">COURSE CODE
                    </th>
                    <th rowspan='2' style="border-bottom:1px solid black;border-right: 1px solid black;">SUBJECT
                        NAME
                    </th>
                    <th rowspan="2" style="border-bottom:1px solid black;border-right: 1px solid black; width='1%';">
                        CREDIT</th>
                    <th rowspan='2' style="border-bottom:1px solid black;border-right: 1px solid black;width='1%';">
                        FULL MARKS
                    </th>
                    <th colspan="4" style="border-bottom:1px solid black;border-right: 1px solid black;">MARKS
                        SECURED
                    </th>
                    <th rowspan="2" style="border-bottom:1px solid black;width='1%';"><br>GRADE POINTS</th>
                    <th rowspan="2" style="border-bottom:1px solid black;border-right: 1px solid black;width='1%';">
                        GRADE</th>
                    <th rowspan="2"
                        style="width='1%';border-bottom:1px solid black;border-right: 1px solid black;width: 50px">
                        CREDIT * GRADE POINT</th>
                </tr>
                <tr height="25" class="bgcolor_02" colspan="4" class="">
                    <th style="border-bottom:1px solid black;border-right: 1px solid black;width='1%';">INT.</th>
                    <th style="border-bottom:1px solid black;border-right: 1px solid black;width='1%';">EXT.</th>
                    <th style="border-bottom:1px solid black;border-right: 1px solid black;width='1%';">PRAC.</th>
                    <th style="border-bottom:1px solid black;border-right: 1px solid black;width='1%';">MARKS OBTD
                    </th>
                </tr>

                <?php
                    $sql_get = "SELECT * FROM `tbl_subjects` WHERE 
							course_id = '" . $row["course_id"] . "' AND 
							 semester_id = '" . $row["semester_id"] . "' AND 
							fee_academic_year = '" . $row["academic_year"] . "'
							 ORDER BY `subject_id` ASC";
                    $row_get = $con->query($sql_get);


                    $passmarks_total = 0;
                    $grandtotal = 0;
                    $totalcredit = 0;
                    $totalcredit2 = 0;
                    $fullmarks = 0;
                    $total_fullmarks = 0;
                    $creditgrade = 0;
                    $cnt = 1;
                    $failedSubCount = 0;


                    while ($rows = $row_get->fetch_assoc()) {
                        $passmarks_total = $passmarks_total + $rows["pass_marks"];

                        $sql_check = "SELECT * FROM `tbl_marks` WHERE
							`subject_id` = '" . $rows['subject_id'] . "' && 
							`reg_no` = '" . $row['reg_no'] . "' && 
							`fee_academic_year` = '" . $row['admission_session'] . "' && 
							`semester_id` = '" . $row['semester_id'] . "' && 
							`course_id` = '" . $row['admission_course_name'] . "' 
							 ";

                        $marsk_result = mysqli_query($con, $sql_check);
                        $marks_row = mysqli_fetch_assoc($marsk_result);

                        $totalmarks = $marks_row["internal_marks"] + $marks_row["external_marks"] + $marks_row["practical_marks"];
                        $intpass_marks = $marks_row["internal_marks"];
                        $extpass_marks = $marks_row["external_marks"];
                        $practical_marks = $marks_row["practical_marks"];
                        $credit = $rows["credit"];
                        $credit2 = $credit;
                        $fullmarks = $rows['full_marks'];
                        ?>

                <tr>
                    <!-- <td align="center" class="narmal"><?php //echo $cnt++ 
                                    ?></td> -->
                    <td align="left" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">
                        <?php echo $rows["subject_code"] ?>
                    </td>
                    <td align="left" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">
                        <?php echo $rows["subject_name"] ?>
                    </td>
                    <!-- <td align="center" class="narmal"><?php //echo $rows["subject_type"] 
                                    ?></td> -->
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">
                        <?php echo $rows["credit"] ?>
                    </td>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">
                        <?php echo $rows["full_marks"]; ?>
                    </td>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">
                        <?php echo $marks_row["internal_marks"] ?>
                    </td>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">
                        <?php echo $marks_row["external_marks"] ?>
                    </td>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">
                        <?php echo $marks_row["practical_marks"] ?>
                    </td>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">
                        <?php echo $totalmarks; ?>
                    </td>
                    <!-- ------------------------------Grade Point---------------------------- -->

                    <?php if ($fullmarks == 100) { ?>


                    <?php if (($totalmarks >= 90 && $totalmarks <= 100)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 80 && $totalmarks <= 89.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 70 && $totalmarks <= 79.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 69.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 50 && $totalmarks <= 59.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 49.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks < 40)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>


                    <?php if (($totalmarks >= 90 && $totalmarks <= 100)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <!-- ---------------------Grade---------------------------- -->
                    <?php } else if (($totalmarks >= 80 && $totalmarks <= 89.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 70 && $totalmarks <= 79.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 69.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 50 && $totalmarks <= 59.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 49.99)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks < 40)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>

                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>

                    <?php } else if ($fullmarks == 60) { ?>

                    <?php if (($totalmarks >= 54 && $totalmarks <= 60)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 48 && $totalmarks <= 53)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 42 && $totalmarks <= 47)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 36 && $totalmarks <= 41)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 35)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 24 && $totalmarks <= 29)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks <= 23)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>

                    <?php } ?>
                    <?php if (($totalmarks >= 54 && $totalmarks <= 60)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 48 && $totalmarks <= 53)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 42 && $totalmarks <= 47)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 36 && $totalmarks <= 41)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 35)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 24 && $totalmarks <= 29)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks <= 23)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>


                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>
                    <?php } else if ($fullmarks == 50) { ?>

                    <?php if (($totalmarks >= 45 && $totalmarks <= 50)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 44)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 35 && $totalmarks <= 39)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 34)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 25 && $totalmarks <= 29)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 20 && $totalmarks <= 24)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks <= 20)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>

                    <?php } ?>
                    <?php if (($totalmarks >= 45 && $totalmarks <= 50)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 44)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 35 && $totalmarks <= 39)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 34)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 25 && $totalmarks <= 29)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 20 && $totalmarks <= 24)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks <= 20)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>


                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>
                    <?php } else if ($fullmarks == 150) { ?>

                    <?php if (($totalmarks >= 130 && $totalmarks <= 150)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 115 && $totalmarks <= 129)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 90 && $totalmarks <= 114)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 80 && $totalmarks <= 89)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 70 && $totalmarks <= 79)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 69)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>

                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>
                    <?php if (($totalmarks >= 130 && $totalmarks <= 150)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 115 && $totalmarks <= 129)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 90 && $totalmarks <= 114)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 80 && $totalmarks <= 89)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 70 && $totalmarks <= 79)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 69)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>


                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>
                    <?php } else if ($fullmarks == 250) { ?>

                    <?php if (($totalmarks >= 225 && $totalmarks <= 250)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 200 && $totalmarks <= 225)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 175 && $totalmarks <= 200)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 150 && $totalmarks <= 175)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 125 && $totalmarks <= 150)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 100 && $totalmarks <= 125)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks == 100)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>
                    <?php if (($totalmarks >= 225 && $totalmarks <= 250)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 200 && $totalmarks <= 225)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 175 && $totalmarks <= 200)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 150 && $totalmarks <= 175)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 125 && $totalmarks <= 150)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 100 && $totalmarks <= 125)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks == 100)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>

                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>
                    <?php }
                                //------------------------------------------------------Marks----------------------------------------------------------
                                else if ($fullmarks == 80) { ?>

                    <?php if (($totalmarks >= 72 && $totalmarks <= 80)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 64 && $totalmarks <= 72)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 56 && $totalmarks <= 64)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 48 && $totalmarks <= 56)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 48)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 32 && $totalmarks <= 40)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks == 32)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>
                    <?php if (($totalmarks >= 72 && $totalmarks <= 80)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 64 && $totalmarks <= 72)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 56 && $totalmarks <= 64)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 48 && $totalmarks <= 56)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 48)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 32 && $totalmarks <= 40)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks == 32)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>

                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>
                    <?php } else if ($fullmarks == 20) { ?>

                    <?php if (($totalmarks >= 18 && $totalmarks <= 20)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 16 && $totalmarks <= 18)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 14 && $totalmarks <= 16)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 12 && $totalmarks <= 14)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 10 && $totalmarks <= 12)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 8 && $totalmarks <= 10)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks == 8)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>
                    <?php if (($totalmarks >= 18 && $totalmarks <= 20)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 16 && $totalmarks <= 18)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 14 && $totalmarks <= 16)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 12 && $totalmarks <= 14)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 10 && $totalmarks <= 12)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 8 && $totalmarks <= 10)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks == 8)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>

                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>
                    <?php } else if ($fullmarks == 75) { ?>

                    <?php if (($totalmarks >= 67.5 && $totalmarks <= 75)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 67.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 52.5 && $totalmarks <= 60)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 45 && $totalmarks <= 52.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 37.5 && $totalmarks <= 45)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 37.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks == 30)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>
                    <?php if (($totalmarks >= 67.5 && $totalmarks <= 75)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 67.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 52.5 && $totalmarks <= 60)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 45 && $totalmarks <= 52.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 37.5 && $totalmarks <= 45)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 37.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks == 30)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>

                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>


                    <?php } else if ($fullmarks == 25) { ?>

                    <?php if (($totalmarks >= 22.5 && $totalmarks <= 25)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 20 && $totalmarks <= 22.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 17.5 && $totalmarks <= 20)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 15 && $totalmarks <= 17.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 12.5 && $totalmarks <= 15)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 10 && $totalmarks <= 12.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks == 10)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>
                    <?php if (($totalmarks >= 22.5 && $totalmarks <= 25)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 20 && $totalmarks <= 22.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 17.5 && $totalmarks <= 20)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 15 && $totalmarks <= 17.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 12.5 && $totalmarks <= 15)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 10 && $totalmarks <= 12.5)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks == 10)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>

                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>

                    <?php } else if ($fullmarks == 30) { ?>

                    <?php if (($totalmarks >= 27 && $totalmarks <= 30)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 24 && $totalmarks <= 27)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 21 && $totalmarks <= 24)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 18 && $totalmarks <= 21)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 15 && $totalmarks <= 18)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 12 && $totalmarks <= 15)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else if (($totalmarks == 12)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>
                    <?php if (($totalmarks >= 27 && $totalmarks <= 30)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 24 && $totalmarks <= 27)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 21 && $totalmarks <= 24)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 18 && $totalmarks <= 21)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 15 && $totalmarks <= 18)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 12 && $totalmarks <= 15)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else if (($totalmarks == 12)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>

                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>
                    <?php } else if ($fullmarks == 70) { ?>

                    <?php if (($totalmarks >= 63 && $totalmarks <= 70)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                    <?php } else if (($totalmarks >= 56 && $totalmarks <= 62)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                    <?php } else if (($totalmarks >= 49 && $totalmarks <= 55)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                    <?php } else if (($totalmarks >= 42 && $totalmarks <= 48)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                    <?php } else if (($totalmarks >= 35 && $totalmarks <= 41)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                    <?php } else if (($totalmarks >= 28 && $totalmarks <= 34)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                    <?php } ?>
                    <?php if (($totalmarks >= 63 && $totalmarks <= 70)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                    <?php } else if (($totalmarks >= 56 && $totalmarks <= 62)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                    <?php } else if (($totalmarks >= 49 && $totalmarks <= 55)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                    <?php } else if (($totalmarks >= 42 && $totalmarks <= 48)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                    <?php } else if (($totalmarks >= 35 && $totalmarks <= 41)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                    <?php } else if (($totalmarks >= 28 && $totalmarks <= 34)) { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">P</td>
                    <?php } else { ?>
                    <td align="center" class="narmal"
                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>
                    <?php }
                                //$cr_gr =   $rows["credit"] * $gradePoint;
                                ?>
                    <?php } ?>
                    <!-- ------------------------credit * grade point---------------------- -->
                    <?php if ($fullmarks == 100) { ?>
                    <?php if (($totalmarks >= 90 && $totalmarks <= 100)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 80 && $totalmarks <= 89.99)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 70 && $totalmarks <= 79.99)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 69.99)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 50 && $totalmarks <= 59.99)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 49.99)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks > 40)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 4);
                                        $total_grade = $total_grade + ($rows["credit"] * 4);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php } else if ($fullmarks == 60) { ?>

                    <?php if (($totalmarks >= 54 && $totalmarks <= 60)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 48 && $totalmarks <= 53)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 42 && $totalmarks <= 47)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 36 && $totalmarks <= 41)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 35)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 24 && $totalmarks <= 29)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks < 24)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 0);
                                        $total_grade = $total_grade + ($rows["credit"] * 0);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php } else if ($fullmarks == 50) { ?>

                    <?php if (($totalmarks >= 45 && $totalmarks <= 50)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 44)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 35 && $totalmarks <= 39)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 34)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 25 && $totalmarks <= 29)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 20 && $totalmarks <= 24)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks < 20)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 0);
                                        $total_grade = $total_grade + ($rows["credit"] * 0);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php } else if ($fullmarks == 150) { ?>

                    <?php if (($totalmarks >= 130)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 115 && $totalmarks <= 129)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 90 && $totalmarks <= 114)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 80 && $totalmarks <= 89)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 70 && $totalmarks <= 79)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 69)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>

                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php }
                            if ($fullmarks == 250) { ?>

                    <?php if (($totalmarks >= 225)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 200 && $totalmarks <= 225)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 175 && $totalmarks <= 200)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 150 && $totalmarks <= 175)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 125 && $totalmarks <= 150)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 100 && $totalmarks <= 125)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks == 100)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 4);
                                        $total_grade = $total_grade + ($rows["credit"] * 4);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php }
                            //---------------------------------------------------Credits----------------------------------------------------
                            if ($fullmarks == 80) { ?>

                    <?php if (($totalmarks >= 72)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 64 && $totalmarks <= 72)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 56 && $totalmarks <= 64)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 48 && $totalmarks <= 56)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 40 && $totalmarks <= 48)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 32 && $totalmarks <= 40)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks == 32)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 4);
                                        $total_grade = $total_grade + ($rows["credit"] * 4);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php }
                            if ($fullmarks == 20) { ?>

                    <?php if (($totalmarks >= 18)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 16 && $totalmarks <= 18)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 14 && $totalmarks <= 16)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 12 && $totalmarks <= 14)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 10 && $totalmarks <= 12)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 8 && $totalmarks <= 10)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks == 8)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 4);
                                        $total_grade = $total_grade + ($rows["credit"] * 4);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php }
                            if ($fullmarks == 75) { ?>

                    <?php if (($totalmarks >= 67.5)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 67.5)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 52.5 && $totalmarks <= 60)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 45 && $totalmarks <= 52.5)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 37.5 && $totalmarks <= 45)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 30 && $totalmarks <= 37.5)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks == 30)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 4);
                                        $total_grade = $total_grade + ($rows["credit"] * 4);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>

                    <?php }
                            if ($fullmarks == 25) { ?>

                    <?php if (($totalmarks >= 22.5)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 20 && $totalmarks <= 22.5)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 17.5 && $totalmarks <= 20)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 15 && $totalmarks <= 17.5)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 12.5 && $totalmarks <= 15)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 10 && $totalmarks <= 12.5)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks == 10)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 4);
                                        $total_grade = $total_grade + ($rows["credit"] * 4);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>

                    <?php }
                            if ($fullmarks == 30) { ?>

                    <?php if (($totalmarks <= 30)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 24 && $totalmarks <= 27)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 21 && $totalmarks <= 24)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 18 && $totalmarks <= 21)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 15 && $totalmarks <= 18)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 12 && $totalmarks <= 15)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks == 12)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 4);
                                        $total_grade = $total_grade + ($rows["credit"] * 4);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php }
                            if ($fullmarks == 70) { ?>

                    <?php if (($totalmarks >= 63 && $totalmarks <= 70)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 10);
                                        $total_grade = $total_grade + ($rows["credit"] * 10);

                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 56 && $totalmarks <= 62)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 9);
                                        $total_grade = $total_grade + ($rows["credit"] * 9);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 49 && $totalmarks <= 55)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 8);
                                        $total_grade = $total_grade + ($rows["credit"] * 8);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 42 && $totalmarks <= 48)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 7);
                                        $total_grade = $total_grade + ($rows["credit"] * 7);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 35 && $totalmarks <= 41)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 6);
                                        $total_grade = $total_grade + ($rows["credit"] * 6);
                                        ?>
                    </td>
                    <?php } else if (($totalmarks >= 28 && $totalmarks <= 34)) { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                        <?php echo ($rows["credit"] * 5);
                                        $total_grade = $total_grade + ($rows["credit"] * 5);
                                        ?>
                    </td>
                    <?php } else { ?>
                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                    <?php } ?>
                    <?php } ?>
                    <?php $sum_total = $marks_row["internal_marks"] + $marks_row["external_marks"] + $marks_row["practical_marks"];
                            $grandtotal = $grandtotal + $marks_row['internal_marks'] + $marks_row["external_marks"] + $marks_row["practical_marks"];
                            $totalcredit = $totalcredit + $credit;
                            $totalcredit2 = $totalcredit2 + $credit2;
                            $total_fullmarks = $total_fullmarks + $rows['full_marks'];

                            $sub_percentage = $totalmarks / $fullmarks * 100;
                            if ($course_id == 28) {
                                if ($totalmarks < 20) {
                                    $failedSubCount++;
                                }
                            } else if ($sub_percentage < 40) {
                                $failedSubCount++;
                            }
                            ?>
                </tr>
                <?php } ?>
                <?php
                    $percentage = ($grandtotal / $total_fullmarks) * 100;
                    $sgpa = $total_grade / $totalcredit2;
                    $tempDate = new DateTime($date_of_result);
                    ?>
                <tr class="tableLastChild">
                    <td colspan="2" class="bgcolor_02" class=""
                        style="text-align:center;  height:25px;border-right:1px solid black;">TOTAL SUBJECT
                        CREDIT
                    </td>
                    <td colspan="1" style="text-align:center; border-right:1px solid black;" class="bgcolor_02">
                        <?php echo $totalcredit2; ?>
                    </td>

                    <td colspan="4" class="bgcolor_02" class=""
                        style="text-align:center;  height:25px;border-right:1px solid black;">TOTAL MARKS OBTD.
                    </td>
                    <td colspan="1" style="text-align:center; border-right:1px solid black;" class="bgcolor_02">
                        <?php echo $grandtotal; ?>
                    </td>
                    <td colspan="2" class="bgcolor_02" class=""
                        style="text-align:center;  height:25px;border-right:1px solid black;">SGPA</td>
                    <td colspan="2" style="text-align:center; border-right:1px solid black;" class="bgcolor_02">
                        <?php echo round($sgpa, 2) ?>
                    </td>
                </tr>
                <tr class="tableLastChild">
                    <td colspan="4" class="bgcolor_02" class=""
                        style="font-size: 10px;text-align:center;height:25px;border-right:1px solid black;font-weight: 500;">
                        DATE OF PUBLICATION OF
                        RESULT: <?php echo $tempDate->format('d-m-Y') ?></td>
                    <td colspan="3" class="bgcolor_02" class=""
                        style="text-align:center;  height:25px;border-right:1px solid black;">PERCENTAGE</td>
                    <td colspan="1" style="text-align:center; border-right:1px solid black;" class="bgcolor_02">
                        <?php echo round($percentage, 2) ?>
                    </td>
                    <td colspan="2" class="bgcolor_02" class=""
                        style="text-align:center;  height:25px;border-right:1px solid black;">RESULT</td>
                    <td colspan="2" style="text-align:center; border-right:1px solid black;" class="bgcolor_02">
                        <?php
                            if ($failedSubCount == 0) {
                                echo "PASS";
                            } else if ($failedSubCount <= 3) {
                                echo "PROMOTED";
                            } else {
                                echo "FAIL";
                            } ?>
                    </td>
                </tr>
            </table>
            <p style="">

                <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    if ($grandtotal >= $passmarks_total) {
                        $resultVar = "PASS";
                    } else {
                        $resultVar = "FAIL";
                    }

                    $data = array(
                        "University" => "www.nsuniv.ac.in",
                        "Student Name" => $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"],
                        "Father's Name" => $row["admission_father_name"],
                        "REGN.NO" => $row["reg_no"],
                        "ROLL NO" => $row["roll_no"],
                        "Course" => $row_course["course_name"],
                        "Result" => $resultVar
                    );

                    // Include the qrlib file 
                    include_once 'include/qr-lib/qrlib.php';

                    // Define the path
                    $path = 'images/';

                    // Check if directory exists, if not create it
                    if (!is_dir($path)) {
                        if (!mkdir($path, 0755, true)) {
                            die('Failed to create directories...');
                        }
                    }

                    // Check if directory is writable
                    if (!is_writable($path)) {
                        die('Directory is not writable.');
                    }

                    // Generate unique filename
                    $file = $path . uniqid() . uniqid() . ".png";
                    $ecc = 'H';
                    $pixel_Size = 10;
                    $frame_Size = 1;

                    // Generates QR Code and Stores it in directory given 
                    QRcode::png(json_encode($data), $file, $ecc, $pixel_Size, $frame_Size);

                    // Check if file is created
                    if (!file_exists($file)) {
                        die('QR code file not created.');
                    }

                    // Display the stored QR code from directory 
                    echo "<img height='100px' style='border: 1px solid;margin-left: -10px;margin-bottom: -60px;filter: invert(0);' src='" . $file . "'>";
                    ?>

            </p>
        </div>

        <!-- <div class="sign d-flex"
                style="text-transform: capitalize; margin-top:100px; display: flex;justify-content: space-between;">
                <div>

                    <h5>Tabulator - 1 </h5>
                </div>
                <div>

                    <h5>Controller of examination</h5>
                </div>

            </div> -->
        <script>
        window.print();
        </script>


        <?php } ?>
</body>

</html>