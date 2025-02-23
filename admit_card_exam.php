<?php
include "framwork/main.php";
ERROR_REPORTING(0);
include "include/config.php";
include "include/function.php";
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="School Management 	" />
    <meta name="keywords" content="School Management   " />
    <title> Netaji Subhas University : Admit Card</title>
    <!-- <link rel="stylesheet" href="../srinath/dist/fonts/"> -->
    <style type="text/css">
    body {
        /* font-family: tahoma !important; */
        color: #0d1065 !important;
        font-family: sans-serif !important;
    }

    .admit_card {
        color: #a92e15;
        border: 2px solid #a92e15;
        font-size: 20px;
        width: 142px;
        margin-left: 44px;
        text-align: left;
        padding-right: 2px;
        padding-left: 14px;
        /* margin-right: -24px; */
        border-radius: 40px;
    }

    .text-u {
        color: #a92e15;

    }

    /* @font-face {
            font-family: Belwec;
            src: url('includes/fonts/Belwec.ttf');
        } */

    .narmal {
        font-family: tahoma !important;
        padding: 2px;
        font-size: 10px !important;
        font-weight: normal;
        text-decoration: none;
        color: #000000;
    }

    txt_01 {
        font-family: verdaba;
        font-size: 14px;
        font-weight: 400;
    }

    .style1 {
        font-size: 25px !important;
        /* margin-left: -100px; */
        color: #a92e15 !important;
        font-weight: bold;
        /* font-family: avalon; */

    }

    .font {

        /*font-family: avalon;*/
        font-size: 40px;
        color: #a92e15;

    }

    .border1 {
        border-bottom: #000000;
        border-top: #000000;
    }

    .admin {
        font-family: tahoma;
        font-size: 10px;
        font-weight: bold;
        color: #0d1065;
        text-decoration: none;
    }

    .bgcolor_2 {
        background-color: #0d1065;
        color: #0d1065;
        text-align: left;
        font-weight: normal;
        font-family: Tahoma;
        font-size: 12px;
        text-decoration: none;
    }

    .admin-logo {
        padding: 24px 8px 22px 10px;
        height: 61px;
    }

    .size-50 {
        font-size: 15px;
        margin-left: -120px;
    }


    .ugc {
        margin-top: -11px;
        background: #fecc00;
        margin-right: 138px;
        border-radius: 10px;
    }

    .size-51 {

        color: black;
        font-size: 15px;
    }
    </style>
    <link href="../student/dist/css/violet.css" rel="stylesheet" type="text/css" />
</head>
<?php
$sql_sign = "SELECT * FROM `tbl_sign` WHERE `des_id` IN ('2')";
$result_sign = $con->query($sql_sign);

while ($row_sign = $result_sign->fetch_assoc()) {
    if ($row_sign['des_id'] === "2") {
        // Retrieve image data associated with des_id '1' (Assuming it's stored in a column named 'image_data')
        $imageData = $row_sign['image_data']; // Replace 'image_data' with your column name

        // Encode the image data to base64
        $base64Image = base64_encode($imageData);
        $sign_r = $base64Image;
    }
}
?>

