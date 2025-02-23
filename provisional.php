<?php
$page_no = "11";
$page_no_inside = "11_8";
include "include/authentication.php";
include_once "include/function.php";
include_once "./framwork/main.php";
$total_grade = 0;
$path = 'images/';
// error_reporting(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="School Management 	" />
    <meta name="keywords" content="School Management   " />
    <title>Provisional Certificate</title>
    <link rel="stylesheet" href="../dist/fonts/">
    <link href="MonotypeCorsiva-italic.ttf" rel="stylesheet" type="text/css" />
    <link href="https://db.onlinewebfonts.com/c/d85e6ab19860a0a1cc2c3d7a3eb7f98c?family=Corsiva" rel="stylesheet">


    <style type="text/css">
        body {
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
            /* Remove default margin from the paragraph */
        }

        .student-info {
            text-align: justify;
            margin-bottom: 20px;
            margin-top: 20px;
            /* font-family: 'Monotype Corsiva'; */
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
            margin-top: -8px;
            /* background-size: cover !important;
            background: url('./uploads/mig-bg.jpg'); */
            /* padding: 20px; */
            border: 5px solid;
            /* background: url('./uploads/mig-bgg.jpg');
            background-size: cover !important; */
        }

        .pro {
            font-size: 20px;
            border-bottom: 5px solid;
            border-radius: 11px;
            /* border: 2px solid black; */
            display: inline-block;
            padding: 10px;
            border-left: 5px solid;
            border-right: 5px solid;
            border-top: 2px solid;
        }

        .content-prov {
            letter-spacing: 1px;
            margin-top: 7px;
            font-family: "Corsiva";
            font-size: 32px;
        }

        .center-container {
            text-align: center;
            margin-top: 15px;
        }

        .lower-section {
            padding: 10px 90px 7px 65px;
            margin-top: -20px;
        }
    </style>
    <style>
        @media print {
            .certificate-prov {
                background-image: url('./uploads/mig-bgg.jpg') !important;
                background-size: cover !important;
                /* Other background properties as needed */
            }
        }
    </style>
</head>

<body>


    <?php
    $sql_create_tbl = "CREATE TABLE IF NOT EXISTS tbl_provisional (
    `provisional_id` int(11) NOT NULL AUTO_INCREMENT,
    `student_id` varchar(255) NOT NULL,
    `session` varchar(255) NOT NULL,
    `course_id` int(11) NOT NULL,
    `date_and_time` DATETIME NOT NULL,
    `status` varchar(255) NOT NULL,
    PRIMARY KEY (`provisional_id`)
)";
    if ($conn->query($sql_create_tbl) === TRUE) {
        // echo "Table 'tbl_provisional' created successfully!!!";
    } else {
        echo "Error creating table: " . $conn->error;
    }

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



    // echo  $_GET['id'];
    $sql_semester = "SELECT * FROM `tbl_allot_semester` WHERE reg_no = '" . $_GET['id'] . "'";
    $result_semester = mysqli_query($con, $sql_semester);
    $allot_semester = mysqli_fetch_assoc($result_semester);





    $sql = "SELECT *, tbl_admission.admission_id
