<?php
error_reporting(0);
if (isset($_POST["course_id"]) && isset($_POST["academic_year"])) {
    $page_no = "11";
    $page_no_inside = "11_6";
    include_once "include/authentication.php";
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $semester_id = $_POST["semester_id"];




    $sql = "SELECT * FROM `tbl_reg` WHERE `status` = '$visible' && `academic_year` = '$academic_year' && `course_id` = '$course_id'";
    $result = $con->query($sql);

    if ($result === false) {
        // Handle query errors here
        echo "Query error: " . $con->error;
    } else {
        ?>

<html>

<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    </style>
    <style>
    body {
        margin: 0;
        padding: 0;
        font: 12pt;
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .bor {
        border: 1px solid;
        margin: 10px;
    }

    .page {
        width: 21cm;
        min-height: 29.7cm;
        /* padding: 1cm; */
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        /*background-image:  url(images/marksheet/nsu_print_bg.png);*/
        background-size: cover;
        background-position: fixed;
        background-repeat: no-repeat;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 0cm;
        height: 256mm;
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
        position: fixed;
        left: 57px;
        bottom: 0;
        width: 88%;
        color: black;
        text-align: center;
    }

    .courseText h5 {
        font-size: 15px;
        text-align: center;
        margin-top: -24px;
    }

    .courseText h5 {
        font-size: 18px;
        text-align: center;
        margin-top: -24px;
    }

    .tableText {
        margin: 5px 0;
        margin-left: -28px;
    }

    .qr-code {
        position: relative;
    }

    .qr-code img {
        position: absolute;
        top: 0px;
        left: 50px;
    }

    label {
        font-weight: 500 !important;
    }

    strong {
        font-weight: 500;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        padding: 5px;
        /* Increase padding to increase cell size */
        text-align: left;
        border: 1px solid #dddddd;
    }


    table,
    th,
    td {
        border: 1px solid black;
        text-align: center;

    }
    </style>
</head>

<body>
    <div class="book">
        <?php

                while ($row = $result->fetch_assoc()) {

                    ?>
        <div class="page">
            <div class="bor">
                <div class="subpage">
                    <form action="">
                        <div class="row p-4 mt-3">
                            <div class="container">
                                <div class="row roww">
                                    <div class="col-6 offset-3 text-center">
                                        <h2 style="color: #c70013;font-weight: bolder;">
                                            <img src="uploads/logo1.png"
                                                style="width: 120px; margin-left: 0px; filter: invert(0);">
                                        </h2>
                                        <b style="font-size: 30;color: #c70013;">NETAJI SUBHAS UNIVERSITY</b>
                                        <p style="font-size: 20px;font-weight: 500;margin-bottom: 0;">Pokhari,
                                            Jamshedpur-(JH)</p>
                                        <p style="font-size: 18px;font-weight: 700;color: #c70013;margin-bottom: 0;">
                                            Registration Form</p>
                                        <?php
 $sql = "SELECT * FROM `tbl_university_details`
 WHERE `status` = '$visible' && university_details_id = '" .
 $row['academic_year'] .
 "'
 ORDER BY `university_details_id` DESC
 ";
 $result = $con->query($sql);
 $rows = $result->fetch_assoc();
 $completeSessionStart = explode("-",
 $rows["university_details_academic_start_date"]);
 $completeSessionEnd = explode("-",
 $rows["university_details_academic_end_date"]);
 $completeSessionOnlyYear = $completeSessionStart[0] . "-" .
 $completeSessionEnd[0];
                                                    ?>
                                        <p style="font-weight: 700;font-size: 15px;">(Session
                                            <?php echo $completeSessionOnlyYear; ?>)
                                        </p>

                                    </div>
                                    <div class="col-3 text-center" style="margin-top: 25px;">
                                        <img src="student/uploads/registered_student/passport_photos/<?php echo $row["passport_photo"]; ?>"
                                            alt="Passport Image"
                                            style="border: 2px solid gray;float: right;filter: invert(0); width: 80%;">
                                        <img src="student/uploads/registered_student/signatures/<?php echo $row["candidate_signature"]; ?>"
                                            alt="Student Sign"
                                            style="border: 2px solid gray;float: right;filter: invert(0); width: 80%; height: 20%;">
                                    </div>
                                </div>
                            </div>

                            <style>
                            .container {
                                display: flex;
                                justify-content: center;
                            }

                            .roww {
                                height: 275px;
                                width: 100%;
                                /* max-width: 800px; */
                                /* Adjust this width according to your layout */
                            }
                            </style>



                            <div class="col-12">
                                <p><strong style="padding-right: 10px;">1.</strong>A). Programme Applied for
                                    ______________________________________________________<br>
                                    <span style="margin-left: 25px;"> Preference - Branch /
                                        Specialization / Hons. :- ___________________________________________</span>
                                </p>
                                <p><strong style="padding-right: 10px;"></strong>B). Registration Amount Paid (Rs _____)
                                    through
                                    <b>CASH/CHEQUE/NEFT/UPI/NETBANKING</b>
                                </p>
                            </div>
                        </div>

                        <div class="row p-4">
                            <div class="col-6 text-center">
                                <label>&nbsp;&nbsp;<strong>2. NSU registration / Admission Enrollment No. (if
                                        any)</strong>&nbsp;&nbsp;</label>
                                <p class='text-muted'>To be filled by the Office</p>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][0]))
                                                            echo strtoupper($row["reg_id"])[0]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][1]))
                                                            echo strtoupper($row["reg_id"])[1]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][2]))
                                                            echo strtoupper($row["reg_id"])[2]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][3]))
                                                            echo strtoupper($row["reg_id"])[3]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][4]))
                                                            echo strtoupper($row["reg_id"])[4]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][5]))
                                                            echo strtoupper($row["reg_id"])[5]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][6]))
                                                            echo strtoupper($row["reg_id"])[6]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][7]))
                                                            echo strtoupper($row["reg_id"])[7]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][8]))
                                                            echo strtoupper($row["reg_id"])[8]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][9]))
                                                            echo strtoupper($row["reg_id"])[9]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["reg_id"][10]))
                                                            echo strtoupper($row["reg_id"])[10]; ?>">
                                    </div>
                                </div>




                            </div>
                            <div class="col-6 text-center">
                                <label>&nbsp;&nbsp;<strong style="color: white;">NSU registration / Admission Enrollment
                                        No.
                                        (if any)</strong>&nbsp;&nbsp;</label>
                                <p class='text-muted'>To be filled by the candidate</p>
                                <div class="form-group">
                                    <div class="input-group ">

                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][0]))
                                                            echo strtoupper($row["roll_no"])[0]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][1]))
                                                            echo strtoupper($row["roll_no"])[1]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][2]))
                                                            echo strtoupper($row["roll_no"])[2]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][3]))
                                                            echo strtoupper($row["roll_no"])[3]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][4]))
                                                            echo strtoupper($row["roll_no"])[4]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][5]))
                                                            echo strtoupper($row["roll_no"])[5]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][6]))
                                                            echo strtoupper($row["roll_no"])[6]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][7]))
                                                            echo strtoupper($row["roll_no"])[7]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][8]))
                                                            echo strtoupper($row["roll_no"])[8]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][9]))
                                                            echo strtoupper($row["roll_no"])[9]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["roll_no"][10]))
                                                            echo strtoupper($row["roll_no"])[10]; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group mb-1">
                                        <label>&nbsp;&nbsp;<strong>3. Name of the Candidate</strong>&nbsp;&nbsp;</label>
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][0]))
                                                            echo strtoupper($row["candidate_name"])[0]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][1]))
                                                            echo strtoupper($row["candidate_name"])[1]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][2]))
                                                            echo strtoupper($row["candidate_name"])[2]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][3]))
                                                            echo strtoupper($row["candidate_name"])[3]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][4]))
                                                            echo strtoupper($row["candidate_name"])[4]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][5]))
                                                            echo strtoupper($row["candidate_name"])[5]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][6]))
                                                            echo strtoupper($row["candidate_name"])[6]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][7]))
                                                            echo strtoupper($row["candidate_name"])[7]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][8]))
                                                            echo strtoupper($row["candidate_name"])[8]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][9]))
                                                            echo strtoupper($row["candidate_name"])[9]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][10]))
                                                            echo strtoupper($row["candidate_name"])[10]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][11]))
                                                            echo strtoupper($row["candidate_name"])[11]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][12]))
                                                            echo strtoupper($row["candidate_name"])[12]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][13]))
                                                            echo strtoupper($row["candidate_name"])[13]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][14]))
                                                            echo strtoupper($row["candidate_name"])[14]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][15]))
                                                            echo strtoupper($row["candidate_name"])[15]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][16]))
                                                            echo strtoupper($row["candidate_name"])[16]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][17]))
                                                            echo strtoupper($row["candidate_name"])[17]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][18]))
                                                            echo strtoupper($row["candidate_name"])[18]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][19]))
                                                            echo strtoupper($row["candidate_name"])[19]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["candidate_name"][20]))
                                                            echo strtoupper($row["candidate_name"])[20]; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-8 text-center">
                                <label>&nbsp;&nbsp;<strong>4. Date of Birth</strong>&nbsp;&nbsp;</label>
                                <div class="form-group">
                                    <div class="input-group ">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][0]))
                                                            echo strtoupper($row["DOB"])[0]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][1]))
                                                            echo strtoupper($row["DOB"])[1]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][2]))
                                                            echo strtoupper($row["DOB"])[2]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][3]))
                                                            echo strtoupper($row["DOB"])[3]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][4]))
                                                            echo strtoupper($row["DOB"])[4]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][5]))
                                                            echo strtoupper($row["DOB"])[5]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][6]))
                                                            echo strtoupper($row["DOB"])[6]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][7]))
                                                            echo strtoupper($row["DOB"])[7]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][8]))
                                                            echo strtoupper($row["DOB"])[8]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["DOB"][8]))
                                                            echo strtoupper($row["DOB"])[8]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <label>&nbsp;&nbsp;<strong>5. Gender</strong>&nbsp;&nbsp;</label>
                                <div class="form-group">
                                    <div class="input-group ">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["gender"][0]))
                                                            echo strtoupper($row["gender"])[0]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["gender"][1]))
                                                            echo strtoupper($row["gender"])[1]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["gender"][2]))
                                                            echo strtoupper($row["gender"])[2]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["gender"][3]))
                                                            echo strtoupper($row["gender"])[3]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["gender"][4]))
                                                            echo strtoupper($row["gender"])[4]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["gender"][5]))
                                                            echo strtoupper($row["gender"])[5]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row mx-3">
                                    <div class="col-md-6">
                                        <label><strong>6. Category(Gen/OBC/ST/Other)</strong></label>&nbsp;&nbsp; <span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["category"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>7. Disability, if any (VN/HH/OH)</strong></label>
                                        &nbsp;&nbsp;<span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["disablility"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group mb-1">
                                        <label>&nbsp;&nbsp;<strong>8. Father's Name</strong>&nbsp;&nbsp;</label>
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][0]))
                                                            echo strtoupper($row["father_name"])[0]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][1]))
                                                            echo strtoupper($row["father_name"])[1]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][2]))
                                                            echo strtoupper($row["father_name"])[2]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][3]))
                                                            echo strtoupper($row["father_name"])[3]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][4]))
                                                            echo strtoupper($row["father_name"])[4]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][5]))
                                                            echo strtoupper($row["father_name"])[5]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][6]))
                                                            echo strtoupper($row["father_name"])[6]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][7]))
                                                            echo strtoupper($row["father_name"])[7]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][8]))
                                                            echo strtoupper($row["father_name"])[8]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][9]))
                                                            echo strtoupper($row["father_name"])[9]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][10]))
                                                            echo strtoupper($row["father_name"])[10]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][11]))
                                                            echo strtoupper($row["father_name"])[11]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][12]))
                                                            echo strtoupper($row["father_name"])[12]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][13]))
                                                            echo strtoupper($row["father_name"])[13]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][14]))
                                                            echo strtoupper($row["father_name"])[14]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][15]))
                                                            echo strtoupper($row["father_name"])[15]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][16]))
                                                            echo strtoupper($row["father_name"])[16]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][17]))
                                                            echo strtoupper($row["father_name"])[17]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][18]))
                                                            echo strtoupper($row["father_name"])[18]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][19]))
                                                            echo strtoupper($row["father_name"])[19]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["father_name"][20]))
                                                            echo strtoupper($row["father_name"])[20]; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <div class="input-group mb-1">
                                        <label>&nbsp;&nbsp;<strong>9. Mother's Name</strong>&nbsp;&nbsp;</label>
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][0]))
                                                            echo strtoupper($row["mother_name"])[0]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][1]))
                                                            echo strtoupper($row["mother_name"])[1]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][2]))
                                                            echo strtoupper($row["mother_name"])[2]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][3]))
                                                            echo strtoupper($row["mother_name"])[3]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][4]))
                                                            echo strtoupper($row["mother_name"])[4]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][5]))
                                                            echo strtoupper($row["mother_name"])[5]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][6]))
                                                            echo strtoupper($row["mother_name"])[6]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][7]))
                                                            echo strtoupper($row["mother_name"])[7]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][8]))
                                                            echo strtoupper($row["mother_name"])[8]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][9]))
                                                            echo strtoupper($row["mother_name"])[9]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][10]))
                                                            echo strtoupper($row["mother_name"])[10]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][11]))
                                                            echo strtoupper($row["mother_name"])[11]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][12]))
                                                            echo strtoupper($row["mother_name"])[12]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][13]))
                                                            echo strtoupper($row["mother_name"])[13]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][14]))
                                                            echo strtoupper($row["mother_name"])[14]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][15]))
                                                            echo strtoupper($row["mother_name"])[15]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][16]))
                                                            echo strtoupper($row["mother_name"])[16]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][17]))
                                                            echo strtoupper($row["mother_name"])[17]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][18]))
                                                            echo strtoupper($row["mother_name"])[18]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][19]))
                                                            echo strtoupper($row["mother_name"])[19]; ?>">
                                        <input id="" name="" type="text"
                                            class="form-control p-0 text-center otp-text remove-spin" value="<?php if (isset($row["mother_name"][20]))
                                                            echo strtoupper($row["mother_name"])[20]; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label>&nbsp;&nbsp;<strong>10. (a) In case the candidate is in guardianship other than
                                        mother and father,
                                        specify
                                        name and relationship.</strong>&nbsp;&nbsp;</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong>Name</strong></label>&nbsp;&nbsp; <span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["guardian_name"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>Relationship</strong></label> &nbsp;&nbsp;<span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["guardian_relation"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex mt-2" style="justify-content: space-between;">
                                <div>
                                    <label><strong>11. Residence Status</strong></label>&nbsp;&nbsp; <span
                                        style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                        <?php echo $row["residence_status"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>
                                </div>
                                <div>
                                    <label><strong>12. Blood Group</strong></label>&nbsp;&nbsp; <span
                                        style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                        <?php echo $row["blood"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>
                                </div>
                                <div>
                                    <label><strong>13. Marital Status</strong></label>&nbsp;&nbsp; <span
                                        style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                        <?php echo $row["matrial_status"]; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label><strong>14. Parents / Guardians Occupation:</strong>
                                            &nbsp;&nbsp;<strong>Father</strong></label>&nbsp;&nbsp; <span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["father_occu"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>Mother</strong></label> &nbsp;&nbsp;<span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["mother_occu"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label><strong>15. Parents / Guardians Education:</strong>
                                            &nbsp;&nbsp;<strong>Father</strong></label>&nbsp;&nbsp; <span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["father_edu"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label><strong>Mother</strong></label> &nbsp;&nbsp;<span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["mother_edu"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label><strong>16. Religion</strong></label>&nbsp;&nbsp; <span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["religion"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label> <strong>17. Nationality</strong></label> &nbsp;&nbsp;<span
                                            style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                            <?php echo $row["nationality"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mt-2">
                                <label>&nbsp;&nbsp;<strong>18. Details of Examination
                                        Passed/Appeared.</strong>&nbsp;&nbsp;</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table border="1">
                                            <tr>
                                                <th>Examination</th>
                                                <th>Year of Passing</th>
                                                <th>School/College</th>
                                                <th>Name of Board/Univ.</th>
                                                <th>Max. Marks</th>
                                                <th>Marks Obtained</th>
                                                <th>% of Marks/Grade</th>
                                                <th>Medium of Instruction</th>
                                                <th>Discipline</th>
                                            </tr>
                                            <tr>
                                                <td>10th(Secondary)</td>
                                                <td>
                                                    <?php echo $row["tpassing_year"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["tschool_college"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["tboard_name"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["tmax_marks"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["tmarks_obtained"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["tpercentage_grade"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["tmedium_instruction"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["tdiscipline"]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>12th(Sr. Secondary)</td>
                                                <td>
                                                    <?php echo $row["twpassing_year"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["twschool_college"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["twboard_name"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["twmax_marks"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["twmarks_obtained"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["twpercentage_grade"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["twmedium_instruction"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["twdiscipline"]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Graduation</td>
                                                <td>
                                                    <?php echo $row["gpassing_year"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["gschool_college"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["gboard_name"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["gmax_marks"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["gmarks_obtained"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["gpercentage_grade"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["gmedium_instruction"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["gdiscipline"]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Post Graduation</td>
                                                <td>
                                                    <?php echo $row["postpassing_year"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["postschool_college"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["postboard_name"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["postmax_marks"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["postmarks_obtained"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["postpercentage_grade"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["postmedium_instruction"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["postdiscipline"]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Professional Degree</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Other Qualification</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                </div>
                </form>
                <div class="page" style="margin-top: 600px;">
                    <div class="subpage">
                        <form action="">
                            <div class="row p-4 mt-3">
                                <div class="container">
                                    <div class="col-12">
                                        <label>&nbsp;&nbsp;<strong>19. Details of Examination
                                                Passed/Appeared.</strong>&nbsp;&nbsp;</label>
                                        <div class="row">
                                            <div class="col-md-6" style="border: 1px solid grey;">
                                                <strong>Permanent Address</strong>
                                                <p><span
                                                        style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                        <?php echo $row["parnament_adr"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </span></p>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p>Dist <span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["parnament_dist"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Pin No<span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["parnament_pin"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>State <span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["parnament_state"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Country <span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["parnament_country"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="border: 1px solid grey;">
                                                <strong>Correspondence Address</strong>
                                                <p><span
                                                        style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                        <?php echo $row["corr_adr"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </span></p>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p>Dist <span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["corr_dist"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Pin No<span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["corr_pin"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>State <span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["corr_state"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Country <span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["corr_country"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-4 mt-3">
                                <div class="container">
                                    <div class="col-12">
                                        <label>&nbsp;&nbsp;<strong>20. Contacts:</strong>&nbsp;&nbsp;</label>
                                        <div class="row">
                                            <div class="col-md-6" style="border: 1px solid grey;">
                                                <strong>Student Contacts:</strong>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><strong>Telephone No</strong><span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["stelephone"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="input-group mb-1">
                                                                <label>&nbsp;&nbsp;<strong>Mobile
                                                                        No</strong>&nbsp;&nbsp;</label>
                                                                <input id="" name="" type="text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][0]))
                                                                                    echo strtoupper($row["smob"])[0]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][1]))
                                                                                    echo strtoupper($row["smob"])[1]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][2]))
                                                                                    echo strtoupper($row["smob"])[2]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][3]))
                                                                                    echo strtoupper($row["smob"])[3]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][4]))
                                                                                    echo strtoupper($row["smob"])[4]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][5]))
                                                                                    echo strtoupper($row["smob"])[5]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][6]))
                                                                                    echo strtoupper($row["smob"])[6]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][7]))
                                                                                    echo strtoupper($row["smob"])[7]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][8]))
                                                                                    echo strtoupper($row["smob"])[8]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["smob"][9]))
                                                                                    echo strtoupper($row["smob"])[9]; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12">
                                                        <div class="form-group">
                                                            <div class="input-group mb-1">
                                                                <label>&nbsp;&nbsp;<strong>What App
                                                                        No</strong>&nbsp;&nbsp;</label>
                                                                <input id="" name="" type="text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][0]))
                                                                                    echo strtoupper($row["swhatsapp"])[0]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][1]))
                                                                                    echo strtoupper($row["swhatsapp"])[1]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][2]))
                                                                                    echo strtoupper($row["swhatsapp"])[2]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][3]))
                                                                                    echo strtoupper($row["swhatsapp"])[3]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][4]))
                                                                                    echo strtoupper($row["swhatsapp"])[4]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][5]))
                                                                                    echo strtoupper($row["swhatsapp"])[5]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][6]))
                                                                                    echo strtoupper($row["swhatsapp"])[6]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][7]))
                                                                                    echo strtoupper($row["swhatsapp"])[7]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][8]))
                                                                                    echo strtoupper($row["swhatsapp"])[8]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["swhatsapp"][9]))
                                                                                    echo strtoupper($row["swhatsapp"])[9]; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <p><strong>Email Id</strong> <span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["smail"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="border: 1px solid grey;">
                                                <strong>Parent Contacts:</strong>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><strong>Telephone No</strong><span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["ptelephone"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="input-group mb-1">
                                                                <label>&nbsp;&nbsp;<strong>Mobile
                                                                        No</strong>&nbsp;&nbsp;</label>
                                                                <input id="" name="" type="text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][0]))
                                                                                    echo strtoupper($row["pmob"])[0]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][1]))
                                                                                    echo strtoupper($row["pmob"])[1]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][2]))
                                                                                    echo strtoupper($row["pmob"])[2]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][3]))
                                                                                    echo strtoupper($row["pmob"])[3]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][4]))
                                                                                    echo strtoupper($row["pmob"])[4]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][5]))
                                                                                    echo strtoupper($row["pmob"])[5]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][6]))
                                                                                    echo strtoupper($row["pmob"])[6]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][7]))
                                                                                    echo strtoupper($row["pmob"])[7]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][8]))
                                                                                    echo strtoupper($row["pmob"])[8]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pmob"][9]))
                                                                                    echo strtoupper($row["pmob"])[9]; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12">
                                                        <div class="form-group">
                                                            <div class="input-group mb-1">
                                                                <label>&nbsp;&nbsp;<strong>What App
                                                                        No</strong>&nbsp;&nbsp;</label>
                                                                <input id="" name="" type="text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][0]))
                                                                                    echo strtoupper($row["pwhatsapp"])[0]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][1]))
                                                                                    echo strtoupper($row["pwhatsapp"])[1]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][2]))
                                                                                    echo strtoupper($row["pwhatsapp"])[2]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][3]))
                                                                                    echo strtoupper($row["pwhatsapp"])[3]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][4]))
                                                                                    echo strtoupper($row["pwhatsapp"])[4]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][5]))
                                                                                    echo strtoupper($row["pwhatsapp"])[5]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][6]))
                                                                                    echo strtoupper($row["pwhatsapp"])[6]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][7]))
                                                                                    echo strtoupper($row["pwhatsapp"])[7]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][8]))
                                                                                    echo strtoupper($row["pwhatsapp"])[8]; ?>">
                                                                <input id="" name="" type=" text"
                                                                    class="form-control p-0 text-center otp-text remove-spin"
                                                                    value="<?php if (isset($row["pwhatsapp"][9]))
                                                                                    echo strtoupper($row["pwhatsapp"])[9]; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <p><strong>Email Id</strong> <span
                                                                style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                                <?php echo $row["pmail"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </span></p>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-12"
                                                style="border-bottom: 1px solid grey; border-left: 1px solid grey; border-right: 1px solid grey;">
                                                <p style="margin-bottom:0 !important;margin-top:10px;"><strong>Student's
                                                        Adhar (UID) No. :-</strong>
                                                    <span
                                                        style="border-bottom: 1px dashed #626262;text-transform: uppercase;font-size: 1.1rem;color: #495057;">
                                                        <?= $row["sadhar"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-12">
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <h6><b>UNDERTAKING:</b></h6>
                                                        <span>
                                                            I solemnly affirm that the information furnished above is
                                                            true
                                                            and correct in all
                                                            respect. I have not cocealed any information. I undertake
                                                            that
                                                            if any information
                                                            furnished herein is found to be incorrect or untrue, I shall
                                                            be
                                                            liable for criminal
                                                            prosecution and also forgo my claim to the University.
                                                            Further,
                                                            my candidature for
                                                            the examination/admission to the programme shall be liable
                                                            for
                                                            cancellation at any
                                                            stage. I agree to abide by the rules and regulations of the
                                                            University.
                                                        </span>
                                                    </div>
                                                    <div class="col-4 mt-3">
                                                        <span style="font-weight: 800;">
                                                            <?php
                                                                        $date = $row["submission_date"];
                                                                        $formattedDate = date("Y-m-d", strtotime($date));
                                                                        echo $formattedDate;
                                                                        ?>
                                                        </span>
                                                        <br>
                                                        <p>
                                                            Date
                                                        </p>
                                                    </div>
                                                    <div class="col-4 mt-3"><span style="font-weight: 800;">
                                                        </span>
                                                        <br>Signature of Parent/Guardian
                                                    </div>
                                                    <div class="col-4 mt-3">
                                                        <span style="font-weight: 800;">
                                                        </span>
                                                        <br>Signature of Student
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container mt-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h4 class="text-uppercase font-weight-bold text-center"
                                                            style="text-decoration: underline;">
                                                            Checklist of Verified Documents & Enclosure
                                                        </h4>
                                                    </div>

                                                    <table style="width: 95%;">
                                                        <tbody>
                                                            <tr>
                                                                <td>1.</td>
                                                                <td>High School (10th Standard) Mark Sheet</td>
                                                                <td>Attested Photocopy</td>

                                                            </tr>
                                                            <tr>
                                                                <td>2.</td>
                                                                <td>High School (10th Standard) Certificate</td>
                                                                <td>Attested Photocopy</td>

                                                            </tr>
                                                            <tr>
                                                                <td>3.</td>
                                                                <td>High School (12th Standard) Mark Sheet</td>
                                                                <td>Attested Photocopy</td>

                                                            </tr>
                                                            <tr>
                                                                <td>4.</td>
                                                                <td>High School (12th Standard) Certificate</td>
                                                                <td>Attested Photocopy</td>

                                                            </tr>
                                                            <tr>
                                                                <td>5.</td>
                                                                <td>Bachelor's Degree/Equivalent Examination Mark Sheet
                                                                    (all
                                                                    semesters/years/consolidated)</td>
                                                                <td>Attested Photocopy</td>

                                                            </tr>
                                                            <tr>
                                                                <td>6.</td>
                                                                <td>Bachelor's Degree/Equivalent Examination Degree</td>
                                                                <td>Attested Photocopy</td>

                                                            </tr>
                                                            <tr>
                                                                <td>7.</td>
                                                                <td>Master's Degree/Equivalent Examination Mark Sheet
                                                                    (all
                                                                    semesters/years/consolidated)</td>
                                                                <td>Attested Photocopy</td>

                                                            </tr>
                                                            <tr>
                                                                <td>8.</td>
                                                                <td>Master's Degree/Equivalent Examnination Degree</td>
                                                                <td>Attested Photocopy</td>

                                                            </tr>
                                                            <tr>
                                                                <td>9.</td>
                                                                <td>Transfer certificate <b>(College/School Leaving
                                                                        Certificate)</b></td>
                                                                <td>Original</td>

                                                            </tr>
                                                            <tr>
                                                                <td>10.</td>
                                                                <td>Migration certificate</b></td>
                                                                <td>Original</td>

                                                            </tr>
                                                            <tr>
                                                                <td>11.</td>
                                                                <td>Adhar (UID) Card</b></td>
                                                                <td>Self Attested Photocopy</td>

                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                    <div class="col-12">
                                                        <p class='mt-2'>The above documents have been verified and found
                                                            in
                                                            order as per the
                                                            requirement of
                                                            the University registration Process.</p>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-between mt-5">
                                                        <div>
                                                            Seal of the University
                                                        </div>

                                                        <div>
                                                            Approved / Not Approved
                                                        </div>
                                                        <div>
                                                            Signature of Registerar
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page script -->
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <script>
    window.print();
    </script>

</body>

</html>
<?php
    }
}
?>