<body class="body_pop" style="color:#0d1065;">
    <!-- <p style="position: fixed;right: 3%;">
        <a href="" id="printbutton" value="&nbsp;Print" onclick="return printing();"><img src="images/print.jpg" style="height: 80px;"></a>
    </p> -->
    <table width="740" border="0" align="center" class="tb2_grid"
        style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin-top: 50px;">

        <tr>
            <td align="right" valign="top">

            <td align="right" valign="top">
                <table width="100%" border="0">
                    <td width="8%" rowspan="4" align="center" valign="top">
                        <div class="lo" style="border-right: 1px solid;padding-right: 5px;">
                            <img src="./uploads/logo1.png" width="100" height="" alt="Image" border="0" title="Images"
                                style="">
                        </div>
                    </td>
                    <tr>

                        <td align="center" valign="top"><span class="style1"
                                style="border-bottom: 3px solid;color:#c70013;font-size: 24px;">NETAJI
                                SUBHAS UNIVERSITY,
                                JAMSHEDPUR
                                <!--"CENTRAL PROVINCIAL SCHOOL"-->
                            </span></td>
                        <?php

                        $sql_semester = "SELECT * FROM tbl_allot_semester WHERE allot_id = '" . $_GET['id'] . "' ";
                        $result_semester = mysqli_query($con, $sql_semester);
                        $allot_semester = mysqli_fetch_assoc($result_semester);

                        $sql_exam = "SELECT * FROM tbl_examination_form WHERE `admission_id` = '" . $allot_semester['admission_id'] . "' && `course_id` = '" . $allot_semester['course_id'] . "' && `academic_year` = '" . $allot_semester['academic_year'] . "' && `semester_id` = '" . $allot_semester['semester_id'] . "' ";
                        $result_exam = mysqli_query($con, $sql_exam);
                        $row_exam = mysqli_fetch_assoc($result_exam);

                        $sql = "SELECT * FROM `tbl_admission` 
		        INNER JOIN `tbl_allot_semester` ON `tbl_admission`.`admission_id` = `tbl_allot_semester`.`admission_id`
		        WHERE `tbl_admission`.`admission_id` = '" . $allot_semester['admission_id'] . "' && `tbl_allot_semester`.`allot_id` = '" . $allot_semester['allot_id'] . "' ";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_assoc($result);
                        // $exam_reg_no = '';
                        // $sql2 = "SELECT `exam_reg_no` FROM `tbl_admission` WHERE `admission_id` = " . $row["admission_id"];
                        // $result2 = mysqli_query($con, $sql2);
                        // while($row2 = mysqli_fetch_assoc($result2)){
                        
                        //     if ($row2['exam_reg_no'] !== null) {
                        //         $exam_reg_no = $row2['exam_reg_no'];
                        //         // Perform operations with $exam_reg_no or any other logic here
                        //     }
                        // }
                        

                        $sql_course = "SELECT * FROM `tbl_course`
					   WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
					   ";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();

                        // echo "<pre>";
                        // print_r($row_course);
                        // echo "</pre>";
                        
                        // echo $row["semester_id"];
                        $sql_semester = "SELECT * FROM `tbl_semester`
						 WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
					    ";
                        $result_semester = $con->query($sql_semester);
                        $row_semester = $result_semester->fetch_assoc(); ?>
                    <tr>
                        <td>
                        </td>
                    </tr>
        </tr>


        <tr>
            <td height="93" colspan="3">

                <script type="text/javascript">
                document.title = "Netaji Subhas University :  Admit Card";
                </script>



        <tr>
            <td colspan="3" class="" align="center">&nbsp;&nbsp;<span class="admin">
                    <ul style="margin-top: -120px;font-size: 16px; text-align: center;">
                        <span style="border-bottom: 2px solid;">
                            <?php echo strtoupper($row_semester["examname"]) ?>
                            <?php echo strtoupper($row_semester["semester"]) ?>
                            <?php echo strtoupper($row_semester["examination_month"]) ?>
                        </span>
                    </ul>
                </span></td>
        </tr>
        <tr>
            <td colspan="3" class="" align="center">&nbsp;&nbsp;<span class="admin">
                    <ul style="margin-top:-100px; margin-left: -188px text-align: center"><u
                            style="font-size: 16px;">Admit
                            Card</u>
                </span></td>
        </tr>
        </tr>
    </table>
    <tr>
        <table width="740" align="center" style='margin-top: -158px;'>
            <td height="85" colspan="3">


                <tr>
                    <script type="text/javascript">
                    document.title = "Netaji Subhas University :  Admit Card";
                    </script>
                    <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <?php

                                $sql_semester = "SELECT * FROM tbl_allot_semester WHERE allot_id = '" . $_GET['id'] . "' ";
                                $result_semester = mysqli_query($con, $sql_semester);
                                $allot_semester = mysqli_fetch_assoc($result_semester);

                                $sql = "SELECT * FROM `tbl_admission` 
		        INNER JOIN `tbl_allot_semester` ON `tbl_admission`.`admission_id` = `tbl_allot_semester`.`admission_id`
		        WHERE `tbl_admission`.`admission_id` = '" . $allot_semester['admission_id'] . "' && `tbl_allot_semester`.`allot_id` = '" . $allot_semester['allot_id'] . "' ";
                                $result = mysqli_query($con, $sql);
                                $row = mysqli_fetch_assoc($result);
                                // $exam_reg_no = '';
                                // $sql2 = "SELECT `exam_reg_no` FROM `tbl_admission` WHERE `admission_id` = " . $row["admission_id"];
                                // $result2 = mysqli_query($con, $sql2);
                                // while($row2 = mysqli_fetch_assoc($result2)){
                                
                                //     if ($row2['exam_reg_no'] !== null) {
                                //         $exam_reg_no = $row2['exam_reg_no'];
                                //         // Perform operations with $exam_reg_no or any other logic here
                                //     }
                                // }
                                

                                $sql_course = "SELECT * FROM `tbl_course`
					   WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
					   ";
                                $result_course = $con->query($sql_course);
                                $row_course = $result_course->fetch_assoc();

                                // echo "<pre>";
                                // print_r($row_course);
                                // echo "</pre>";
                                
                                // echo $row["semester_id"];
                                $sql_semester = "SELECT * FROM `tbl_semester`
						 WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
					    ";
                                $result_semester = $con->query($sql_semester);
                                $row_semester = $result_semester->fetch_assoc(); ?>
                                <tr>
                                    <td colspan="3" class="" align="center">&nbsp;&nbsp;<span class="admin">
                                            <ul style="margin-top: -100px;font-size: 16px;">
                                                <?php echo strtoupper($row_semester["examname"]) ?>
                                                <?php echo strtoupper($row_semester["semester"]) ?> Examination - 2020
                                            </ul>
                                        </span></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="" align="center">&nbsp;&nbsp;<span class="admin">
                                            <ul style="margin-top:-80px;"><u>ADMIT CARD</u>
                                        </span></td>
                                </tr> -->
                <tr class="">
                    <td width="1" class="bgcolor_02"></td>
                    <td align="left" valign="top">
                        <table width="740px" class="" style="margin-left: 0px; border: 1px solid black;">
                            <tr class="">
                                <td>
                                    <table style="border-bottom: 0;width:100.4%">

                                        <tr>
                                            <td height="25" colspan="3" class="tb1_grid">
                                                &nbsp;&nbsp;<span class="admin"
                                                    style="position: absolute;word-spacing: -1px;">REGN
                                                    NO:
                                                    <?php echo $row["reg_no"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <b style="margin-left: 30px;">COURSE: <?php
                                                    echo $row_course["course_name"];

                                                    $date = $row['date_of_admission'];
                                                    $year = date("Y", strtotime($date));

                                                    ?></b>&nbsp;&nbsp;&nbsp;&nbsp;<b style="margin-left: 40px;">YEAR OF
                                                        REGISTRATION:
                                                        <?php echo $year; ?></b>
                                                    </b>&nbsp;&nbsp;&nbsp;&nbsp;<b style="margin-left: 40px;">APAAR ID:
                                                        <?php echo $row_exam['apaar_id']; ?></b></span></td>
                                        </tr>
                                    </table>
                                    <table
                                        style="border-top: 1px solid black;border-bottom: 1px solid black;width:100%">
                                        <tr>
                                            <td align="left" class="narmal " width="21%"><b>NAME </td>
                                            <td align="left" class="narmal" width="1%"></td>
                                            <td align="left" class="narmal" width="37%"
                                                style="text-transform: uppercase;">
                                                <span style="margin-left: -42px;"><b>:
                                                        <?php echo $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"] ?></b></span>

                                            </td>

                                            <td align="left" class="narmal" width="1%"><b
                                                    style="margin-left: -37px;">DATE
                                                    OF BIRTH</td>
                                            <td align="left" class="narmal" width="1%"><b>:</td>
                                            <td align="left" class="narmal" width="20%" ;>
                                                <b><?php echo date('d-M-Y', strtotime($row["admission_dob"])); ?> </b>
                                            </td>
                                            <th rowspan="3"
                                                style="padding: 3px;background: white;z-index: 2;position: absolute;width: 90px;/* border: 1px solid #4d4a74; */margin-left: -4px;width:93px;border-left: 1px solid;/* border-right: 1px solid black; */margin-top: -2px;backgound-color:white;">
                                                <div style="padding: 2px;">
                                                    <a href="" id="profile" value=""><img
                                                            src="./student/images/student_images_new/<?php echo $row_exam["passport_photo"]; ?>"
                                                            style="height: 50px;"></a>
                                                    <!-- <a href="" id="profile" value=""><img
                                                            src="https://nsucms.in/nsucms/images/student_images/st_07032019_020709_st_06272019_010621_manisha1.jpg"
                                                            style="height: 50px;"></a> -->
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td align="left" class="narmal" width="21%"><b>FATHER'S NAME
                                                </b></td>
                                            <td align="left" class="narmal" width="1%"></td>
                                            <td align="left" class="narmal" width="37%"
                                                style="text-transform: uppercase;">
                                                <span style="margin-left: -42px;"><b>:
                                                        <?php echo $row["admission_father_name"]; ?></b></span>
                                            </td>


                                            <td align="left" class="narmal" width="1%"><b>GENDER</b>
                                            </td>
                                            <td align="left" class="narmal" width="1%"><b>:</td>
                                            <td align="left" class="narmal" width="20%"
                                                style="text-transform: uppercase;">
                                                <b><?php echo $row["admission_gender"]; ?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="position: relative;/* margin-left: -74px !important; */border-bottom: 0 !important;border-top: 1px solid black;height: 1px;left: -2px;"
                                                height="25" colspan="6" align="center" class="">
                                                &nbsp;&nbsp;<span class="admin"><u
                                                        style='text-decoration:underline !important;'><b
                                                            style="font-size:12px;">SUBJECT
                                                            DETAILS</b></u></span></td>
                                        </tr>
                                    </table>


                                </td>
                            </tr>
                            <tr colspan="3" class="">
                                <td>
                                    <table width="100%" class="" style="margin-top: -4px;">
                                        <thead>
                                            <tr height="25" class="bgcolor_02" colspan="3" class=""
                                                style="font-size: small">
                                                <td width="15%" align="center"><u><b>SUBJECT
                                                            CODE</b></u></td>
                                                <td width="35%" align="center"><u><b>SUBJECT
                                                            NAME</b></u></td>
                                                <td width="25%" align="center"><u><b>DATE OF
                                                            EXAMINATION</b></u></td>
                                                <td width="25%" align="center"><u><b>SIGN OF
                                                            INVIGILATOR</b></u></td>
                                            </tr>
                                        </thead>

                                        <tbody style="background-size:cover; margin-top:25px;">
                                            <?php
                                            $sql = "SELECT * FROM `tbl_subjects` WHERE course_id = '" . $row["course_id"] . "' AND semester_id = '" . $row["semester_id"] . "' AND fee_academic_year = '" . $row["academic_year"] . "' AND (specialization_id = '" . $row['specialization_id'] . "' OR specialization_id = '" . $row['specialization_id_dual'] . "' OR COALESCE(specialization_id, '') = '') ORDER BY `date_of_examination` ASC;";
                                            $rows = $con->query($sql);
                                            while ($row_course = $rows->fetch_assoc()) {
                                                ?>
                                            <tr height="20">
                                                <td align="center" class="narmal">
                                                    <b><?php echo $row_course["subject_code"] ?></b>
                                                </td>
                                                <td align="center" class="narmal" style="text-transform: uppercase;">
                                                    <b><?php echo $row_course["subject_name"] ?></b>
                                                </td>
                                                <td align="center" class="narmal"><b><?php if (strtotime($row_course['date_of_examination']) > 0) {
                                                        echo date("d-M-Y", strtotime($row_course["date_of_examination"]));
                                                    } else {
                                                        echo '--';
                                                    } ?></b></td>
                                                <td style="border:1px solid black;">
                                                    <div></div>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr colspan="3">
                                <td>
                                    <table width="100%"
                                        style="border-top: 1px solid black; margin-top: 0px; line-height: 9px; width: 100.4%;">
                                        <td class="narmal"><b>CENTRE NAME: NETAJI SUBHAS UNIVERSITY,
                                                JAMSHEDPUR</br></br><b>ROLL NO:
                                                    <?php echo $row["roll_no"] ?></td>
                                        <td class="narmal"><b>REPORTING TIME </b><b style="margin-left: 17px;">:
                                            </b><b><?php echo strtoupper($row_semester["exam_reporting_time"]) ?>
                                            </b></br></br><b>TIME OF EXAMINATION </b><b
                                                style="margin-left: 18px;">:<?php echo strtoupper($lTime = $row_semester["time_of_examination"]) ?>
                                            </b>
                                            <b><?php

                                            // echo date('h:i A', strtotime($lTime));
                                            if ($row_semester["time_of_dispersal"] != "") {
                                                $mTime = $row_semester["time_of_dispersal"];
                                                echo " - " . date('h:i A', strtotime($mTime));
                                            }
                                            ?></b>
                                        </td>
                                    </table>
                                </td>
                            </tr>
                        </table>


                    </td>

                    <td width="1" class="bgcolor_02"></td>
                </tr>
                <!--  -->
                <tr>
                    <td colspan="7" align="left" valign="top"></td>
                </tr>
        </table>
        </td>
    </tr>

    <tr>
        <table>
            <div class="controller">
                <p class="cust"><b>STUDENT'S SIGNATURE</b></p>

                <div>
                    <?php
                    $dateString = $row_semester["examination_month"];
                    $year = substr($dateString, -4); // Extract the last 4 characters (the year part)
                    ?>
                    <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>"
                        style="top: -2px;height: 50px;width: 130px;content: &quot;&quot;;position: relative;margin-left: 45px;filter: invert(0);">

                    <p style="font-size: 12px;margin-top: 0px;margin-bottom: 3px;"><b>CONTROLLER OF EXAMINATIONS</b>
                    </p>
                </div>
            </div>


            <style>
            .controller {
                width: 738px;
                color: black;
                justify-content: space-around;
                display: flex;
                margin-top: -12px !important;
                margin: 0 auto;
                border-bottom: 1px solid black;
                border-right: 1px solid;
                border-left: 1px solid black;
                padding-top: 20px;
            }

            b {
                color: #0d1065 !important;
            }

            .cust {
                font-size: 12px;
                margin-top: 49px !important;
                margin-bottom: 3px;
                font-weight: 400 !important;
            }
            </style>
            </div>
        </table>

    </tr>

    <p>
    <table width="740" border="0" align="center" class="tb2_grid" style="margin-top: 20px">
        <tbody>
            <tr>
                <td style="padding: 10px;border: 1px solid;margin-right: 50px;margin-left: 80px;">
                    <center><b style="color:#0d1065;">
                            <udf style="font-size: 16px;">“EXAM INSTRUCTIONS FOR EXAMINEE”
                    </center>
                    <ol style="font-size:12px;text-align: justify;color:#0d1065;">
                        <li>Check the exam timetable carefully. Make sure you know the time and location of
                            examination hall/room of your exams.</li>
                        <li>Bring your Admit Card and keep it always with you as long as you are in the Exam-Centre.
                            You will not to be allowed entry in the exam hall/room without admit card and student
                            ID.</li>
                        <li>Do not bring any unauthorised material, if found, it will be confiscated.</li>
                        <li>Ensure that you use the washroom before arriving for your exam as you will not be
                            permitted to leave during the first hour.</li>
                        <li>Normally, you are required to answer questions using blue or black ink (Ball Pen), no
                            other colour of ink is allowed to write.</li>
                        <li>Arrive at least 15 minutes before the exam is due to start. As you enter show your ID
                            card.</li>
                        <li>Make sure your mobile phone is switched off and place as advised by the invigilator.
                            Bags are not allowed in the examination room.</li>
                        <li>Remember that talking is strictly prohibited at any time in the exam hall/room.</li>
                        <li>Listen carefully to instructions. Students are required to comply with instruction of
                            given by invigilators at all times.</li>
                        <li>You are not allowed to leave the exam rooms in the first hour and last fifteen minutes.
                        </li>
                        <li>If you have any queries or need more papers, raise your hand, the invigilator will come
                            to you.</li>
                        <li>Examinees should clearly write their Roll Number, Registration No., Subject code and
                            Paper Name and Date of Examination on the Answer sheet. Such answer sheet, having no
                            aforesaid details, will not go for evaluation.</li>
                        <li>After final submission of Answer sheet, the copy will not be handover to the examinee
                            under any circumstances.</li>
                        <li>Within one hour of question paper distribution, no examinee will be allowed to submit
                            the answer sheet.</li>
                        <li>Once the examinee leaves the examination room, he/she will not be allowed to re-enter
                            the examination room.</li>
                        <li>In case of boycott, repeat examination will not be held under any circumstances.</li>
                        <li>Keep your eyes on your own paper. Remember, copying is cheating!</li>
                        <li>Stop writing immediately when the invigilator asks it is the end of the exam.</li>
                        <li>Leave the exam hall/room quickly and quietly. Remember to take all your belongings with
                            you. Leave the building quietly.</li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>



    </table>

    <p>




        </td>
        </tr>

        </table>

        </td>
        </tr>
        <script type="text/javaScript">
            function printing(){
      document.getElementById("printbutton").style.display = "none";
      window.print();
      window.close();
     }

   

        </script>



        <style type="text/css" media="print">
        @page {
            /*size: A5 landscape;*/
            margin: 0;

        }

        body {
            margin: 0;
            padding: 0;
            /* Adjust font size as needed for A5 */
        }


        .admit_card {}


        /* You may need to adjust specific elements' widths, heights, or margins to fit properly within the A5 size. */
        </style>

        </table>
        <script>
        window.print();
        </script>
</body>

</html>