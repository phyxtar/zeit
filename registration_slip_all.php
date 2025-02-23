<?php
// include "framwork/main.php";
// include "include/authentication.php";
include "include/config.php";
include "include/function.php";
$visible = md5("visible");
$course_id = $_POST["course_id"];
$academic_year = $_POST["academic_year"];
$semester_id = $_POST["semester_id"];
// echo $course_id ."/". $academic_year ."/". $semester_id;
 ERROR_REPORTING(0);
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="School Management 	" />
    <meta name="keywords" content="School Management" />
    <title> NETAJI SUBHAS UNIVERSITY : Registration Slip</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <link rel="stylesheet" href="../srinath/dist/fonts/">

    <link href="../student/dist/css/violet.css" rel="stylesheet" type="text/css" />
</head>
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

.bg {
    background-size: cover;
    background-image: url('uploads/Picture2.png');
}
</style>
<link href="../student/dist/css/violet.css" rel="stylesheet" type="text/css" />

<body class="body_pop" style="color:#0d1065;">

    <?php
    $sql_sign = "SELECT * FROM `tbl_sign` WHERE `des_id` IN ('1')";
    $result_sign = $con->query($sql_sign);
    $sign_r = '';
    while ($row_sign = $result_sign->fetch_assoc()) {
        if ($row_sign['des_id'] === "1") {
            $imageData = $row_sign['image_data'];
            $base64Image = base64_encode($imageData);
            $sign_r = $base64Image;
        }
    }
  

    $sql = "SELECT * FROM `tbl_registration_form` WHERE `status` = '$visible' && `academic_year` = '$academic_year' && `course_id` = '$course_id' && `semester_id`='$semester_id'
    ";