FROM tbl_admission
INNER JOIN tbl_allot_semester ON tbl_admission.admission_id = tbl_allot_semester.admission_id
WHERE tbl_admission.status = '$visible' AND tbl_admission.admission_id = '" . $allot_semester['admission_id'] . "' AND tbl_allot_semester.allot_id = '" . $allot_semester['allot_id'] . "' ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql_course = "SELECT * FROM `tbl_course`
    WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
    ";
    $result_course = $con->query($sql_course);
    $row_course = $result_course->fetch_assoc();

    $sql_semester = "SELECT * FROM `tbl_semester`
    WHERE `status` = '$visible'  && `course_id` = '" . $row["course_id"] . "'
    ORDER BY `examination_month` DESC;
   ";
    $result_semester = $con->query($sql_semester);
    $row_semester = $result_semester->fetch_assoc();

    $sql_roll = "SELECT * FROM `tbl_allot_semester` WHERE `status` = '$visible' 
                                && `course_id` = '" . $row["course_id"] . "'
                                 && `admission_id` = '" . $row["admission_id"] . "'
                                ORDER BY `allot_id` ASC
                                ";
    $roll_no = $con->query($sql_roll);
    $roll = $roll_no->fetch_assoc();
    $currentDateTimeObj = new DateTime(); // Create a DateTime object initialized with the current date and time
    $currentDateTime = $currentDateTimeObj->format('Y-m-d H:i:s');

    if (isset($_GET['id'])) {
        $sql_provisional = "SELECT * FROM `tbl_provisional` WHERE `student_id`='" . $_GET['id'] . "' AND `session`='" . get_session($row["admission_session"]) . "' AND `course_id`='" . $row["course_id"] . "'";
        $result_provisional = $con->query($sql_provisional);
        if ($result_provisional->num_rows > 0) {
            $row_provisional = $result_provisional->fetch_assoc();
        } else {
            $sql_provisional = "INSERT INTO `tbl_provisional` (`student_id`, `session`, `course_id`,`date_and_time`, `status`) VALUES ('" . $_GET['id'] . "','" . get_session($row["admission_session"]) . "'," . $row["course_id"] . ",'" . $currentDateTime . "', 'active');";
            $result_provisiona = $con->query($sql_provisional);

            $sql_provisional = "SELECT * FROM `tbl_provisional` WHERE `student_id`='" . $_GET['id'] . "' AND `session`='" . get_session($row["admission_session"]) . "' AND `course_id`='" . $row["course_id"] . "'";
            $result_provisional = $con->query($sql_provisional);
            $row_provisional = $result_provisional->fetch_assoc();
        }
        $serialNumber = $row_provisional['provisional_id'];
        $formattedSerialNumber = str_pad($serialNumber, 5, '0', STR_PAD_LEFT);
        $course_name2 = $row_course['course_name'];
        $course_name2 = $row_course['course_name'];

        $sql_sign = "SELECT * FROM `tbl_sign` WHERE `des_id` = '1'";
        $result_sign = $con->query($sql_sign);
        $row_sign = $result_sign->fetch_assoc();


        if ($row_course['course_name'] === 'Diploma in Engineering - Lateral') {
            $course_name2 = 'Dip-Engg.';
        }
        $date = date("y-m-d");
        $year = $year = date("Y", strtotime($date));
    ?>

        <section class="certificate-prov" style="background-image: url('./uploads/mig-bgg.jpg'); background-size: cover;">

            <div class="container-fluid">
                <div class='row'>
                    <div style="margin-top: -40px;">
                        <h6 style="margin: right 60px;float: right;font-family: initial;font-weight: 800;font-size: 16px;margin-top:50px;margin-right: 64px;">
                            Sl.
                            No:
                            <span>NSU/
                                <?= $course_name2 . $year . "/" . $formattedSerialNumber ?>
                            </span>
                        </h6>
                    </div>
                    <div class='col-md-12'>
                        <img src="./uploads/logo1.png" class="rounded mx-auto d-block" width='10%'>
                    </div>
                    <h2 class="text-center" style="color: #bd393e;font-weight: 900;font-size: 35px;letter-spacing: 1px;">
                        NETAJI SUBHAS
                        UNIVERSITY, JAMSHEDPUR</h2>
                    <h5 class='text-center' style="font-size: 19px;font-weight:800;letter-spacing: 1px;">--- Estd. Under
                        Jharkhand State
                        Private
                        University Act, 2018 ---</h5>
                </div>
                <div class="center-container">
                    <h3 class="text-center pro" style="font-weight: 700; letter-spacing: 3px;">PROVISIONAL CERTIFICATE</h3>
                </div>
                <div class="row">
                    <?php
                    $sql_session = "SELECT * FROM `tbl_university_details` WHERE `status` = '" . $visible . "' AND `university_details_id` =  '" . $row['admission_session'] . "'";

                    $result_session = $con->query($sql_session);
                    $row_session = $result_session->fetch_assoc();

                    $completeSessionStart = explode("-", $row_session["university_details_academic_start_date"]);
                    $completeSessionEnd = explode("-", $row_session["university_details_academic_end_date"]);
                    $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                    ?>
                    <div class="col-md-12 content-prov">
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;This is certify that Miss / Mr. / Mrs.
                        <b>&nbsp;
                            <?php echo $row["admission_first_name"] ?>&nbsp;
                            <?php echo $row["admission_middle_name"] ?>&nbsp;
                            <?php echo $row["admission_last_name"] ?>
                        </b>
                        Son /
                        Daughter of <b>
                            <?php echo $row["admission_father_name"]; ?>
                            Roll No.&nbsp;
                            <?php echo $roll["roll_no"] ?> Registration
                            No.&nbsp;
                            <?php echo $row["admission_id"] ?>
                        </b>
                        of Session&nbsp;<b>
                            <?= $completeSessionOnlyYear ?>
                        </b> of <b>Netaji Subhas University,
                            Jamshedpur,</b> has
                        been declared to have
                        passed the
                        <b>
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
                            } ?>,
                        </b>
                        <?php
                        $exam_month = $row_semester['examination_month']; // Assuming $row_semester['examination_month'] contains "JAN'2020"
                        $year = substr($exam_month, -4); // Extracting the last 4 characters (the year)
                        // Output: 2020
                        ?>
                        (Under Semester System) Examination-
                        <?php echo $year; ?> held
                        in the month of &nbsp;&nbsp;
                        <?php echo $row_semester['examination_month']; ?>&nbsp;&nbsp;
                        with <b>First Class with Distinction..</b>
                    </div>
                </div>

                <div class="row lower-section">
                    <!-- <div class="col-md-6">
                        <h6 style="margin-top: 100px;font-family: initial;font-weight: 800;font-size: 20px;">Date of Issue:
                            <span id="certificateDate">[Date]</span>
                        </h6>
                    </div> -->

                    <!-- <div class="col-md-6 text-right">
                        <div style="display: flex; flex-direction: column-reverse; align-items: flex-end;">
                            <h6 style="font-family: initial; font-weight: 800; font-size: 20px; text-transform:uppercase;">
                                <?php echo $row_sign['designation']; ?>
                            </h6>
                            <?php echo "<img src='data:image/jpeg;base64," . base64_encode($row_sign["image_data"]) . "' alt='Uploaded Image' width='50' height='50'>"; ?>
                        </div>
                    </div> -->
                    <div class="col-md-6">

                        <p style="margin-top: 95px;font-size: 15px;font-weight: 600;text-transform: uppercase;">Date of
                            Issue:
                            <span id="certificateDate">[Date]</span>
                        </p>
                    </div>
                    <div class="col-md-6 reg">
                        <img src="data:image/jpeg;base64,<?php echo $base64Image2; ?>" alt="Registrar Image" style="width: 30%;">
                        <p style="font-size: 15px;font-weight: 500;text-transform: uppercase;font-weight: 600;">Registrar
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
                window.print();
            };
        </script>
    <?php } ?>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>


</html>