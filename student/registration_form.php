<?php
error_reporting(0);
$page_no = "10";
$page_no_inside = "10_1";
include "include/authentication.php";
$row = $_SESSION['user'];
$course_id = $row["admission_course_name"];
$academic_yearId = $_SESSION['user']["admission_session"];
$_SESSION['user']["admission_id"];
$admission_id = $_SESSION['user']["admission_id"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Registration Form </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .form-control {
        font-weight: 900 !important;
        color: #ad183a !important;
        margin-bottom: 15px;
    }

    .card-secondary:not(.card-outline)>.card-header {
        background-color: #e3b020 !important;
    }

    .responsive-container {
        width: 90%;
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffc107;
        color: white;
        padding: 10px;
        text-align: center;
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
        .responsive-container {
            width: 95%;
            padding: 15px;
        }

        .responsive-container h1 {
            font-size: 1.5rem;
            /* Adjust the font size for smaller screens */
        }
    }
    </style>
</head>

<body class="hold-transition sidebar-mini" oncontextmenu="return false;">
    <?php include 'imp_notice.php'; ?>
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-10">
                            <h1>REGISTRATION FORM - For University Campus Programme</h1>
                        </div>
                        <div class="col-sm-2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <?php



            $sql_sem = "SELECT * FROM `tbl_reg_semester`
            WHERE `course_id`='" . $row['admission_course_name'] . "' && `fee_academic_year`='" . $row['admission_session'] . "' ";
            $sem_result = $con->query($sql_sem);
            $sem_row = $sem_result->fetch_assoc();
   
            $today = date("Y-m-d");
          
            $sql_semester = "SELECT * FROM `tbl_semester`
            WHERE `semester_id`='" . $sem_row['semester_id'] . "' ";
            $semester_result = $con->query($sql_semester);
            $semester_row = $semester_result->fetch_assoc();
            $semester_name = $semester_row['semester'];

            if ($sem_row['form_start_date'] == "") {
            ?>
            <div class="responsive-container">
                <h1>University Registration Form Haven't Started Yet.</h1>
            </div>
            <?php
            } elseif ($sem_row['form_close_date'] != "" && strtotime($sem_row['form_close_date'] . ' 23:59:59') < time()) {
            ?>
            <div class="responsive-container">
                <h3>Registration date is over.<br>New dates will be announced later.<br>पंजीकरण की तारीख समाप्त हो गई
                    हैI<br>नई तारीखों की घोषणा बाद में की जाएगीI</h3>
            </div>
            <?php
            if (isset($_SESSION['user']["admission_id"])) {
                $admission_id = $_SESSION['user']["admission_id"];
        
                // Include your database connection file
                include('db_connection.php');  // Assuming this is your database connection file
        
                // Prepare the SQL query to fetch registration form data for the logged-in user
                $sql3 = "SELECT * FROM `tbl_registration_form` WHERE `admission_id` = ?";
                $stmt = $con->prepare($sql3);
                $stmt->bind_param("i", $admission_id);
                $stmt->execute();
                $result = $stmt->get_result();
        
                // If data is found, display it
                if ($result->num_rows > 0) {
                    // Fetch the data
                    $rowww = $result->fetch_assoc();
                    ?>
            <!-- Registration Form with Print Button -->
            <div class='text-center'>

                <h5 class='mt-3' style='margin-bottom:0px!important;'><b>NOTE:</b>If you have already filled up the
                    <b><u>University
                            Registration
                            Form</u></b>,
                    you can
                    download
                    it
                    by
                    clicking
                    the
                    button
                    below:
                </h5>

                <!-- Registration Form with Print Button -->
                <form action="print-registration.php" method="POST">
                    <input type="hidden" name="academic_year" value="<?= htmlspecialchars($academic_year) ?>">
                    <input type="hidden" name="admission_id" value="<?= htmlspecialchars($admission_id) ?>">
                    <input type="hidden" name="course_id" value="<?= htmlspecialchars($course_id) ?>">
                    <button class="print-button btn btn-success btn-sm" type="submit">
                        <i class="fas fa-print"></i> Print Form
                    </button>
                </form>
            </div>
            <?php
                } else {
                    echo "<p>No data found for the given admission_id.</p>";
                }
        
                // Close the prepared statement
                $stmt->close();
            } else {
                echo "<p>User not logged in.</p>";
            }
            
            
            
            } else {
            ?>
            <section class="content">
                <div class="container-fluid">

                    <div class="card card-default">
                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body">

                                <div class="row">
                                    <?php

$status_row = fetchRow('tbl_fee_status', '`admission_id`=' . $row["admission_id"] .
    '');
if (isset($sem_row['form_start_date']) && $today >= $sem_row['form_start_date']) {
    if (isset($status_row['reg_status']) && $status_row["reg_status"] == 'Approve') {

        ?>
                                    <div class="card card-secondary" style="width: -webkit-fill-available;">
                                        <div class="card-header">
                                            <h3 class="card-title">INSTRUCTIONS FOR FILLING UP THE REGISTRATION
                                                FORM:
                                            </h3>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <div class="card-body">
                                                <ul>

                                                    <li>In case, wrong / invalid course or subject code is
                                                        mentioned in
                                                        Registration form, the
                                                        Admit Card will not be issued.</li>
                                                    <li>Submit Registration form within the due date.</li>
                                                    <li>It is advised to enclose required documents to complete
                                                        registration form.</li>
                                                    <li>Registration is valid for only enrolled Course.</li>
                                                    <li>The enrolment number, subject code, papers’ name are
                                                        correctly
                                                        filled in the registration
                                                        form.</li>
                                                    <li> Registration fees once paid, not refundable / adjusted
                                                        in any
                                                        case.</li>
                                                    <li> The correct size of a passport photo and candidate
                                                        signature is
                                                        must within between 50KB
                                                    </li>
                                                </ul><br><br><br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Course Name</label>
                                                            <input type="hidden" name="academic_year"
                                                                value="<?php echo $row["academic_year"]; ?>">
                                                            <?php
                                                                    $sql_course = "SELECT * FROM `tbl_course`
															   WHERE `status` = '$visible';
															   ";
                                                                    $result_course = $con->query($sql_course);
                                                                    while ($row_course = $result_course->fetch_assoc()) {
                                                                        if ($course_id == $row_course["course_id"]) {

                                                                          $p_t =  $row_course["program_type"];
                                                                    ?>
                                                            <input onchange="showdesg1(this.value)" type="hidden"
                                                                name="course_id" id="course_id"
                                                                value="<?php echo $course_id ?>">
                                                            <input type="hidden" name="academic_year" id="academic_year"
                                                                value="<?php echo $academic_yearId ?>">
                                                            <input class="form-control  rounded-pill" name=""
                                                                id="course_id"
                                                                value="<?php echo $row_course["course_name"]; ?>"
                                                                readonly>
                                                            <input type="hidden" class="form-control  rounded-pill"
                                                                name="program_type" id="program_type"
                                                                value="<?php echo $row_course["program_type"]; ?>"
                                                                readonly>
                                                            <?php }
                                                                    } ?>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-4">
                                                                    <div class="form-group">
                                                                        <label>Semester</label>
                                                                        <input type="hidden" name="subject_id">
                                                                        <select class="form-control  rounded-pill"
                                                                            name="semester_id" id="sem" required>
                                                                            <option value="<?= $sem_row['semester_id'] ?>">
                                                                                <?= $semester_name ?>
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div> -->
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Program Type</label>
                                                            <input class="form-control  rounded-pill" name="" id=""
                                                                value="<?php echo $p_t; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Registration Fee</label>
                                                            <input type="text" class="form-control  rounded-pill"
                                                                name="amount" id="amount" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                            } else {
                                            ?>
                                    <h4 style='color:red;'>Dear
                                        <?php echo ucfirst($_SESSION["user"]["admission_first_name"]); ?>, Please Clear
                                        Your Dues fee to fill up your form.</h4>
                                    <br>
                                    <h4 style='color:red;'>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </h4>
                                    <br>
                                    <div class="alert alert-danger"
                                        style="border-left: 5px solid #17a2b8; padding: 20px; margin: 25px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        <h4 style="color: #17a2b8; margin-bottom: 15px; font-weight: 600;"><i
                                                class="fas fa-info-circle"></i> Important Notice</h4>
                                        <p style="font-size: 16px; line-height: 1.6; color: #fff;">Dear student, we
                                            notice that either:</p>
                                        <ul style="margin: 15px 0; padding-left: 25px; color: #fff;">
                                            <li style="margin-bottom: 8px;">Your 1st installment fee payment is pending,
                                                or</li>
                                            <li>Your payment verification is in process.</li>
                                        </ul>
                                        <p style="margin-top: 15px;">Please <a href="payment_status"
                                                style="color: #17a2b8; text-decoration: none; font-weight: 600; border-bottom: 2px solid #17a2b8; padding-bottom: 2px; transition: all 0.3s ease;">click
                                                here</a> to check your payment status and complete the process if
                                            required.</p>
                                    </div>
                                    <?php
                                    }

                                        } else {

                                            if (isset($sem_row['form_start_date']) && $today <= $sem_row['form_start_date']) { ?>
                                    <h4 class="text-warning">Dear <strong class="text-dark">
                                            <?= ucfirst($_SESSION['user']["admission_first_name"]) ?>
                                        </strong> University Registration Form Start Form
                                        <?= date('d-M-Y', strtotime($sem_row['form_start_date'])) ?> .
                                    </h4>;

                                    <?php } else { ?>
                                    <!-- <h4 class="text-warning">Dear <strong class="text-dark">
                                            <?= ucfirst($_SESSION['user']["admission_first_name"]) ?>
                                        </strong> University Registration has been closed on this date
                                        <?= date('d-M-Y', strtotime($sem_row['form_close_date'])) ?> .
                                    </h4>; -->
                                    <h4 class="text-warning">Dear <strong class="text-dark">
                                            <?= ucfirst($_SESSION['user']["admission_first_name"]) ?>
                                        </strong> Registration date is over.</br>New dates will be announced
                                        later.</br>पंजीकरण की तारीख समाप्त हो गई है I</br>नई तारीखों की घोषणा
                                        बाद में की जाएगी I
                                    </h4>;

                                    <?php }
                                        }
                                        ?>
                                </div>
                            </div>
                        </form>
                        <div class="col-12" id="loader_section"></div>
                        <!-- /.card-header -->
                        <div class="card-body" id="data_table">

                        </div>
                    </div>
                </div>
            </section>
            <?php } ?>
            <!-- /.content -->
        </div>
        <script>
        function image_check(element, uploadImageSize) {
            var imgpath = element;
            console.log(element.files[0]);
            if (element.files[0].type == "image/jpeg" || element.files[0].type == "image/jpg" || element.files[0]
                .type == "image/jfif" || element.files[0]
                .type == "image/png" || element.files[0].type == "application/pdf") {
                if (!imgpath.value == "") {

                    var img = imgpath.files[0].size;
                    var imgsize = Math.round(img / 1024);
                    if (imgsize > uploadImageSize) {
                        alert("Image size is " + imgsize + " KB please Upload  Image smaller than " +
                            uploadImageSize +
                            " KB");
                        element.value = "";
                    }
                }

            } else {
                alert("Image type must be jpg or jpeg or png or PDF only");
                element.value = "";
            }
        }
        </script>
        <?php include 'include/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
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
    <script>
    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }



    function fetch_data() {
        $('#loader_section').append(
            '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
        );
        $('#fetchStudentDataButton').prop('disabled', true);
        $.ajax({
            url: 'include/view.php?action=fetch_registrationn_form',
            type: 'POST',
            data: $('#fetchStudentDataForm').serializeArray(),
            success: function(result) {
                $('#response').remove();
                if (result == 0) {
                    $('#error_section').append(
                        '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                    );
                } else {
                    $('#data_table').append('<div id = "response">' + result + '</div>');
                }
                $('#loading').fadeOut(500, function() {
                    $(this).remove();
                });
                $('#fetchStudentDataButton').prop('disabled', false);
            }
        });
        event.preventDefault();
    }
    </script>
    <script>
    $(function() {
        function showdesg() {
            dept = <?= $course_id ?>;
            academic_year = <?= $academic_yearId ?>;
            $.ajax({
                url: '../ajaxdata4.php',
                type: 'POST',
                data: {
                    depart: dept,
                    academic_year: academic_year
                },
                success: function(data) {
                    $("#sem").html(data);
                },
            });
        }
    });
    </script>
    <script>
    showdesg1();

    function showdesg1() {
        var dept1 = document.getElementById('course_id').value
        $.ajax({
            url: 'ajaxdatareg.php',
            type: 'POST',
            data: {
                depart1: dept1
            },
            success: function(data) {
                $("#amount").val(data);
                fetch_data();
            },
        });

    }
    </script>

</body>

</html>