$result = $con->query($sql);
             
    ?>

    <?php
            while ($row = $result->fetch_assoc()) {
                ?>
    <div class='bg'>
        <table width="740" border="0" align="center" class="tb2_grid"
            style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin-top: 40px;">

            <tr>
                <td align="right" valign="top">

                <td align="right" valign="top">
                    <table width="100%" border="0">
                        <td width="8%" rowspan="4" align="center" valign="top">
                            <div class="lo" style="border-right: 1px solid;padding-right: 5px;">
                                <img src="./uploads/logo1.png" width="100" height="" alt="Image" border="0"
                                    title="Images" style="">
                            </div>
                        </td>
                        <tr>

                            <td align="center" valign="top"><span class="style1"
                                    style="border-bottom: 3px solid;color:#c70013;font-size: 24px;">NETAJI
                                    SUBHAS UNIVERSITY,
                                    JAMSHEDPUR

                                </span></td>

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
                        <ul style="margin-top:-112px; margin-left: -188px text-align: center"><u
                                style="font-size: 16px;">REGISTRATION SLIP</u>
                    </span></td>
            </tr>

        </table>

        <tr>
            <table width="740" align="center" style='margin-top: -158px;'>
                <td height="85" colspan="3">
                    <tr>
                        <script type="text/javascript">
                        document.title = "Netaji Subhas University : Registration Slip";
                        </script>

                    <tr class="">

                        <td align="left" valign="top">

                            <table width="740px" class="" style="margin-left: 0px; border: 1px solid black;">
                                <tr class="">
                                    <td>
                                        <table style="border-bottom: 0; width: 100.4%; text-align: center;">
                                            <tr>
                                                <td colspan="3" class="tb1_grid" style="vertical-align: middle;">
                                                    <span class="admin" style="word-spacing: -1px;">
                                                        REGISTRATION NO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php echo $row["registration_no"]; ?>
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid"
                                                    style="border-left: 1px solid; vertical-align: middle;">
                                                    <span class="admin" style="word-spacing: -1px;">
                                                        Apaar ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php echo $row["abc_id"]; ?>
                                                    </span>
                                                </td>
                                                <!-- <td colspan="3" class="tb1_grid"
                                                    style="border-left: 1px solid; vertical-align: middle;">
                                                    <span class="admin" style="word-spacing: -1px;">
                                                        YEAR OF REGISTRATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php echo date('Y', strtotime($row["update_time"])); ?>
                                                    </span>
                                                </td> -->
                                                <td colspan="3" class="tb1_grid"
                                                    style="border-left: 1px solid; vertical-align: middle;">
                                                    <span class="admin" style="word-spacing: -1px;">
                                                        YEAR OF REGISTRATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php
                                                        $reg_year = "SELECT * FROM `tbl_university_details` WHERE `university_details_id` = '". $row['academic_year'] ."'";
                                                        $result_reg_year = $con->query($reg_year);
                                                        $row_reg_year = $result_reg_year->fetch_assoc();
                                                        echo date('Y', strtotime($row_reg_year["university_details_academic_start_date"])); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table width="740px" class=""
                                style="margin-left: 0px;/* border: 1px solid black; */border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;">
                                <tr class="">
                                    <td>
                                        <table style="border-bottom: 0;width: 100.4%;margin-bottom: -15px;">
                                            <tr style="position: relative;top: -4px;">
                                                <td colspan="3" class="tb1_grid" width='30'>
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php echo $row["candidate_name"] ?>
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">

                                                        &nbsp;&nbsp;<?php // Display the student image here ?>
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        <img src="./student/images/regstudent_images/<?php echo $row["passport_photo"]; ?>"
                                                            style="width: 100px; height: 94px; margin-left: 25px; display: block; border: 1px solid #ccc;"
                                                            alt='Passport Photo'>
                                                        &nbsp;&nbsp;<?php // Display the student image here ?>
                                                    </span>
                                                </td>
                                            </tr>

                                            <!-- Father's Name Row -->
                                            <tr style="position: relative;top: -5px;">
                                                <td colspan="3" class="tb1_grid" width='30'>
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        FATHER'S NAME
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php echo $row["father_name"] ?>
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        <!-- You can add additional info or keep it empty -->
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        <!-- You can add additional info or keep it empty -->
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr style="position: relative;top: -7px;">
                                                <td colspan="3" class="tb1_grid" width='30'>
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        MOTHER'S NAME
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php echo $row["mother_name"] ?>
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        <!-- You can add additional info or keep it empty -->
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        <!-- You can add additional info or keep it empty -->
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr style="position: relative;top: -9px;">
                                                <td colspan="3" class="tb1_grid" width='30'>
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        GENDER
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php echo $row["gender"] ?>
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        <!-- You can add additional info or keep it empty -->
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        <!-- You can add additional info or keep it empty -->
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr style="position: relative;top: -11px;">
                                                <td colspan="3" class="tb1_grid" width='30'>
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        DOB (DD-MM-YYYY)
                                                        &nbsp;&nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;<?php echo $row["dob"] ?>
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="right: 176px;position: absolute;word-spacing: -1px;">
                                                        Candidate Signature
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute;word-spacing: -1px;">
                                                        <!-- You can add additional info or keep it empty -->
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table width="740px" class=""
                                style="margin-left: 0px;/* border: 1px solid black; */border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;">
                                <tr class="">
                                    <td>
                                        <table
                                            style="margin-bottom: -8px;position: relative;height: 50px;border-bottom: 0;width:100.4%;top: -4px;">
                                            <tr>
                                                <td colspan="3" class="tb1_grid" width='30' align='center'>
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="left: 190px;position: absolute;word-spacing: -1px;">
                                                        <U>COURSE DETAILS</U>

                                                        <?php
                                                    $sql_course="SELECT * FROM `tbl_course` WHERE
                                                        `status`='$visible' && `course_id`='" . $row["course_id"]
                                                        . "' ; " ; $result_course=$con->query($sql_course);
                                                        $row_course = $result_course->fetch_assoc();

                                                        ?>
                                                        <br><?php echo $row_course["course_name"] ?>
                                                    </span>
                                                </td>

                                                <td colspan=" 3" class="tb1_grid" style="border-left: 1px solid;"
                                                    align='center'>
                                                    &nbsp;&nbsp;
                                                    <span class="admin"
                                                        style="position:absolute;word-spacing: -1px;top: -15px;right: -275px;">
                                                        <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>"
                                                            style="display: block;margin: 0px auto;/* height: 14px; */width: 15%;object-fit: contain;filter: invert(0);top: 13px;position: relative;">
                                                        REGISTRAR
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>


                            <table width="740px"
                                style="margin-left: 0px; border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid;">
                                <tr>
                                    <td>
                                        <table style="height: 35px; border-bottom: 0; width: 100.4%;">
                                            <tr>
                                                <td colspan="3" class="tb1_grid" width="15">
                                                    &nbsp;&nbsp;<span class="admin"
                                                        style="position: absolute; word-spacing: -1px;">
                                                        Important Instructions
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                                        &nbsp;&nbsp;Please keep this slip safely for future reference
                                                        <br>
                                                        <span style="position: relative; left: 139px;">
                                                            Please ensure all the information printed are correct
                                                        </span>
                                                    </span>
                                                </td>
                                                <td colspan="3" class="tb1_grid" style="border-left: 1px solid;">
                                                    &nbsp;&nbsp;
                                                    <span class="admin"
                                                        style="margin-left: -15px; position: absolute; word-spacing: -1px; margin-top: -16px;">
                                                        <canvas
                                                            id="barcode-<?php echo $row["registration_no"]; ?>"></canvas>
                                                        <!-- Barcode Canvas -->
                                                        <div id="barcode-text-<?php echo $row["registration_no"]; ?>">

                                                        </div>
                                                        <script>
                                                        document.addEventListener("DOMContentLoaded", function() {
                                                            // Generate barcode with JsBarcode
                                                            JsBarcode(
                                                                "#barcode-<?php echo $row["registration_no"]; ?>",
                                                                "<?php echo $row["registration_no"]; ?>", {
                                                                    format: "CODE128",
                                                                    width: 1.53, // Adjust barcode line width (smaller value for smaller barcode)
                                                                    height: 30, // Adjust height
                                                                    displayValue: false, // Don't show the text (registrationNo)
                                                                    lineColor: "#000000", // Color of the barcode bars
                                                                    background: null // Set background to transparent
                                                                });
                                                        });
                                                        </script>
                                                    </span>
                                                    <script>

                                                    </script>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>

                    <tr>
                        <td colspan="7" align="left" valign="top"></td>
                    </tr>
            </table>
            </td>
        </tr>
        <p>
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
            /* Assuming each slip is wrapped in a generic container like a div */
            @media print {

                div:nth-of-type(3n),
                section:nth-of-type(3n) {
                    page-break-after: always;
                }

                div,
                section {
                    page-break-inside: avoid;
                }

                div:last-of-type,
                section:last-of-type {
                    page-break-after: auto;
                }
            }




            /* You may need to adjust specific elements' widths, heights, or margins to fit properly within the A5 size. */
            </style>


            </table>
            <style>
            @media print {
                @page {
                    size: auto;
                    margin: 0;
                    /* Remove default margins */
                    transform: scale(1.55);
                    /* This may not apply directly in some browsers */
                }

                body {
                    zoom: 1.55;
                    /* Scale content */
                    margin: 0;
                    /* Ensure no extra margins */
                }
            }
            </style>

            <script>
            window.print();
            </script>
    </div>

    <?php } ?>

    <script type="text/javaScript">
        function printing(){
      document.getElementById("printbutton").style.display = "none";
      window.print();
      window.close();
     }

  </script>





</body>

</html>