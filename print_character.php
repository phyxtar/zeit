<?php
$page_no = "11";
$page_no_inside = "11_8";
include "include/authentication.php";
$total_grade = 0;
$path = 'images/';
// error_reporting(0);

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="School Management 	" />
    <meta name="keywords" content="School Management   " />
    <title>Character Certificate</title>
    <link rel="stylesheet" href="../dist/fonts/">
    <link href="MonotypeCorsiva-italic.ttf" rel="stylesheet" type="text/css" />
    <link href="https://db.onlinewebfonts.com/c/d85e6ab19860a0a1cc2c3d7a3eb7f98c?family=Corsiva" rel="stylesheet">


    <style type="text/css">
    body {
        text-align: justify;
        padding: 10px;
        font-family: Arial, sans-serif;
    }

    .certificate {
        width: 100%;
        height: 1124.46 px;
        margin: 0 auto;
        text-align: center;
        margin-top: 170.4px;
        /* font-style: italic; */
    }

    .align {
        margin: 0 50px;
        padding: 0;
        line-height: 2;
    }

    .sno {
        /* margin-top: 100px; */
        position: absolute;
        top: -35px;
        right: -11px;
        padding: 10px;
    }

    .title {
        font-size: 40px;
        border-radius: 5px;
        font-weight: bold;
        font-family: 'mono';
        font-style: italic;
        border: 2px solid black;
        display: inline-block;
        padding: 5px;
        line-height: 1;
        margin-bottom: 5px;
        height: 50px;
    }

    .title p {
        margin: 0;
    }

    .student-info {
        text-align: justify;
        margin-bottom: 20px;
        margin-top: 20px;
        font-family: "Corsiva";
        font-size: 25px;
    }

    .signature {
        margin-top: 130px;
        display: flex;
        justify-content: space-between;
        line-height: 1.3;
    }


    .certificate-prov {
        /* margin-top: 30px; */

        border: 7px solid;
        /* background: url('./uploads/mig-bgg.jpg');
            background-size: cover !important; */
    }

    .pro {
        font-size: 17px;
        border-bottom: 8px solid;
        border-radius: 11px;
        /* border: 2px solid black; */
        display: inline-block;
        padding: 10px;
        border-left: 6px solid;
        border-right: 6px solid;
        border-top: 2px solid;
    }

    .content-prov {
        letter-spacing: 1px;
        margin-top: 7px;
        font-family: "Corsiva";
        font-size: 28px;
        font-weight: 600;
    }

    .center-container {
        text-align: center;
        margin-top: 5px;
    }

    .lower-section {
        padding: 10px 90px 7px 65px;
        margin-top: -20px;
    }
    </style>
    <style>
    @media print {
        .certificate-prov {
            background-image: url('./uploads/Picture2.png') !important;
            background-size: cover !important;
            -webkit-print-color-adjust: exact;
            /* Chrome, Safari */
            print-color-adjust: exact;
            /* Firefox */
        }
    }
    </style>
</head>

<body>
    <!-- <?php include 'imp_notice.php'; ?> -->
    <?php


