<?php
$page_no = "11";
$page_no_inside = "11_6";
include "include/authentication.php";
include_once "include/function.php";
include_once "framwork/main.php";
$total_grade = 0;
$path = 'images2/';
error_reporting(0);



$sql = "SELECT * FROM `tbl_allot_semester` INNER JOIN `tbl_admission` WHERE `tbl_allot_semester`.`admission_id` = `tbl_admission`.`admission_id` && `tbl_allot_semester` .`allot_id` = '" . $_GET['id'] . "' ";
$result = $con->query($sql);
$row = $result->fetch_assoc();



// $specialization = $row['specialization'];
// echo "<pre>";
// print_r($row);

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

    ?>
    <html>

    <head>
        <!-- <link rel="stylesheet" href="../srinath/dist/fonts/"> -->

        <style>
            .text-uppercase {
                text-transform: uppercase;
            }

            body {
                margin: 0;
                padding: 0;
                font: 12pt "Tahoma";
            }

            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            .book {
                background-image: url(images/marksheet/nsu_print_bg.png);
                background-size: cover;
                height: 95vh;
                padding-left: 10px;
                background-repeat: no-repeat;
            }

            .page {
                height: 70vh;
                width: 80%;
                margin: 0px auto;
                padding: 230px 100px 0px 100px;
                border: 1px #D3D3D3 solid;
                border-radius: 5px;
            }


            /* .page {
                                                height: 95vh;
                                                width: 80%;
                                                margin: 0 auto;
                                                padding: 145px 100px 0px 75px;
                                                border: 1px #D3D3D3 solid;
                                                border-radius: 5px;
                
                                            } */



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
                width: 88%;
                color: black;
                text-align: center;
                margin-top: -136px;
                margin-left: 111px;
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

            .table {
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
            <?php
            $session = get_session($row["admission_session"]);
            // echo $session; //to be updated manually, at the time of generating marksheet
            $session_year = explode('-', $session)[0];
            $session_year_first = $session_year[2] . $session_year[3];
            // echo $session_year;
            ?>
            <!-- <p style="text-align: right; padding-top: 30px; padding-right:25px">Serial No :
                <?= 'SU/' . substr($session_year, -3, -1) . '/' . $row_marksheet['marksheet_id'] ?>
            </p> -->
            <div class="page">
                <div class="subpage">

                    <?php
                    $passmarks_total = 0;
                    $grandtotal = 0;
                    $totalcredit = 0;
                    $totalcredit2 = 0;
                    $fullmarks = 0;
                    $total_fullmarks = 0;
                    $creditgrade = 0;
                    $cnt = 1;
                    $failedSubCount = 0;
                    ?>


                    <!-- <img src="images/marksheet/nsu_print_bg.png" style="height:100px; margin-left: -50px; margin-top:-125px;"/> -->
                    <img src="images/marksheet/5e68a7e326ea65e68a7e326ee1.png"
                        style="height:100px; margin-left: -50px; margin-top:-108px;" />
                    <img src="images/marksheet/nsu_image.png" style="height:210px; margin-left: 50px; margin-top:-108px;" />
                    <div class="courseText mb3">
                        <h5><u>CONSOLIDATED ACADEMIC TRANSCRIPT</u></h5>
                    </div>
                    <?php
                    $course_name = $row_course["course_name"];
                    $course_modified = str_replace("(Lateral Entry)", "", $course_name);
                    ?>

                    <p style="text-align: center;margin-top: -15px; line-height: 50%;"><b>
                            <?php echo $course_modified ?>
                        </b></p>

                    <!-- <p style="text-align: center; line-height: 50%;">Examination held in the month of
                        <?php echo $row_semester["examination_month"] ?>
                    </p> -->

                    <!--my code start-->
                    <div class="student-info">
                        The following are the Marks and Grade Points obtained by <b>
                            <?php echo $row["admission_first_name"] ?>

                        </b> Registration No. <b>
                            <!-- <?php echo $row["exam_reg_no"] ?> -->

                        </b> Roll No. <b>
                            <?php echo $row["roll_no"] ?>



                        </b> in the <b>
                            <?php
                            $course_name = str_replace(" ", "", $row_course["course_name"]);
                            if (trim($row_course["course_name"]) == "BBA") {
                                echo "BACHELOR OF BUSINESS ADMINISTRATION";
                            } else if (trim($course_name) == "MBA") {
                                echo "MASTER OF BUSINESS ADMINISTRATION";
                            } else if (trim($course_name) == "B.COM") {
                                echo "BACHELOR OF COMMERCE";
                            } else if (trim($course_name) == "M.COM") {
                                echo "MASTER OF COMMERCE";
                            } else if (trim($course_name) == "BCA") {
                                echo "BACHELOR OF COMPUTER APPLICATION";
                            } else if (trim($course_name) == "MCA") {
                                echo "MASTER OF COMPUTER APPLICATION";
                            } else if (trim($course_name) == "B.SC(IT)") {
                                echo "BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY";
                            } else if (trim($course_name) == "M.SC(IT)") {
                                echo "MASTER OF SCIENCE IN INFORMATION TECHNOLOGY";
                            } else if (trim($course_name) == "B.PHARM") {
                                echo "BACHELOR OF PHARMACY";
                            } else if (trim($course_name) == "D.PHARM") {
                                echo "DIPLOMA OF PHARMACY";
                            } else if (trim($course_name) == "B.ED") {
                                echo "BACHELOR OF EDUCATION";
                            } else if (trim($course_name) == "B.Sc in Hotel Management") {
                                echo "B.SC IN HOTEL MANAGEMENT";
                            } else if (trim($course_name) == "B.Sc IN Travel & Tourism Management") {
                                echo "B.Sc IN Travel & Tourism Management";
                            } else if (trim($course_name) == "LLB") {
                                echo "BACHELOR OF LEGISLATIVE LAW";
                            } else if (trim($course_name) == "BBA LLB") {
                                echo "BACHELOR OF BUSINESS ADMINISTRATION AND BACHELOR OF LAWS";
                            } else if (trim($course_name) == "B.Sc (BOTANY)") {
                                echo "BACHELOR OF SCIENCE - BOTANY";
                            } else if (trim($course_name) == "B.Sc (ZOOLOGY)") {
                                echo "BACHELOR OF SCIENCE - ZOOLOGY";
                            } else if (trim($course_name) == "B.Sc (MATHEMATICS)") {
                                echo "BACHELOR OF SCIENCE - MATHEMATICS";
                            } else if (trim($course_name) == "B.SC (PHYSICS)") {
                                echo "BACHELOR OF SCIENCE - PHYSICS";
                            } else if (trim($course_name) == "B.SC (CHEMISTRY)") {
                                echo "BACHELOR OF SCIENCE - CHEMISTRY";
                            } else if (trim($course_name) == "M.Sc (BOTANY)") {
                                echo "MASTER OF SCIENCE - BOTANY";
                            } else if (trim($course_name) == "M.Sc (ZOOLOGY)") {
                                echo "MASTER OF SCIENCE - ZOOLOGY";
                            } else if (trim($course_name) == "M.Sc (MATHEMATICS)") {
                                echo "MASTER OF SCIENCE - MATHEMATICS";
                            } else if (trim($course_name) == "M.SC (PHYSICS)") {
                                echo "MASTER OF SCIENCE - PHYSICS";
                            } else if (trim($course_name) == "M.SC (CHEMISTRY)") {
                                echo "MASTER OF SCIENCE - CHEMISTRY";
                            } else if (trim($course_name) == "B.TECH") {
                                echo "B.TECH";
                            } else if (trim($course_name) == "POLYTECHNIC") {
                                echo "POLYTECHNIC";
                            } else if (trim($course_name) == "B.A") {
                                echo "BACHELOR OF ARTS";
                            } else if (trim($course_name) == "M.A") {
                                echo "MASTER OF ARTS";
                            } else if (trim($course_name) == "Event Management") {
                                echo "Event Management";
                            } else if (trim($course_name) == "B.A IN JOURNALISM & MASS COMM.") {
                                echo "BACHELOR OF ARTS IN JOURNALISM & MASS COMMUNICATION";
                            } else if (trim($course_name) == "M.A IN JOURNALISM & MASS COMM.") {
                                echo "MASTER OF ARTS IN JOURNALISM & MASS COMMUNICATION";
                            } else if (trim($course_name) == "FASHION DESIGNING") {
                                echo "FASHION DESIGNING";
                            } else if (trim($course_name) == "INTERIOR DESIGNING") {
                                echo "INTERIOR DESIGNING";
                            } else if (trim($course_name) == "PHD") {
                                echo "PHD";
                            } else if (trim($course_name) == "B.A (Economics)") {
                                echo "BACHELOR OF ARTS - ECONOMIC (HONS.)";
                            } else if (trim($course_name) == "B.A (Geography)") {
                                echo "BACHELOR OF ARTS - GEOGRAPHY (HONS.)";
                            } else if (trim($course_name) == "B.A (Political Science)") {
                                echo "BACHELOR OF ARTS - POLITICAL SCIENCE (HONS.)";
                            } else if (trim($course_name) == "B.A (English)") {
                                echo "BACHELOR OF ARTS - ENGLISH (HONS.)";
                            } else if (trim($course_name) == "Diploma in Engineering") {
                                echo "DIPLOMA IN ENGINEERING";
                            } else {
                                echo $row_course['course_name'];
                            } ?>

                        </b> of <b>
                            <?php

                            $examination_month = $row_semester['examination_month'];
                            $last_four_digits = substr($examination_month, -4);
                            $last_four_digits_string = strval($last_four_digits);

                            ?>
                            <?= get_session($row["admission_session"]); ?>

                        </b>, Final Examination, <?php echo $last_four_digits_string; ?> held in the Month of
                        <?php echo $row_semester['examination_month'] ?>.</b>
                    </div>




                    <table width="100%" class="table" style="margin-left:-65px;border-bottom:0px">

                        <tr height="25" class="bgcolor_02" colspan="3" class="">

                            <td align="center" class="narmal" width="12%"><b>FINAL STATEMENT OF MARKS OF
                                    <?php echo $row_semester["semester"] ?></b></td>

                        </tr>

                    </table>

                    <!-- ----------------------Main table data-------------------------------------------- -->

                    <table align="center"
                        style="margin-left:-65px; border-top:0px; border: 1px solid black; border-collapse: collapse"
                        class="table" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr height="25" class="bgcolor_02" colspan="3" class="">
                            <!-- <th rowspan='2'>SL NO</th> -->
                            <th rowspan='2' style="border-bottom:1px solid black;border-right: 1px solid black;">PAPER CODE
                            </th>
                            <th rowspan='2' style="border-bottom:1px solid black;border-right: 1px solid black;">PAPER NAME
                            </th>
                            <!-- <th rowspan='2'>PAPER TYPE</th> -->
                            <th rowspan='2' style="border-bottom:1px solid black;border-right: 1px solid black;">FULL MARKS
                            </th>
                            <th colspan="3" style="border-bottom:1px solid black;border-right: 1px solid black;">MARKS
                                OBTAINED</th>
                            <th rowspan="2" style="border-bottom:1px solid black;border-right: 1px solid black;">CREDIT</th>
                            <th rowspan="2" style="border-bottom:1px solid black;border-right: 1px solid black;width: 50px">
                                GRADE POINT</th>
                            <th rowspan="2" style="border-bottom:1px solid black;border-right: 1px solid black;">GRADE</th>
                            <th rowspan="2" style="border-bottom:1px solid black;">CREDIT *<br>GRADE POINT</th>
                        </tr>
                        <tr height="25" class="bgcolor_02" colspan="3" class="">
                            <th style="border-bottom:1px solid black;border-right: 1px solid black;">INT.</th>
                            <th style="border-bottom:1px solid black;border-right: 1px solid black;">EXT.</th>
                            <th style="border-bottom:1px solid black;border-right: 1px solid black;">TOTAL</th>
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
                            $totalmarks = $marks_row["internal_marks"] + $marks_row["external_marks"];
                            $intpass_marks = $marks_row["internal_marks"];
                            $extpass_marks = $marks_row["external_marks"];
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
                                    <?php echo $rows["full_marks"] ?>
                                </td>
                                <td align="center" class="narmal"
                                    style="border-bottom:1px solid black;border-right: 1px solid black;">
                                    <?php echo $marks_row["internal_marks"] ?>
                                </td>
                                <td align="center" class="narmal"
                                    style="border-bottom:1px solid black;border-right: 1px solid black;"
                                    style="border-bottom:1px solid black;border-right: 1px solid black;">
                                    <?php echo $marks_row["external_marks"] ?>
                                </td>
                                <td align="center" class="narmal"
                                    style="border-bottom:1px solid black;border-right: 1px solid black;">
                                    <?php echo $totalmarks; ?>
                                </td>

                                <!-- Credit calculation -->
                                <td align="center" class="narmal"
                                    style="border-bottom:1px solid black;border-right: 1px solid black;">
                                    <?php
                                    if ($fullmarks == 100) {
                                        if ($totalmarks < 40) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo "$credit2";
                                    }
                                    if ($fullmarks == 50) {
                                        if ($totalmarks < 20) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo $credit2;
                                    }
                                    if ($fullmarks == 150) {
                                        if ($totalmarks < 75) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo $credit2;
                                    }
                                    if ($fullmarks == 250) {
                                        if ($totalmarks < 100) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo $credit2;
                                    }
                                    //---------------------------------------------credits---------------------------------------------------
                                    if ($fullmarks == 80) {
                                        if ($course_id == 28 && $totalmarks >= 26) {
                                            echo $credit2;
                                        } elseif ($course_id != 28 && $totalmarks >= 32) {
                                            echo $credit2;
                                        } else {
                                            echo "0";
                                            $credit2 = 0;
                                        }
                                    }
                                    if ($fullmarks == 20) {
                                        if ($totalmarks < 8) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo $credit2;
                                    }
                                    if ($fullmarks == 75) {
                                        if ($totalmarks < 30) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo $credit2;
                                    }
                                    if ($fullmarks == 25) {
                                        if ($totalmarks < 10) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo $credit2;
                                    }
                                    if ($fullmarks == 30) {
                                        if ($totalmarks < 12) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo $credit2;
                                    }
                                    if ($fullmarks == 70) {
                                        if ($totalmarks < 28) {
                                            echo "0";
                                            $credit2 = 0;
                                        } else
                                            echo $credit2;
                                    } ?>
                                </td>
                                <!-- ---------------------- Credit ends here------------------------ -->

                                <?php $sum_total = $marks_row["internal_marks"] + $marks_row["external_marks"];
                                //$gradePoint = $sum_total/10 
                        
                                ?>

                                <!-- ------------------------------Grdae Point---------------------------- -->

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
                                                            <!-- <?php } else if (($totalmarks < 40)) { ?>
                                        <td align="center" class="narmal" style="border-bottom:1px solid black;border-right: 1px solid black;">04</td> -->
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

                                    <?php } else if (($totalmarks >= 45 && $totalmarks <= 49.99)) { ?>
                                                            <td align="center" class="narmal"
                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
                                                            <!-- <?php } else if (($totalmarks < 45)) { ?>
                                        <td align="center" class="narmal" style="border-bottom:1px solid black;border-right: 1px solid black;">P</td> -->

                                    <?php } else { ?>
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
                                    <?php } else if (($totalmarks >= 23 && $totalmarks <= 24)) { ?>
                                                                <td align="center" class="narmal"
                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                                    <?php } else if (($totalmarks <= 23)) { ?>
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

                                    <?php } else if (($totalmarks >= 23 && $totalmarks <= 24)) { ?>
                                                                <td align="center" class="narmal"
                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
                                    <?php } else if (($totalmarks <= 23)) { ?>
                                                                    <td align="center" class="narmal"
                                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">F</td>


                                    <?php }
                                    //$cr_gr =   $rows["credit"] * $gradePoint;
                                    ?>
                                <?php } else if ($fullmarks == 150) { ?>

                                    <?php if (($totalmarks >= 135 && $totalmarks <= 150)) { ?>
                                                <td align="center" class="narmal"
                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                                    <?php } else if (($totalmarks >= 120 && $totalmarks <= 135)) { ?>
                                                    <td align="center" class="narmal"
                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                                    <?php } else if (($totalmarks >= 105 && $totalmarks <= 120)) { ?>
                                                        <td align="center" class="narmal"
                                                            style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                                    <?php } else if (($totalmarks >= 90 && $totalmarks <= 105)) { ?>
                                                            <td align="center" class="narmal"
                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                                    <?php } else if (($totalmarks >= 75 && $totalmarks <= 90)) { ?>
                                                                <td align="center" class="narmal"
                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 75)) { ?>
                                                                    <td align="center" class="narmal"
                                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                                    <?php } else if (($totalmarks == 60)) { ?>
                                                                        <td align="center" class="narmal"
                                                                            style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                                    <?php } else { ?>
                                                                        <td align="center" class="narmal"
                                                                            style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                                    <?php } ?>
                                    <?php if (($totalmarks >= 135 && $totalmarks <= 150)) { ?>
                                                <td align="center" class="narmal"
                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                                    <?php } else if (($totalmarks >= 120 && $totalmarks <= 135)) { ?>
                                                    <td align="center" class="narmal"
                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                                    <?php } else if (($totalmarks >= 105 && $totalmarks <= 120)) { ?>
                                                        <td align="center" class="narmal"
                                                            style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                                    <?php } else if (($totalmarks >= 90 && $totalmarks <= 105)) { ?>
                                                            <td align="center" class="narmal"
                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                                    <?php } else if (($totalmarks >= 75 && $totalmarks <= 90)) { ?>
                                                                <td align="center" class="narmal"
                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 75)) { ?>
                                                                    <td align="center" class="narmal"
                                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
                                    <?php } else if (($totalmarks == 60)) { ?>
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
                                                                            style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
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
                                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
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
                                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
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
                                                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
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
                                                                                            style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
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
                                                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
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

                                    <?php if (($totalmarks > 64 && $totalmarks <= 70)) { ?>
                                                                            <td align="center" class="narmal"
                                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">10</td>
                                    <?php } else if (($totalmarks > 58 && $totalmarks <= 64)) { ?>
                                                                                <td align="center" class="narmal"
                                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">09</td>
                                    <?php } else if (($totalmarks > 52 && $totalmarks <= 58)) { ?>
                                                                                    <td align="center" class="narmal"
                                                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">08</td>
                                    <?php } else if (($totalmarks > 46 && $totalmarks <= 52)) { ?>
                                                                                        <td align="center" class="narmal"
                                                                                            style="border-bottom:1px solid black;border-right: 1px solid black;">07</td>
                                    <?php } else if (($totalmarks > 40 && $totalmarks <= 46)) { ?>
                                                                                            <td align="center" class="narmal"
                                                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">06</td>
                                    <?php } else if (($totalmarks > 34 && $totalmarks <= 40)) { ?>
                                                                                                <td align="center" class="narmal"
                                                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">05</td>
                                    <?php } else if (($totalmarks >= 28 && $totalmarks <= 34)) { ?>
                                                                                                    <td align="center" class="narmal"
                                                                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">04</td>
                                    <?php } else { ?>
                                                                                                    <td align="center" class="narmal"
                                                                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">0</td>
                                    <?php } ?>
                                    <?php if (($totalmarks > 64 && $totalmarks <= 70)) { ?>
                                                                            <td align="center" class="narmal"
                                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">O</td>


                                    <?php } else if (($totalmarks > 58 && $totalmarks <= 64)) { ?>
                                                                                <td align="center" class="narmal"
                                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;A+</td>
                                    <?php } else if (($totalmarks > 52 && $totalmarks <= 58)) { ?>
                                                                                    <td align="center" class="narmal"
                                                                                        style="border-bottom:1px solid black;border-right: 1px solid black;">A</td>

                                    <?php } else if (($totalmarks > 46 && $totalmarks <= 52)) { ?>
                                                                                        <td align="center" class="narmal"
                                                                                            style="border-bottom:1px solid black;border-right: 1px solid black;">&nbsp;&nbsp;B+</td>

                                    <?php } else if (($totalmarks > 40 && $totalmarks <= 46)) { ?>
                                                                                            <td align="center" class="narmal"
                                                                                                style="border-bottom:1px solid black;border-right: 1px solid black;">B</td>

                                    <?php } else if (($totalmarks > 34 && $totalmarks <= 40)) { ?>
                                                                                                <td align="center" class="narmal"
                                                                                                    style="border-bottom:1px solid black;border-right: 1px solid black;">C</td>
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
                                    <?php } else if (($totalmarks <= 20)) { ?>
                                                                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 0);
                                            $total_grade = $total_grade + ($rows["credit"] * 4);
                                            ?>
                                                                    </td>
                                    <?php } else { ?>
                                                                    <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                                    <?php } ?>
                                <?php } else if ($fullmarks == 150) { ?>

                                    <?php if (($totalmarks >= 135)) { ?>
                                                <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 10);
                                            $total_grade = $total_grade + ($rows["credit"] * 10);

                                            ?>
                                                </td>
                                    <?php } else if (($totalmarks >= 120 && $totalmarks <= 135)) { ?>
                                                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 9);
                                            $total_grade = $total_grade + ($rows["credit"] * 9);
                                            ?>
                                                    </td>
                                    <?php } else if (($totalmarks >= 105 && $totalmarks <= 120)) { ?>
                                                        <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 8);
                                            $total_grade = $total_grade + ($rows["credit"] * 8);
                                            ?>
                                                        </td>
                                    <?php } else if (($totalmarks >= 90 && $totalmarks <= 105)) { ?>
                                                            <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 7);
                                            $total_grade = $total_grade + ($rows["credit"] * 7);
                                            ?>
                                                            </td>
                                    <?php } else if (($totalmarks >= 75 && $totalmarks <= 90)) { ?>
                                                                <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 6);
                                            $total_grade = $total_grade + ($rows["credit"] * 6);
                                            ?>
                                                                </td>
                                    <?php } else if (($totalmarks >= 60 && $totalmarks <= 75)) { ?>
                                                                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 5);
                                            $total_grade = $total_grade + ($rows["credit"] * 5);
                                            ?>
                                                                    </td>
                                    <?php } else if (($totalmarks == 60)) { ?>
                                                                        <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 4);
                                            $total_grade = $total_grade + ($rows["credit"] * 4);
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

                                    <?php if (($totalmarks > 64 && $totalmarks <= 70)) { ?>
                                        <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 10);
                                            $total_grade = $total_grade + ($rows["credit"] * 10);

                                            ?>
                                        </td>
                                    <?php } else if (($totalmarks > 58 && $totalmarks <= 64)) { ?>
                                            <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 9);
                                            $total_grade = $total_grade + ($rows["credit"] * 9);
                                            ?>
                                            </td>
                                    <?php } else if (($totalmarks > 52 && $totalmarks <= 58)) { ?>
                                                <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 8);
                                            $total_grade = $total_grade + ($rows["credit"] * 8);
                                            ?>
                                                </td>
                                    <?php } else if (($totalmarks > 46 && $totalmarks <= 52)) { ?>
                                                    <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 7);
                                            $total_grade = $total_grade + ($rows["credit"] * 7);
                                            ?>
                                                    </td>
                                    <?php } else if (($totalmarks > 40 && $totalmarks <= 46)) { ?>
                                                        <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 6);
                                            $total_grade = $total_grade + ($rows["credit"] * 6);
                                            ?>
                                                        </td>
                                    <?php } else if (($totalmarks > 34 && $totalmarks <= 40)) { ?>
                                                            <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 5);
                                            $total_grade = $total_grade + ($rows["credit"] * 5);
                                            ?>
                                                            </td>
                                    <?php } else if (($totalmarks >= 28 && $totalmarks <= 34)) { ?>
                                                                <td align="center" class="narmal" style="border-bottom:1px solid black;">
                                            <?php echo ($rows["credit"] * 4);
                                            $total_grade = $total_grade + ($rows["credit"] * 4);
                                            ?>
                                                                </td>
                                    <?php } else { ?>
                                                                <td align="center" class="narmal" style="border-bottom:1px solid black;">0</td>
                                    <?php } ?>
                                <?php } ?>
                                <?php $sum_total = $marks_row["internal_marks"] + $marks_row["external_marks"];
                                $grandtotal = $grandtotal + $marks_row['internal_marks'] + $marks_row["external_marks"];
                                $totalcredit = $totalcredit + $credit;
                                $totalcredit2 = $totalcredit2 + $credit2;
                                $total_fullmarks = $total_fullmarks + $rows['full_marks'];

                                $sub_percentage = $totalmarks / $fullmarks * 100;
                                if ($course_id == 28) {
                                    if ($totalmarks < 26) {
                                        $failedSubCount++;
                                    }
                                } else if ($sub_percentage < 40) {
                                    $failedSubCount++;
                                }
                                ?>
                            </tr>
                        <?php }
                        //$cnt++;
                        ?>
                        <?php
                        $percentage = ($grandtotal / $total_fullmarks) * 100;
                        $sgpa = $total_grade / $totalcredit;
                        // $tempDate = new DateTime($date_of_result);
                        ?>


                        <table width="100%" align="center" class="table"
                            style="  margin-left: -65px; margin-top:-1px; border:1px solid black; border-collapse: collapse"
                            border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr class="tableLastChild" style="border:1px solid black; border-collapse: collapse">

                                    <td width="20%" class="bgcolor_02" class=""
                                        style="text-align:center;  height:25px; border:1px solid black; border-collapse: collapse">
                                        TOTAL: <?php echo $total_fullmarks; ?></td>

                                    <!-- <td colspan="2"></td> -->
                                    <td width="18%" class="bgcolor_02" class=""
                                        style="text-align:center;  height:25px;border-right:1px solid black;">Percentage:
                                        <?php
                                        $percentage = ($grandtotal / $total_fullmarks) * 100;
                                        echo round($percentage, 2);
                                        ?>
                                    </td>
                                    <td width="17%" class="bgcolor_02" class=""
                                        style="text-align:center;  height:25px;border-right:1px solid black;">Mark Obtd.:
                                        <?php echo $grandtotal; ?>
                                    </td>
                                    <td width="5%" style="text-align:center; border-right:1px solid black;"
                                        class="bgcolor_02">
                                        <?php echo $totalcredit2; ?>
                                    </td>
                                    <td width="11%" style="border-right:1px solid black;"></td>

                                    <td width="10%" colspan="2" class="bgcolor_02"
                                        style="text-align:center; border-right:1px solid black;">
                                        <?php echo $total_grade; ?>
                                    </td>
                                </tr>
                        </table>

                        <table width="100%" align="center" class="table"
                            style="  margin-left: -65px; margin-top:-1px; border:1px solid black; border-collapse: collapse"
                            border="0" cellspacing="0" cellpadding="0">

                            <tr class="tableLastChild" style="border:1px solid black; border-collapse: collapse">
                                <td width="23%" class="bgcolor_02" class=""
                                    style="text-align:center;  height:25px; border:1px solid black;">SGPA:
                                    <?php echo round($sgpa, 2) ?>
                                </td>
                                <td width="21%" class="bgcolor_02" class=""
                                    style="text-align:center;  height:25px; border:1px solid black;">EC/TC: <b>
                                        <?php echo $totalcredit2;
                                        echo "/";
                                        echo $totalcredit; ?>
                                    </b> </td>
                                <?php $percentages = round($percentage, 2); ?>

                                <?php if (($percentages >= 90 && $percentages <= 100)) { ?>
                                    <td width="23%" class="bgcolor_02" class=""
                                        style="text-align:center;  height:25px; border:1px solid black;">Grade: O</td>
                                <?php } else if (($percentages >= 80 && $percentages <= 90)) { ?>
                                        <td width="23%" class="bgcolor_02" class=""
                                            style="text-align:center;  height:25px; border:1px solid black;">Grade: A+</td>
                                <?php } else if (($percentages >= 70 && $percentages <= 80)) { ?>
                                            <td width="23%" class="bgcolor_02" class=""
                                                style="text-align:center;  height:25px; border:1px solid black;">Grade: A</td>
                                <?php } else if (($percentages >= 60 && $percentages <= 70)) { ?>
                                                <td width="23%" class="bgcolor_02" class=""
                                                    style="text-align:center;  height:25px; border:1px solid black;">Grade: B+</td>
                                <?php } else if (($percentages >= 50 && $percentages <= 60)) { ?>
                                                    <td width="23%" class="bgcolor_02" class=""
                                                        style="text-align:center;  height:25px; border:1px solid black;">Grade: B</td>
                                <?php } else if (($percentages >= 40 && $percentages <= 50)) { ?>
                                                        <td width="23%" class="bgcolor_02" class=""
                                                            style="text-align:center;  height:25px; border:1px solid black;">Grade: P</td>
                                <?php } else { ?>
                                                        <td width="23%" class="bgcolor_02" class=""
                                                            style="text-align:center;  height:25px; border:1px solid black;">Grade: F</td>
                                <?php } ?>
                                <td colspan="3"
                                    style="text-align:center;  height:25px; border:1px solid black; border-right:0px; border-collapse: collapse">
                                    <p class="bgcolor_02" class="">Promotional Status:
                                        <?php
                                        if ($failedSubCount == 0) {
                                            echo "PASS";
                                        } else if ($failedSubCount <= 3) {
                                            echo "PROMOTED";
                                        } else {
                                            echo "FAIL";
                                        } ?>
                                    </p>
                                </td>
                            </tr>

                            </tbody>

                        </table>
                        <!----------- My Code start ------------->

                    <table width="100%" class="table"
                        style="margin-left:-65px; border: 1px solid black; border-bottom:0px; border-collapse: collapse; ">

                        <?php
                        $totalmarks = 0;
                        $intpass_marks = 0;
                        $extpass_marks = 0;
                        $credit = 0;
                        $fullmarks = 0;
                        $fullmarks_nw = 0;

                        $sql_get = "SELECT * FROM `tbl_subjects` WHERE 
                        course_id = '" . $row["course_id"] . "' AND 
                         semester_id = '" . $row["semester_id"] . "' AND 
                        fee_academic_year = '" . $row["academic_year"] . "'
                    
                         ORDER BY `subject_id` ASC";
                        $row_get = $con->query($sql_get);
                        $rows = $row_get->fetch_assoc();

                        $sql_grand = "SELECT * FROM `tbl_marks` WHERE
							`reg_no` = '" . $row['reg_no'] . "' && 
							`fee_academic_year` = '" . $row['admission_session'] . "' &&
							`course_id` = '" . $row['admission_course_name'] . "' ";


                        $marsk_result = mysqli_query($con, $sql_grand);

                        if (mysqli_num_rows($marsk_result) > 0) {
                            // Loop through each row
                            while ($marks_row = mysqli_fetch_assoc($marsk_result)) {

                                // Process each row
                                $totalmarks = $totalmarks + $marks_row["internal_marks"] + $marks_row["external_marks"];
                                $intpass_marks = $intpass_marks + $marks_row["internal_marks"];
                                $extpass_marks = $extpass_marks + $marks_row["external_marks"];

                                $fullmarks = $fullmarks + $rows['full_marks'];

                                // credit calculation
                    
                                $sql_sub = "SELECT * FROM `tbl_subjects` WHERE
                                            `subject_id` = '" . $marks_row['subject_id'] . "' ";
                                $result_sub = mysqli_query($con, $sql_sub);
                                $row_sub = mysqli_fetch_assoc($result_sub);

                                $credit = $credit + $row_sub["credit"];

                            }
                        }


                        $sql_gd = "SELECT * FROM `tbl_marks` WHERE
							`reg_no` = '" . $row['reg_no'] . "' && 
							`fee_academic_year` = '" . $row['admission_session'] . "' &&
							`course_id` = '" . $row['admission_course_name'] . "' ";


                        $marsk_relt = mysqli_query($con, $sql_gd);

                        if (mysqli_num_rows($marsk_relt) > 0) {

                            while ($marks_row = mysqli_fetch_assoc($marsk_relt)) {


                                $sql_sb = "SELECT * FROM `tbl_subjects` WHERE
                                            `subject_id` = '" . $marks_row['subject_id'] . "' ";
                                $result_sb = mysqli_query($con, $sql_sb);
                                $row_sb = mysqli_fetch_assoc($result_sb);


                                $uniqueValues = array();

                                while ($marks_row = mysqli_fetch_assoc($marsk_relt)) {
                                    $unique = $marks_row['semester_id'];

                                    echo $fullmarks_nw;
                                    if (!in_array($unique, $uniqueValues)) {
                                        $uniqueValues[] = $unique;
                                    }
                                }
                                sort($uniqueValues);
                                $new_value = $uniqueValues;

                                //  print_r($uniqueValues);   
                            }
                        }
                        foreach ($uniqueValues as $value) {

                            $credits = 0;

                            $sql_gt = "SELECT * FROM `tbl_subjects` WHERE 
                                    course_id = '" . $row["course_id"] . "' AND 
                                    semester_id = '" . $value . "' AND 
                                    fee_academic_year = '" . $row["academic_year"] . "'";

                            $result_gt = $con->query($sql_gt);


                            while ($row_gt = $result_gt->fetch_assoc()) {

                                // $credits = $credits + $row_gt["credit"];
                            }

                            $credits_array[] = $credits;
                        }

                        ?>


                        <!-------            credit point for per sem                -------->

                            <?php

                            $total_grade_array = array();

                            foreach ($new_value as $valuess) {
                                $total_grades = 0;

                                $sql_check = "SELECT * FROM `tbl_marks` WHERE
							`reg_no` = '" . $row['reg_no'] . "' && 
							`fee_academic_year` = '" . $row['admission_session'] . "' && 
							`semester_id` = '" . $valuess . "' && 
							`course_id` = '" . $row['admission_course_name'] . "' 
							 ";

                                $marsk_result = mysqli_query($con, $sql_check);

                                if (mysqli_num_rows($marsk_result) > 0) {

                                    while ($marks_rw = mysqli_fetch_assoc($marsk_result)) {
                                        $totalmarks1 = $marks_rw["internal_marks"] + $marks_rw["external_marks"];
                                        $intpass_marks1 = $marks_rw["internal_marks"];
                                        $extpass_marks1 = $marks_rw["external_marks"];
                                        $credit = $credit + $rows_sb["credit"];
                                        $fullmarks_nw = $rows['full_marks'];
                                        $totalcredit = $totalcredit + $credit;


                                        ?>


                                        <?php

                                        $sql_sb = "SELECT * FROM `tbl_subjects` WHERE
                                        `subject_id` = '" . $marks_rw['subject_id'] . "' ";
                                        $result_sb = $con->query($sql_sb);

                                        if (mysqli_num_rows($result_sb) > 0) {
                                            while ($row_sab = $result_sb->fetch_assoc()) {

                                                if ($fullmarks_nw == 100) { ?>


                                                    <?php if (($totalmarks1 >= 90 && $totalmarks1 <= 100)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 80 && $totalmarks1 <= 89.99)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 70 && $totalmarks1 <= 79.99)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 60 && $totalmarks1 <= 69.99)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 50 && $totalmarks1 <= 59.99)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 40 && $totalmarks1 <= 49.99)) {
                                                        '05';
                                                    } else if (($totalmarks1 < 40)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    } ?>

                                                <?php } else if ($fullmarks_nw == 50) { ?>

                                                    <?php if (($totalmarks1 >= 45 && $totalmarks1 <= 50)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 40 && $totalmarks1 <= 44)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 35 && $totalmarks1 <= 39)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 30 && $totalmarks1 <= 34)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 25 && $totalmarks1 <= 29)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 20 && $totalmarks1 <= 24)) {
                                                        '05';
                                                    } else if (($totalmarks1 <= 20)) {
                                                        '0';
                                                    } ?>

                                                <?php } else if ($fullmarks_nw == 150) { ?>

                                                    <?php if (($totalmarks1 >= 135 && $totalmarks1 <= 150)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 120 && $totalmarks1 <= 135)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 105 && $totalmarks1 <= 120)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 90 && $totalmarks1 <= 105)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 75 && $totalmarks1 <= 90)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 60 && $totalmarks1 <= 75)) {
                                                        '05';
                                                    } else if (($totalmarks1 == 60)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    } ?>

                                                <?php } else if ($fullmarks_nw == 250) { ?>

                                                    <?php if (($totalmarks1 >= 225 && $totalmarks1 <= 250)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 200 && $totalmarks1 <= 225)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 175 && $totalmarks1 <= 200)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 150 && $totalmarks1 <= 175)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 125 && $totalmarks1 <= 150)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 100 && $totalmarks1 <= 125)) {
                                                        '05';
                                                    } else if (($totalmarks1 == 100)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    } ?>

                                                <?php } else if ($fullmarks_nw == 80) { ?>

                                                    <?php if (($totalmarks1 >= 72 && $totalmarks1 <= 80)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 64 && $totalmarks1 <= 72)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 56 && $totalmarks1 <= 64)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 48 && $totalmarks1 <= 56)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 40 && $totalmarks1 <= 48)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 32 && $totalmarks1 <= 40)) {
                                                        '05';
                                                    } else if (($totalmarks1 == 32)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    } ?>

                                                <?php } else if ($fullmarks_nw == 20) { ?>

                                                    <?php if (($totalmarks1 >= 18 && $totalmarks1 <= 20)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 16 && $totalmarks1 <= 18)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 14 && $totalmarks1 <= 16)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 12 && $totalmarks1 <= 14)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 10 && $totalmarks1 <= 12)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 8 && $totalmarks1 <= 10)) {
                                                        '05';
                                                    } else if (($totalmarks1 == 8)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    } ?>

                                                <?php } else if ($fullmarks_nw == 75) { ?>

                                                    <?php if (($totalmarks1 >= 67.5 && $totalmarks1 <= 75)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 60 && $totalmarks1 <= 67.5)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 52.5 && $totalmarks1 <= 60)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 45 && $totalmarks1 <= 52.5)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 37.5 && $totalmarks1 <= 45)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 30 && $totalmarks1 <= 37.5)) {
                                                        '05';
                                                    } else if (($totalmarks1 == 30)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    } ?>



                                                <?php } else if ($fullmarks_nw == 25) { ?>

                                                    <?php if (($totalmarks1 >= 22.5 && $totalmarks1 <= 25)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 20 && $totalmarks1 <= 22.5)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 17.5 && $totalmarks1 <= 20)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 15 && $totalmarks1 <= 17.5)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 12.5 && $totalmarks1 <= 15)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 10 && $totalmarks1 <= 12.5)) {
                                                        '05';
                                                    } else if (($totalmarks1 == 10)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    } ?>


                                                <?php } else if ($fullmarks_nw == 30) { ?>

                                                    <?php if (($totalmarks1 >= 27 && $totalmarks1 <= 30)) {
                                                        '10';
                                                    } else if (($totalmarks1 >= 24 && $totalmarks1 <= 27)) {
                                                        '09';
                                                    } else if (($totalmarks1 >= 21 && $totalmarks <= 24)) {
                                                        '08';
                                                    } else if (($totalmarks1 >= 18 && $totalmarks1 <= 21)) {
                                                        '07';
                                                    } else if (($totalmarks1 >= 15 && $totalmarks1 <= 18)) {
                                                        '06';
                                                    } else if (($totalmarks1 >= 12 && $totalmarks1 <= 15)) {
                                                        '05';
                                                    } else if (($totalmarks1 == 12)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    } ?>

                                                <?php } else if ($fullmarks_nw == 70) { ?>

                                                    <?php if (($totalmarks1 > 64 && $totalmarks1 <= 70)) {
                                                        '10';
                                                    } else if (($totalmarks1 > 58 && $totalmarks1 <= 64)) {
                                                        '09';
                                                    } else if (($totalmarks1 > 52 && $totalmarks1 <= 58)) {
                                                        '08';
                                                    } else if (($totalmarks1 > 46 && $totalmarks1 <= 52)) {
                                                        '07';
                                                    } else if (($totalmarks1 > 40 && $totalmarks1 <= 46)) {
                                                        '06';
                                                    } else if (($totalmarks1 > 34 && $totalmarks1 <= 40)) {
                                                        '05';
                                                    } else if (($totalmarks1 >= 28 && $totalmarks1 <= 34)) {
                                                        '04';
                                                    } else {
                                                        '0';
                                                    }
                                                } ?>

                                                <?php if ($fullmarks_nw == 100) { ?>
                                                    <?php if (($totalmarks1 >= 90 && $totalmarks1 <= 100)) { ?>

                                                        <?php
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 80 && $totalmarks1 <= 89.99)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>


                                                    <?php } else if (($totalmarks1 >= 70 && $totalmarks1 <= 79.99)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 60 && $totalmarks1 <= 69.99)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 50 && $totalmarks1 <= 59.99)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 40 && $totalmarks1 <= 49.99)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 > 40)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {

                                                        '0';
                                                    } ?>
                                                <?php } else if ($fullmarks_nw == 50) { ?>

                                                    <?php if (($totalmarks1 >= 45 && $totalmarks1 <= 50)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 40 && $totalmarks1 <= 44)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 35 && $totalmarks1 <= 39)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 30 && $totalmarks1 <= 34)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 25 && $totalmarks1 <= 29)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 20 && $totalmarks1 <= 24)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 <= 20)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    } ?>

                                                <?php } else if ($fullmarks_nw == 150) { ?>

                                                    <?php if (($totalmarks1 >= 135)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 120 && $totalmarks1 <= 135)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 105 && $totalmarks1 <= 120)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 90 && $totalmarks1 <= 105)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 75 && $totalmarks1 <= 90)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 60 && $totalmarks1 <= 75)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 == 60)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    } ?>
                                                <?php }
                                                if ($fullmarks_nw == 250) { ?>

                                                    <?php if (($totalmarks1 >= 225)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 200 && $totalmarks1 <= 225)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 175 && $totalmarks1 <= 200)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 150 && $totalmarks1 <= 175)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 125 && $totalmarks1 <= 150)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 100 && $totalmarks1 <= 125)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 == 100)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    } ?>
                                                <?php }
                                                //----------------------------------------------Credits----------------------------------------------------
                                                if ($fullmarks_nw == 80) { ?>

                                                    <?php if (($totalmarks1 >= 72)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 64 && $totalmarks1 <= 72)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 56 && $totalmarks1 <= 64)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 48 && $totalmarks1 <= 56)) {

                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 40 && $totalmarks1 <= 48)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 32 && $totalmarks1 <= 40)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 == 32)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    } ?>
                                                <?php }
                                                if ($fullmarks_nw == 20) { ?>

                                                    <?php if (($totalmarks1 >= 18)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 16 && $totalmarks1 <= 18)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 14 && $totalmarks1 <= 16)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 12 && $totalmarks1 <= 14)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 10 && $totalmarks1 <= 12)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 8 && $totalmarks1 <= 10)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 == 8)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    } ?>
                                                <?php }
                                                if ($fullmarks_nw == 75) { ?>

                                                    <?php if (($totalmarks1 >= 67.5)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 60 && $totalmarks1 <= 67.5)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 52.5 && $totalmarks1 <= 60)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 45 && $totalmarks1 <= 52.5)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 37.5 && $totalmarks1 <= 45)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 30 && $totalmarks1 <= 37.5)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 == 30)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    } ?>

                                                <?php }
                                                if ($fullmarks_nw == 25) { ?>

                                                    <?php if (($totalmarks1 >= 22.5)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 20 && $totalmarks1 <= 22.5)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 17.5 && $totalmarks1 <= 20)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 15 && $totalmarks1 <= 17.5)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 12.5 && $totalmarks1 <= 15)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 10 && $totalmarks1 <= 12.5)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 == 10)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    } ?>

                                                <?php }
                                                if ($fullmarks_nw == 30) { ?>

                                                    <?php if (($totalmarks1 <= 30)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 24 && $totalmarks1 <= 27)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 21 && $totalmarks1 <= 24)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 18 && $totalmarks1 <= 21)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 15 && $totalmarks1 <= 18)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 12 && $totalmarks1 <= 15)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 == 12)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    } ?>
                                                <?php }
                                                if ($fullmarks_nw == 70) { ?>

                                                    <?php if (($totalmarks1 > 64 && $totalmarks1 <= 70)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 10);

                                                        ?>

                                                    <?php } else if (($totalmarks1 > 58 && $totalmarks1 <= 64)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 9);
                                                        ?>

                                                    <?php } else if (($totalmarks1 > 52 && $totalmarks1 <= 58)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 8);
                                                        ?>

                                                    <?php } else if (($totalmarks1 > 46 && $totalmarks1 <= 52)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 7);
                                                        ?>

                                                    <?php } else if (($totalmarks1 > 40 && $totalmarks1 <= 46)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 6);
                                                        ?>

                                                    <?php } else if (($totalmarks1 > 34 && $totalmarks1 <= 40)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 5);
                                                        ?>

                                                    <?php } else if (($totalmarks1 >= 28 && $totalmarks1 <= 34)) {
                                                        $total_grades = $total_grades + ($row_sab["credit"] * 4);
                                                        ?>

                                                    <?php } else {
                                                        '0';
                                                    }
                                                }
                                            } ?>
                                            <?php
                                        }
                                    }

                                    $total_grade_array[] = $total_grades;

                                    $semester_data = array();

                                    for ($i = 0; $i < count($credits_array); $i++) {

                                        if ($credits_array[$i] > 0) {

                                            $sgpa = round($total_grade_array[$i] / $credits_array[$i], 2);

                                            $semester_data[$i + 1] = array("sgpa" => $sgpa, "credits" => $credits_array[$i]);
                                        }
                                    }

                                    $total_grade_points = 0;
                                    $total_credits = 0;

                                    foreach ($semester_data as $semester => $data) {

                                        $sgpa = $data["sgpa"];
                                        $credits = $data["credits"];

                                        $total_grade_points += $sgpa * $credits;

                                        $total_credits += $credits;
                                    }

                                    $cgpa = $total_grade_points / $total_credits;

                                }
                            }
                            $sgpa = $total_grade_array[3] / $credits_array[3];

                            ?>
                            <!-- ----------------------------credit point & SGPA Calculation finish------------------------------ -->




                            <!----------------------------------- PERCENTAGE  ------------------------------------------->
                        <?php
                        $percentage = ($totalmarks / $fullmarks) * 100;
                        $sgpa = $total_grade / $totalcredit;

                        ?>

                        <!---------------------------------- PERCENTAGE END ------------------------------------------->

                        <!------------------------------------ GRADE -------------------------------------------------->

                            <?php $percentages = round($percentage, 2); ?>

                            <?php if (($percentages >= 90 && $percentages <= 100)) {
                                $Grade = "O";
                                ?>

                            <?php } else if (($percentages >= 80 && $percentages <= 90)) {
                                $Grade = "A+";
                                ?>

                            <?php } else if (($percentages >= 70 && $percentages <= 80)) {
                                $Grade = "A";
                                ?>
                            <?php } else if (($percentages >= 60 && $percentages <= 70)) {
                                $Grade = "B+";
                                ?>

                            <?php } else if (($percentages >= 50 && $percentages <= 60)) {
                                $Grade = "B";
                                ?>

                            <?php } else if (($percentages >= 40 && $percentages <= 50)) {
                                $Grade = "P";
                                ?>

                            <?php } else {
                                $Grade = "F";
                            } ?>

                            <!------------------------------------- GRADE END -------------------------------------------->




                            <tr height="25" class="bgcolor_02" colspan="3" class=""
                                style="border: 1px solid black; border-collapse: collapse; border-bottom:0px;">

                                <td align="center" class="narmal" width="12%"
                                    style=" border: 1px solid black; border-bottom:0px;"><b>CUMULATIVE STATEMENT</b></td>

                            </tr>

                        </table>



                        <table width="100%" class="table"
                            style="margin-left:-65px; border-top: 0px; border-collapse: collapse; ">

                            <tr height="25" class="bgcolor_02" class=""
                                style="border: 1px solid black; border-collapse:collapse; ">

                                <!--------------- SEM LOOP ----------------->
                            <?php

                            if (!empty($credits_array)) {

                                for ($i = 0; $i < count($credits_array) - 1; $i++) {
                                    ?>
                            <td style="text-align: center; border-right: 1px solid black;">
                                <?php echo ($i + 1) . "<sup>th</sup> SEM"; ?>
                            </td>
                            <?php
                                }
                            } else {

                                ?>
                            <td style="text-align: center; border-right: 1px solid black;">No data available</td>
                            <?php
                            }
                            ?>

                            <td rowspan="2" style="text-align: center; border-right: 1px solid black;">GRAND<br>TOTAL
                            </td>
                            <td rowspan="2" style="text-align: center; border-right: 1px solid black;">
                                TOTAL<br>MARKS<br>OBTD.</td>
                            <td rowspan="2" style="text-align: center; border-right: 1px solid black;">PERCENTAGE</td>
                            <td rowspan="2" style="text-align: center; border-right: 1px solid black;">
                                TOTAL<br>CREDIT<br>(ALL SEM)</td>
                            <td rowspan="2" style="text-align: center; border-right: 1px solid black;">OVERALL<br>GRADE
                            </td>
                            <td rowspan="2" style="text-align: center; border-right: 1px solid black;">CGPA</td>
                            <td width="20%" rowspan="2" style="text-align: center; border-right: 1px solid black;">
                                RESULT</td>


                        </tr>

                        <!-------------------- TOTAL CREDIT LOOP ------------------------>

                            <tr height="25" class="bgcolor_02" style="border: 1px solid black; border-collapse: collapse">
                                <?php

                                if (!empty($credits_array)) {

                                    for ($i = 0; $i < count($credits_array) - 1; $i++) {
                                        ?>
                                        <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                            <small>TOTAL<br>CREDIT : <?php echo $credits_array[$i]; ?></small>
                                        </td>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">NAN</td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <!----------------- SGPA LOOP ----------------------->

                        <tr style="border: 1px solid black; border-collapse:collapse;">
                            <?php for ($i = 0; $i < count($total_grade_array) - 1; $i++) {
                                if ($credits_array[$i] > 0) {
                                    $sgpa = round($total_grade_array[$i] / $credits_array[$i], 2);
                                    ?>
                            <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                <small>SGPA</small>:
                                <?php echo $sgpa; ?>
                            </td>
                            <?php
                                } else {
                                    ?>
                            <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                <small>SGPA</small>: NAN
                            </td>
                            <?php
                                }
                            } ?>

                            <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                <?php echo $fullmarks ?>
                            </td>
                            <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                <?php echo $totalmarks ?>
                            </td>
                            <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                <?php echo round($percentage, 2) ?>
                            </td>
                            <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                <?php echo $credit ?>
                            </td>
                            <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                <?php echo $Grade ?>
                            </td>
                            <td class="bgcolor_02" style="text-align: center; border-right: 1px solid black;">
                                <?php echo round($cgpa, 2); ?>
                            </td>
                            <td style="text-align: center;">
                                <p class="bgcolor_02">
                                    <?php
                                    if ($percentage >= 80 && $percentage <= 100) {
                                        echo "FIRST DIVISION WITH DISTINCTION";
                                    } elseif ($percentage >= 60 && $percentage <= 79.99) {
                                        echo "FIRST DIVISION";
                                    } else if ($percentage >= 50 && $percentage <= 59.99) {
                                        echo "SECOND DIVISION";
                                    } else if ($percentage >= 40 && $percentage <= 49.99) {
                                        echo "THIRD DIVISION / PASS";
                                    } else {
                                        echo "FAIL";
                                    } ?>
                                </p>
                            </td>
                        </tr>

                    </table>

                    <!-- ----------------------Main table data ends here----------------------------------- -->

                        <table width="100%" align="center" class="table" style=" margin-left: -65px;" cellspacing="0"
                            cellpadding="0">
                            <tr>
                                <td style="vertical-align: top;">

                                    <table width="90%" align="center" height=210px;
                                        style="margin-left: 0px; margin-top:-1px; border: 1px solid black; border-left:0px; border-collapse: collapse">

                                        <thead>

                                            <tr height="25" class="bgcolor_02" colspan="3" class="tb1_grid">
                                                <th width="30%" align="center"
                                                    style="border: 1px solid black; border-left:0px; border-collapse: collapse;">
                                                    Percentage<br>of Marks</th>
                                                <th width="20%" align="center"
                                                    style="border: 1px solid black; border-collapse: collapse; border-top: 1px solid black">
                                                    Grade Point</th>
                                                <th width="20%" align="center"
                                                    style="border: 1px solid black; border-collapse: collapse; border-top: 1px solid black">
                                                    Letter Grade</th>

                                            </tr>

                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td width="30%" align="center" class="narmal"
                                                    style="border:1px solid black; border-left:0px; border-collapse:collapse">
                                                    90 - 100</td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black;">10</td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black; text-transform: capitalize;"><small>O
                                                        (Outstanding)</small></td>
                                            </tr>
                                            <tr>
                                                <td width="30%" align="center" class="narmal"
                                                    style="border:1px solid black; border-left:0px;">80 - 89 </td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black; ">09</td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black; text-transform: capitalize;">
                                                    &nbsp;&nbsp;<small>A+ (Excellent)</small></td>
                                            </tr>

                                            <tr>
                                                <td width="30%" align="center" class="narmal"
                                                    style="border:1px solid black; border-left:0px;">70 - 79 </td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black;">08</td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black; text-transform: capitalize;"><small>A
                                                        (Very Good)</small></td>
                                            </tr>

                                            <tr>
                                                <td width="30%" align="center" class="narmal"
                                                    style="border:1px solid black; border-left:0px;">60 - 69 </td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black;">07</td>
                                                <td width="40%" align="center" class="narmal"
                                                    style="border:1px solid black; text-transform: capitalize;">
                                                    &nbsp;&nbsp;<small>B+ (Good)</small></td>
                                            </tr>

                                            <tr>
                                                <td width="30%" align="center" class="narmal"
                                                    style="border:1px solid black; border-left:0px;">50 - 59 </td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black;">06</td>
                                                <td width="10%" align="center" class="narmal"
                                                    style="border:1px solid black; text-transform: capitalize;"><small>B
                                                        (Above Average)</small></td>
                                            </tr>

                                            <tr>
                                                <td width="30%" align="center" class="narmal"
                                                    style="border:1px solid black; border-left:0px;">45 - 49 </td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black;">05</td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black; text-transform: capitalize;"><small>C
                                                        (Pass)</small></td>
                                            </tr>

                                            <tr>
                                                <td width="30%" align="center" class="narmal"
                                                    style="border:1px solid black; border-left:0px;">
                                                    < 45 </td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black;">0</td>
                                                <td width="20%" align="center" class="narmal"
                                                    style="border:1px solid black; text-transform: capitalize;"><small>F
                                                        (Fail)</small></td>
                                            </tr>

                                            <tr>
                                                <td rowspan="2" width="20%" align="center" class="narmal"
                                                    style="border:1px solid black; border-left:0px; border-bottom:0px; text-transform: capitalize;">
                                                    AB (Absent)</td>

                                                <td rowspan="2" width="20%" align="center" class="narmal" colspan="2"
                                                    style="border:1px solid black; border-bottom:0px; text-transform: capitalize;">
                                                    AB</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                                <td style="vertical-align: top;">

                                    <table width="100%" align="center" height=210px;
                                        style="margin-left: -20px; margin-top:-1px; border: 0px; border-collapse: collapse"
                                        cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr height="25" class="bgcolor_02"
                                                style="text-align: center; text-transform: capitalize;">
                                                <td>
                                                    <small>Computation of Credit Point = Grade Point X Credit</small>
                                                </td>

                                            </tr>
                                            <tr height="25" class="bgcolor_02"
                                                style="text-align: center; text-transform: capitalize;">
                                                <td><small> <span class="teat"
                                                            style=" position: relative; top: 4px; left: -4px;">SGPA =
                                                        </span>
                                                        <span style="text-decoration: underline;">Total Credit Points of All
                                                            Courses</span><br>&emsp;&emsp;&emsp;&emsp;Total Credits of
                                                        Semester</small>
                                                </td>
                                            </tr>
                                            <tr height="25" class="bgcolor_02"
                                                style="text-align: center; text-transform: capitalize;">
                                                <td><small> <span class="teat"
                                                            style="position: relative; top: 4px; left: -4px;">SGPA = </span>
                                                        <span style="text-decoration: underline;">Total of SGPA*CREDIT of
                                                            All Semester</span><br>&emsp;&emsp;&emsp;&emsp;Total Credits of
                                                        All Semester
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="vertical-align: top;">
                                    <table width="100%" align="center" height=210px;
                                        style="margin-left:0px; margin-top:-1px; border: 1px solid black; border-right:0px; border-collapse: collapse"
                                        cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr height="25" class="bgcolor_02" style="width: 100%;">
                                                <th Colspan="2"
                                                    style="text-align: center; border: 1px solid black; border-right:0px">
                                                    CLASSIFICATION<br>OF DIVISION
                                                </th>
                                            </tr>
                                            <tr height="25" class="bgcolor_02">
                                                <td style="width:50% ;text-align: center; border:1px solid black;">
                                                    80.00-100.00
                                                </td>
                                                <td
                                                    style="width: 120%;text-align: center; border:1px solid black; border-right:0px">
                                                    <small>FIRST DIVISION<br>WITH<br>DISTINCTION</small>
                                                </td>
                                            </tr>
                                            <tr height="25" class="bgcolor_02">
                                                <td style="text-align: center; border:1px solid black;">
                                                    60.00-79.99
                                                </td>
                                                <td style="text-align: center; border:1px solid black; border-right:0px">
                                                    <small>FIRST DIVISION</small>
                                                </td>
                                            </tr>
                                            <tr height="25" class="bgcolor_02">
                                                <td style="text-align: center; border:1px solid black;">
                                                    50.00-59.99
                                                </td>
                                                <td style="text-align: center; border:1px solid black; border-right:0px">
                                                    <small>SECOND DIVISION</small>
                                                </td>
                                            </tr>
                                            <tr height="25" class="bgcolor_02">
                                                <td style="text-align: center; border:1px solid black; border-bottom:0px;">
                                                    40.00-49.99
                                                </td>
                                                <td
                                                    style="text-align: center; border:1px solid black; border-right:0px; border-bottom:0px;">
                                                    <small>THIRD DIVISION / <br>PASS</small>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- currentDate Calculation -->
                        <?php

                        $currentDate = date("l, F j, Y");

                        $dayOfMonth = date("j");

                        if ($dayOfMonth % 10 == 1 && $dayOfMonth != 11) {
                            $suffix = "st";
                        } elseif ($dayOfMonth % 10 == 2 && $dayOfMonth != 12) {
                            $suffix = "nd";
                        } elseif ($dayOfMonth % 10 == 3 && $dayOfMonth != 13) {
                            $suffix = "rd";
                        } else {
                            $suffix = "<span style='text-transform: lowercase;'>th</span>";
                        }


                        $currentDate = str_replace($dayOfMonth, $dayOfMonth . "<sup>" . $suffix . "</sup>", $currentDate);



                        if ($grandtotal >= $passmarks_total) {
                            $resultVar = "PASS";
                        } else {
                            $resultVar = "FAIL";
                        }
                        $data = array(
                            "University" => "nsuniv.ac.in",
                            "Reg No" => $row["reg_no"],
                            "Academic Session" => $session,
                            "Course" => $row_course["course_name"],
                            "Student Name" => $row["student_name"],
                            "Fathers Name" => $row["father_name"],
                            "Result" => $resultVar
                        );
                        //  echo "<pre>";
                        //  print_r($data);
                    


                        // Include the qrlib file 
                        include_once 'include/qr-lib/qrlib.php';

                        $file = $path . uniqid() . uniqid() . ".png";
                        // $ecc stores error correction capability('L') (LOW)
                        // $ecc stores error correction capability('H') (HIGH)
                        $ecc = 'H';
                        $pixel_Size = 10;
                        $frame_Size = 1;
                        // Generates QR Code and Stores it in directory given 
                        QRcode::png(json_encode($data), $file, $ecc, $pixel_Size, $frame_Size);

                        ?>


                        <table width="100%" align="center" class="table" height="20"
                            style="margin-left: -65px; margin-top:5px" border="0px" cellspacing="0" cellpadding="0">
                            <tbody>

                                <tr>
                                    <td>
                                        <!-- <img src='" . $file . "'
                                            style="margin-top: -15px; height: 70px;width: 70px;margin-left: 10px;"> -->
                                        <?php
                                        // Displaying the stored QR code from directory 
                                        echo "<img style='margin-top: -15px; height: 70px;width: 70px;margin-left: 10px;' src='" . $file . "'>";
                                        ?>
                                    </td>



                                    <td>&emsp;&emsp;<img src="images/sig2.png"
                                            style="margin-top: 55px;height: 45px;width: 90px;margin-left: 10px;">
                                    </td>

                                    <td>&emsp;&emsp;&emsp;
                                        <img src="images/sig.jpeg"
                                            style="margin-top: 45px;height: 50px;width: 90px;margin-left: 60px;">
                                    </td>
                                </tr>

                                <tr>
                                    <td height="5" class="bgcolor_02" style="text-transform: capitalize;">
                                        <small>
                                            <p>&emsp;Date of Publication of Result:
                                                <?php echo $tempDate->format('d-m-Y') ?>
                                                <br>&emsp;
                                                Issue Date:
                                                <?php echo $currentDate; ?>
                                            </p>.
                                        </small>
                                    </td>



                                    <td>
                                        <p class="narmal" style="height: 30px; text-transform: capitalize;">
                                            &emsp;&emsp;&emsp;<b>Tabulator / OSD</b></p>
                                    </td>

                                    <td>
                                        <p class="narmal"
                                            style="margin-top: -15px;height: 5px; width: 210px;margin-right: 0px; text-transform: capitalize;">
                                            &emsp;&emsp;&emsp;&emsp;&emsp;<b>Controller of Examinations</b>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php

                        $currentDateTime = date('Y-m-d H:i:s');

                        if (isset($_GET['id'])) {
                            // Check if the record already exists
                            $sql = "SELECT * FROM `tbl_consolidated_ms` WHERE `student_id`='" . $_GET['id'] . "' AND `course_id`='" . $row["course_id"] . "' AND `print_datetime`='" . $currentDateTime . "'";
                            $result_consolidated = $con->query($sql);

                            if ($result_consolidated->num_rows > 0) {
                                echo "Record already exists.";
                            } else {
                                // Insert the record
                                $sql = "INSERT INTO `tbl_consolidated_ms` (`student_id`,  `course_id`, `print_datetime`) VALUES (" . $_GET['id'] . "," . $row["course_id"] . ",'" . $currentDateTime . "')";
                                $new_data = $con->query($sql);

                            }
                        }
                        ?>
                </div>

            </div>

        </div>

        <script>
            window.print();
        </script>
    <?php } ?>
</body>

</html>