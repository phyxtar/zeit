<?php
include "include/authentication.php"; 
error_reporting(0);
// echo $_SESSION["logger_username1"];
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="School Management 	" />
    <meta name="keywords" content="School Management   " />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://db.onlinewebfonts.com/c/d85e6ab19860a0a1cc2c3d7a3eb7f98c?family=Corsiva" rel="stylesheet">
    <title> NETAJI SUBHAS UNIVERSITY : Migration Certificate</title>
    <style type="text/css">
    body {
        font-family: 'Poppins', sans-serif !important;
        font-family: 'PT Serif', serif;
    }

    .bg-logo {
        /* border: 5px solid; */
        position: relative;
    }

    .bg-logo::after {
        background-position: center;
        content: '';
        position: absolute;
        top: 100px;
        left: 50px;
        width: 90%;
        height: 90%;
        background-image: url(../uploads/table_bg.jpg);
        opacity: 0.1;
        background-size: cover;

    }

    .migration-header {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .migration-header h5 {
        font-size: 40px;
        font-family: 'PT Serif', serif;
        text-transform: uppercase;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        letter-spacing: 3px;
    }

    .migration_cum h3 {
        text-transform: uppercase;
        font-weight: 600;
        font-size: 19px;
        letter-spacing: 1px;
        margin-bottom: 0 !important;
    }

    .migration_cum p {
        font-size: 16px;
        font-weight: normal;
    }

    .content_pra {
        font-size: 19px;
    }

    span {
        font-family: "Corsiva" !important;
        letter-spacing: 1px;
        font-size: 30px;
    }

    .span-date {
        letter-spacing: 1px !important;
        font-family: "Corsiva" !important;
    }

    .migration_footer {
        margin-top: 45px;
        padding: 0 20px 0 20px;
    }

    .content_heading p {
        margin-bottom: 15px !important;
        font-size: 19px;
        font-weight: 500;
    }

    .narmal {
        font-family: tahoma;
        padding: 2px;
        font-size: 10px;
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
        font-size: 22px;
        /*font-family: Verdana, Arial, Helvetica, sans-serif;
	font-family:Belwec;*/
        font-weight: bold;
    }

    .border1 {
        border-bottom: #000000;
        border-top: #000000;
    }

    .admin {
        font-family: tahoma;
        font-size: 14px;
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

    .row2 {
        font-weight: 600;
        margin-top: 10px;
        margin-left: 5%;
        margin-right: 5%;
        display: flex;
        justify-content: space-between;
    }

    .row3 {
        font-weight: 600;
        padding-top: 15px;
        margin-left: 5%;
        margin-right: 5%;
        font-size: 18px;
    }

    .row4 {
        font-weight: 600;
        padding-top: 30px;
        margin-left: 10%;
        margin-right: 10%;
        display: flex;
        justify-content: space-between;
    }

    .rowpara {
        padding: 10px;
        font-size: 18px;
        font-weight: 600;
        margin-left: 5%;
        /* padding-top: 10px; */
        text-align: left;
    }

    .undeline {
        font-size: 35px;
        /* text-decoration:underline;
        width: 100%; */
        border-bottom: 3px dotted black;
        /* Creates the dotted line */
        flex-grow: 1;
        /* Allows the dotted line to take up remaining space */
        margin-left: 10px;
    }

    .undelinedate {
        /* font-size:35px; */
        /* text-decoration:underline;
        width: 100%; */
        border-bottom: 3px dotted black;
        /* Creates the dotted line */
        flex-grow: 1;
        /* Allows the dotted line to take up remaining space */
        margin-left: 10px;
    }

    table p {
        font-family: 'Montserrat', sans-serif;
    }
    </style>
    <link href="dist/css/violet.css" rel="stylesheet" type="text/css" />
</head>
<?php
 $sql_sign = "SELECT * FROM `tbl_sign` WHERE `des_id` IN ('1', '6')";
 $result_sign = $con->query($sql_sign);

 while ($row_sign = $result_sign->fetch_assoc()) {
     if ($row_sign['des_id'] === "6") {
         // Retrieve image data associated with des_id '1' (Assuming it's stored in a column named 'image_data')
         $imageData = $row_sign['image_data']; // Replace 'image_data' with your column name

         // Encode the image data to base64
         $base64Image = base64_encode($imageData);
         $sign_r = $base64Image;
     }
     if ($row_sign['des_id'] === "1") {
         // Retrieve image data associated with des_id '1' (Assuming it's stored in a column named 'image_data')
         $imageData2 = $row_sign['image_data']; // Replace 'image_data' with your column name

         // Encode the image data to base64
         $base64Image2 = base64_encode($imageData2);
         $sign_r2 = $base64Image2;
     }
 }
?>

<body class="" style="">
    <?php include 'imp_notice.php'; ?>
    <!-- <p style="position: fixed;right: 3%;">
        <a href="" id="printbutton" value="&nbsp;Print" onclick="return printing();"><img src="images/print.jpg" style="height: 80px;"></a>
    </p> -->
    <table width="740" border="0" align="center" class="bg-logo" style="margin-top: 10mm;">
        <tr>
            <td align="right" valign="top">
                <table width="100%" border="0" align="center">
                    <tr <td width="8%" rowspan="4" align="center" valign="top">
                        <div class="migration-header">
                            <img src="../uploads/logo1.png" width="15%" class="mt-2" alt="">
                            <h5 class='migration_head'>netaji subhas university</h5>
                            <div class="lower-content">
                                <p
                                    style="margin-bottom: 0 !important;font-size: 18px;letter-spacing: 6px;margin-top: 7px;border-bottom: 2px solid;">
                                    <b>
                                        JAMSHEDPUR</b></p>
                                <p
                                    style="margin-top: 7px;font-size: 13px;font-weight: 600;font-style: italic;margin-bottom: 0;">
                                    Estd.
                                    under Jharkhand
                                    State
                                    Private
                                    University Act, 2018</p>
                            </div>
                            <div class='migration_cum'>
                                <h3 style="">migration - cum - transfer certificate</h3>
                                <p style="margin:0;"><b>(For Candidates Leaving the University)</b></p>
                            </div>
                        </div>
            </td>
        </tr>
        <?php
        $admission_id = $_SESSION['user']['admission_id'];
        $sql_migration = "SELECT * FROM `tbl_migration_form` WHERE `admission_id` = '$admission_id'";
        $result_migration = $con->query($sql_migration);
        $row_migration = $result_migration->fetch_assoc();
        
       ?>


        <tr>
            <td>
                <div class="row2">
                    <p>SI No.: NSU
                        /<span><?php echo '0' . str_pad($row_migration['migration_id'], 2, '0', STR_PAD_LEFT); ?></span>/
                        <?php echo date("Y"); ?></p>
                    <p>Date : <span class="undelinedate"><?php echo date("d-m-Y"); ?></span></p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <p class="row3">Miss / Mr. / Mrs : &nbsp;&nbsp;
                    <span class="undeline">
                        <?php 
                // Fetch the candidate name from the database
                $candidateName = $row_migration['candidate_name'];
                
                // Convert the name to lowercase and then capitalize the first letter of each word
                $formattedName = ucwords(strtolower($candidateName));
                
                // Output the formatted name
                echo $formattedName; 
            ?>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="row3">S/o / D/o / W/o : &nbsp;&nbsp;
                    <span class="undeline">
                        <?php 
                    // Fetch the father's name from the database
                    $fatherName = $row_migration['father_name'];
                    
                    // Convert the name to lowercase and then capitalize the first letter of each word
                    $formattedFatherName = ucwords(strtolower($fatherName));
                    
                    // Output the formatted name
                    echo $formattedFatherName; 
                ?>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </p>
            </td>
        </tr>

        <tr>
            <td>
                <p class="row3">Registration No : &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <span
                        class="undeline"><?php echo $row_migration['registration_no']; ?>&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;</span></p>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                $admission_id = $_SESSION['user']['admission_id'];
                $sql_admission_date = "SELECT date_of_admission FROM `tbl_admission` WHERE `admission_id` = '$admission_id'";
                $result_admission_date = $con->query($sql_admission_date);
                $row_admission_date = $result_admission_date->fetch_assoc();
                $year_of_admission = date("Y", strtotime($row_admission_date['date_of_admission']));
                ?>
                <p class="row3">Year of Admission : &nbsp;<span
                        class="undeline"><?php echo $year_of_admission; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;</span></p>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                $course_id = $row_migration['course_id'];
                $sql_course = "SELECT course_name FROM `tbl_course` WHERE `course_id` = '$course_id'";
                $result_course = $con->query($sql_course);
                $row_course = $result_course->fetch_assoc();
                ?>
                <p class="row3">Branch / Department : &nbsp;<span
                        class="undeline"><?php echo $row_course['course_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
            </td>
        </tr>
    </table>
    <p class="rowpara">Is informed that the University has no objection to Her / His Migration to another University.
    </p>
    <div class="row4">
        <div>
            <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>"
                style="top: -2px;height: 50px;width: 130px;content: &quot;&quot;;position: relative;margin-left: 45px;filter: invert(0);">
            <p>Administrative Officer</p>
        </div>
        <div>
            <img src="data:image/jpeg;base64,<?php echo $base64Image2; ?>"
                style="top: -2px;height: 50px;width: 130px;content: &quot;&quot;;position: relative;margin-left: 45px;filter: invert(0);">
            <p>Registrar</p>
        </div>
    </div>
    <p>
    <p>

        </td>
        </tr>

        </table>

        </td>
        </tr>

        <script type="text/javascript">
        function getfieldvalues() {
            if (document.getElementById('sameaddress').checked) {
                //alert("checked");
                document.preadmission.pre_address.value = document.preadmission.pre_address1.value;
                document.preadmission.pre_city.value = document.preadmission.pre_city1.value;
                document.preadmission.pre_pincode.value = document.preadmission.pre_pincode1.value;
                document.preadmission.pre_phno.value = document.preadmission.pre_phno1.value;
                document.preadmission.pre_state.value = document.preadmission.pre_state1.value;


                document.preadmission.pre_mobile.value = document.preadmission.pre_mobile1.value;
                document.preadmission.pre_country.value = document.preadmission.pre_country1.value;
            } else {
                document.preadmission.pre_address.value = "";
                document.preadmission.pre_city.value = "";
                document.preadmission.pre_pincode.value = "";
                document.preadmission.pre_phno.value = "";
                document.preadmission.pre_state.value = "";


                document.preadmission.pre_mobile.value = "";
                document.preadmission.pre_country.value = "";
            }
        }

        function open_sub(val) {
            popup_letter('?pid=94&action=display_sub&scat_id=' + val);
        }
        </script>
        <script type="text/javascript">
        function popup_letter(url) {
            var width = 500;
            var height = 300;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            var params = 'width=' + width + ', height=' + height;
            params += ', top=' + top + ', left=' + left;
            params += ', directories=no';
            params += ', location=no';
            params += ', menubar=no';
            params += ', resizable=no';
            params += ', scrollbars=yes';
            params += ', status=no';
            params += ', toolbar=no';
            newwin = window.open(url, 'windowname5', params);
            if (window.focus) {
                newwin.focus()
            }
            return false;
        }
        </script>

        <iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js"
            src="includes/js/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0"
            style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
        </iframe>



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
            size: A5;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }
        </style>
        </table>
</body>

</html>