$sql_sign = "SELECT * FROM `tbl_sign` WHERE `des_id` IN ('1')";
 $result_sign = $con->query($sql_sign);

 while ($row_sign = $result_sign->fetch_assoc()) {
     
     if ($row_sign['des_id'] === "1") {
         // Retrieve image data associated with des_id '1' (Assuming it's stored in a column named 'image_data')
         $imageData = $row_sign['image_data']; // Replace 'image_data' with your column name

         // Encode the image data to base64
         $base64Image = base64_encode($imageData);
         $sign_r = $base64Image;
     }
 }
        $admission_id = $_SESSION['user']['admission_id'];
        $student_id = $_GET['student_id'];
        $sql_provisional = "SELECT * FROM `tbl_character` WHERE `student_id` = '$admission_id'";
        $result_provisional = $con->query($sql_provisional);
        $row_provisional = $result_provisional->fetch_assoc();

        

        $admission_id = $_SESSION['user']['admission_id'];
        $sql_allot_semester = "SELECT * FROM tbl_allot_semester WHERE admission_id = '$admission_id'";
        $result_allot_semester = $con->query($sql_allot_semester);
        $row_allot_semester = $result_allot_semester->fetch_assoc();

        $student_id = $_GET['student_id'];
        $admission_id = $_SESSION['user']['admission_id'];
        
        // Fetch provisional data
        $sql_provisional = "SELECT p.*, c.course_name
                            FROM tbl_character p
                            INNER JOIN tbl_course c ON p.course_id = c.course_id
                            WHERE p.student_id = '$student_id'";
        $result_provisional = $con->query($sql_provisional);
        
        if ($result_provisional->num_rows > 0) {
            $row_provisional = $result_provisional->fetch_assoc();
        
            // Get the course name
            $courseName = str_replace(" ", "", $row_provisional['course_name']);
        
            // Get the provisional_id and pad it with leading zeros
            $provisionalId = str_pad($row_provisional['provisional_id'], 3, '0', STR_PAD_LEFT);
        
            // Fetch the examination_month
            $sql_allot_semester = "SELECT * FROM `tbl_allot_semester` WHERE `admission_id` = '$admission_id'";
            $result_allot_semester = $con->query($sql_allot_semester);
            $row_allot_semester = $result_allot_semester->fetch_assoc();
        
            $semester_id = $row_allot_semester['semester_id'];
            $sql_semester = "SELECT `examination_month` FROM `tbl_semester` WHERE `semester_id` = '$semester_id'";
            $result_semester = $con->query($sql_semester);
            $row_semester = $result_semester->fetch_assoc();
        
            // Extract the year from examination_month
            $exam_month = $row_semester['examination_month'];
            $exam_year = substr($exam_month, -4);
        
            // Generate the Sl. No. format
            $slNo = $courseName . $exam_year . '/' . $provisionalId;
        } else {
            // Handle case where no provisional record is found
            $slNo = ''; // Or display an error message
        }
        
        ?>
    <section class="certificate-prov" style="background-image: url('./uploads/Picture2.png'); background-size: cover;">

        <div class="container-fluid">
            <div class='row'>
                <div style="margin-top: -40px;">
                    <h6
                        style="margin: right 60px;float: right;font-family: initial;font-weight: 800;font-size: 16px;margin-top:50px;margin-right: 64px;">
                        Sl.
                        No:
                        <span><?= substr($row_provisional['session'], -4) ?>/<?php echo str_replace("NSU", "", $row_allot_semester["reg_no"]); ?></span>
                        </span>
                    </h6>
                </div>
                <div class='col-md-12'>
                    <img src="./uploads/logo1.png" class="rounded mx-auto d-block" width='10%'>
                </div>
                <h2 class="text-center" style="color: #bd393e;font-weight: 900;font-size: 30px;letter-spacing: 1px;">
                    NETAJI SUBHAS
                    UNIVERSITY, JAMSHEDPUR</h2>
                <h5 class='text-center' style="font-size: 17px;font-weight:800;letter-spacing: 1px;">--- Estd. Under
                    Jharkhand State
                    Private
                    University Act, 2018 ---</h5>
            </div>
            <div class="center-container">
                <h3 class="text-center pro" style="font-weight: 800; letter-spacing: 3px;">CHARACTER CERTIFICATE</h3>
            </div>
            <div class="row">

                <div class="col-md-12 content-prov">
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;This is certify that
                    <b>
                        <?php
                $admission_id = $_SESSION['user']['admission_id'];
                $sql_admission = "SELECT * FROM tbl_admission WHERE admission_id = '$admission_id'";
                $result_admission = $con->query($sql_admission);
                $row_admission = $result_admission->fetch_assoc();
                echo $row_admission["admission_first_name"] . ' ' . $row_admission["admission_middle_name"] . ' ' . $row_admission["admission_last_name"] ?>&nbsp;

                    </b>
                    Son /
                    Daughter of <span> <b>
                            <?php echo $row_admission["admission_father_name"]; ?>,</b></span> having Registration No.
                    <b><?php echo $row_allot_semester["reg_no"] ?></b>
                    and Roll No: <b><?php
                
                echo $row_allot_semester["roll_no"];?>,</b> has been a part of this University in <b><?php
                $course_id = $row_provisional["course_id"];
                $sql_course = "SELECT course_name FROM tbl_course WHERE course_id = '$course_id'";
                $result_course = $con->query($sql_course);
                $row_course = $result_course->fetch_assoc();
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
                    echo "BACHELOR OF  COMPUTER APPLICATION";
                } else if (trim($course_name) == "MCA") {
                    echo "MASTER OF  COMPUTER APPLICATION";
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
                } ?>,</b>
                    for the
                    session
                    <b><?= $row_provisional['session'] ?>.</b>
                    </br>
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;We
                    can proudly bear witness to the student’s
                    excellent morality, ethics and character. Throughout the period of study, he/she has shown no
                    signs
                    of violence or anti-social behaviour toward others, and he/she has nothing on his/her record
                    that
                    would disqualify his/her candidature for future endeavour in due course.
                    </br>
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;We
                    wish him/her all the
                    success in his/her life.
                </div>
            </div>

            <div class="row lower-section">
                <div class="col-md-6">

                    <p style="margin-top: 95px;font-size: 15px;font-weight: 600;text-transform: uppercase;">Date of
                        Issue:
                        <span id="certificateDate">[Date]</span>
                    </p>
                </div>
                <div class="col-md-6 reg">
                    <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="Registrar Image"
                        style="width: 27%;top: 20px;content: &quot;&quot;;filter: invert(0);position: relative;left: 29px;">
                    <p style="font-size: 15px;font-weight: 500;text-transform: uppercase;font-weight: 600;">
                        Registrar
                    </p>
                </div>
            </div>
            <style>
            .reg {
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                align-items: flex-end;
            }
            </style>



        </div>

    </section>

    <script>
    var currentDate = new Date();
    var options = {
        weekday: 'long',
        month: 'long',
        day: 'numeric',
        year: 'numeric'
    };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);
    document.getElementById("certificateDate").textContent = formattedDate;
    </script>
    <script>
    window.onload = function() {
        // Set the print settings for A4 landscape format
        var style = document.createElement('style');
        style.type = 'text/css';
        style.media = 'print';
        style.innerHTML = '@page { size: A4 landscape; }';
        document.head.appendChild(style);

        window.print();
    };
    </script>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>


</html>