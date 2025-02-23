<?php
$page_no = "11";
$page_no_inside = "11_9";
include "include/authentication.php";
include_once "include/function.php";
include_once "framwork/main.php";
$total_grade = 0;
$path = 'images/';
// error_reporting(0);

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,400;1,500;1,600&display=swap"
        rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="School Management 	" />
    <meta name="keywords" content="School Management   " />
    <title>Migration Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="MonotypeCorsiva-italic.ttf" rel="stylesheet" type="text/css" />
    <link href="https://db.onlinewebfonts.com/c/d85e6ab19860a0a1cc2c3d7a3eb7f98c?family=Corsiva" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif !important;
            font-family: 'PT Serif', serif;
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
            font-size: 30px;
            font-family: 'PT Serif', serif;
            text-transform: uppercase;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            letter-spacing: 3px;
        }

        .bg-logo {
            /* border: 5px solid; */
            position: relative;
        }

        .bg-logo::after {
            background-position: center;
            content: '';
            position: absolute;
            top: 78px;
            left: 70px;
            width: 90%;
            height: 100%;
            background-image: url(./uploads/logo1.png);
            opacity: 0.1;
            z-index: -1;
            background-size: contain;
            background-repeat: no-repeat;
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
    </style>
</head>

<body>
    <?php
    $sql_create_tbl = "CREATE TABLE IF NOT EXISTS tbl_migration (
    `migration_id` int(11) NOT NULL AUTO_INCREMENT,
    `student_id` varchar(255) NOT NULL,
    `session` varchar(255) NOT NULL,
    `course_id` int(11) NOT NULL,
    `date_and_time` varchar(255) NOT NULL,
    `status` varchar(255) NOT NULL,
    PRIMARY KEY (`migration_id`)
)";

    if ($conn->query($sql_create_tbl) === TRUE) {
        // echo "Table 'tbl_provisional' created successfully!!!";
    } else {
        echo "Error creating table: " . $conn->error;
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

    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";
    
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
    $currentDateTimeObj = new DateTime(); // Create a DateTime object initialized with the current date and time
    $currentDateTime = $currentDateTimeObj->format('Y-m-d H:i:s');

    if (isset($_GET['id'])) {

        $sql_migration = "SELECT * FROM `tbl_migration` WHERE `student_id`='" . $_GET['id'] . "' AND `session`='" . get_session($row["admission_session"]) . "' AND `course_id`='" . $row["course_id"] . "'";
        $result_migration = $con->query($sql_migration);
        if ($result_migration->num_rows > 0) {
            $row_migration = $result_migration->fetch_assoc();
        } else {
            $sql_migration = "INSERT INTO `tbl_migration` (`student_id`, `session`, `course_id`,`date_and_time`, `status`) VALUES ('" . $_GET['id'] . "','" . get_session($row["admission_session"]) . "'," . $row["course_id"] . ",'" . $currentDateTime . "', 'active');";

            $result_provisional = $con->query($sql_migration);

            $sql_migration = "SELECT * FROM `tbl_migration` WHERE `student_id`='" . $_GET['id'] . "' AND `session`='" . get_session($row["admission_session"]) . "' AND `course_id`='" . $row["course_id"] . "'";
            $result_migration = $con->query($sql_migration);
            $row_migration = $result_migration->fetch_assoc();
            $result_migration = $con->query($sql_create_tbl);
        }
        $serialNumber = $row_migration['migration_id'];
        $formattedSerialNumber = str_pad($serialNumber, 5, '0', STR_PAD_LEFT);
        $date = date("y-m-d");
        $year = date("Y", strtotime($date));

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



        <section>
            <div class="container migration">
                <div class="row">
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-8 bg-logo">
                        <div class="migration-header">
                            <img src="./uploads/logo1.png" width="15%" class="mt-2" alt="">
                            <h5 class='migration_head'>netaji subhas university</h5>
                            <div class="lower-content">
                                <p
                                    style="margin-bottom: 0 !important;font-size: 18px;letter-spacing: 6px;margin-top: 7px;border-bottom: 2px solid;">
                                    JAMSHEDPUR</p>
                                <p style="font-size: 13px;font-weight: 600;font-style: italic;">Estd. under Jharkhand State
                                    Private
                                    University Act, 2018</p>
                            </div>
                            <div class='migration_cum'>
                                <h3>migration - cum - transfer certificate</h3>
                                <p>(For Condidates Leaving the University)</p>
                            </div>
                        </div>
                        <div style="padding: 0 20px 0 20px;margin-bottom: -28px;">
                            <div class="content content_pra">
                                <div class="first_line d-flex justify-content-between mt-3">
                                    <p>Sl. No. :<span1 style="font-weight: 600;">
                                            NSU/
                                            <?php echo $formattedSerialNumber ?>/
                                            <?= $year ?>
                                        </span1>
                                    </p>
                                    <p>Date : <span1 style="font-weight: 600;" id="certificateDate">[Date]</span1>
                                    </p>
                                </div>
                            </div>
                            <div class="content_all content_heading">
                                <p>Miss / Mr. / Mrs. : &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                    <span><b>
                                            <?php echo $row["admission_first_name"] ?>&nbsp;
                                            <?php echo $row["admission_middle_name"] ?>&nbsp;
                                            <?php echo $row["admission_last_name"] ?>
                                        </b>
                                    </span>
                                </p>
                                <p>S/o D/o W/o :
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><b>
                                            <?php echo $row["admission_father_name"]; ?>
                                        </b></span></p>
                                <p>Registration No. : &nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><b>
                                            <?php echo $row["reg_no"] ?>
                                        </b></span>
                                </p>
                                <p>Year of Registration :
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span>
                                        <?= explode('-', get_session($row["admission_session"]))[0]; ?>
                                    </span>
                                </p>
                                <p>Branch / Department :
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><b>
                                            <?php echo $row_course['course_name']; ?>
                                        </b></span></p>
                                <p
                                    style="margin-bottom: 0 !important;font-size: 19px;letter-spacing: 0.3px;line-height: 25px;">
                                    Is informed
                                    that the University has no objection to Her /His Migration to another
                                    University.</p>
                            </div>
                        </div>
                        <div class="migration_footer">
                            <div class="d-flex" style="padding: 0 40px 0 25px;">
                                <div>
                                    <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="Your Image"
                                        style="width: 55%;">
                                    <p style="font-size: 15px;font-weight: 500; text-transform: uppercase;">Administrative
                                        Officer</p>
                                </div>
                                <div class='reg'>
                                    <img src="data:image/jpeg;base64,<?php echo $base64Image2; ?>" alt="Registrar Image"
                                        style="width: 55%;">
                                    <p style="font-size: 15px;font-weight: 500;text-transform: uppercase;">Registrar</p>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="Your Image"
                                        style="width: 40%;">
                                    <p style="font-size: 15px;font-weight: 500; text-transform: uppercase;">Administrative
                                        Officer</p>
                                </div>
                                <div class="col-md-6 reg">
                                    <img src="data:image/jpeg;base64,<?php echo $base64Image2; ?>" alt="Registrar Image"
                                        style="width: 40%;">
                                    <p style="font-size: 15px;font-weight: 500;text-transform: uppercase;">Registrar</p>
                                </div>
                            </div> -->
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
                </div>
                <div class="col-md-2">

                </div>
            </div>
            </div>
        </section>






        <script>
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();

            var formattedDate = day + '-' + month + '-' + year;
            document.getElementById("certificateDate").textContent = formattedDate;
        </script>
        <!-- <script>
    window.onload = function() {
        window.print();
    };
    </script> -->
    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>